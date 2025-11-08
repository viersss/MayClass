<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Material;
use App\Models\ScheduleSession;
use App\Support\ScheduleViewData;
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

        $recentMaterials = Schema::hasTable('materials')
            ? Material::orderByDesc('created_at')
                ->take(3)
                ->get()
                ->map(fn ($material) => [
                    'slug' => $material->slug,
                    'subject' => $material->subject,
                    'title' => $material->title,
                    'summary' => $material->summary,
                ])
            : collect();

        $activeEnrollment = Schema::hasTable('enrollments')
            ? Auth::user()
                ->enrollments()
                ->with('package')
                ->where('is_active', true)
                ->orderByDesc('ends_at')
                ->first()
            : null;

        return view('student.dashboard', [
            'schedule' => $schedule,
            'recentMaterials' => $recentMaterials,
            'activePackage' => $this->formatActivePackage($activeEnrollment),
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
