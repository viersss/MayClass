@extends('student.layouts.app')

@section('title', 'Dashboard Siswa')

@push('styles')
    <style>
        :root {
            /* MayClass Brand Colors */
            --primary: #0f766e;
            --primary-light: #ccfbf1;
            --primary-dark: #115e59;
            --surface: #ffffff;
            --background: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;

            /* Optimized Dimensions */
            --sidebar-width: 320px;
            --radius: 14px;

            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Layout */
        .dashboard-container {
            width: 100%;
            padding: 0 28px;
            display: grid;
            gap: 28px;
        }

        .dashboard-layout {
            display: grid;
            grid-template-columns: 1fr var(--sidebar-width);
            gap: 28px;
            align-items: start;
        }

        /* Hero Section - Compact */
        .hero-card {
            background: linear-gradient(135deg, #0f766e 0%, #115e59 100%);
            color: white;
            border-radius: var(--radius);
            padding: 28px 32px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            margin-bottom: 28px;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-eyebrow {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            opacity: 0.85;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .hero-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 12px;
            line-height: 1.2;
        }

        .hero-desc {
            font-size: 0.95rem;
            opacity: 0.9;
            margin: 0 0 24px;
            max-width: 650px;
            line-height: 1.6;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-hero {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            backdrop-filter: blur(4px);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-hero:hover {
            background: white;
            color: var(--primary);
            border-color: white;
            transform: translateY(-2px);
        }

        /* Stats Grid - With Icons */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 18px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: var(--surface);
            padding: 18px 20px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.2s;
        }

        .stat-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.1);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg {
            width: 22px;
            height: 22px;
            stroke: var(--primary);
        }

        .stat-info {
            flex: 1;
        }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            margin-top: 32px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 10px;
        }

        .section-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .link-more {
            font-size: 0.85rem;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .link-more:hover {
            background: var(--primary-light);
        }

        /* Content Cards - Optimized */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .content-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: all 0.2s;
            text-decoration: none;
            height: 100%;
        }

        .content-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary);
        }

        .card-tag {
            align-self: flex-start;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 5px 10px;
            border-radius: 6px;
            letter-spacing: 0.03em;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            line-height: 1.4;
        }

        .card-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .card-meta {
            margin-top: 8px;
            padding-top: 12px;
            border-top: 1px solid var(--border);
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            display: flex;
            gap: 8px;
            align-items: center;
        }

        /* Sidebar - Optimized */
        .sidebar-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: sticky;
            top: 20px;
        }

        .sidebar-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow-sm);
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .sidebar-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            letter-spacing: 0.02em;
        }

        /* Active Package */
        .pkg-info {
            background: var(--primary-light);
            border-radius: 10px;
            padding: 14px 16px;
            border: 1px solid rgba(15, 118, 110, 0.1);
        }

        .pkg-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: block;
            margin-bottom: 6px;
        }

        .pkg-meta {
            font-size: 0.8rem;
            color: var(--primary);
            font-weight: 500;
        }

        /* Schedule Timeline - Compact */
        .schedule-list {
            position: relative;
            padding-left: 14px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .schedule-list::before {
            content: '';
            position: absolute;
            top: 6px;
            bottom: 0;
            left: 0;
            width: 2px;
            background: var(--border);
        }

        .schedule-item {
            position: relative;
            padding-left: 18px;
        }

        .schedule-item::before {
            content: '';
            position: absolute;
            left: -19px;
            top: 3px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--surface);
            border: 2px solid var(--primary);
            z-index: 2;
        }

        .schedule-date {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            margin-bottom: 4px;
            display: block;
        }

        .schedule-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-main);
            margin: 0 0 3px;
            line-height: 1.3;
        }

        .schedule-detail {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 30px;
            background: var(--surface);
            border: 1px dashed var(--border);
            border-radius: var(--radius);
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Inactive State */
        .inactive-wrapper {
            display: flex;
            justify-content: center;
            padding: 40px 0;
        }

        .inactive-card {
            background: var(--surface);
            padding: 44px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            max-width: 750px;
            width: 100%;
            text-align: center;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 36px;
            text-align: left;
        }

        .step-box {
            background: var(--background);
            padding: 18px;
            border-radius: 10px;
            border: 1px solid var(--border);
        }

        .step-num {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
            opacity: 0.2;
            margin-bottom: 6px;
            line-height: 1;
        }

        .step-title {
            font-weight: 700;
            color: var(--text-main);
            display: block;
            margin-bottom: 4px;
            font-size: 0.95rem;
        }

        .step-desc {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Responsive - Tablet */
        @media (max-width: 1024px) {
            .dashboard-container {
                padding: 0 20px;
            }

            .dashboard-layout {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .sidebar-content {
                position: static;
            }

            .steps-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Tablet - iPad */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 0 16px;
                gap: 24px;
            }

            .hero-card {
                padding: 24px;
                margin-bottom: 24px;
            }

            .hero-title {
                font-size: 1.5rem;
            }

            .hero-desc {
                font-size: 0.9rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
            }

            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 18px;
            }

            .sidebar-card {
                padding: 18px;
            }
        }

        /* Mobile */
        @media (max-width: 640px) {
            .dashboard-container {
                padding: 0 14px;
            }

            .hero-card {
                padding: 20px;
            }

            .hero-title {
                font-size: 1.4rem;
            }

            .hero-desc {
                font-size: 0.85rem;
                margin-bottom: 20px;
            }

            .hero-actions {
                flex-direction: column;
                gap: 10px;
            }

            .btn-hero {
                width: 100%;
                justify-content: center;
                padding: 11px 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .stat-card {
                flex-direction: row;
                padding: 14px 16px;
            }

            .section-header {
                margin-top: 28px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .section-title {
                font-size: 1.05rem;
            }

            .link-more {
                font-size: 0.8rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .content-card {
                padding: 18px;
            }

            .card-title {
                font-size: 0.95rem;
            }

            .inactive-card {
                padding: 32px 24px;
            }

            .inactive-card h1 {
                font-size: 1.6rem !important;
            }

            .inactive-card p {
                font-size: 0.9rem !important;
            }
        }

        /* Small Mobile */
        @media (max-width: 480px) {
            .dashboard-container {
                padding: 0 12px;
            }

            .hero-eyebrow {
                font-size: 0.7rem;
            }

            .hero-title {
                font-size: 1.25rem;
            }

            .hero-desc {
                font-size: 0.8rem;
            }

            .stat-icon {
                width: 36px;
                height: 36px;
            }

            .stat-value {
                font-size: 1.4rem;
            }

            .stat-label {
                font-size: 0.75rem;
            }

            .card-tag {
                font-size: 0.65rem;
                padding: 4px 8px;
            }

            .sidebar-card {
                padding: 16px;
            }

            .schedule-item {
                padding-left: 16px;
            }

            .schedule-date {
                font-size: 0.7rem;
            }

            .schedule-title {
                font-size: 0.85rem;
            }

            .schedule-detail {
                font-size: 0.75rem;
            }
        }
    </style>
@endpush

@php($user = auth()->user())
@php($materialsLink = $materialsLink ?? config('mayclass.links.materials_drive'))
@php($quizLink = $quizLink ?? config('mayclass.links.quiz_platform'))
@php($hasActivePackage = $hasActivePackage ?? ($studentHasActivePackage ?? false))

@section('content')

@if ($hasActivePackage)
<div class="dashboard-container">

    <div class="dashboard-layout">
        {{-- LEFT COLUMN: Main Content --}}
        <main>
            {{-- Hero Welcome --}}
            <div class="hero-card">
                <div class="hero-content">
                    <span class="hero-eyebrow">Dashboard Siswa</span>
                    <h1 class="hero-title">Hai, {{ $user?->name ?? 'Siswa' }}!</h1>
                    <p class="hero-desc">
                        Paket belajarmu aktif. Siap untuk meningkatkan prestasi hari ini?
                        Akses materi, kerjakan kuis, atau cek jadwalmu sekarang.
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('student.materials') }}" class="btn-hero">
                            Buka Materi
                        </a>
                        <a href="{{ route('student.quiz') }}" class="btn-hero">
                            Mulai Kuis
                        </a>
                        <a href="{{ route('student.schedule') }}" class="btn-hero">
                            Lihat Jadwal
                        </a>
                    </div>
                </div>
            </div>

            {{-- Quick Stats with Icons --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">{{ number_format($metrics['materials_total']) }}</span>
                        <span class="stat-label">Materi Tersedia</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">{{ number_format($metrics['quizzes_total']) }}</span>
                        <span class="stat-label">Kuis Latihan</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">{{ number_format($metrics['upcoming_total']) }}</span>
                        <span class="stat-label">Sesi Terjadwal</span>
                    </div>
                </div>
            </div>

            {{-- Materials Section --}}
            <div class="section-header">
                <h2 class="section-title">Materi Terbaru</h2>
                <a href="{{ route('student.materials') }}" class="link-more">Lihat Semua</a>
            </div>

            @if ($recentMaterials->isNotEmpty())
                <div class="cards-grid">
                    @foreach ($recentMaterials as $material)
                        <a href="{{ route('student.materials') }}" class="content-card">
                            <span class="card-tag">{{ $material['subject'] }}</span>
                            <h3 class="card-title">{{ $material['title'] }}</h3>
                            <p class="card-desc">{{ $material['summary'] }}</p>
                            <div class="card-meta">
                                <span>Level {{ $material['level'] }}</span>
                                <span>&bull;</span>
                                <span>{{ $material['chapter_count'] }} Bab</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">Belum ada materi baru yang diterbitkan.</div>
            @endif

            {{-- Quizzes Section --}}
            <div class="section-header">
                <h2 class="section-title">Kuis Latihan</h2>
                <a href="{{ route('student.quiz') }}" class="link-more">Lihat Semua</a>
            </div>

            @if ($recentQuizzes->isNotEmpty())
                <div class="cards-grid">
                    @foreach ($recentQuizzes as $quiz)
                        <a href="{{ route('student.quiz') }}" class="content-card">
                            <span class="card-tag" style="background:#fff7ed; color:#c2410c;">{{ $quiz['questions'] }}
                                Soal</span>
                            <h3 class="card-title">{{ $quiz['title'] }}</h3>
                            <p class="card-desc">{{ $quiz['summary'] }}</p>
                            <div class="card-meta">
                                <span>{{ $quiz['duration'] }}</span>
                                @if(!empty($quiz['levels']))
                                    <span>&bull;</span>
                                    <span>{{ implode(', ', $quiz['levels']) }}</span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">Kuis belum tersedia saat ini.</div>
            @endif

        </main>

        {{-- RIGHT COLUMN: Sidebar --}}
        <aside class="sidebar-content">

            {{-- Active Package --}}
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <h3 class="sidebar-title">PAKET AKTIF</h3>
                </div>
                <div class="pkg-info">
                    <span class="pkg-name">{{ $activePackage['title'] }}</span>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 4px;">
                        <span class="pkg-meta">{{ $activePackage['period'] }}</span>
                        <span
                            style="font-size: 0.7rem; background: #0f766e; color: white; padding: 2px 8px; border-radius: 4px; font-weight: 600;">{{ $activePackage['status'] }}</span>
                    </div>
                </div>
            </div>

            {{-- Schedule Timeline --}}
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <h3 class="sidebar-title">JADWAL TERDEKAT</h3>
                    <a href="{{ route('student.schedule') }}" class="link-more" style="font-size: 0.75rem;">Semua</a>
                </div>

                @php($upcomingSessions = collect($schedule['upcoming'] ?? [])->take(4))

                                    @if ($upcomingSessions->isNotEmpty())
                                        <div class="schedule-list">
                                            @foreach ($upcomingSessions as $session)
                                                <div class="schedule-item">
                                                    <span class="schedule-date">{{ $session['date'] }}</span>
                                                    <h4 class="schedule-title">{{ $session['title'] }}</h4>
                                                    <p class="schedule-detail">{{ $session['subject'] ?? $session['category'] }}</p>
                                                    <p class="schedule-detail" style="margin-top: 2px;">{{ $session['time'] }} &bull;
                                                        {{ $session['mentor'] }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div style="text-align: center; padding: 18px 0; color: var(--text-muted); font-size: 0.85rem;">
                                            Belum ada jadwal sesi mendatang.
                                        </div>
                                    @endif
                                </div>
                            </aside>
                        </div>
                    </div>

                @else
{{-- USER BELUM PUNYA PAKET --}}
<div class="inactive-wrapper">
    <div class="inactive-card">
        <h1 style="margin: 0 0 12px; font-size: 2rem; font-weight: 700; color: var(--text-main);">Halo,
            {{ $user?->name ?? 'Siswa' }}!</h1>
        <p
            style="color: var(--text-muted); margin-bottom: 28px; max-width: 600px; margin-left: auto; margin-right: auto; line-height: 1.6; font-size: 1rem;">
            Akunmu sudah aktif, tetapi kamu belum memiliki paket belajar. Yuk, pilih paket favoritmu untuk membuka akses
            ke materi, kuis, dan jadwal eksklusif MayClass.
        </p>

        <a href="{{ route('packages.index') }}"
            style="display: inline-block; background: var(--primary); color: white; padding: 13px 32px; border-radius: 99px; font-weight: 600; text-decoration: none; box-shadow: 0 8px 16px -4px rgba(15, 118, 110, 0.4); transition: transform 0.2s;">
            Lihat Pilihan Paket
        </a>

        <div class="steps-grid">
            <div class="step-box">
                <div class="step-num">01</div>
                <span class="step-title">Pilih Paket</span>
                <span class="step-desc">Bandingkan fitur dan harga di katalog kami.</span>
            </div>
            <div class="step-box">
                <div class="step-num">02</div>
                <span class="step-title">Bayar</span>
                <span class="step-desc">Transfer dan unggah bukti pembayaran.</span>
            </div>
            <div class="step-box">
                <div class="step-num">03</div>
                <span class="step-title">Belajar</span>
                <span class="step-desc">Admin verifikasi, akses langsung terbuka.</span>
            </div>
        </div>
    </div>
</div>
@endif

@endsection