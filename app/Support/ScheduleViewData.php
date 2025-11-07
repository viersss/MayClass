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
        $referenceDate = $sessions->min('start_at')
            ? CarbonImmutable::parse($sessions->min('start_at'))
            : CarbonImmutable::now();

        $highlightSession = $sessions->firstWhere('is_highlight', true)
            ?? $sessions->firstWhere(fn ($session) => CarbonImmutable::parse($session->start_at)->isFuture())
            ?? $sessions->first();

        $highlight = $highlightSession
            ? self::formatSession($highlightSession)
            : [
                'title' => 'Belum ada jadwal',
                'category' => '-',
                'date' => self::formatFullDate($referenceDate),
                'time' => '-',
                'mentor' => '-',
            ];

        $upcoming = $sessions
            ->filter(fn ($session) => CarbonImmutable::parse($session->start_at)->isFuture())
            ->sortBy('start_at')
            ->map(fn ($session) => self::formatSession($session))
            ->values()
            ->take(3);

        if ($upcoming->isEmpty() && $highlightSession) {
            $upcoming = collect([$highlight]);
        }

        $calendar = self::buildCalendar($referenceDate, $sessions);

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
        $startAt = CarbonImmutable::parse($session->start_at);
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
            ->filter(fn ($session) => CarbonImmutable::parse($session->start_at)->month === $referenceDate->month)
            ->map(fn ($session) => CarbonImmutable::parse($session->start_at)->day)
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
}
