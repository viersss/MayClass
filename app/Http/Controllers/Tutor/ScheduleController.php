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
                $start = CarbonImmutable::parse($session->start_at);
                $end = $start->addMinutes(90);

                return [
                    'day_key' => $start->format('Y-m-d'),
                    'day_label' => $start->locale('id')->translatedFormat('l'),
                    'date_label' => $start->translatedFormat('d F Y'),
                    'subject' => $session->category,
                    'title' => $session->title,
                    'class_level' => $session->class_level ?? '-',
                    'time_range' => $start->format('H.i') . ' - ' . $end->format('H.i'),
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

        return $this->render('tutor.schedule.index', [
            'days' => $grouped,
        ]);
    }
}
