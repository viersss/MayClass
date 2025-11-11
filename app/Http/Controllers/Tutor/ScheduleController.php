<?php

namespace App\Http\Controllers\Tutor;

use App\Models\ScheduleSession;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ScheduleController extends BaseTutorController
{
    public function index()
    {
        $tutor = Auth::user();

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

        $grouped = $sessions
            ->map(function (ScheduleSession $session) {
                $start = $this->parseDate($session->start_at ?? null);
                $end = $start ? $start->addMinutes(90) : null;

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
            'session_count' => $sessions->count(),
            'day_count' => $grouped->count(),
            'subject_count' => $sessions->pluck('category')->filter()->unique()->count(),
        ];

        $nextSession = $sessions->first();
        $nextSessionHighlight = null;

        if ($nextSession) {
            $start = $this->parseDate($nextSession->start_at ?? null);
            $end = $start ? $start->addMinutes(90) : null;

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
            'days' => $grouped,
            'metrics' => $metrics,
            'nextSessionHighlight' => $nextSessionHighlight,
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
