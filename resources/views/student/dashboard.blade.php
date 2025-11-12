@extends('student.layouts.app')

@section('title', 'Dashboard Siswa')

@push('styles')
    <style>
        .dashboard-wrapper {
            display: grid;
            gap: clamp(24px, 6vw, 36px);
        }

        .dashboard-grid {
            display: grid;
            gap: clamp(16px, 3vw, 24px);
        }

        .dashboard-grid--two {
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }

        .dashboard-grid--cards {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        }

        .dashboard-card {
            background: var(--student-surface);
            border: 1px solid var(--student-border);
            border-radius: var(--student-radius-md);
            padding: clamp(20px, 4vw, 28px);
            display: grid;
            gap: 12px;
        }

        .dashboard-card--accent {
            background: linear-gradient(160deg, rgba(47, 152, 140, 0.16), rgba(95, 106, 248, 0.12));
            border: none;
        }

        .dashboard-eyebrow {
            margin: 0;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--student-primary);
            font-weight: 600;
        }

        .dashboard-card__title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .dashboard-card__text {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 0.95rem;
        }

        .dashboard-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .dashboard-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .dashboard-stat {
            min-width: 160px;
            padding: 14px 16px;
            border-radius: var(--student-radius-sm);
            border: 1px solid var(--student-border);
            background: rgba(47, 152, 140, 0.05);
            display: grid;
            gap: 6px;
        }

        .dashboard-stat__value {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .dashboard-stat__label {
            margin: 0;
            font-size: 0.85rem;
            color: var(--student-text-muted);
        }

        .dashboard-section__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .dashboard-section__title {
            margin: 0;
            font-size: 1.3rem;
        }

        .dashboard-list {
            display: grid;
            gap: 12px;
        }

        .dashboard-list__item {
            border: 1px solid var(--student-border);
            border-radius: var(--student-radius-sm);
            padding: clamp(16px, 3vw, 22px);
            background: var(--student-surface);
            display: grid;
            gap: 8px;
        }

        .dashboard-list__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--student-text-muted);
        }

        .dashboard-empty {
            text-align: center;
            padding: clamp(20px, 4vw, 28px);
            border-radius: var(--student-radius-md);
            border: 1px dashed var(--student-border);
            color: var(--student-text-muted);
            display: grid;
            gap: 12px;
        }

        .package-grid {
            display: grid;
            gap: clamp(16px, 3vw, 24px);
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        }

        .package-card {
            border: 1px solid var(--student-border);
            border-radius: var(--student-radius-md);
            padding: clamp(20px, 3vw, 26px);
            display: grid;
            gap: 12px;
            background: var(--student-surface);
        }

        .package-card__image {
            width: 100%;
            border-radius: var(--student-radius-sm);
            aspect-ratio: 4 / 3;
            object-fit: cover;
        }

        .package-card__tag {
            align-self: flex-start;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--student-accent);
            background: rgba(95, 106, 248, 0.12);
            border-radius: 999px;
            padding: 6px 12px;
            font-weight: 600;
        }

        .package-card__meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            font-size: 0.85rem;
            color: var(--student-text-muted);
            flex-wrap: wrap;
        }

        .package-card__level {
            font-weight: 600;
        }

        .package-card__price {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--student-primary);
        }

        .package-features {
            list-style: disc;
            padding-left: 20px;
            margin: 0;
            display: grid;
            gap: 8px;
            font-size: 0.9rem;
            color: var(--student-text-muted);
        }

        .visitor-grid {
            display: grid;
            gap: clamp(18px, 4vw, 28px);
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }

        .dashboard-steps {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        .dashboard-step {
            border: 1px solid var(--student-border);
            border-radius: var(--student-radius-sm);
            padding: clamp(16px, 3vw, 22px);
            background: rgba(47, 152, 140, 0.05);
            display: grid;
            gap: 8px;
        }

        .dashboard-step strong {
            font-size: 0.95rem;
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
        <section class="dashboard-wrapper">
            <div class="dashboard-grid dashboard-grid--two">
                <article class="dashboard-card dashboard-card--accent">
                    <p class="dashboard-eyebrow">Selamat datang kembali</p>
                    <h1 style="margin: 0; font-size: clamp(1.6rem, 3vw, 2.2rem);">Hai, {{ $user?->name ?? 'Siswa' }}</h1>
                    <p class="dashboard-card__text">
                        Paket belajarmu sudah aktif. Gunakan akses cepat di bawah untuk langsung membuka materi, kuis,
                        atau jadwal belajar.
                    </p>
                    <div class="dashboard-actions">
                        <a class="student-button student-button--primary" href="{{ $materialsLink }}" target="_blank" rel="noopener">
                            Buka materi
                        </a>
                        <a class="student-button student-button--outline" href="{{ $quizLink }}" target="_blank" rel="noopener">
                            Mulai kuis
                        </a>
                        <a class="student-button student-button--outline" href="{{ route('student.schedule') }}">
                            Kelola jadwal
                        </a>
                    </div>
                </article>
                <article class="dashboard-card">
                    <p class="dashboard-eyebrow">Paket aktif</p>
                    <h2 class="dashboard-card__title">{{ $activePackage['title'] }}</h2>
                    <p class="dashboard-card__text">{{ $activePackage['period'] }}</p>
                    <p class="dashboard-card__text">Status: {{ $activePackage['status'] }}</p>
                    <a class="student-button student-button--outline" href="{{ route('packages.index') }}">Lihat paket lainnya</a>
                </article>
            </div>

            <div class="dashboard-stats">
                <div class="dashboard-stat">
                    <p class="dashboard-stat__value">{{ number_format($metrics['materials_total']) }}</p>
                    <p class="dashboard-stat__label">Materi tersedia</p>
                </div>
                <div class="dashboard-stat">
                    <p class="dashboard-stat__value">{{ number_format($metrics['quizzes_total']) }}</p>
                    <p class="dashboard-stat__label">Koleksi kuis</p>
                </div>
                <div class="dashboard-stat">
                    <p class="dashboard-stat__value">{{ number_format($metrics['upcoming_total']) }}</p>
                    <p class="dashboard-stat__label">Sesi terjadwal</p>
                </div>
            </div>
        </section>

        <section class="student-section">
            <div class="dashboard-section__header">
                <h2 class="dashboard-section__title">Jadwal terdekat</h2>
                <a class="student-button student-button--outline" href="{{ route('student.schedule') }}">Kelola jadwal</a>
            </div>
            @if (! empty($schedule['upcoming']) && count($schedule['upcoming']) > 0)
                <div class="dashboard-list">
                    @foreach ($schedule['upcoming'] as $session)
                        <article class="dashboard-list__item">
                            <h3 style="margin: 0; font-size: 1.05rem;">{{ $session['title'] }}</h3>
                            <div class="dashboard-list__meta">
                                <span>{{ $session['date'] }}</span>
                                <span>{{ $session['time'] }}</span>
                                <span>Mentor {{ $session['mentor'] }}</span>
                                <span>{{ $session['category'] }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="dashboard-empty">
                    <p>Belum ada sesi dijadwalkan. Tambahkan jadwal baru melalui menu Jadwal.</p>
                    <a class="student-button student-button--primary" href="{{ route('student.schedule') }}">Tambah jadwal</a>
                </div>
            @endif
        </section>

        <section class="student-section">
            <div class="dashboard-section__header">
                <h2 class="dashboard-section__title">Materi terbaru</h2>
                <a class="student-button student-button--outline" href="{{ $materialsLink }}" target="_blank" rel="noopener">Buka arsip</a>
            </div>
            @if ($recentMaterials->isNotEmpty())
                <div class="dashboard-grid dashboard-grid--cards">
                    @foreach ($recentMaterials as $material)
                        <article class="dashboard-card">
                            <span class="student-chip" style="background: rgba(47, 152, 140, 0.12); color: var(--student-primary);">
                                {{ $material['subject'] }}
                            </span>
                            <h3 class="dashboard-card__title">{{ $material['title'] }}</h3>
                            <p class="dashboard-card__text">{{ $material['summary'] }}</p>
                            <div class="dashboard-list__meta">
                                <span>Level {{ $material['level'] }}</span>
                                <span>{{ $material['chapter_count'] }} bab</span>
                            </div>
                            <a class="student-button student-button--primary" href="{{ $material['resource'] }}" target="_blank" rel="noopener">Lihat materi</a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="dashboard-empty">
                    <p>Belum ada materi diterbitkan. Materi baru akan muncul di sini secara otomatis.</p>
                </div>
            @endif
        </section>

        <section class="student-section">
            <div class="dashboard-section__header">
                <h2 class="dashboard-section__title">Kuis terbaru</h2>
                <a class="student-button student-button--outline" href="{{ $quizLink }}" target="_blank" rel="noopener">Buka platform</a>
            </div>
            @if ($recentQuizzes->isNotEmpty())
                <div class="dashboard-grid dashboard-grid--cards">
                    @foreach ($recentQuizzes as $quiz)
                        <article class="dashboard-card">
                            <span class="student-chip" style="background: rgba(95, 106, 248, 0.14); color: var(--student-accent);">
                                {{ $quiz['duration'] }} • {{ $quiz['questions'] }} soal
                            </span>
                            <h3 class="dashboard-card__title">{{ $quiz['title'] }}</h3>
                            <p class="dashboard-card__text">{{ $quiz['summary'] }}</p>
                            @if (! empty($quiz['levels']))
                                <div class="dashboard-list__meta">
                                    @foreach ($quiz['levels'] as $level)
                                        <span>{{ $level }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <a class="student-button student-button--outline" href="{{ $quiz['link'] }}" target="_blank" rel="noopener">Mulai latihan</a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="dashboard-empty">
                    <p>Kuis belum tersedia. Cek lagi nanti untuk latihan terbaru.</p>
                </div>
            @endif
        </section>
    @else
        @php($featuredPackage = $packages->first())
        <section class="student-section dashboard-wrapper">
            <div class="visitor-grid">
                <article class="dashboard-card dashboard-card--accent">
                    <p class="dashboard-eyebrow">Mulai perjalanan belajarmu</p>
                    <h1 style="margin: 0; font-size: clamp(1.8rem, 4vw, 2.4rem);">Hai, {{ $user?->name ?? 'Siswa' }}!</h1>
                    <p class="dashboard-card__text">
                        Akunmu sudah aktif, namun belum ada paket belajar yang berjalan. Pilih paket favorit untuk membuka
                        materi, kuis, dan jadwal eksklusif MayClass.
                    </p>
                    <ul style="margin: 0; padding-left: 18px; color: var(--student-text-muted); display: grid; gap: 6px; font-size: 0.95rem;">
                        <li>Akses bank materi lengkap yang terus diperbarui</li>
                        <li>Latihan soal interaktif sesuai jenjang belajarmu</li>
                        <li>Kalender belajar terstruktur bersama tutor MayClass</li>
                    </ul>
                    <div class="dashboard-actions">
                        <a class="student-button student-button--primary" href="{{ route('packages.index') }}">Lihat semua paket</a>
                        @if ($featuredPackage)
                            <a class="student-button student-button--outline" href="{{ route('checkout.show', $featuredPackage['slug']) }}">
                                Checkout {{ $featuredPackage['title'] }}
                            </a>
                        @endif
                    </div>
                </article>
                <article class="dashboard-card">
                    <p class="dashboard-eyebrow" style="color: var(--student-accent);">Status langganan</p>
                    <h2 class="dashboard-card__title">Belum ada paket aktif</h2>
                    <p class="dashboard-card__text">
                        Aktivasi salah satu paket di MayClass untuk membuka materi eksklusif, kuis interaktif, dan jadwal
                        belajar bersama tutor profesional.
                    </p>
                    <a class="student-button student-button--primary" href="{{ route('packages.index') }}">Pilih paket belajar</a>
                </article>
            </div>
        </section>

        <section class="student-section">
            <div class="dashboard-section__header">
                <h2 class="dashboard-section__title">Paket belajar rekomendasi</h2>
                <a class="student-button student-button--outline" href="{{ route('packages.index') }}">Lihat katalog lengkap</a>
            </div>
            @if ($packages->isNotEmpty())
                <div class="package-grid">
                    @foreach ($packages as $package)
                        <article class="package-card">
                            @if (! empty($package['image']))
                                <img class="package-card__image" src="{{ $package['image'] }}" alt="Ilustrasi paket {{ $package['title'] }}" />
                            @endif
                            @if (! empty($package['tag']) || ! empty($package['stage_label'] ?? $package['stage']))
                                <div class="package-card__meta">
                                    @if (! empty($package['tag']))
                                        <span class="package-card__tag">{{ $package['tag'] }}</span>
                                    @endif
                                    @if (! empty($package['stage_label'] ?? $package['stage']))
                                        <span class="package-card__level">
                                            {{ $package['stage_label'] ?? $package['stage'] }}
                                            @if (! empty($package['grade_range']))
                                                • {{ $package['grade_range'] }}
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            @endif
                            <h3 class="dashboard-card__title">{{ $package['title'] }}</h3>
                            <p class="package-card__price">{{ $package['card_price'] ?? $package['price'] }}</p>
                            @if (! empty($package['detail_price']))
                                <p class="dashboard-card__text" style="font-size: 0.85rem; color: var(--student-text-muted);">
                                    {{ $package['detail_price'] }}
                                </p>
                            @endif
                            <p class="dashboard-card__text">{{ $package['summary'] }}</p>
                            @if (! empty($package['features']))
                                <ul class="package-features">
                                    @foreach ($package['features'] as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="dashboard-actions">
                                <a class="student-button student-button--primary" href="{{ route('checkout.show', $package['slug']) }}">Checkout sekarang</a>
                                <a class="student-button student-button--outline" href="{{ route('packages.show', $package['slug']) }}">Lihat detail</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="dashboard-empty">
                    <p>Paket belajar belum tersedia. Silakan hubungi admin MayClass untuk bantuan berlangganan.</p>
                    <a class="student-button student-button--primary" href="{{ route('packages.index') }}">Kunjungi katalog paket</a>
                </div>
            @endif
        </section>

        <section class="student-section">
            <div class="dashboard-section__header">
                <h2 class="dashboard-section__title">Langkah aktivasi langganan</h2>
            </div>
            <div class="dashboard-steps">
                <div class="dashboard-step">
                    <strong>1. Pilih paket</strong>
                    <span>Bandingkan manfaat tiap paket sebelum checkout.</span>
                </div>
                <div class="dashboard-step">
                    <strong>2. Selesaikan pembayaran</strong>
                    <span>Unggah bukti transfer di halaman checkout.</span>
                </div>
                <div class="dashboard-step">
                    <strong>3. Nikmati akses penuh</strong>
                    <span>Materi, kuis, dan jadwal langsung terbuka setelah diverifikasi.</span>
                </div>
            </div>
        </section>
    @endif
@endsection
