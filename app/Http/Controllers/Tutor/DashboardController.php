<?php

namespace App\Http\Controllers\Tutor;

use App\Models\Enrollment;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\ScheduleSession;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DashboardController extends BaseTutorController
{
    public function index()
    {
        $tutor = Auth::user();

        $stats = [
            'students' => Schema::hasTable('enrollments')
                ? Enrollment::where('is_active', true)->distinct('user_id')->count('user_id')
                : 0,
            'materials' => Schema::hasTable('materials') ? Material::count() : 0,
            'quizzes' => Schema::hasTable('quizzes') ? Quiz::count() : 0,
        ];

        $today = CarbonImmutable::now();

        $sessions = Schema::hasTable('schedule_sessions')
            ? ScheduleSession::query()
                ->when($tutor, function ($query) use ($tutor) {
                    $query->where('user_id', $tutor->id)
                        ->orWhere(function ($inner) use ($tutor) {
                            $inner->whereNull('user_id')->where('mentor_name', $tutor->name);
                        });
                })
                ->orderBy('start_at')
                ->get()
            : collect();

        $todaySessions = $sessions
            ->filter(fn ($session) => CarbonImmutable::parse($session->start_at)->isSameDay($today))
            ->map(function (ScheduleSession $session) {
                $start = CarbonImmutable::parse($session->start_at);
                $end = $start->addMinutes(90);

                return [
                    'subject' => $session->category,
                    'title' => $session->title,
                    'class_level' => $session->class_level ?? 'Kelas',
                    'time_range' => $start->format('H.i') . ' - ' . $end->format('H.i'),
                    'location' => $session->location ?? 'Ruang Virtual',
                    'student_count' => $session->student_count,
                ];
            })
            ->values();

        $nextSessions = $sessions
            ->reject(fn ($session) => CarbonImmutable::parse($session->start_at)->isSameDay($today))
            ->sortBy('start_at')
            ->take(6)
            ->map(function (ScheduleSession $session) {
                $start = CarbonImmutable::parse($session->start_at);
                $end = $start->addMinutes(90);

                return [
                    'day' => $start->locale('id')->translatedFormat('l'),
                    'title' => $session->title,
                    'subject' => $session->category,
                    'class_level' => $session->class_level ?? '-',
                    'time_range' => $start->format('H.i') . ' - ' . $end->format('H.i'),
                ];
            })
            ->values();

        return $this->render('tutor.dashboard', [
            'stats' => $stats,
            'todaySessions' => $todaySessions,
            'nextSessions' => $nextSessions,
            'todayLabel' => $today->locale('id')->translatedFormat('l, d F Y'),
        ]);
    }
}
