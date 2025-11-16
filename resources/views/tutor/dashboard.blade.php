@extends('tutor.layout')

@section('title', 'Dashboard Tentor - MayClass')

@push('styles')
    <style>
        .dashboard-content {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .hero-panel {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 32px;
            padding: 32px 36px;
            border-radius: 24px;
            background: #1d3a8a;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .hero-copy {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .hero-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #34d399;
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

        .hero-metrics {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .hero-metrics .metric {
            min-width: 120px;
            padding: 12px 16px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.12);
        }

        .hero-metrics .metric span {
            display: block;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .hero-metrics .metric strong {
            display: block;
            font-size: 1.6rem;
            margin-top: 4px;
        }

        .hero-visual {
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

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

        .stat-card span.label {
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

        .stat-card[data-accent='blue'],
        .stat-card.accent-blue {
            border-top: 4px solid #2563eb;
        }

        .stat-card[data-accent='mint'],
        .stat-card.accent-mint {
            border-top: 4px solid #10b981;
        }

        .stat-card[data-accent='orange'],
        .stat-card.accent-orange {
            border-top: 4px solid #f97316;
        }

        .stat-card[data-accent='purple'],
        .stat-card.accent-purple {
            border-top: 4px solid #7c3aed;
        }

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.7fr) minmax(0, 1fr);
            gap: 24px;
        }

        .column-primary,
        .column-secondary {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .schedule-card,
        .resource-section,
        .insight-card,
        .upcoming-card,
        .quick-actions-card {
            background: var(--surface);
            border-radius: 20px;
            padding: 24px;
            border: 1px solid var(--border-subtle);
        }

        .schedule-card header,
        .resource-section header,
        .upcoming-card header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .schedule-card header h2,
        .resource-section header h2,
        .upcoming-card header h2,
        .insight-card h2,
        .quick-actions-card h2 {
            margin: 0;
            font-size: 1.3rem;
        }

        .schedule-card header span,
        .resource-section header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .schedule-card .link,
        .resource-section header a,
        .upcoming-card header a {
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

        .resource-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .resource-card {
            display: flex;
            flex-direction: column;
            border-radius: 16px;
            border: 1px solid var(--border-subtle);
            background: var(--surface-muted);
            overflow: hidden;
        }

        .resource-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .resource-card .info {
            padding: 16px 18px 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .resource-card .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: var(--accent);
            font-size: 0.85rem;
            font-weight: 600;
        }

        .resource-card h3 {
            margin: 0;
            font-size: 1.05rem;
        }

        .resource-card .resource-link {
            margin-top: 4px;
            color: var(--accent);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .resource-empty {
            text-align: center;
            padding: 28px;
            border-radius: 16px;
            border: 1px dashed var(--border-subtle);
            color: var(--text-muted);
        }

        .insight-card p {
            margin: 0 0 16px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .insight-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .insight-list li {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            background: var(--surface-muted);
        }

        .insight-list li span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .upcoming-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .upcoming-card li {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border-subtle);
        }

        .upcoming-card li:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .upcoming-card span {
            color: var(--text-muted);
        }

        .upcoming-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .upcoming-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-subtle);
        }

        .upcoming-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .upcoming-item span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .quick-actions-card ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .quick-actions-card li {
            width: 100%;
        }

        .quick-actions-card a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 12px;
            border: 1px solid var(--border-subtle);
            font-weight: 600;
            color: var(--text-main);
            background: var(--surface-muted);
            justify-content: space-between;
        }

        .quick-actions-card a:hover {
            color: var(--accent);
            border-color: rgba(37, 99, 235, 0.4);
        }

        .quick-actions-card .arrow {
            font-weight: 700;
            color: var(--text-muted);
        }

        @media (max-width: 1024px) {
            .hero-panel {
                grid-template-columns: 1fr;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .hero-panel {
                padding: 24px;
            }

            .timeline-item {
                grid-template-columns: 1fr;
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
        <section class="hero-panel">
            <div class="hero-copy">
                <span class="hero-badge">Dashboard Tentor</span>
                <h1>{{ $firstName }}, mari optimalkan sesi belajar hari ini.</h1>
                <p>
                    Pantau jadwal, materi, dan perkembangan siswa secara real-time agar pengalaman belajar tetap konsisten
                    dan terarah.
                </p>
                <div class="hero-metrics">
                    <div class="metric">
                        <span>Jadwal hari ini</span>
                        <strong>{{ $todaySessions->count() }}</strong>
                    </div>
                    <div class="metric">
                        <span>Siswa terjadwal</span>
                        <strong>{{ number_format($totalStudentsToday) }}</strong>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <img src="{{ $heroImage }}" alt="Ilustrasi tutor" />
            </div>
        </section>

        <section class="stat-grid">
            @foreach ($highlightStats as $stat)
                <article class="stat-card accent-{{ $stat['accent'] }}">
                    <span class="label">{{ $stat['label'] }}</span>
                    <div class="value-row">
                        <strong>{{ $stat['display'] }}</strong>
                        <span class="suffix">{{ $stat['suffix'] }}</span>
                    </div>
                    <p>{{ $stat['description'] }}</p>
                </article>
            @endforeach
        </section>

        <div class="content-grid">
            <div class="column-primary">
                <section class="schedule-card">
                    <header>
                        <div>
                            <h2>Agenda Mengajar Hari Ini</h2>
                            <span>{{ $todayLabel }}</span>
                        </div>
                        <a class="link" href="{{ route('tutor.schedule.index') }}">Kelola Jadwal</a>
                    </header>
                    @if ($todaySessions->isEmpty())
                        <div class="empty-timeline">Belum ada sesi mengajar untuk hari ini. Tambahkan jadwal baru agar siswa tetap terarah.</div>
                    @else
                        <ul class="timeline">
                            @foreach ($todaySessions as $session)
                                <li class="timeline-item {{ $session['highlight'] ? 'is-highlight' : '' }}">
                                    <div class="time">{{ $session['time_range'] }}</div>
                                    <div class="details">
                                        <strong>{{ $session['title'] }}</strong>
                                        <span>{{ $session['subject'] }} • {{ $session['class_level'] }}</span>
                                        <span>{{ $session['location'] }}</span>
                                        <span>{{ $session['student_count'] ? $session['student_count'] . ' siswa' : 'Jumlah siswa belum ditentukan' }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </section>

                <section class="resource-section">
                    <header>
                        <div>
                            <h2>Materi Terbaru</h2>
                            <p>Sorotan materi yang paling baru agar mudah dibagikan kepada kelas.</p>
                        </div>
                        <a href="{{ route('tutor.materials.index') }}">Lihat semua</a>
                    </header>
                    @if ($materialsShowcase->isEmpty())
                        <div class="resource-empty">Belum ada materi tersimpan. Mulai rancang modul belajar pertamamu.</div>
                    @else
                        <div class="resource-grid">
                            @foreach ($materialsShowcase as $material)
                                <article class="resource-card">
                                    <img src="{{ $material['thumbnail'] }}" alt="{{ $material['title'] }}" />
                                    <div class="info">
                                        <span class="chip">{{ $material['subject'] }} • {{ $material['level'] }}</span>
                                        <h3>{{ $material['title'] }}</h3>
                                        <a class="resource-link" href="{{ $material['link'] }}">Atur Materi</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </section>

                <section class="resource-section">
                    <header>
                        <div>
                            <h2>Quiz Siap Digunakan</h2>
                            <p>Pilih kuis yang telah tersedia untuk mengevaluasi pemahaman siswa.</p>
                        </div>
                        <a href="{{ route('tutor.quizzes.index') }}">Kelola kuis</a>
                    </header>
                    @if ($quizShowcase->isEmpty())
                        <div class="resource-empty">Belum ada kuis aktif. Buat kuis baru untuk mengukur capaian belajar.</div>
                    @else
                        <div class="resource-grid">
                            @foreach ($quizShowcase as $quiz)
                                <article class="resource-card">
                                    <img src="{{ $quiz['thumbnail'] }}" alt="{{ $quiz['title'] }}" />
                                    <div class="info">
                                        <span class="chip">{{ $quiz['subject'] }} • {{ $quiz['level'] }}</span>
                                        <h3>{{ $quiz['title'] }}</h3>
                                        <a class="resource-link" href="{{ $quiz['link'] }}">Sesuaikan Kuis</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>

            <div class="column-secondary">
                <section class="insight-card">
                    <h2>Ringkasan Mengajar</h2>
                    <p>Angka-angka utama untuk memantau progres kegiatan bimbinganmu.</p>
                    <ul class="insight-list">
                        <li>
                            <span>Jam mengajar akumulasi</span>
                            <strong>{{ number_format($teachingHours, 1, ',', '.') }} jam</strong>
                        </li>
                        <li>
                            <span>Materi aktif</span>
                            <strong>{{ number_format($stats['materials']) }}</strong>
                        </li>
                        <li>
                            <span>Quiz aktif</span>
                            <strong>{{ number_format($stats['quizzes']) }}</strong>
                        </li>
                    </ul>
                </section>

                <section class="upcoming-card">
                    <header>
                        <div>
                            <h2>Jadwal Selanjutnya</h2>
                            <span>Persiapkan materi sebelum sesi dimulai.</span>
                        </div>
                        <a href="{{ route('tutor.schedule.index') }}">Lihat kalender</a>
                    </header>
                    @if ($nextSessions->isEmpty())
                        <div class="resource-empty">Belum ada jadwal mendatang. Jadwalkan sesi agar agenda belajar lebih teratur.</div>
                    @else
                        <div class="upcoming-list">
                            @foreach ($nextSessions as $session)
                                <div class="upcoming-item">
                                    <strong>{{ $session['title'] }}</strong>
                                    <span>{{ $session['day'] }}, {{ $session['date_label'] }}</span>
                                    <span>{{ $session['subject'] }} • {{ $session['class_level'] }}</span>
                                    <span>{{ $session['time_range'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <section class="quick-actions-card">
                    <h2>Aksi Cepat</h2>
                    <ul>
                        @foreach ($quickActions as $action)
                            <li>
                                <a href="{{ $action['href'] }}">
                                    <div>
                                        <strong>{{ $action['label'] }}</strong>
                                        <span>{{ $action['description'] }}</span>
                                    </div>
                                    <span class="arrow">→</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>
        </div>
    </div>
@endsection
