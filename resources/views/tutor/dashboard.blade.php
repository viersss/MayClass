@extends('tutor.layout')

@section('title', 'Dashboard Tentor - MayClass')

@push('styles')
    <style>
        .dashboard-content {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .hero-panel {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            align-items: center;
            gap: 36px;
            padding: 38px 44px;
            border-radius: 32px;
            color: #fff;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(84, 101, 255, 0.94), rgba(61, 183, 173, 0.88));
            box-shadow: 0 40px 80px rgba(84, 101, 255, 0.28);
        }

        .hero-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.22), transparent 46%);
            pointer-events: none;
        }

        .hero-copy {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.16);
            padding: 10px 16px;
            border-radius: 999px;
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 0.4px;
        }

        .hero-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.8);
        }

        .hero-panel h1 {
            margin: 0;
            font-size: 2.4rem;
            line-height: 1.25;
            letter-spacing: 0.3px;
        }

        .hero-panel p {
            margin: 0;
            font-size: 1.05rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .hero-metrics {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .hero-metrics .metric {
            background: rgba(255, 255, 255, 0.16);
            border-radius: 18px;
            padding: 14px 18px;
            min-width: 140px;
        }

        .hero-metrics .metric span {
            display: block;
            font-size: 0.9rem;
            opacity: 0.82;
        }

        .hero-metrics .metric strong {
            display: block;
            font-size: 1.8rem;
            margin-top: 6px;
        }

        .hero-visual {
            position: relative;
            z-index: 2;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 28px 60px rgba(15, 23, 42, 0.28);
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
            gap: 22px;
        }

        .stat-card {
            position: relative;
            background: var(--card-bg);
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.09);
            border: 1px solid var(--card-border);
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0.4;
            pointer-events: none;
        }

        .stat-card span.label {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .stat-card .value-row {
            display: flex;
            align-items: flex-end;
            gap: 12px;
            margin-top: 12px;
        }

        .stat-card .value-row strong {
            font-size: 2.2rem;
            color: #111827;
        }

        .stat-card .value-row .suffix {
            font-size: 1rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .stat-card p {
            margin: 12px 0 0;
            color: #374151;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .stat-card.accent-mint::after {
            background: linear-gradient(135deg, rgba(31, 209, 161, 0.22), transparent 60%);
        }

        .stat-card.accent-indigo::after {
            background: linear-gradient(135deg, rgba(84, 101, 255, 0.22), transparent 60%);
        }

        .stat-card.accent-orange::after {
            background: linear-gradient(135deg, rgba(244, 140, 6, 0.22), transparent 60%);
        }

        .stat-card.accent-purple::after {
            background: linear-gradient(135deg, rgba(155, 93, 229, 0.22), transparent 60%);
        }

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.7fr) minmax(0, 1fr);
            gap: 28px;
        }

        .column-primary,
        .column-secondary {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .schedule-card,
        .resource-section,
        .insight-card,
        .upcoming-card,
        .quick-actions-card {
            background: var(--card-bg);
            border-radius: 26px;
            padding: 28px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
            border: 1px solid var(--card-border);
        }

        .schedule-card header,
        .resource-section header,
        .upcoming-card header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 22px;
        }

        .schedule-card header h2,
        .resource-section header h2,
        .upcoming-card header h2,
        .insight-card h2,
        .quick-actions-card h2 {
            margin: 0;
            font-size: 1.4rem;
        }

        .schedule-card header span {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .schedule-card .link,
        .resource-section header a,
        .upcoming-card header a {
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .timeline {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .timeline-item {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 18px;
            align-items: start;
            padding: 18px 20px;
            border-radius: 20px;
            background: rgba(61, 183, 173, 0.08);
            border: 1px solid rgba(61, 183, 173, 0.18);
        }

        .timeline-item.is-highlight {
            background: rgba(84, 101, 255, 0.12);
            border-color: rgba(84, 101, 255, 0.28);
        }

        .timeline-item .time {
            font-weight: 600;
            color: #1f2937;
        }

        .timeline-item .details {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .timeline-item .details strong {
            font-size: 1.05rem;
        }

        .timeline-item .details span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .empty-timeline {
            text-align: center;
            padding: 38px 16px;
            border-radius: 20px;
            background: rgba(15, 23, 42, 0.04);
            color: var(--text-muted);
            font-weight: 500;
        }

        .resource-section header p {
            margin: 6px 0 0;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .resource-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .resource-card {
            display: flex;
            flex-direction: column;
            gap: 14px;
            background: rgba(248, 250, 252, 0.8);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(15, 23, 42, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .resource-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 40px rgba(15, 23, 42, 0.12);
        }

        .resource-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .resource-card .info {
            padding: 0 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .resource-card .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(61, 183, 173, 0.14);
            color: var(--primary-dark);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .resource-card h3 {
            margin: 0;
            font-size: 1.1rem;
        }

        .resource-card .resource-link {
            margin-top: 6px;
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .resource-empty {
            text-align: center;
            padding: 36px;
            border-radius: 20px;
            background: rgba(15, 23, 42, 0.04);
            color: var(--text-muted);
            font-weight: 500;
        }

        .insight-card p {
            margin: 0 0 18px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .insight-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .insight-list li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 16px;
            background: rgba(15, 23, 42, 0.04);
        }

        .insight-list li span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .insight-list li strong {
            font-size: 1.1rem;
        }

        .upcoming-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .upcoming-item {
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(84, 101, 255, 0.08);
            border: 1px solid rgba(84, 101, 255, 0.18);
            display: grid;
            gap: 6px;
        }

        .upcoming-item strong {
            font-size: 1.05rem;
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
            flex-direction: column;
            gap: 14px;
        }

        .quick-actions-card li a {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
            align-items: center;
            padding: 16px 18px;
            border-radius: 16px;
            background: rgba(15, 23, 42, 0.04);
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .quick-actions-card li a:hover {
            background: rgba(61, 183, 173, 0.14);
            transform: translateY(-2px);
        }

        .quick-actions-card li strong {
            font-size: 1.05rem;
        }

        .quick-actions-card li span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .quick-actions-card li .arrow {
            font-size: 1.2rem;
            color: var(--primary-dark);
        }

        @media (max-width: 1140px) {
            .hero-panel {
                grid-template-columns: 1fr;
                padding: 32px;
            }

            .hero-visual {
                max-width: 320px;
                margin: 0 auto;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .stat-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .timeline-item {
                grid-template-columns: 1fr;
            }

            .quick-actions-card li a {
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
