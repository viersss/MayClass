<!DOCTYPE html>
<html lang="id" data-role="student" data-page="{{ $page ?? '' }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ trim(($title ?? 'MayClass') . ' - MayClass') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- Alpine.js for mobile menu state -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            color-scheme: only light;
            --student-primary: #2b9083;
            --student-primary-soft: #35b6a8;
            --student-accent: #5f6af8;
            --student-surface: #ffffff;
            --student-surface-muted: #f5faf9;
            --student-border: rgba(36, 92, 92, 0.12);
            --student-text: #132b33;
            --student-text-muted: #5d6e75;
            --student-radius-lg: 28px;
            --student-radius-md: 20px;
            --student-radius-sm: 12px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Poppins", sans-serif;
            background: linear-gradient(180deg, #e6f6f3 0%, #ffffff 55%);
            color: var(--student-text);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .student-shell {
            display: flex;
            flex-direction: column;
            gap: 28px;
            padding: 28px clamp(20px, 4vw, 56px) 48px;
        }

        .student-navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 20px clamp(20px, 3vw, 40px);
            background: rgba(255, 255, 255, 0.82);
            border-radius: var(--student-radius-lg);
            box-shadow: 0 36px 80px rgba(27, 119, 110, 0.14);
            backdrop-filter: blur(16px);
            position: relative;
            z-index: 100;
        }

        .student-navbar__brand {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            font-weight: 600;
            color: var(--student-primary);
        }

        .student-navbar__brand img {
            width: 90px;
            height: 70px;
            border-radius: 12px;
            object-fit: cover;
        }

        .student-navbar__links {
            display: flex;
            align-items: center;
            gap: clamp(16px, 3vw, 40px);
            font-size: 0.95rem;
            color: var(--student-text-muted);
        }

        .student-navbar__link {
            position: relative;
            padding-bottom: 6px;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .student-navbar__link.is-active {
            color: var(--student-primary);
        }

        .student-navbar__link.is-active::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -10px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(120deg, var(--student-primary-soft), var(--student-accent));
        }

        .student-navbar__actions {
            display: inline-flex;
            align-items: center;
            gap: 16px;
        }

        .student-navbar__profile {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 10px 18px;
            border-radius: 999px;
            background: rgba(47, 152, 140, 0.12);
            color: var(--student-primary);
            font-size: 0.92rem;
        }

        .student-navbar__avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.6);
        }

        .student-navbar__logout {
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 999px;
            background: rgba(47, 152, 140, 0.18);
            color: var(--student-primary);
            font-weight: 600;
            transition: background 0.2s ease;
        }

        .student-navbar__logout:hover {
            background: rgba(47, 152, 140, 0.28);
        }

        .student-main {
            display: flex;
            flex-direction: column;
            gap: clamp(32px, 6vw, 56px);
        }

        .student-section {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .student-section__header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
        }

        .student-section__title {
            margin: 0;
            font-size: clamp(1.2rem, 2.4vw, 1.8rem);
        }

        .student-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 22px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .student-button--primary {
            background: linear-gradient(120deg, var(--student-primary), var(--student-primary-soft));
            color: #ffffff;
            box-shadow: 0 20px 40px rgba(27, 119, 110, 0.22);
        }

        .student-button--outline {
            background: rgba(47, 152, 140, 0.08);
            border-color: rgba(47, 152, 140, 0.28);
            color: var(--student-primary);
        }

        .student-button:hover {
            transform: translateY(-2px);
        }

        .student-grid {
            display: grid;
            gap: clamp(18px, 3vw, 28px);
        }

        .student-grid--two {
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }

        .student-grid--three {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        }

        .student-card {
            background: var(--student-surface);
            border-radius: var(--student-radius-lg);
            padding: clamp(20px, 3vw, 28px);
            box-shadow: 0 30px 60px rgba(34, 118, 108, 0.12);
            display: flex;
            flex-direction: column;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }

        .student-card__subtitle {
            font-size: 0.9rem;
            color: var(--student-text-muted);
            margin: 0;
        }

        .student-card__title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .student-card__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--student-text-muted);
        }

        .student-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 500;
            background: rgba(47, 152, 140, 0.16);
            color: var(--student-primary);
        }

        .student-alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 16px clamp(18px, 3vw, 28px);
            border-radius: var(--student-radius-md);
            background: rgba(47, 152, 140, 0.12);
            color: var(--student-primary);
            font-size: 0.95rem;
            box-shadow: 0 18px 36px rgba(27, 119, 110, 0.12);
        }

        .student-alert--warning {
            background: rgba(249, 178, 51, 0.16);
            color: #8a5500;
        }

        .student-alert--success {
            background: rgba(53, 182, 168, 0.16);
            color: var(--student-primary);
        }

        .student-alert--info {
            background: rgba(95, 106, 248, 0.12);
            color: var(--student-accent);
        }

        .student-alert__actions {
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        footer.student-footer {
            text-align: center;
            font-size: 0.85rem;
            color: var(--student-text-muted);
        }

        /* Hamburger Menu Button (Hidden on Desktop) */
        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: var(--student-primary);
            border-radius: 8px;
            transition: background 0.2s;
        }

        .hamburger-btn:hover {
            background: rgba(47, 152, 140, 0.1);
        }

        /* Mobile Expanded Menu (Gray Glassmorphism) */
        .mobile-nav-expanded {
            position: absolute;
            top: 100%;
            left: 16px;
            right: 16px;
            margin-top: 8px;
            background: rgba(15, 23, 42, 0.85);
            /* Dark Gray / Slate-900 with opacity */
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 16px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 16px;
            color: rgba(255, 255, 255, 0.9);
            /* Light text */
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s;
            text-align: left;
            background: transparent;
            border: none;
            width: 100%;
            cursor: pointer;
            font-family: inherit;
        }

        .mobile-nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateX(4px);
        }

        .mobile-nav-link.is-active {
            background: rgba(47, 152, 140, 0.9);
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(47, 152, 140, 0.3);
        }

        .mobile-nav-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 8px 0;
        }

        .mobile-nav-logout {
            color: #fca5a5;
            /* Light red */
        }

        .mobile-nav-logout:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #fecaca;
        }

        /* Hide mobile menu elements on desktop */
        @media (min-width: 1025px) {

            .hamburger-btn,
            .mobile-nav-expanded {
                display: none !important;
            }
        }

        /* Tablet: Keep desktop-ish layout but adjust */
        @media (max-width: 1024px) {
            .student-navbar {
                padding: 16px 20px;
            }

            /* Show hamburger, hide desktop nav */
            .hamburger-btn {
                display: flex !important;
                margin-left: auto;
            }

            .student-navbar__links--desktop,
            .student-navbar__actions--desktop {
                display: none !important;
            }
        }

        /* Small Tablet & Large Mobile */
        @media (max-width: 768px) {
            .student-navbar {
                padding: 14px 18px;
            }

            .student-navbar__brand img {
                width: 80px;
                height: 62px;
            }
        }

        /* Mobile */
        @media (max-width: 640px) {
            .student-shell {
                padding: 20px 16px 32px;
                gap: 20px;
            }

            .student-navbar {
                padding: 14px 16px;
            }

            .student-navbar__brand img {
                width: 70px;
                height: 55px;
            }

            .mobile-nav-expanded {
                left: 12px;
                right: 12px;
            }
        }

        /* Small Mobile */
        @media (max-width: 480px) {
            .student-navbar__brand img {
                width: 60px;
                height: 47px;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    @php($user = auth()->user())
    @php($navAvatar = \App\Support\ProfileAvatar::forUser($user))
    @php($hasActivePackage = $hasActivePackage ?? ($studentHasActivePackage ?? false))
    <div class="student-shell" x-data="{ mobileMenuOpen: false }">
        <header class="student-navbar">
            <a href="{{ route('student.dashboard') }}" class="student-navbar__brand">
                <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass" />
            </a>

            <!-- Hamburger Button (Mobile/Tablet Only) -->
            <button class="hamburger-btn" @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle menu">
                <!-- Modern Clean Hamburger Icon -->
                <svg x-show="!mobileMenuOpen" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="8" x2="20" y2="8"></line>
                    <line x1="4" y1="16" x2="20" y2="16"></line>
                </svg>
                <!-- Close Icon -->
                <svg x-show="mobileMenuOpen" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="display: none;">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Desktop Nav (visible on >1024px) -->
            <nav class="student-navbar__links student-navbar__links--desktop">
                <a href="{{ route('student.dashboard') }}"
                    class="student-navbar__link {{ request()->routeIs('student.dashboard') ? 'is-active' : '' }}">Beranda</a>
                @if ($hasActivePackage)
                    <a href="{{ route('student.materials') }}"
                        class="student-navbar__link {{ request()->routeIs('student.materials*') ? 'is-active' : '' }}">Materi</a>
                    <a href="{{ route('student.quiz') }}"
                        class="student-navbar__link {{ request()->routeIs('student.quiz*') ? 'is-active' : '' }}">Quiz</a>
                    <a href="{{ route('student.schedule') }}"
                        class="student-navbar__link {{ request()->routeIs('student.schedule') ? 'is-active' : '' }}">Jadwal</a>
                @endif
            </nav>

            <!-- Mobile Expanded Menu (smooth expand below hamburger) -->
            <div class="mobile-nav-expanded" x-show="mobileMenuOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                style="display: none;">
                <a href="{{ route('student.dashboard') }}"
                    class="mobile-nav-link {{ request()->routeIs('student.dashboard') ? 'is-active' : '' }}">
                    Beranda
                </a>
                @if ($hasActivePackage)
                    <a href="{{ route('student.materials') }}"
                        class="mobile-nav-link {{ request()->routeIs('student.materials*') ? 'is-active' : '' }}">
                        Materi
                    </a>
                    <a href="{{ route('student.quiz') }}"
                        class="mobile-nav-link {{ request()->routeIs('student.quiz*') ? 'is-active' : '' }}">
                        Quiz
                    </a>
                    <a href="{{ route('student.schedule') }}"
                        class="mobile-nav-link {{ request()->routeIs('student.schedule') ? 'is-active' : '' }}">
                        Jadwal
                    </a>
                @endif
                <div class="mobile-nav-divider"></div>
                <a href="{{ route('student.profile') }}" class="mobile-nav-link">
                    Profil
                </a>
                <form method="post" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="mobile-nav-link mobile-nav-logout">
                        Keluar
                    </button>
                </form>
            </div>

            <div class="student-navbar__actions student-navbar__actions--desktop">
                <a class="student-navbar__profile" href="{{ route('student.profile') }}">
                    <img class="student-navbar__avatar" src="{{ $navAvatar }}"
                        alt="Foto profil {{ $user?->name ?? 'Siswa' }}" />
                    <span>{{ $user?->name ?? 'Siswa' }}</span>
                </a>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="student-navbar__logout">Keluar</button>
                </form>
            </div>
        </header>

        @if (session('subscription_notice'))
            <div class="student-alert student-alert--warning">
                <span>{{ session('subscription_notice') }}</span>
                <div class="student-alert__actions">
                    <a class="student-button student-button--primary" href="{{ route('packages.index') }}">Lihat paket</a>
                </div>
            </div>
        @endif

        @if (session('subscription_success'))
            <div class="student-alert student-alert--success">
                <span>{{ session('subscription_success') }}</span>
                @if ($hasActivePackage)
                    <div class="student-alert__actions">
                        <a class="student-button student-button--primary" href="{{ route('student.materials') }}">
                            Buka Materi
                        </a>
                    </div>
                @endif
            </div>
        @endif

        @if (session('purchase_locked'))
            <div class="student-alert student-alert--info">
                <span>{{ session('purchase_locked') }}</span>
            </div>
        @endif

        <main class="student-main">
            @yield('content')
        </main>

        <footer class="student-footer">© {{ now()->year }} MayClass. Portal siswa diperbarui otomatis.</footer>
    </div>
    @stack('scripts')
</body>

</html>