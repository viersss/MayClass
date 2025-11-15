@extends('student.layouts.app')

@section('title', 'Jadwal Belajar')

@push('styles')
    <style>
        /* 1. Hero Section (Banner Style) */
        .student-schedule__hero {
            background: linear-gradient(135deg, var(--student-primary) 0%, #2a8c82 100%); /* Warna dari 'Materi' */
            border-radius: 24px;
            padding: clamp(30px, 5vw, 60px);
            color: white;
            text-align: left;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(47, 152, 140, 0.2);
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .student-schedule__hero h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            line-height: 1.2;
        }

        .student-schedule__hero p {
            margin: 0;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            max-width: 600px;
            line-height: 1.6;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        /* Tombol Custom untuk Hero (dari desain baru) */
        .hero-btn {
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero-btn--primary {
            background: #FFA726; /* Warna aksen oranye */
            color: white;
            box-shadow: 0 4px 15px rgba(255, 167, 38, 0.4);
        }

        .hero-btn--outline {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .hero-btn:hover {
            transform: translateY(-2px);
        }

        /* 2. Highlight Card (Sesi Terdekat) */
        .highlight-card {
            background: var(--student-surface, #ffffff);
            border-radius: 20px;
            padding: clamp(24px, 4vw, 32px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .highlight-card .student-chip {
            background: var(--student-primary);
            color: white;
        }

        .highlight-card h2 {
            margin: 12px 0 8px 0;
            font-size: 1.5rem;
            color: var(--student-primary);
        }
        
        .highlight-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 20px;
            font-size: 0.95rem;
            color: var(--student-text-muted);
            margin-bottom: 24px;
        }

        /* 3. Upcoming Grid (Desain Baru) */
        .upcoming-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .session-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: var(--student-primary); /* Warna default */
            color: white;
            border-radius: 20px;
            padding: 28px;
            min-height: 180px;
            box-shadow: 0 10px 30px rgba(47, 152, 140, 0.2);
            transition: all 0.2s ease;
        }

        .session-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(47, 152, 140, 0.3);
        }

        /* Memberi warna berbeda untuk variasi, bisa disesuaikan */
        .session-card:nth-child(3n+2) {
            background: #5f6af8; /* Aksen Ungu/Biru */
            box-shadow: 0 10px 30px rgba(95, 106, 248, 0.2);
        }
        .session-card:nth-child(3n+3) {
            background: #27a4b8; /* Aksen Biru Muda */
            box-shadow: 0 10px 30px rgba(39, 164, 184, 0.2);
        }

        .session-card .category {
            font-size: 0.9rem;
            font-weight: 600;
            opacity: 0.8;
            margin-bottom: 8px;
        }

        .session-card h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .session-card .meta {
            margin-top: 16px;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* 4. Kalender Section */
        .calendar-controls {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 24px;
            /* max-width: 1100px; <-- DIHAPUS */
            /* margin-left: auto; <-- DIHAPUS */
            /* margin-right: auto; <-- DIHAPUS */
        }

        .student-schedule__tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            background: var(--student-surface, #f8f9fa);
            padding: 8px;
            border-radius: 50px;
            width: max-content;
        }

        .student-schedule__tab {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 22px;
            border-radius: 30px;
            border: none;
            background: transparent;
            color: var(--student-text-muted);
            font-weight: 600;
            font-size: 0.92rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .student-schedule__tab.is-active {
            background: linear-gradient(120deg, var(--student-primary), var(--student-primary-soft));
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(47, 152, 140, 0.2);
            border-color: transparent;
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
            max-width: 1100px; /* [BARU] Batasi lebar maksimum kalender */
            margin: 0 auto; /* [BARU] Buat kalender rata tengah */
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

        /* 7. Empty State */
        .student-schedule__empty {
            padding: clamp(24px, 4vw, 32px);
            border-radius: 20px;
            background: var(--student-surface);
            text-align: center;
            color: var(--student-text-muted);
            grid-column: 1 / -1; /* Agar span full width di grid */
        }

        /* 8. Responsive */
        @media (max-width: 768px) {
            .calendar-controls {
                align-items: flex-start;
            }
            .student-schedule__tabs {
                width: 100%;
            }
            .student-schedule__nav {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }
        }

    </style>
@endpush

@php($calendar = $schedule['calendar'])
@php($viewMode = $schedule['view'])
@php($rangeSessions = $schedule['rangeSessions'])

@section('content')
    <!-- SECTION 1: HERO BARU -->
    <section class="student-section">
        <div class="student-schedule__hero">
            <div>
                <h1>Jadwal Bimbel</h1>
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
            <div class="hero-actions">
                <a class="hero-btn hero-btn--primary" href="#calendar-section">Lihat Jadwal</a>
                <a class="hero-btn hero-btn--outline" href="{{ route('student.dashboard') }}">Kembali ke Beranda</a>
            </div>
        </div>
    </section>

    <!-- SECTION 2: SESI TERDEKAT (Highlight) -->
    <section class="student-section">
        <div class="highlight-card">
            <span class="student-chip">Sesi Terdekat</span>
            <h2>{{ $schedule['highlight']['title'] }}</h2>
            <div class="highlight-meta">
                <span>{{ $schedule['highlight']['date'] }}</span>
                <span>•</span>
                <span>{{ $schedule['highlight']['time'] }}</span>
                <span>•</span>
                <span>Mentor {{ $schedule['highlight']['mentor'] }}</span>
                <span>•</span>
                <span>Kategori {{ $schedule['highlight']['category'] }}</span>
            </div>
            <a class="student-button student-button--primary" style="width: max-content;" href="{{ route('student.dashboard') }}">
                Buka Dashboard
            </a>
        </div>
    </section>

    <!-- SECTION 3: AGENDA MENDATANG (Grid Desain Baru) -->
    <section class="student-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Agenda Mendatang</h2>
        </div>
        @if (! empty($schedule['upcoming']) && count($schedule['upcoming']) > 0)
            <div class="upcoming-grid">
                @foreach ($schedule['upcoming'] as $session)
                    <article class="session-card">
                        <div>
                            <div class="category">{{ $session['category'] }}</div>
                            <h3>{{ $session['title'] }}</h3>
                        </div>
                        <div class="meta">
                            {{ $session['date'] }} • {{ $session['time'] }}
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

    <!-- SECTION 4: KALENDER SESI (Fungsionalitas Lama) -->
    <section class="student-section" id="calendar-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Kalender Sesi</h2>
        </div>
        
        <!-- Kontrol Kalender (Tabs + Nav) -->
        <div class="calendar-controls">
            <div class="student-schedule__tabs">
                @foreach (['day' => 'Harian', 'week' => 'Mingguan', 'month' => 'Bulanan'] as $mode => $label)
                    <a class="student-schedule__tab {{ $viewMode === $mode ? 'is-active' : '' }}" href="{{ route('student.schedule', ['view' => $mode, 'date' => $calendar['currentDate']]) }}">{{ $label }}</a>
                @endforeach
            </div>
            <div class="student-schedule__nav">
                <a href="{{ route('student.schedule', ['view' => $viewMode, 'date' => $calendar['prevDate']]) }}">&larr; Sebelumnya</a>
                <span class="nav-title">{{ $calendar['label'] }}</span>
                <a href="{{ route('student.schedule', ['view' => $viewMode, 'date' => $calendar['nextDate']]) }}">Berikutnya &rarr;</a>
            </div>
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
