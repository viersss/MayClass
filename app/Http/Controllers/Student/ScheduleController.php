<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ScheduleSession;
use App\Support\ScheduleViewData;
use App\Support\StudentAccess;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        $package = $this->currentPackage();

        $sessions = (! $package || ! Schema::hasTable('schedule_sessions'))
            ? collect()
            : ScheduleSession::query()
                ->where('package_id', $package->id)
                ->orderBy('start_at')
                ->get();

        $viewMode = $this->resolveViewMode($request->query('view'));
        $referenceDate = $this->parseDate($request->query('date'));

        $schedule = ScheduleViewData::compose($sessions, $viewMode, $referenceDate);

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
            'activePackage' => $package,
            'schedule' => $schedule,
            'stats' => $stats,
        ]);
    }

    private function resolveViewMode(?string $view): string
    {
        return match ($view) {
            'day', 'harian' => 'day',
            'week', 'mingguan' => 'week',
            default => 'month',
        };
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

    private function currentPackage()
    {
        $enrollment = StudentAccess::activeEnrollment(Auth::user());

        return $enrollment?->package;
    }
}
