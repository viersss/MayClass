@extends('student.layouts.app')

@section('title', 'Jadwal Belajar')

@push('styles')
    <style>
        .student-schedule__hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: clamp(20px, 4vw, 40px);
            align-items: start;
        }

        .student-schedule__hero h1 {
            margin: 0;
            font-size: clamp(1.9rem, 4vw, 2.6rem);
        }

        .student-schedule__hero p {
            margin: 0;
            color: var(--student-text-muted);
        }

        .student-schedule__stats {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .student-schedule__highlight {
            display: grid;
            gap: 12px;
            padding: clamp(24px, 4vw, 32px);
            border-radius: var(--student-radius-lg);
            background: linear-gradient(140deg, rgba(47, 152, 140, 0.16), rgba(95, 106, 248, 0.16));
            box-shadow: 0 32px 68px rgba(33, 115, 105, 0.16);
        }

        .student-schedule__highlight h2 {
            margin: 0;
            font-size: 1.3rem;
        }

        .student-schedule__list {
            display: grid;
            gap: 16px;
        }

        .student-schedule__item {
            display: grid;
            gap: 10px;
            border-radius: var(--student-radius-lg);
            padding: clamp(20px, 3vw, 26px);
            background: var(--student-surface);
            box-shadow: 0 24px 50px rgba(33, 115, 105, 0.12);
        }

        .student-schedule__item h3 {
            margin: 0;
            font-size: 1.1rem;
        }

        .student-schedule__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 0.9rem;
            color: var(--student-text-muted);
        }

        .student-schedule__empty {
            padding: clamp(24px, 4vw, 32px);
            border-radius: var(--student-radius-lg);
            background: rgba(47, 152, 140, 0.08);
            text-align: center;
            color: var(--student-text-muted);
            display: grid;
            gap: 12px;
        }

        .student-schedule__view-controls {
            display: grid;
            gap: 16px;
        }

        .student-schedule__tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .student-schedule__tab {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border-radius: var(--student-radius-md);
            border: 1px solid rgba(47, 152, 140, 0.16);
            background: #ffffff;
            color: var(--student-text-muted);
            font-weight: 600;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }

        .student-schedule__tab.is-active {
            background: linear-gradient(120deg, var(--student-primary), var(--student-primary-soft));
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 18px 32px rgba(27, 119, 110, 0.22);
        }

        .student-schedule__nav {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .student-schedule__nav a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--student-primary);
            font-weight: 600;
            text-decoration: none;
        }

        .student-schedule__calendar {
            display: grid;
            gap: 20px;
        }

        .student-schedule__calendar-grid {
            display: grid;
            gap: 12px;
        }

        .student-schedule__calendar-cell {
            border-radius: 16px;
            padding: 16px 18px;
            background: rgba(47, 152, 140, 0.08);
            border: 1px solid rgba(47, 152, 140, 0.12);
            display: grid;
            gap: 10px;
        }

        .student-schedule__calendar-cell.is-active {
            background: linear-gradient(120deg, var(--student-primary), var(--student-primary-soft));
            color: #ffffff;
            box-shadow: 0 18px 32px rgba(27, 119, 110, 0.22);
        }

        .student-schedule__calendar-cell.is-muted {
            opacity: 0.5;
        }

        .student-schedule__calendar-headline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            font-weight: 600;
        }

        .student-schedule__calendar-events {
            display: grid;
            gap: 8px;
            font-size: 0.85rem;
        }

        .student-schedule__calendar-event {
            padding: 8px 10px;
            border-radius: var(--student-radius-sm);
            background: rgba(255, 255, 255, 0.18);
            color: inherit;
        }

        .student-schedule__range {
            display: grid;
            gap: 16px;
        }

        .student-schedule__range-day {
            border-radius: var(--student-radius-lg);
            padding: clamp(20px, 3vw, 26px);
            background: var(--student-surface);
            box-shadow: 0 20px 42px rgba(33, 115, 105, 0.12);
            display: grid;
            gap: 12px;
        }

        .student-schedule__range-day h3 {
            margin: 0;
            font-size: 1.05rem;
        }

        .student-schedule__range-sessions {
            display: grid;
            gap: 10px;
        }

        .student-schedule__range-session {
            display: grid;
            gap: 6px;
            padding: 12px 14px;
            border-radius: var(--student-radius-md);
            background: rgba(95, 106, 248, 0.08);
            border: 1px solid rgba(95, 106, 248, 0.12);
        }

        @media (max-width: 640px) {
            .student-schedule__nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .student-schedule__calendar-grid {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            }
        }
    </style>
@endpush

@php($calendar = $schedule['calendar'])
@php($viewMode = $schedule['view'])
@php($rangeSessions = $schedule['rangeSessions'])

@section('content')
    <section class="student-section">
        <div class="student-schedule__hero">
            <div>
                <span class="student-chip">Pengelolaan jadwal</span>
                <h1>Kalender belajar MayClass</h1>
                <p>
                    @if (! empty($activePackage))
                        Agenda eksklusif paket {{ $activePackage->detail_title ?? $activePackage->title }}.
                    @endif
                    Total {{ number_format($stats['total']) }} sesi tercatat dengan {{ number_format($stats['upcoming']) }} agenda
                    mendatang dan {{ number_format($stats['completed']) }} sesi telah selesai.
                </p>
                <div class="student-schedule__stats">
                    <span class="student-chip">{{ $calendar['label'] }}</span>
                    <span class="student-chip">Hari aktif: {{ number_format(count($rangeSessions)) }}</span>
                </div>
            </div>
            <div class="student-schedule__highlight">
                <span class="student-chip">Sesi terdekat</span>
                <h2>{{ $schedule['highlight']['title'] }}</h2>
                <div class="student-schedule__meta">
                    <span>{{ $schedule['highlight']['date'] }}</span>
                    <span>{{ $schedule['highlight']['time'] }}</span>
                    <span>Mentor {{ $schedule['highlight']['mentor'] }}</span>
                    <span>Kategori {{ $schedule['highlight']['category'] }}</span>
                </div>
                <a class="student-button student-button--primary" style="width: max-content;" href="{{ route('student.dashboard') }}">Kembali ke dashboard</a>
            </div>
        </div>
    </section>

    <section class="student-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Agenda mendatang</h2>
        </div>
        @if (! empty($schedule['upcoming']) && count($schedule['upcoming']) > 0)
            <div class="student-schedule__list">
                @foreach ($schedule['upcoming'] as $session)
                    <article class="student-schedule__item">
                        <h3>{{ $session['title'] }}</h3>
                        <div class="student-schedule__meta">
                            <span>{{ $session['date'] }}</span>
                            <span>{{ $session['time'] }}</span>
                            <span>Mentor {{ $session['mentor'] }}</span>
                            <span>{{ $session['category'] }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="student-schedule__empty">
                <p>Belum ada jadwal aktif. Tambahkan sesi baru dari dashboard tutor.</p>
            </div>
        @endif
    </section>

    <section class="student-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Kalender sesi</h2>
        </div>
        <div class="student-schedule__view-controls">
            <div class="student-schedule__tabs">
                @foreach (['day' => 'Harian', 'week' => 'Mingguan', 'month' => 'Bulanan'] as $mode => $label)
                    <a class="student-schedule__tab {{ $viewMode === $mode ? 'is-active' : '' }}" href="{{ route('student.schedule', ['view' => $mode, 'date' => $calendar['currentDate']]) }}">{{ $label }}</a>
                @endforeach
            </div>
            <div class="student-schedule__nav">
                <a href="{{ route('student.schedule', ['view' => $viewMode, 'date' => $calendar['prevDate']]) }}">&larr; Sebelumnya</a>
                <span style="font-weight: 600; color: var(--student-text-muted);">{{ $calendar['label'] }}</span>
                <a href="{{ route('student.schedule', ['view' => $viewMode, 'date' => $calendar['nextDate']]) }}">Berikutnya &rarr;</a>
            </div>
        </div>
        <div class="student-schedule__calendar">
            <div class="student-schedule__calendar-grid" style="grid-template-columns: repeat({{ $calendar['columns'] }}, minmax(0, 1fr));">
                @foreach ($calendar['weeks'] as $week)
                    @foreach ($week as $day)
                        <div class="student-schedule__calendar-cell {{ $day['isActive'] ? 'is-active' : '' }} {{ $day['isMuted'] ? 'is-muted' : '' }}">
                            <div class="student-schedule__calendar-headline">
                                <span>{{ $day['display'] }}</span>
                                <span style="font-size: 0.85rem; color: inherit;">{{ $viewMode === 'day' ? $day['fullLabel'] : $day['weekday'] }}</span>
                            </div>
                            @if (! empty($day['sessions']))
                                <div class="student-schedule__calendar-events">
                                    @foreach ($day['sessions'] as $event)
                                        <div class="student-schedule__calendar-event">
                                            <strong>{{ $event['start_time'] ?? '-' }} WIB</strong>
                                            <div>{{ $event['title'] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p style="margin: 0; font-size: 0.85rem; color: inherit; opacity: 0.8;">Tidak ada sesi.</p>
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    <section class="student-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Rincian jadwal periode ini</h2>
        </div>
        @if (! empty($rangeSessions))
            <div class="student-schedule__range">
                @foreach ($rangeSessions as $day)
                    <article class="student-schedule__range-day">
                        <h3>{{ $day['label'] }}</h3>
                        <div class="student-schedule__range-sessions">
                            @foreach ($day['sessions'] as $session)
                                <div class="student-schedule__range-session">
                                    <strong>{{ $session['title'] }}</strong>
                                    <span style="color: var(--student-text-muted);">{{ $session['time'] }} • Mentor {{ $session['mentor'] }}</span>
                                    <span style="color: var(--student-text-muted);">Kategori {{ $session['category'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="student-schedule__empty">
                <p>Belum ada sesi pada rentang tanggal ini. Coba pindah ke bulan atau minggu lainnya.</p>
            </div>
        @endif
    </section>
@endsection
