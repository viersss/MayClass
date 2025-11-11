<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ScheduleSession;
use App\Support\ScheduleViewData;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Schema;

class ScheduleController extends Controller
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

        $upcomingSessions = $sessions->filter(function ($session) {
            $start = $this->parseDate($session->start_at ?? null);

            return $start ? $start->isFuture() : false;
        });

        $stats = [
            'total' => $sessions->count(),
            'upcoming' => $upcomingSessions->count(),
            'completed' => max($sessions->count() - $upcomingSessions->count(), 0),
        ];

        return view('student.schedule', [
            'page' => 'schedule',
            'title' => 'Jadwal Belajar',
            'schedule' => ScheduleViewData::fromCollection($sessions),
            'stats' => $stats,
        ]);
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
