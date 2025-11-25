<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Tentor - MayClass')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --page-bg: #f5f7fb;
            --surface: #ffffff;
            --surface-muted: #f8fafc;
            --border-subtle: #e4e7ec;
            --sidebar-bg: #111c32;
            --text-main: #0f172a;
            --text-muted: #667085;
            --accent: #2563eb;
            --accent-muted: #e0e7ff;
            --success: #15803d;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--page-bg);
            color: var(--text-main);
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .dashboard-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 264px 1fr;
            gap: 32px;
            padding: 32px 40px;
        }

        .nav-panel {
            background: var(--sidebar-bg);
            border-radius: 24px;
            padding: 32px 24px;
            color: #fff;
            display: flex;
            flex-direction: column;
            gap: 32px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.25);
            position: sticky;
            top: 32px;
            align-self: start;
            min-height: calc(100vh - 64px);
        }

        .navigation {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 14px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .nav-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            display: grid;
            place-items: center;
        }

        .nav-icon svg {
            width: 22px;
            height: 22px;
        }

        .nav-link[data-active='true'] {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
        }

        .nav-footer {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            padding-top: 20px;
        }

        .profile-summary {
            display: flex;
            align-items: center;
            gap: 14px;
            border-radius: 16px;
            padding: 12px 14px;
            background: rgba(255, 255, 255, 0.08);
            transition: background 0.2s ease;
        }

        .profile-summary img {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.25);
        }

        .profile-summary:hover {
            background: rgba(255, 255, 255, 0.14);
        }

        .profile-summary small {
            display: block;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
        }

        .logout-btn {
            width: 100%;
        }

        .logout-btn button {
            width: 100%;
            padding: 12px 18px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            background: transparent;
            color: #fff;
            font: inherit;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .logout-btn button:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.55);
        }

        .main-area {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .main-header {
            background: var(--surface);
            border-radius: 24px;
            padding: 28px 32px;
            border: 1px solid var(--border-subtle);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
        }

        .header-intro h1 {
            margin: 6px 0 8px;
            font-size: 2rem;
        }

        .header-intro p {
            margin: 0;
            color: var(--text-muted);
        }

        .header-meta {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: flex-end;
        }

        .header-profile-link {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: 2px solid rgba(226, 232, 240, 0.5);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--surface-muted);
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.18);
        }

        .header-profile-link img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .date-pill {
            padding: 10px 18px;
            border-radius: 999px;
            background: var(--surface-muted);
            border: 1px solid var(--border-subtle);
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-main);
        }

        .status-pill {
            padding: 8px 16px;
            border-radius: 999px;
            background: var(--accent-muted);
            color: var(--accent);
            font-weight: 700;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .status-pill::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
        }

        .page-wrapper {
            padding-bottom: 48px;
        }

        main {
            flex: 1;
        }

        .page-content {
            max-width: 1240px;
            width: 100%;
        }

        .flash-message {
            margin-bottom: 24px;
            padding: 16px 20px;
            border-radius: 14px;
            font-weight: 600;
            border: 1px solid var(--border-subtle);
            background: var(--surface);
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
            letter-spacing: -0.01em;
            font-size: 0.95rem;
        }

        .flash-message[data-variant='success'] {
            border-color: #bbf7d0;
            color: #166534;
            background: #ecfdf3;
        }

        .flash-message[data-variant='error'] {
            border-color: #fecdd3;
            color: #b91c1c;
            background: #fef2f2;
        }

        @media (max-width: 1240px) {
            .dashboard-shell {
                grid-template-columns: 240px 1fr;
                padding: 28px;
            }
        }

        @media (max-width: 1024px) {
            .dashboard-shell {
                grid-template-columns: 1fr;
                padding: 24px;
            }

            .nav-panel {
                top: 24px;
                z-index: 20;
                flex-direction: row;
                align-items: center;
                gap: 20px;
                overflow-x: auto;
                min-height: auto;
            }

            .navigation {
                flex-direction: row;
                gap: 12px;
            }

            .nav-footer {
                display: none;
            }

            .main-header {
                flex-direction: column;
            }

            .header-meta {
                align-items: flex-start;
            }
        }

        @media (max-width: 640px) {
            .dashboard-shell {
                padding: 20px;
            }

            .main-header {
                padding: 20px;
            }

            .header-intro h1 {
                font-size: 1.6rem;
            }
        }

        /* --- RESPONSIVE TENTOR NAVBAR (Mobile/Tablet) --- */
        .mobile-tentor-header {
            display: none;
            /* Hidden on desktop */
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background: #ffffff;
            border-bottom: 1px solid var(--border-subtle);
            position: sticky;
            top: 0;
            z-index: 40;
            margin: -32px -40px 32px -40px;
            /* Negate shell padding */
        }

        .mobile-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--sidebar-bg);
        }

        .mobile-brand img {
            height: 40px;
            width: auto;
        }

        .hamburger-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: var(--sidebar-bg);
            border-radius: 8px;
        }

        .hamburger-btn:hover {
            background: rgba(15, 23, 42, 0.05);
        }

        /* Mobile Dropdown (Gray Glass) */
        .mobile-nav-expanded {
            position: absolute;
            top: 70px;
            /* Below header */
            left: 16px;
            right: 16px;
            background: rgba(17, 28, 50, 0.9);
            /* Dark Blue/Slate Glass */
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            z-index: 100;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 16px;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .mobile-nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateX(4px);
        }

        .mobile-nav-link.is-active {
            background: var(--accent);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .mobile-nav-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 10px 0;
        }

        .mobile-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            margin-bottom: 8px;
        }

        .mobile-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .mobile-profile div {
            display: flex;
            flex-direction: column;
        }

        .mobile-profile strong {
            color: #fff;
            font-size: 0.95rem;
        }

        .mobile-profile small {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
        }

        @media (max-width: 1024px) {
            .dashboard-shell {
                grid-template-columns: 1fr;
                padding: 24px;
                display: block;
                /* Reset grid for mobile flow */
            }

            .nav-panel {
                display: none !important;
                /* Hide sidebar on mobile */
            }

            .mobile-tentor-header {
                display: flex !important;
                /* Show mobile header */
                margin: -24px -24px 24px -24px;
                /* Adjust for shell padding */
                padding: 16px 24px;
            }
        }

        @media (max-width: 640px) {
            .dashboard-shell {
                padding: 20px;
            }

            .mobile-tentor-header {
                margin: -20px -20px 24px -20px;
                padding: 14px 20px;
            }
        }
    </style>

    {{-- Alpine.js for Modal State Management --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    {{-- Premium Modal Styles (Consistent with Admin) --}}
    <style>
        /* --- PREMIUM MODAL STYLES --- */
        [x-cloak] {
            display: none !important;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-backdrop.show {
            opacity: 1;
        }

        .modal-content {
            background: #ffffff;
            border-radius: 24px;
            box-shadow:
                0 0 0 1px rgba(255, 255, 255, 0.5) inset,
                0 25px 50px -12px rgba(0, 0, 0, 0.35);
            width: 100%;
            max-width: 900px;
            max-height: 85vh;
            overflow-y: auto;
            transform: scale(0.92) translateY(10px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .modal-content::-webkit-scrollbar {
            width: 6px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }

        .modal-backdrop.show .modal-content {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .modal-header {
            padding: 24px 32px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            z-index: 10;
        }

        .modal-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.02em;
            margin: 0;
        }

        .modal-close {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #64748b;
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            transition: all 0.2s;
        }

        .modal-close:hover {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 32px;
        }

        /* Modal Form Styles */
        .modal-form-grid {
            display: grid;
            gap: 24px;
        }

        .modal-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .modal-form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .modal-form-input,
        .modal-form-select,
        .modal-form-textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            background: #fff;
            font-size: 0.95rem;
            transition: all 0.2s;
            color: #0f172a;
            font-family: inherit;
        }

        .modal-form-input:focus,
        .modal-form-select:focus,
        .modal-form-textarea:focus {
            outline: none;
            border-color: #3fa67e;
            box-shadow: 0 0 0 4px rgba(63, 166, 126, 0.1);
        }

        .modal-form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .modal-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            margin-top: 24px;
        }

        .modal-btn-cancel {
            padding: 12px 24px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .modal-btn-cancel:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .modal-btn-submit {
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            background: #3fa67e;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(63, 166, 126, 0.25);
            transition: all 0.2s;
        }

        .modal-btn-submit:hover {
            background: #2f8a67;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(63, 166, 126, 0.35);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .modal-content {
                max-height: 100vh;
                border-radius: 0;
                max-width: 100%;
            }

            .modal-body {
                padding: 24px;
            }

            .modal-header {
                padding: 20px 24px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="dashboard-shell" x-data="{ mobileMenuOpen: false }">
        <!-- Mobile Header -->
        <header class="mobile-tentor-header">
            <div class="mobile-brand">
                <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo">
                <span>Tentor Panel</span>
            </div>
            <button class="hamburger-btn" @click="mobileMenuOpen = !mobileMenuOpen">
                <svg x-show="!mobileMenuOpen" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="8" x2="20" y2="8"></line>
                    <line x1="4" y1="16" x2="20" y2="16"></line>
                </svg>
                <svg x-show="mobileMenuOpen" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="display: none;">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </header>

        <!-- Mobile Dropdown -->
        <div class="mobile-nav-expanded" x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" style="display: none;">

            <!-- Profile Info in Menu -->
            <div class="mobile-profile">
                @php
                    $tutorSummaryAvatar = isset($tutor) ? \App\Support\ProfileAvatar::forUser($tutor) : asset('images/default-avatar.png');
                 @endphp
                <img src="{{ $tutorSummaryAvatar }}" alt="Tentor">
                <div>
                    <strong>{{ $tutor?->name ?? 'Tentor MayClass' }}</strong>
                    <small>{{ $tutorProfile?->specializations ?? 'Mentor' }}</small>
                </div>
            </div>

            <div class="mobile-nav-divider"></div>

            @php
                $currentRoute = request()->route() ? request()->route()->getName() : null;
                $mobileMenuItems = [
                    ['label' => 'Beranda', 'route' => 'tutor.dashboard', 'patterns' => ['tutor.dashboard'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z" />'],
                    ['label' => 'Materi', 'route' => 'tutor.materials.index', 'patterns' => ['tutor.materials.*'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 5h9l5 5v9a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z" /><path stroke-linecap="round" stroke-linejoin="round" d="M14 5v5h5" />'],
                    ['label' => 'Quiz', 'route' => 'tutor.quizzes.index', 'patterns' => ['tutor.quizzes.*'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6a4 4 0 0 1 4 4c0 1.5-.8 2.3-2 3.2-.7.5-1 1-.9 1.8m-.1 3h.01" /><path stroke-linecap="round" stroke-linejoin="round" d="M5 4h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" />'],
                ];
             @endphp

            @foreach ($mobileMenuItems as $item)
                @php
                    $isActive = false;
                    foreach ($item['patterns'] as $pattern) {
                        if ($currentRoute && \Illuminate\Support\Str::is($pattern, $currentRoute)) {
                            $isActive = true;
                            break;
                        }
                    }
                @endphp
                <a href="{{ route($item['route']) }}" class="mobile-nav-link {{ $isActive ? 'is-active' : '' }}">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        {!! $item['icon'] !!}
                    </svg>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach

            <div class="mobile-nav-divider"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mobile-nav-link" style="color: #fca5a5; width: 100%;">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

        <aside class="nav-panel">
            @php
                // Pastikan tutor ada untuk menghindari error pada method static
                $tutorSummaryAvatar = isset($tutor) ? \App\Support\ProfileAvatar::forUser($tutor) : asset('images/default-avatar.png');
            @endphp

            <nav class="navigation">
                @php
                    $currentRoute = request()->route() ? request()->route()->getName() : null;

                    // 1. Definisi Menu Default
                    $defaultMenuItems = [
                        [
                            'label' => 'Beranda',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z" /></svg>',
                            'route' => 'tutor.dashboard',
                            'patterns' => ['tutor.dashboard'],
                        ],
                        [
                            'label' => 'Materi',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5h9l5 5v9a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z" /><path stroke-linecap="round" stroke-linejoin="round" d="M14 5v5h5" /></svg>',
                            'route' => 'tutor.materials.index',
                            'patterns' => ['tutor.materials.*'],
                        ],
                        [
                            'label' => 'Quiz',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6a4 4 0 0 1 4 4c0 1.5-.8 2.3-2 3.2-.7.5-1 1-.9 1.8m-.1 3h.01" /><path stroke-linecap="round" stroke-linejoin="round" d="M5 4h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" /></svg>',
                            'route' => 'tutor.quizzes.index',
                            'patterns' => ['tutor.quizzes.*'],
                        ],
                    ];

                    // 2. Logika Penentuan Menu (Perbaikan Utama)
                    // Jika variabel $menuItems ada DAN berupa array, gunakan itu.
                    // Jika tidak, gunakan $defaultMenuItems.
                    if (isset($menuItems) && is_array($menuItems) && count($menuItems) > 0) {
                        $layoutMenuItems = $menuItems;
                    } else {
                        $layoutMenuItems = $defaultMenuItems;
                    }

                    // 3. Reindex array untuk keamanan loop
                    $layoutMenuItems = array_values($layoutMenuItems);
                @endphp

                @foreach ($layoutMenuItems as $item)
                    @php
                        $isActive = false;
                        // Pastikan patterns ada agar tidak error
                        $patterns = $item['patterns'] ?? [];

                        foreach ($patterns as $pattern) {
                            if ($currentRoute && \Illuminate\Support\Str::is($pattern, $currentRoute)) {
                                $isActive = true;
                                break;
                            }
                        }
                    @endphp
                    <a href="{{ route($item['route']) }}" class="nav-link" data-active="{{ $isActive ? 'true' : 'false' }}">
                        <span class="nav-icon" aria-hidden="true">{!! $item['icon'] !!}</span>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
            <div class="nav-footer">
                <a class="profile-summary" href="{{ route('tutor.account.edit') }}" title="Kelola profil">
                    <img src="{{ $tutorSummaryAvatar }}" alt="Foto tutor" />
                    <div>
                        {{-- Gunakan optional chaining (?->) agar aman jika data kosong --}}
                        <strong>{{ $tutor?->name ?? 'Tutor MayClass' }}</strong>
                        <small>{{ $tutorProfile?->specializations ?? 'Mentor MayClass' }}</small>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="logout-btn">
                    @csrf
                    <button type="submit" title="Keluar dari dashboard">
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>
        <div class="main-area">

            <main>
                <div class="page-wrapper">
                    <div class="page-content">
                        @if (session('status'))
                            <div class="flash-message" data-variant="success">{{ session('status') }}</div>
                        @endif
                        @if (session('alert'))
                            <div class="flash-message" data-variant="error">{{ session('alert') }}</div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>