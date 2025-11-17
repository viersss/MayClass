<?php

namespace App\Http\Controllers\Tutor;

use App\Models\Package;
use App\Models\ScheduleSession;
use App\Models\ScheduleTemplate;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Support\ScheduleTemplateGenerator;

class ScheduleController extends BaseTutorController
{
    public function index()
    {
        $tutor = Auth::user();

        if ($tutor && Schema::hasTable('schedule_templates')) {
            ScheduleTemplateGenerator::ensureForTutor($tutor);
        }

        $sessions = Schema::hasTable('schedule_sessions')
            ? ScheduleSession::query()
                ->where('user_id', $tutor?->id)
                ->orderBy('start_at')
                ->get()
            : collect();

        if (Schema::hasTable('packages') && $sessions->isNotEmpty()) {
            $sessions->load('package');
        }

        $scheduledSessions = Schema::hasColumn('schedule_sessions', 'status')
            ? $sessions->filter(fn ($session) => $session->status === 'scheduled')
            : $sessions;

        $cancelledSessions = Schema::hasColumn('schedule_sessions', 'status')
            ? $sessions->filter(fn ($session) => $session->status === 'cancelled')
            : collect();

        $templates = Schema::hasTable('schedule_templates')
            ? ScheduleTemplate::query()
                ->where('user_id', $tutor?->id)
                ->orderBy('day_of_week')
                ->orderBy('start_time')
                ->get()
            : collect();

        $packages = Schema::hasTable('packages')
            ? Package::orderBy('level')->orderBy('price')->get()
            : collect();

        $grouped = $scheduledSessions
            ->map(function (ScheduleSession $session) {
                $start = $this->parseDate($session->start_at ?? null);
                $duration = (int) ($session->duration_minutes ?? 90);
                $duration = $duration > 0 ? $duration : 90;
                $end = $start ? $start->addMinutes($duration) : null;

                return [
                    'day_key' => $start ? $start->format('Y-m-d') : spl_object_id($session),
                    'day_label' => $start ? $start->locale('id')->translatedFormat('l') : '-',
                    'date_label' => $start ? $start->translatedFormat('d F Y') : '-',
                    'subject' => $session->category,
                    'title' => $session->title,
                    'class_level' => $session->class_level ?? '-',
                    'time_range' => $start && $end
                        ? $start->format('H.i') . ' - ' . $end->format('H.i')
                        : 'Jadwal belum tersedia',
                    'location' => $session->location ?? 'Ruang Virtual',
                    'student_count' => $session->student_count,
                    'session_id' => $session->id,
                    'status' => $session->status ?? 'scheduled',
                    'duration' => $duration,
                    'start_iso' => $start?->toIso8601String(),
                    'is_future' => $start ? $start->isFuture() : false,
                ];
            })
            ->groupBy('day_key')
            ->map(function ($items) {
                $first = $items->first();

                return [
                    'day_label' => $first['day_label'],
                    'date_label' => $first['date_label'],
                    'items' => $items->map(function ($item) {
                        return collect($item)->except(['day_key', 'day_label', 'date_label'])->all();
                    })->values(),
                ];
            })
            ->sortKeys()
            ->values();

        $metrics = [
            'session_count' => $scheduledSessions->count(),
            'day_count' => $grouped->count(),
            'subject_count' => $scheduledSessions->pluck('category')->filter()->unique()->count(),
            'template_count' => $templates->count(),
            'cancelled_count' => $cancelledSessions->count(),
        ];

        $nextSession = $scheduledSessions->first();
        $nextSessionHighlight = null;

        if ($nextSession) {
            $start = $this->parseDate($nextSession->start_at ?? null);
            $duration = (int) ($nextSession->duration_minutes ?? 90);
            $duration = $duration > 0 ? $duration : 90;
            $end = $start ? $start->addMinutes($duration) : null;

            $nextSessionHighlight = [
                'title' => $nextSession->title,
                'subject' => $nextSession->category,
                'date_label' => $start ? $start->locale('id')->translatedFormat('l, d F Y') : '-',
                'time_range' => $start && $end
                    ? $start->format('H.i') . ' - ' . $end->format('H.i') . ' WIB'
                    : 'Jadwal belum tersedia',
                'location' => $nextSession->location ?? 'Ruang Virtual',
                'class_level' => $nextSession->class_level ?? '-',
                'student_count' => $nextSession->student_count,
            ];
        }

        return $this->render('tutor.schedule.index', [
            'days' => $grouped->keyBy('day_label'),
            'metrics' => $metrics,
            'nextSessionHighlight' => $nextSessionHighlight,
            'templates' => $templates,
            'tutor' => $tutor,
            'cancelledSessions' => $cancelledSessions,
            'packages' => $packages,
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
