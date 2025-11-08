<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\ScheduleSession;
use App\Support\ScheduleViewData;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:tutor']);
    }

    public function index()
    {
        $tutor = Auth::user();

        if ($tutor && Schema::hasTable('tutor_profiles')) {
            $tutor->loadMissing('tutorProfile');
        }

        $sessions = Schema::hasTable('schedule_sessions')
            ? ScheduleSession::query()
                ->when($tutor, function ($query) use ($tutor) {
                    $query->where('user_id', $tutor->id)
                        ->orWhere(function ($nested) use ($tutor) {
                            $nested->whereNull('user_id')
                                ->where('mentor_name', $tutor->name);
                        });
                })
                ->orderBy('start_at')
                ->get()
            : collect();

        $schedule = ScheduleViewData::fromCollection($sessions);
        $now = CarbonImmutable::now();

        $todaySessions = $this->formatSessions(
            $sessions->filter(fn ($session) => CarbonImmutable::parse($session->start_at)->isSameDay($now))
        );

        $upcomingSessions = $this->formatSessions(
            $sessions->filter(fn ($session) => CarbonImmutable::parse($session->start_at)->isFuture())->take(5)
        );

        $completedSessions = $sessions->filter(fn ($session) => CarbonImmutable::parse($session->start_at)->isPast());

        $stats = [
            'students' => Schema::hasTable('enrollments')
                ? Enrollment::where('is_active', true)->distinct('user_id')->count('user_id')
                : 0,
            'upcoming' => $upcomingSessions->count(),
            'materials' => Schema::hasTable('materials') ? Material::count() : 0,
            'quizzes' => Schema::hasTable('quizzes') ? Quiz::count() : 0,
        ];

        $weekStart = $now->startOfWeek();
        $weekEnd = $now->endOfWeek();

        $weekSessions = $sessions->filter(fn ($session) => $this->isWithinWeek($session, $weekStart, $weekEnd));
        $completedWeekSessions = $weekSessions
            ->filter(fn ($session) => CarbonImmutable::parse($session->start_at)->isPast())
            ->count();
        $weekProgress = $weekSessions->count() > 0
            ? (int) round(($completedWeekSessions / $weekSessions->count()) * 100)
            : 0;

        $activeStudents = Schema::hasTable('enrollments')
            ? $this->formatStudents(
                Enrollment::with(['user', 'package'])
                    ->where('is_active', true)
                    ->orderByDesc('starts_at')
                    ->get()
            )
            : collect();

        $materials = Schema::hasTable('materials')
            ? Material::orderByDesc('created_at')
                ->take(3)
                ->get()
                ->map(fn ($material) => [
                    'title' => $material->title,
                    'subject' => $material->subject,
                    'slug' => $material->slug,
                    'created_at' => optional($material->created_at)?->toImmutable(),
                ])
            : collect();

        $quizzes = Schema::hasTable('quizzes')
            ? Quiz::with('level')
                ->orderByDesc('created_at')
                ->take(3)
                ->get()
                ->map(fn ($quiz) => [
                    'title' => $quiz->title,
                    'subject' => $quiz->subject,
                    'slug' => $quiz->slug,
                    'level' => optional($quiz->level)->name,
                ])
            : collect();

        return view('tutor.dashboard', [
            'tutor' => $tutor,
            'tutorProfile' => Schema::hasTable('tutor_profiles') ? optional($tutor)->tutorProfile : null,
            'schedule' => $schedule,
            'todaySessions' => $todaySessions,
            'upcomingSessions' => $upcomingSessions,
            'completedSessionCount' => $completedSessions->count(),
            'stats' => $stats,
            'weekProgress' => [
                'percentage' => $weekProgress,
                'completed' => $completedWeekSessions,
                'total' => $weekSessions->count(),
            ],
            'students' => $activeStudents,
            'materials' => $materials,
            'quizzes' => $quizzes,
        ]);
    }

    private function formatSessions(Collection $sessions): Collection
    {
        return $sessions
            ->map(function (ScheduleSession $session) {
                $start = CarbonImmutable::parse($session->start_at);
                $end = $start->addMinutes(90);
                $details = ScheduleViewData::formatSession($session);

                $details['status'] = $start->isPast()
                    ? __('Selesai')
                    : ($start->isToday() ? __('Hari ini') : __('Mendatang'));
                $details['time_range'] = $start->format('H.i') . ' - ' . $end->format('H.i');
                $details['start_at_iso'] = $start->toIso8601String();
                $details['day_label'] = $start->locale('id')->translatedFormat('l');

                return $details;
            })
            ->values();
    }

    private function formatStudents(Collection $enrollments): Collection
    {
        return $enrollments
            ->unique('user_id')
            ->take(6)
            ->map(function (Enrollment $enrollment) {
                $user = $enrollment->user;
                $package = $enrollment->package;
                $startDate = $enrollment->starts_at
                    ? CarbonImmutable::parse($enrollment->starts_at)->locale('id')->translatedFormat('d F Y')
                    : null;

                return [
                    'name' => $user?->name ?? __('Siswa MayClass'),
                    'package' => $package?->detail_title ?? __('Belum ada paket aktif'),
                    'since' => $startDate,
                    'phone' => $user?->phone,
                ];
            })
            ->values();
    }

    private function isWithinWeek(ScheduleSession $session, CarbonImmutable $start, CarbonImmutable $end): bool
    {
        $date = CarbonImmutable::parse($session->start_at);

        return $date->betweenIncluded($start, $end);
    }
}
