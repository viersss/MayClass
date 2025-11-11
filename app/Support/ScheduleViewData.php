<?php

namespace App\Support;

use App\Models\ScheduleSession;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class ScheduleViewData
{
    private const DAY_LABELS = [
        1 => 'Sen',
        2 => 'Sel',
        3 => 'Rab',
        4 => 'Kam',
        5 => 'Jum',
        6 => 'Sab',
        7 => 'Min',
    ];

    private const DAY_NAMES = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
        7 => 'Minggu',
    ];

    private const MONTH_NAMES = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    public static function fromCollection(Collection $sessions): array
    {
        $validSessions = $sessions->filter(fn ($session) => self::parseDate($session->start_at ?? null));

        $referenceDate = $validSessions
            ->map(fn ($session) => self::parseDate($session->start_at ?? null))
            ->filter()
            ->sortBy(fn (CarbonImmutable $date) => $date->timestamp)
            ->first() ?? CarbonImmutable::now();

        $highlightSession = $validSessions->firstWhere('is_highlight', true)
            ?? $validSessions->firstWhere(function ($session) {
                $start = self::parseDate($session->start_at ?? null);

                return $start ? $start->isFuture() : false;
            })
            ?? $validSessions->first();

        $highlight = $highlightSession
            ? self::formatSession($highlightSession)
            : [
                'title' => 'Belum ada jadwal',
                'category' => '-',
                'date' => self::formatFullDate($referenceDate),
                'time' => '-',
                'mentor' => '-',
            ];

        $upcoming = $validSessions
            ->filter(function ($session) {
                $start = self::parseDate($session->start_at ?? null);

                return $start ? $start->isFuture() : false;
            })
            ->sortBy('start_at')
            ->map(fn ($session) => self::formatSession($session))
            ->values()
            ->take(3);

        if ($upcoming->isEmpty() && $highlightSession) {
            $upcoming = collect([$highlight]);
        }

        $calendar = self::buildCalendar($referenceDate, $validSessions);

        return [
            'highlight' => $highlight,
            'upcoming' => $upcoming,
            'calendar' => $calendar['columns'],
            'activeDays' => $calendar['activeDays'],
            'mutedCells' => $calendar['mutedCells'],
            'monthLabel' => $calendar['monthLabel'],
        ];
    }

    public static function formatFullDate(CarbonImmutable $date): string
    {
        $dayLabel = self::DAY_NAMES[$date->dayOfWeekIso];
        $monthLabel = self::MONTH_NAMES[$date->month];

        return sprintf('%s, %d %s %d', $dayLabel, $date->day, $monthLabel, $date->year);
    }

    public static function formatSession(ScheduleSession $session): array
    {
        $startAt = self::parseDate($session->start_at ?? null);

        if (! $startAt) {
            return [
                'title' => $session->title,
                'category' => $session->category,
                'date' => '-',
                'time' => '-',
                'mentor' => $session->mentor_name,
            ];
        }

        $endAt = $startAt->addMinutes(90);

        return [
            'title' => $session->title,
            'category' => $session->category,
            'date' => self::formatFullDate($startAt),
            'time' => $startAt->format('H.i') . ' - ' . $endAt->format('H.i') . ' WIB',
            'mentor' => $session->mentor_name,
        ];
    }

    private static function buildCalendar(CarbonImmutable $referenceDate, Collection $sessions): array
    {
        $start = $referenceDate->startOfMonth()->startOfWeek(CarbonImmutable::MONDAY);
        $end = $referenceDate->endOfMonth()->endOfWeek(CarbonImmutable::SUNDAY);

        $columns = [];
        $mutedCells = [];
        foreach (self::DAY_LABELS as $label) {
            $columns[$label] = [
                'label' => $label,
                'days' => [],
            ];
            $mutedCells[$label] = [];
        }

        for ($date = $start; $date->lessThanOrEqualTo($end); $date = $date->addDay()) {
            $label = self::DAY_LABELS[$date->dayOfWeekIso];
            $columns[$label]['days'][] = $date->day;
            if ($date->month !== $referenceDate->month) {
                $mutedCells[$label][] = $date->day;
            }
        }

        $activeDays = $sessions
            ->map(fn ($session) => self::parseDate($session->start_at ?? null))
            ->filter(fn ($date) => $date && $date->month === $referenceDate->month)
            ->map(fn ($date) => $date->day)
            ->unique()
            ->values()
            ->all();

        return [
            'columns' => array_values($columns),
            'mutedCells' => array_map(fn ($days) => array_values(array_unique($days)), $mutedCells),
            'activeDays' => $activeDays,
            'monthLabel' => self::MONTH_NAMES[$referenceDate->month] . ' ' . $referenceDate->year,
        ];
    }

    private static function parseDate($value): ?CarbonImmutable
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
