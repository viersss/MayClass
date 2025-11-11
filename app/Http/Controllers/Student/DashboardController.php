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
        $quizzesAvailable = Schema::hasTable('quizzes');

        $recentMaterials = $materialsAvailable
            ? Material::withCount(['chapters', 'objectives'])
                ->orderByDesc('created_at')
                ->take(4)
                ->get()
                ->map(function (Material $material) use ($materialsLink) {
                    return [
                        'slug' => $material->slug,
                        'subject' => $material->subject,
                        'title' => $material->title,
                        'summary' => $material->summary,
                        'level' => $material->level,
                        'chapter_count' => $material->chapters_count,
                        'objective_count' => $material->objectives_count,
                        'resource' => $material->resource_url ?? $materialsLink,
                        'accent' => SubjectPalette::accent($material->subject),
                    ];
                })
            : collect();

        $recentQuizzes = $quizzesAvailable
            ? Quiz::with(['levels' => fn ($query) => $query->orderBy('position')])
                ->orderByDesc('created_at')
                ->take(4)
                ->get()
                ->map(function (Quiz $quiz) use ($quizLink) {
                    return [
                        'slug' => $quiz->slug,
                        'title' => $quiz->title,
                        'summary' => $quiz->summary,
                        'duration' => $quiz->duration_label,
                        'questions' => $quiz->question_count,
                        'levels' => $quiz->levels->pluck('label')->all(),
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

        $levelSet = collect($materialLevels)->merge($quizLevels)->filter()->unique()->values();

        $upcomingTotal = $sessions
            ->filter(fn ($session) => $session->start_at && CarbonImmutable::parse($session->start_at)->isFuture())
            ->count();

        $weekSessions = $sessions
            ->filter(function ($session) {
                if (! $session->start_at) {
                    return false;
                }

                $start = CarbonImmutable::parse($session->start_at);
                $now = CarbonImmutable::now();

                return $start->isSameWeek($now);
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
}
