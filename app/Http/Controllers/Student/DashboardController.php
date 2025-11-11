<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\ScheduleSession;
use App\Support\ScheduleViewData;
use App\Support\SubjectPalette;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sessions = Schema::hasTable('schedule_sessions')
            ? ScheduleSession::orderBy('start_at')->get()
            : collect();
        $schedule = ScheduleViewData::fromCollection($sessions);

        $materialsLink = (string) config('mayclass.links.materials_drive');
        $quizLink = (string) config('mayclass.links.quiz_platform');

        $materialsAvailable = Schema::hasTable('materials');
        $materialChaptersReady = Schema::hasTable('material_chapters');
        $materialObjectivesReady = Schema::hasTable('material_objectives');
        $quizzesAvailable = Schema::hasTable('quizzes');
        $quizLevelsReady = Schema::hasTable('quiz_levels');

        $recentMaterials = $materialsAvailable
            ? Material::query()
                ->when($materialChaptersReady, fn ($query) => $query->withCount('chapters'))
                ->when($materialObjectivesReady, fn ($query) => $query->withCount('objectives'))
                ->orderByDesc('created_at')
                ->take(4)
                ->get()
                ->map(function (Material $material) use ($materialsLink, $materialChaptersReady, $materialObjectivesReady) {
                    return [
                        'slug' => $material->slug,
                        'subject' => $material->subject,
                        'title' => $material->title,
                        'summary' => $material->summary,
                        'level' => $material->level,
                        'chapter_count' => $materialChaptersReady ? (int) $material->chapters_count : 0,
                        'objective_count' => $materialObjectivesReady ? (int) $material->objectives_count : 0,
                        'resource' => $material->resource_url ?? $materialsLink,
                        'accent' => SubjectPalette::accent($material->subject),
                    ];
                })
            : collect();

        $recentQuizzes = $quizzesAvailable
            ? Quiz::query()
                ->when($quizLevelsReady, fn ($query) => $query->with(['levels' => fn ($levels) => $levels->orderBy('position')]))
                ->orderByDesc('created_at')
                ->take(4)
                ->get()
                ->map(function (Quiz $quiz) use ($quizLink, $quizLevelsReady) {
                    return [
                        'slug' => $quiz->slug,
                        'title' => $quiz->title,
                        'summary' => $quiz->summary,
                        'duration' => $quiz->duration_label,
                        'questions' => $quiz->question_count,
                        'levels' => $quizLevelsReady ? $quiz->levels->pluck('label')->all() : [],
                        'link' => $quiz->link ?? $quizLink,
                        'accent' => SubjectPalette::accent($quiz->subject),
                    ];
                })
            : collect();

        $materialsTotal = $materialsAvailable ? Material::count() : 0;
        $recentMaterialsCount = $materialsAvailable
            ? Material::where('created_at', '>=', now()->subDays(14))->count()
            : 0;
        $subjectsTotal = $materialsAvailable ? Material::distinct('subject')->count('subject') : 0;
        $materialLevels = $materialsAvailable
            ? Material::select('level')->distinct()->pluck('level')->filter()->values()->all()
            : [];

        $quizzesTotal = $quizzesAvailable ? Quiz::count() : 0;
        $recentQuizzesCount = $quizzesAvailable
            ? Quiz::where('created_at', '>=', now()->subDays(14))->count()
            : 0;
        $quizLevels = $quizzesAvailable
            ? Quiz::select('class_level')->distinct()->pluck('class_level')->filter()->values()->all()
            : [];

        $levelSet = collect($materialLevels)->merge($quizLevels);

        if ($quizLevelsReady && $quizzesAvailable) {
            $levelSet = $levelSet->merge(
                Quiz::query()
                    ->with(['levels' => fn ($levels) => $levels->orderBy('position')])
                    ->get()
                    ->flatMap(fn ($quiz) => $quiz->levels->pluck('label'))
            );
        }

        $levelSet = $levelSet->filter()->unique()->values();

        $upcomingTotal = $sessions
            ->filter(function ($session) {
                $start = $this->parseDate($session->start_at ?? null);

                return $start ? $start->isFuture() : false;
            })
            ->count();

        $weekSessions = $sessions
            ->filter(function ($session) {
                $start = $this->parseDate($session->start_at ?? null);

                return $start ? $start->isSameWeek(CarbonImmutable::now()) : false;
            })
            ->count();

        $activeEnrollment = Schema::hasTable('enrollments')
            ? Auth::user()
                ->enrollments()
                ->with('package')
                ->where('is_active', true)
                ->orderByDesc('ends_at')
                ->first()
            : null;

        return view('student.dashboard', [
            'page' => 'dashboard',
            'title' => 'Dashboard Siswa',
            'schedule' => $schedule,
            'recentMaterials' => $recentMaterials,
            'recentQuizzes' => $recentQuizzes,
            'metrics' => [
                'materials_total' => $materialsTotal,
                'recent_materials' => $recentMaterialsCount,
                'quizzes_total' => $quizzesTotal,
                'recent_quizzes' => $recentQuizzesCount,
                'upcoming_total' => $upcomingTotal,
                'week_sessions' => $weekSessions,
                'subjects_total' => $subjectsTotal,
                'levels_total' => $levelSet->count(),
            ],
            'activePackage' => $this->formatActivePackage($activeEnrollment),
            'materialsLink' => $materialsLink,
            'quizLink' => $quizLink,
        ]);
    }

    private function formatActivePackage(?Enrollment $enrollment): array
    {
        if (! $enrollment || ! $enrollment->package) {
            return [
                'title' => 'Belum ada paket aktif',
                'period' => 'Silakan pilih paket belajar untuk mulai.',
                'status' => 'Tidak aktif',
            ];
        }

        $package = $enrollment->package;
        $endDate = CarbonImmutable::parse($enrollment->ends_at);

        return [
            'title' => $package->detail_title,
            'period' => 'Aktif hingga ' . ScheduleViewData::formatFullDate($endDate),
            'status' => $endDate->isFuture() ? 'Berjalan' : 'Berakhir',
        ];
    }

    private function parseDate($value): ?CarbonImmutable
    {
        if (! $value) {
            return null;
        }

        try {
            return CarbonImmutable::parse($value);
        } catch (\Throwable $exception) {
            return null;
        }
    }
}
