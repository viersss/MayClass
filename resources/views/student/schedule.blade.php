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

        .student-schedule__calendar {
            display: grid;
            gap: 20px;
        }

        .student-schedule__calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 12px;
        }

        .student-schedule__calendar-cell {
            text-align: center;
            padding: 14px 0;
            border-radius: 16px;
            font-size: 0.92rem;
            color: var(--student-text-muted);
        }

        .student-schedule__calendar-cell.is-active {
            background: linear-gradient(120deg, var(--student-primary), var(--student-primary-soft));
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 18px 32px rgba(27, 119, 110, 0.22);
        }

        .student-schedule__calendar-cell.is-muted {
            opacity: 0.45;
        }
    </style>
@endpush

@section('content')
    <section class="student-section">
        <div class="student-schedule__hero">
            <div>
                <span class="student-chip">Pengelolaan jadwal</span>
                <h1>Kalender belajar MayClass</h1>
                <p>
                    Total {{ number_format($stats['total']) }} sesi tercatat dengan {{ number_format($stats['upcoming']) }} agenda
                    mendatang dan {{ number_format($stats['completed']) }} sesi telah selesai.
                </p>
                <div class="student-schedule__stats">
                    <span class="student-chip">{{ $schedule['monthLabel'] }}</span>
                    <span class="student-chip">Hari aktif: {{ count($schedule['activeDays']) }}</span>
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
        <div class="student-schedule__calendar">
            <div class="student-schedule__calendar-grid">
                @foreach ($schedule['calendar'] as $column)
                    @foreach ($column['days'] as $day)
                        @php($isActive = in_array($day, $schedule['activeDays'], true))
                        @php($isMuted = in_array($day, $schedule['mutedCells'][$column['label']] ?? [], true))
                        <div class="student-schedule__calendar-cell {{ $isActive ? 'is-active' : '' }} {{ $isMuted ? 'is-muted' : '' }}">
                            {{ $day }}
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
@endsection
