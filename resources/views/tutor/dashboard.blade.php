@extends('tutor.layout')

@section('title', 'Dashboard Tentor - MayClass')

@push('styles')
<style>
    /* ==========
       Layout dasar
       ========== */
    .dashboard-content {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* ==========
       Hero
       ========== */
    .hero-panel {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 280px;
        gap: 32px;
        padding: 32px 36px;
        border-radius: 24px;
        background: #67aba6ff;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .hero-copy {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }
    .hero-panel h1 {
        margin: 0;
        font-size: 2.3rem;
    }
    .hero-panel p {
        margin: 0;
        font-size: 1.05rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.85);
    }
    .hero-visual {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(0,0,0,0.06);
    }
    .hero-visual img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* ==========
       Stat cards
       ========== */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }
    .stat-card {
        background: var(--surface);
        border-radius: 20px;
        padding: 20px;
        border: 1px solid var(--border-subtle);
    }
    .stat-card .label {
        font-size: 0.9rem;
        color: var(--text-muted);
    }
    .stat-card .value-row {
        display: flex;
        align-items: flex-end;
        gap: 10px;
        margin-top: 10px;
    }
    .stat-card .value-row strong {
        font-size: 2rem;
        color: var(--text-main);
    }
    .stat-card .value-row .suffix {
        font-size: 0.9rem;
        color: var(--text-muted);
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }
    .stat-card p {
        margin: 10px 0 0;
        color: var(--text-muted);
        line-height: 1.5;
    }
    /* Aksen yang tersedia */
    .stat-card.accent-blue { border-top: 4px solid #2563eb; }
    .stat-card.accent-mint { border-top: 4px solid #10b981; }
    .stat-card.accent-orange { border-top: 4px solid #f97316; }
    .stat-card.accent-purple { border-top: 4px solid #7c3aed; }

    /* ==========
       Konten utama: Jadwal
       ========== */
    .content-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr);
        gap: 24px;
    }
    .column-primary {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .schedule-card {
        background: var(--surface);
        border-radius: 20px;
        padding: 24px;
        border: 1px solid var(--border-subtle);
    }
    .schedule-card header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
    }
    .schedule-card header h2 {
        margin: 0;
        font-size: 1.3rem;
    }
    .schedule-card header span {
        color: var(--text-muted);
        font-size: 0.95rem;
    }
    .schedule-card .link {
        color: var(--accent);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .timeline {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .timeline-item {
        display: grid;
        grid-template-columns: 110px 1fr;
        gap: 16px;
        padding: 16px 18px;
        border-radius: 16px;
        background: var(--surface-muted);
        border: 1px solid var(--border-subtle);
    }
    .timeline-item.is-highlight {
        border-color: rgba(37, 99, 235, 0.4);
    }
    .timeline-item .time {
        font-weight: 600;
    }
    .timeline-item .details {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .timeline-item .details span {
        color: var(--text-muted);
        font-size: 0.95rem;
    }
    .empty-timeline {
        text-align: center;
        padding: 32px 16px;
        border-radius: 16px;
        border: 1px dashed var(--border-subtle);
        color: var(--text-muted);
    }

    /* ==========
       Responsif
       ========== */
    @media (max-width: 1024px) {
        .hero-panel { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .hero-panel { padding: 24px; }
        .timeline-item { grid-template-columns: 1fr; }
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
    {{-- HERO --}}
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

    {{-- HIGHLIGHT STATS --}}
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
                    $accent = 'blue'; // fallback aman
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

    {{-- AGENDA HARI INI --}}
    <div class="content-grid">
        <div class="column-primary">
            <section class="schedule-card" aria-labelledby="agenda-title">
                <header>
                    <div>
                        <h2 id="agenda-title">Agenda Mengajar Hari Ini</h2>
                        <span>{{ $todayLabel }}</span>
                    </div>
                </header>

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
    </div>
</div>
@endsection
