@extends('student.layouts.app')

@section('title', 'Dashboard Siswa')

@push('styles')
    <style>
        .student-dashboard__hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: clamp(20px, 4vw, 40px);
        }

        .student-dashboard__summary {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .student-dashboard__summary h1 {
            margin: 0;
            font-size: clamp(1.9rem, 4vw, 2.6rem);
            line-height: 1.18;
        }

        .student-dashboard__summary p {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 1rem;
        }

        .student-dashboard__chips {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .student-dashboard__highlight {
            position: relative;
            padding: clamp(24px, 4vw, 32px);
            border-radius: var(--student-radius-lg);
            background: linear-gradient(140deg, rgba(47, 152, 140, 0.12), rgba(95, 106, 248, 0.16));
            box-shadow: 0 32px 68px rgba(33, 115, 105, 0.16);
            overflow: hidden;
            display: grid;
            gap: 12px;
        }

        .student-dashboard__highlight::after {
            content: "";
            position: absolute;
            inset: 0;
            background: url("{{ \App\Support\ImageRepository::url('dashboard_banner') }}") center/cover;
            opacity: 0.18;
        }

        .student-dashboard__highlight > * {
            position: relative;
        }

        .student-dashboard__stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: clamp(16px, 3vw, 28px);
        }

        .student-dashboard__calendar {
            display: grid;
            gap: 20px;
        }

        .student-dashboard__calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 12px;
        }

        .student-dashboard__calendar-cell {
            text-align: center;
            padding: 14px 0;
            border-radius: 16px;
            font-size: 0.92rem;
            color: var(--student-text-muted);
        }

        .student-dashboard__calendar-cell.is-active {
            background: linear-gradient(120deg, var(--student-primary), var(--student-primary-soft));
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 18px 32px rgba(27, 119, 110, 0.22);
        }

        .student-dashboard__calendar-cell.is-muted {
            opacity: 0.45;
        }

        .student-dashboard__list {
            display: grid;
            gap: 16px;
        }

        .student-dashboard__list-item {
            display: grid;
            gap: 8px;
            background: var(--student-surface);
            border-radius: var(--student-radius-lg);
            padding: clamp(18px, 2vw, 24px);
            box-shadow: 0 22px 48px rgba(33, 115, 105, 0.12);
        }

        .student-dashboard__list-item h3 {
            margin: 0;
            font-size: 1.05rem;
        }

        .student-dashboard__materials,
        .student-dashboard__quizzes {
            display: grid;
            gap: 20px;
        }

        .student-dashboard__card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: clamp(18px, 3vw, 28px);
        }

        .student-dashboard__material-card,
        .student-dashboard__quiz-card {
            position: relative;
            border-radius: var(--student-radius-lg);
            overflow: hidden;
            background: var(--student-surface);
            box-shadow: 0 24px 52px rgba(33, 115, 105, 0.14);
            display: grid;
            gap: 14px;
            padding: clamp(18px, 3vw, 26px);
        }

        .student-dashboard__material-card::before,
        .student-dashboard__quiz-card::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: 0.18;
            pointer-events: none;
            background: linear-gradient(160deg, var(--accent, rgba(47, 152, 140, 0.45)), rgba(255, 255, 255, 0));
        }

        .student-dashboard__material-card h4,
        .student-dashboard__quiz-card h4 {
            margin: 0;
            font-size: 1.1rem;
        }

        .student-dashboard__material-card p,
        .student-dashboard__quiz-card p {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 0.92rem;
        }

        .student-dashboard__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--student-text-muted);
        }

        .student-dashboard__empty {
            padding: clamp(24px, 4vw, 32px);
            border-radius: var(--student-radius-lg);
            background: rgba(47, 152, 140, 0.08);
            text-align: center;
            color: var(--student-text-muted);
            display: grid;
            gap: 12px;
        }

        .student-visitor__layout {
            display: grid;
            gap: clamp(28px, 6vw, 44px);
        }

        .student-visitor__intro {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: clamp(18px, 3vw, 28px);
        }

        .student-visitor__hero {
            display: grid;
            gap: 16px;
            padding: clamp(28px, 5vw, 40px);
            border-radius: var(--student-radius-lg);
            background: linear-gradient(140deg, rgba(47, 152, 140, 0.16), rgba(95, 106, 248, 0.14));
            box-shadow: 0 36px 72px rgba(33, 115, 105, 0.16);
            position: relative;
            overflow: hidden;
        }

        .student-visitor__hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: url("{{ \App\Support\ImageRepository::url('dashboard_banner') }}") center/cover;
            opacity: 0.12;
            pointer-events: none;
        }

        .student-visitor__hero > * {
            position: relative;
        }

        .student-visitor__hero h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 2.8rem);
            line-height: 1.18;
        }

        .student-visitor__hero p {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 1rem;
        }

        .student-visitor__cta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .student-visitor__benefits {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 10px;
            font-size: 0.95rem;
            color: var(--student-text-muted);
        }

        .student-visitor__benefits li {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .student-visitor__benefits li::before {
            content: "✔";
            font-size: 0.9rem;
            color: var(--student-primary);
        }

        .student-visitor__status {
            display: grid;
            gap: 12px;
            padding: clamp(24px, 4vw, 32px);
            border-radius: var(--student-radius-lg);
            background: var(--student-surface);
            box-shadow: 0 30px 60px rgba(34, 118, 108, 0.12);
        }

        .student-visitor__status p {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 0.92rem;
        }

        .student-visitor__packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: clamp(18px, 3vw, 28px);
        }

        .student-visitor__card {
            position: relative;
            display: grid;
            gap: 14px;
            padding: clamp(24px, 4vw, 30px);
            border-radius: var(--student-radius-lg);
            background: var(--student-surface);
            box-shadow: 0 28px 60px rgba(33, 115, 105, 0.14);
            overflow: hidden;
        }

        .student-visitor__card::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: 0.18;
            background: linear-gradient(160deg, rgba(47, 152, 140, 0.45), rgba(255, 255, 255, 0));
            pointer-events: none;
        }

        .student-visitor__card > * {
            position: relative;
        }

        .student-visitor__badge {
            align-self: flex-start;
            padding: 6px 14px;
            border-radius: 999px;
            background: rgba(95, 106, 248, 0.14);
            color: var(--student-accent);
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .student-visitor__title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .student-visitor__price {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--student-primary);
        }

        .student-visitor__summary {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 0.95rem;
        }

        .student-visitor__features {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 8px;
            font-size: 0.9rem;
            color: var(--student-text-muted);
        }

        .student-visitor__features li {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .student-visitor__features li::before {
            content: "•";
            color: var(--student-accent);
            font-size: 1.2rem;
            line-height: 1;
        }

        .student-visitor__actions {
            display: inline-flex;
            flex-wrap: wrap;
            gap: 12px;
        }
    </style>
@endpush

@php($user = auth()->user())
@php($materialsLink = $materialsLink ?? config('mayclass.links.materials_drive'))
@php($quizLink = $quizLink ?? config('mayclass.links.quiz_platform'))
@php($hasActivePackage = $hasActivePackage ?? ($studentHasActivePackage ?? false))
@php($packages = collect($packages ?? []))

@section('content')
    @if ($hasActivePackage)
    <section class="student-section">
        <div class="student-dashboard__hero">
            <div class="student-dashboard__summary">
                <span class="student-chip">Portal belajar pribadi</span>
                <h1>Hai, {{ $user?->name ?? 'Siswa' }}</h1>
                <p>
                    Tersedia {{ number_format($metrics['materials_total']) }} materi, {{ number_format($metrics['quizzes_total']) }}
                    kuis, dan {{ number_format($metrics['upcoming_total']) }} sesi yang dijadwalkan.
                </p>
                <div class="student-dashboard__chips">
                    <span class="student-chip">{{ number_format($metrics['subjects_total']) }} mata pelajaran</span>
                    <span class="student-chip">{{ number_format($metrics['levels_total']) }} jenjang belajar</span>
                    <span class="student-chip">{{ number_format($metrics['week_sessions']) }} sesi minggu ini</span>
                </div>
                <div class="student-dashboard__chips">
                    <a class="student-button student-button--primary" href="{{ $materialsLink }}" target="_blank" rel="noopener">
                        Buka bank materi
                    </a>
                    <a class="student-button student-button--outline" href="{{ $quizLink }}" target="_blank" rel="noopener">
                        Mulai latihan soal
                    </a>
                    <a class="student-button student-button--outline" href="{{ route('student.schedule') }}">
                        Kelola jadwal
                    </a>
                </div>
            </div>
            <div class="student-dashboard__highlight">
                <span class="student-chip">Sesi terdekat</span>
                <h2 style="margin: 0; font-size: 1.4rem;">{{ $schedule['highlight']['title'] }}</h2>
                <div class="student-dashboard__meta">
                    <span>{{ $schedule['highlight']['date'] }}</span>
                    <span>{{ $schedule['highlight']['time'] }}</span>
                    <span>Mentor {{ $schedule['highlight']['mentor'] }}</span>
                    <span>Kategori {{ $schedule['highlight']['category'] }}</span>
                </div>
                <a class="student-button student-button--primary" style="width: max-content;" href="{{ route('student.schedule') }}">
                    Lihat detail jadwal
                </a>
            </div>
        </div>
    </section>

    <section class="student-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Ringkasan aktivitas</h2>
        </div>
        <div class="student-dashboard__stats">
            <div class="student-card">
                <p class="student-card__subtitle">Sesi terencana (7 hari)</p>
                <h3 class="student-card__title">{{ number_format($metrics['upcoming_total']) }}</h3>
                <div class="student-card__meta">
                    <span>{{ $schedule['monthLabel'] }}</span>
                </div>
            </div>
            <div class="student-card">
                <p class="student-card__subtitle">Materi aktif</p>
                <h3 class="student-card__title">{{ number_format($metrics['materials_total']) }}</h3>
                <div class="student-card__meta">
                    <span>{{ number_format($metrics['recent_materials']) }} materi baru 14 hari terakhir</span>
                </div>
                <a class="student-button student-button--outline" href="{{ route('student.materials') }}">Kelola materi</a>
            </div>
            <div class="student-card">
                <p class="student-card__subtitle">Koleksi kuis</p>
                <h3 class="student-card__title">{{ number_format($metrics['quizzes_total']) }}</h3>
                <div class="student-card__meta">
                    <span>{{ number_format($metrics['recent_quizzes']) }} kuis baru 14 hari terakhir</span>
                </div>
                <a class="student-button student-button--outline" href="{{ route('student.quiz') }}">Kelola kuis</a>
            </div>
            <div class="student-card">
                <p class="student-card__subtitle">Paket aktif</p>
                <h3 class="student-card__title">{{ $activePackage['title'] }}</h3>
                <div class="student-card__meta">
                    <span>{{ $activePackage['period'] }}</span>
                    <span>Status: {{ $activePackage['status'] }}</span>
                </div>
                <a class="student-button student-button--outline" href="{{ route('student.profile') }}">Kelola profil</a>
            </div>
        </div>
    </section>

    <section class="student-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Jadwal terdekat</h2>
            <a class="student-button student-button--outline" href="{{ route('student.schedule') }}">Lihat kalender</a>
        </div>
        @if (! empty($schedule['upcoming']) && count($schedule['upcoming']) > 0)
            <div class="student-dashboard__list">
                @foreach ($schedule['upcoming'] as $session)
                    <article class="student-dashboard__list-item">
                        <h3>{{ $session['title'] }}</h3>
                        <div class="student-dashboard__meta">
                            <span>{{ $session['date'] }}</span>
                            <span>{{ $session['time'] }}</span>
                            <span>Mentor {{ $session['mentor'] }}</span>
                            <span>{{ $session['category'] }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="student-dashboard__empty">
                <p>Belum ada sesi dijadwalkan. Tambahkan jadwal baru melalui menu Jadwal.</p>
                <a class="student-button student-button--primary" href="{{ route('student.schedule') }}">Tambah jadwal</a>
            </div>
        @endif
    </section>

    <section class="student-section student-dashboard__materials">
        <div class="student-section__header">
            <h2 class="student-section__title">Materi terbaru</h2>
            <a class="student-button student-button--outline" href="{{ $materialsLink }}" target="_blank" rel="noopener">Buka arsip</a>
        </div>
        @if ($recentMaterials->isNotEmpty())
            <div class="student-dashboard__card-grid">
                @foreach ($recentMaterials as $material)
                    <article class="student-dashboard__material-card" style="--accent: {{ $material['accent'] }};">
                        <span class="student-chip" style="background: rgba(47, 152, 140, 0.14); color: var(--student-primary);">{{ $material['subject'] }}</span>
                        <h4>{{ $material['title'] }}</h4>
                        <p>{{ $material['summary'] }}</p>
                        <div class="student-dashboard__meta">
                            <span>Level {{ $material['level'] }}</span>
                            <span>{{ $material['chapter_count'] }} bab</span>
                        </div>
                        <a class="student-button student-button--primary" href="{{ $material['resource'] }}" target="_blank" rel="noopener">Lihat materi</a>
                    </article>
                @endforeach
            </div>
        @else
            <div class="student-dashboard__empty">
                <p>Belum ada materi diterbitkan. Tambahkan melalui dashboard tutor.</p>
            </div>
        @endif
    </section>

    <section class="student-section student-dashboard__quizzes">
        <div class="student-section__header">
            <h2 class="student-section__title">Quiz terbaru</h2>
            <a class="student-button student-button--outline" href="{{ $quizLink }}" target="_blank" rel="noopener">Buka platform</a>
        </div>
        @if ($recentQuizzes->isNotEmpty())
            <div class="student-dashboard__card-grid">
                @foreach ($recentQuizzes as $quiz)
                    <article class="student-dashboard__quiz-card" style="--accent: {{ $quiz['accent'] }};">
                        <span class="student-chip" style="background: rgba(95, 106, 248, 0.14); color: var(--student-accent);">
                            {{ $quiz['duration'] }} • {{ $quiz['questions'] }} soal
                        </span>
                        <h4>{{ $quiz['title'] }}</h4>
                        <p>{{ $quiz['summary'] }}</p>
                        <div class="student-dashboard__meta">
                            @foreach ($quiz['levels'] as $level)
                                <span>Level {{ $level }}</span>
                            @endforeach
                        </div>
                        <a class="student-button student-button--primary" href="{{ $quiz['link'] }}" target="_blank" rel="noopener">Mulai kuis</a>
                    </article>
                @endforeach
            </div>
        @else
            <div class="student-dashboard__empty">
                <p>Belum ada kuis diterbitkan. Tambahkan kuis melalui dashboard tutor.</p>
            </div>
        @endif
    </section>

    <section class="student-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Kalender belajar</h2>
            <span class="student-chip">{{ $schedule['monthLabel'] }}</span>
        </div>
        <div class="student-dashboard__calendar">
            <div class="student-dashboard__calendar-grid">
                @foreach ($schedule['calendar'] as $column)
                    @foreach ($column['days'] as $day)
                        @php($isActive = in_array($day, $schedule['activeDays'], true))
                        @php($isMuted = in_array($day, $schedule['mutedCells'][$column['label']] ?? [], true))
                        <div class="student-dashboard__calendar-cell {{ $isActive ? 'is-active' : '' }} {{ $isMuted ? 'is-muted' : '' }}">
                            {{ $day }}
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    @else
        @php($featuredPackage = $packages->first())
        <section class="student-section student-visitor__layout">
            <div class="student-visitor__intro">
                <div class="student-visitor__hero">
                    <span class="student-chip">Mulai perjalanan belajarmu</span>
                    <h1>Hai, {{ $user?->name ?? 'Siswa' }}!</h1>
                    <p>
                        Akunmu sudah aktif, namun belum ada paket belajar yang berjalan. Pilih paket favorit untuk membuka materi,
                        kuis, dan jadwal eksklusif MayClass.
                    </p>
                    <ul class="student-visitor__benefits">
                        <li>Akses bank materi lengkap yang terus diperbarui</li>
                        <li>Latihan soal interaktif sesuai jenjang belajarmu</li>
                        <li>Kalender belajar terstruktur bersama tutor MayClass</li>
                    </ul>
                    <div class="student-visitor__cta">
                        <a class="student-button student-button--primary" href="{{ route('packages.index') }}">Lihat semua paket</a>
                        @if ($featuredPackage)
                            <a class="student-button student-button--outline" href="{{ route('checkout.show', $featuredPackage['slug']) }}">
                                Checkout {{ $featuredPackage['title'] }}
                            </a>
                        @endif
                    </div>
                </div>
                <div class="student-visitor__status">
                    <p class="student-card__subtitle" style="color: var(--student-primary); font-weight: 600;">Status langganan</p>
                    <h3 style="margin: 0;">{{ $activePackage['title'] }}</h3>
                    <p>{{ $activePackage['period'] }}</p>
                    <p>Status: {{ $activePackage['status'] }}</p>
                    <div class="student-visitor__actions">
                        <a class="student-button student-button--primary" href="{{ route('packages.index') }}">Pilih paket belajar</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="student-section">
            <div class="student-section__header">
                <h2 class="student-section__title">Paket belajar rekomendasi</h2>
                <a class="student-button student-button--outline" href="{{ route('packages.index') }}">Lihat katalog lengkap</a>
            </div>
            @if ($packages->isNotEmpty())
                <div class="student-visitor__packages-grid">
                    @foreach ($packages as $package)
                        <article class="student-visitor__card">
                            @if (! empty($package['tag']))
                                <span class="student-visitor__badge">{{ $package['tag'] }}</span>
                            @endif
                            <h3 class="student-visitor__title">{{ $package['title'] }}</h3>
                            <p class="student-visitor__price">{{ $package['price'] }}</p>
                            <p class="student-visitor__summary">{{ $package['summary'] }}</p>
                            @if (! empty($package['features']))
                                <ul class="student-visitor__features">
                                    @foreach ($package['features'] as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="student-visitor__actions">
                                <a class="student-button student-button--primary" href="{{ route('checkout.show', $package['slug']) }}">Checkout sekarang</a>
                                <a class="student-button student-button--outline" href="{{ route('packages.show', $package['slug']) }}">Lihat detail</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="student-dashboard__empty">
                    <p>Paket belajar belum tersedia. Silakan hubungi admin MayClass untuk bantuan berlangganan.</p>
                    <a class="student-button student-button--primary" href="{{ route('packages.index') }}">Kunjungi katalog paket</a>
                </div>
            @endif
        </section>

        <section class="student-section">
            <div class="student-section__header">
                <h2 class="student-section__title">Langkah aktivasi langganan</h2>
            </div>
            <div class="student-dashboard__stats">
                <div class="student-card">
                    <p class="student-card__subtitle">1. Pilih paket</p>
                    <p class="student-card__title">Sesuaikan dengan kebutuhan belajarmu</p>
                    <div class="student-card__meta">
                        <span>Bandingkan manfaat tiap paket sebelum checkout.</span>
                    </div>
                </div>
                <div class="student-card">
                    <p class="student-card__subtitle">2. Selesaikan pembayaran</p>
                    <p class="student-card__title">Unggah bukti transfer di halaman checkout</p>
                    <div class="student-card__meta">
                        <span>Tim MayClass memverifikasi pembayaran dalam jam kerja.</span>
                    </div>
                </div>
                <div class="student-card">
                    <p class="student-card__subtitle">3. Nikmati akses penuh</p>
                    <p class="student-card__title">Materi, kuis, dan jadwal langsung terbuka</p>
                    <div class="student-card__meta">
                        <span>Tutor akan membantu menyusun jadwal belajarmu.</span>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
