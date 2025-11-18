@extends('tutor.layout')

@section('title', 'Dashboard Tentor - MayClass')

@push('styles')
<style>
    .dashboard-content {
        display: grid;
        gap: 24px;
    }

    /* Hero Section */
    .hero-panel {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 32px;
        padding: 32px;
        border-radius: 20px;
        background: #67aba6ff;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
    }

    .hero-copy {
        display: flex;
        flex-direction: column;
        gap: 16px;
        justify-content: center;
    }

    .hero-panel h1 {
        margin: 0;
        font-size: 2.2rem;
        line-height: 1.3;
    }

    .hero-panel p {
        margin: 0;
        font-size: 1.05rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
    }

    .hero-visual {
        border-radius: 16px;
        overflow: hidden;
        border: 2px solid rgba(255, 255, 255, 0.2);
        background: rgba(0, 0, 0, 0.1);
        height: 200px;
    }

    .hero-visual img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Stats Grid */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .stat-card {
        background: var(--surface);
        border-radius: 18px;
        padding: 22px;
        border: 1px solid var(--border);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
        display: grid;
        gap: 12px;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: currentColor;
    }

    .stat-card.accent-blue {
        color: #2563eb;
    }

    .stat-card.accent-mint {
        color: #10b981;
    }

    .stat-card.accent-orange {
        color: #f97316;
    }

    .stat-card.accent-purple {
        color: #7c3aed;
    }

    .stat-card .label {
        font-size: 0.9rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    .stat-card .value-row {
        display: flex;
        align-items: baseline;
        gap: 8px;
    }

    .stat-card .value-row strong {
        font-size: 1.8rem;
        color: var(--text-main);
    }

    .stat-card .value-row .suffix {
        font-size: 0.85rem;
        color: var(--text-muted);
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-weight: 600;
    }

    .stat-card p {
        margin: 0;
        color: var(--text-muted);
        line-height: 1.5;
        font-size: 0.9rem;
    }

    /* Schedule Section */
    .schedule-card {
        background: var(--surface);
        border-radius: 20px;
        padding: 28px;
        border: 1px solid var(--border);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        display: grid;
        gap: 24px;
    }

    .schedule-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border);
    }

    .schedule-header h2 {
        margin: 0;
        font-size: 1.4rem;
    }

    .schedule-header span {
        color: var(--text-muted);
        font-size: 0.95rem;
        display: block;
        margin-top: 4px;
    }

    .schedule-link {
        color: var(--primary);
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
    }

    .schedule-link:hover {
        text-decoration: underline;
    }

    /* Timeline */
    .timeline {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 12px;
    }

    .timeline-item {
        display: grid;
        grid-template-columns: 120px 1fr;
        gap: 20px;
        padding: 18px 20px;
        border-radius: 16px;
        background: var(--surface-muted);
        border: 1px solid var(--border);
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    }

    .timeline-item:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
    }

    .timeline-item.is-highlight {
        background: rgba(37, 99, 235, 0.04);
        border-color: rgba(37, 99, 235, 0.3);
    }

    .timeline-item .time {
        font-weight: 700;
        color: var(--text-main);
        font-size: 0.95rem;
    }

    .timeline-item .details {
        display: grid;
        gap: 6px;
    }

    .timeline-item .details strong {
        font-size: 1.05rem;
        color: var(--text-main);
    }

    .timeline-item .details span {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .empty-timeline {
        text-align: center;
        padding: 48px 24px;
        border-radius: 16px;
        border: 1px dashed var(--border);
        background: var(--surface-muted);
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 1024px) {
        .hero-panel {
            grid-template-columns: 1fr;
        }

        .hero-visual {
            height: 180px;
        }
    }

    @media (max-width: 768px) {
        .hero-panel {
            padding: 24px;
        }

        .hero-panel h1 {
            font-size: 1.8rem;
        }

        .stat-grid {
            grid-template-columns: 1fr;
        }

        .timeline-item {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .schedule-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
@php
    use Illuminate\Support\Str;

    $firstName = $tutor?->name ? Str::of($tutor->name)->before(' ') : 'Tutor';
    $heroImage = $tutorProfile?->banner_path
        ? asset('storage/' . $tutorProfile->banner_path)
        : config('mayclass.images.tutor.banner.fallback');
@endphp

<div class="dashboard-content">
    {{-- Hero Section --}}
    <section class="hero-panel" aria-labelledby="hero-title">
        <div class="hero-copy">
            <h1 id="hero-title">{{ $firstName }}, mari optimalkan sesi belajar hari ini.</h1>
            <p>
                Pantau jadwal, materi, dan perkembangan siswa secara real-time agar pengalaman belajar
                tetap konsisten dan terarah.
            </p>
        </div>
        <figure class="hero-visual">
            <img src="{{ $heroImage }}" alt="Banner {{ $firstName }}">
        </figure>
    </section>

    {{-- Highlight Stats --}}
    <section class="stat-grid" aria-label="Sorotan Statistik">
        @foreach ($highlightStats as $stat)
            @php
                $label = trim($stat['label'] ?? '');
                $accent = $stat['accent'] ?? 'blue';

                // Khusus: dilarang orange/purple untuk Materi Aktif & (Quiz/Kuis) Siap Pakai
                $normalized = Str::lower($label);
                $isMateriAktif = $normalized === 'materi aktif';
                $isQuizSiapPakai = in_array($normalized, ['quiz siap pakai', 'kuis siap pakai']);

                if (($isMateriAktif || $isQuizSiapPakai) && in_array($accent, ['orange', 'purple'])) {
                    $accent = 'blue';
                }
            @endphp
            <article class="stat-card accent-{{ $accent }}">
                <span class="label">{{ $stat['label'] }}</span>
                <div class="value-row">
                    <strong>{{ $stat['display'] }}</strong>
                    @if (!empty($stat['suffix']))
                        <span class="suffix">{{ $stat['suffix'] }}</span>
                    @endif
                </div>
                @if (!empty($stat['description']))
                    <p>{{ $stat['description'] }}</p>
                @endif
            </article>
        @endforeach
    </section>

    {{-- Agenda Hari Ini --}}
    <section class="schedule-card" aria-labelledby="agenda-title">
        <div class="schedule-header">
            <div>
                <h2 id="agenda-title">Agenda Mengajar Hari Ini</h2>
                <span>{{ $todayLabel }}</span>
            </div>
        </div>

        @if ($todaySessions->isEmpty())
            <div class="empty-timeline">
                Belum ada sesi mengajar untuk hari ini. Tambahkan jadwal baru agar siswa tetap terarah.
            </div>
        @else
            <ul class="timeline">
                @foreach ($todaySessions as $session)
                    <li class="timeline-item {{ !empty($session['highlight']) ? 'is-highlight' : '' }}">
                        <div class="time">{{ $session['time_range'] }}</div>
                        <div class="details">
                            <strong>{{ $session['title'] }}</strong>
                            <span>{{ $session['subject'] }} • {{ $session['class_level'] }}</span>
                            <span>{{ $session['location'] }}</span>
                            <span>
                                {{ $session['student_count'] ? $session['student_count'] . ' siswa' : 'Jumlah siswa belum ditentukan' }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</div>
@endsection