<?php

namespace App\Http\Controllers\Tutor;

use App\Models\ScheduleSession;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ScheduleController extends BaseTutorController
{
    public function index(): View
    {
        $tutor = Auth::user();

        $sessionsReady = Schema::hasTable('schedule_sessions');

        $sessions = $sessionsReady
            ? ScheduleSession::query()
                ->where(function ($query) use ($tutor) {
                    $query
                        ->where('user_id', optional($tutor)->id)
                        ->orWhere(function ($inner) use ($tutor) {
                            $inner->whereNull('user_id')->where('mentor_name', optional($tutor)->name);
                        });
                })
                ->orderBy('start_at')
                ->get()
            : collect();

        if ($sessions->isNotEmpty() && Schema::hasTable('packages')) {
            $sessions->load('package:id,detail_title');
        }

        if ($sessions->isNotEmpty() && Schema::hasTable('enrollments') && Schema::hasTable('users')) {
            $sessions->load([
                'package.enrollments' => function ($query) {
                    $query
                        ->where('is_active', true)
                        ->where(function ($subQuery) {
                            $subQuery
                                ->whereNull('ends_at')
                                ->orWhere('ends_at', '>=', now());
                        })
                        ->with('user:id,name');
                },
            ]);
        }

        $now = CarbonImmutable::now();

        $sessionPayload = $sessions->map(function (ScheduleSession $session) use ($now) {
            $start = $this->parseDate($session->start_at);
            $duration = (int) ($session->duration_minutes ?? 90);
            $duration = $duration > 0 ? $duration : 90;
            $end = $start ? $start->addMinutes($duration) : null;

            $status = Schema::hasColumn('schedule_sessions', 'status')
                ? ($session->status ?? 'scheduled')
                : 'scheduled';

            if ($status === 'scheduled' && $start && $start->lt($now)) {
                $status = 'completed';
            }

            $isUpcoming = $start ? $start->greaterThanOrEqualTo($now) : false;

            $participants = collect(optional($session->package)->enrollments ?? [])
                ->map(fn ($enrollment) => optional($enrollment->user)->name)
                ->filter()
                ->values();

            $location = $session->location ?: __('Ruang virtual');

            return [
                'id' => $session->id,
                'title' => $session->title,
                'subject' => $session->category,
                'package' => optional($session->package)->detail_title ?? __('Paket MayClass'),
                'students' => $participants->isNotEmpty()
                    ? $participants->join(', ')
                    : ($session->student_count
                        ? number_format($session->student_count) . ' ' . __('siswa terjadwal')
                        : __('Belum terhubung ke siswa')),
                'location' => $location,
                'time_range' => $start && $end
                    ? $start->format('H.i') . ' - ' . $end->format('H.i') . ' WIB'
                    : __('Waktu belum ditetapkan'),
                'date_label' => $start
                    ? $start->locale('id')->translatedFormat('l, d F Y')
                    : __('Tanggal belum ditetapkan'),
                'status' => $status,
                'status_meta' => $this->statusMeta($status, $isUpcoming),
                'start_iso' => $start?->toIso8601String(),
                'is_upcoming' => $isUpcoming,
            ];
        });

        $upcomingSessions = $sessionPayload
            ->filter(fn ($session) => $session['is_upcoming'])
            ->sortBy('start_iso')
            ->values();

        $historySessions = $sessionPayload
            ->reject(fn ($session) => $session['is_upcoming'])
            ->sortByDesc('start_iso')
            ->values();

        $stats = [
            'total' => $sessionPayload->count(),
            'upcoming' => $upcomingSessions->count(),
            'completed' => $sessionPayload
                ->filter(fn ($session) => $session['status'] === 'completed' || (! $session['is_upcoming'] && $session['status'] !== 'cancelled'))
                ->count(),
            'cancelled' => $sessionPayload
                ->filter(fn ($session) => $session['status'] === 'cancelled')
                ->count(),
        ];

        return $this->render('tutor.schedule.index', [
            'pageTitle' => __('Jadwal Tentor'),
            'summary' => $stats,
            'upcomingSessions' => $upcomingSessions,
            'historySessions' => $historySessions,
        ]);
    }

    private function statusMeta(string $status, bool $isUpcoming): array
    {
        return match ($status) {
            'cancelled' => ['label' => __('Dibatalkan'), 'tone' => 'danger'],
            'completed' => ['label' => __('Selesai'), 'tone' => 'neutral'],
            default => [
                'label' => $isUpcoming ? __('Dijadwalkan') : __('Selesai'),
                'tone' => $isUpcoming ? 'info' : 'neutral',
            ],
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
}
