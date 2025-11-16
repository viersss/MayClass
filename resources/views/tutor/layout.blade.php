<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'Dashboard Tentor - MayClass')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
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
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .brand-logo {
                width: 48px;
                height: 48px;
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.1);
                display: grid;
                place-items: center;
                font-weight: 600;
                font-size: 1.1rem;
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
                font-size: 0.9rem;
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
                font-weight: 600;
                font-size: 0.9rem;
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
                font-weight: 500;
                border: 1px solid var(--border-subtle);
                background: var(--surface);
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .flash-message[data-variant='success'] {
                border-color: rgba(21, 128, 61, 0.2);
                color: var(--success);
            }

            .flash-message[data-variant='error'] {
                border-color: rgba(220, 38, 38, 0.25);
                color: #b91c1c;
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
                    position: sticky;
                    top: 24px;
                    z-index: 20;
                    flex-direction: row;
                    align-items: center;
                    gap: 20px;
                    overflow-x: auto;
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
        </style>
        @stack('styles')
    </head>
    <body>
        <div class="dashboard-shell">
            <aside class="nav-panel">
                <div class="brand">
                    <div class="brand-logo">MC</div>
                    <span>MayClass Mentor</span>
                </div>
                <nav class="navigation">
                    @php
                        $currentRoute = request()->route() ? request()->route()->getName() : null;
                        $menuItems = [
                            [
                                'label' => 'Dashboard',
                                'abbr' => 'DB',
                                'route' => 'tutor.dashboard',
                                'patterns' => ['tutor.dashboard'],
                            ],
                            [
                                'label' => 'Materi',
                                'abbr' => 'MT',
                                'route' => 'tutor.materials.index',
                                'patterns' => ['tutor.materials.*'],
                            ],
                            [
                                'label' => 'Quiz',
                                'abbr' => 'QZ',
                                'route' => 'tutor.quizzes.index',
                                'patterns' => ['tutor.quizzes.*'],
                            ],
                            [
                                'label' => 'Jadwal',
                                'abbr' => 'JD',
                                'route' => 'tutor.schedule.index',
                                'patterns' => ['tutor.schedule.*'],
                            ],
                        ];
                        $avatarCandidates = array_filter([
                            $tutorProfile?->avatar_path,
                            $tutor?->avatar_path,
                        ]);
                        $resolvedAvatar = \App\Support\AvatarResolver::resolve($avatarCandidates);
                        $avatarPlaceholder = asset('images/avatar-placeholder.svg');
                        $tutorSummaryAvatar = $resolvedAvatar ?? $avatarPlaceholder;
                    @endphp
                    @foreach ($menuItems as $item)
                        @php
                            $isActive = false;
                            foreach ($item['patterns'] as $pattern) {
                                if ($currentRoute && \Illuminate\Support\Str::is($pattern, $currentRoute)) {
                                    $isActive = true;
                                    break;
                                }
                            }
                        @endphp
                        <a href="{{ route($item['route']) }}" class="nav-link" data-active="{{ $isActive ? 'true' : 'false' }}">
                            <span class="nav-icon">{{ $item['abbr'] }}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
                <div class="nav-footer">
                    <a class="profile-summary" href="{{ route('tutor.account.edit') }}" title="Kelola profil">
                        <img
                            src="{{ $tutorSummaryAvatar }}"
                            alt="Foto tutor"
                        />
                        <div>
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
                <header class="main-header">
                    <div class="header-intro">
                        <span style="font-weight: 600; color: var(--text-muted); font-size: 0.95rem;">Panel Tentor MayClass</span>
                        <h1>Halo, {{ $tutor?->name ?? 'Tutor' }}!</h1>
                        <p>{{ $tutorProfile?->headline ?? 'Tetap fokus mengajar dan selesaikan agenda penting hari ini.' }}</p>
                    </div>
                    <div class="header-meta">
                        <span class="date-pill">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                        <span class="status-pill">Mode mengajar aktif</span>
                    </div>
                </header>
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
