<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'Dashboard Admin - MayClass')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
        <style>
            :root {
                --bg-primary: #f5f7fb;
                --card-bg: rgba(255, 255, 255, 0.9);
                --card-border: rgba(15, 23, 42, 0.04);
                --sidebar-start: #0f172a;
                --sidebar-end: #1e2643;
                --accent-mint: #1fd1a1;
                --accent-indigo: #5465ff;
                --accent-orange: #f48c06;
                --accent-purple: #9b5de5;
                --primary: #3db7ad;
                --primary-dark: #2c938b;
                --text-muted: #6b7280;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: 'Poppins', sans-serif;
                background: radial-gradient(circle at top left, rgba(84, 101, 255, 0.18), transparent 45%),
                    radial-gradient(circle at top right, rgba(31, 209, 161, 0.12), transparent 40%), var(--bg-primary);
                color: #0f172a;
                min-height: 100vh;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .dashboard-shell {
                position: relative;
                min-height: 100vh;
                display: grid;
                grid-template-columns: 280px 1fr;
                gap: 32px;
                padding: 32px 40px;
            }

            .nav-panel {
                background: linear-gradient(195deg, var(--sidebar-start), var(--sidebar-end));
                border-radius: 28px;
                padding: 32px 26px;
                color: #fff;
                display: flex;
                flex-direction: column;
                gap: 32px;
                box-shadow: 0 35px 70px rgba(15, 23, 42, 0.35);
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .brand-logo {
                width: 54px;
                height: 54px;
                border-radius: 18px;
                background: rgba(255, 255, 255, 0.08);
                display: grid;
                place-items: center;
                font-weight: 600;
                font-size: 1.1rem;
                letter-spacing: 0.4px;
            }

            .brand span {
                display: grid;
                font-weight: 600;
                line-height: 1.2;
            }

            .navigation {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .nav-link {
                display: grid;
                grid-template-columns: 48px 1fr;
                align-items: center;
                gap: 18px;
                padding: 14px 18px;
                border-radius: 18px;
                background: rgba(255, 255, 255, 0.04);
                color: rgba(255, 255, 255, 0.78);
                font-weight: 500;
                transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
                font-size: 0.96rem;
            }

            .nav-link[data-active='true'] {
                background: rgba(255, 255, 255, 0.16);
                color: #fff;
                transform: translateX(6px);
            }

            .nav-link:hover {
                background: rgba(255, 255, 255, 0.12);
                color: #fff;
            }

            .nav-icon {
                width: 48px;
                height: 48px;
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.1);
                display: grid;
                place-items: center;
                font-weight: 600;
                letter-spacing: 0.5px;
            }

            .nav-footer {
                margin-top: auto;
                padding-top: 20px;
                border-top: 1px solid rgba(255, 255, 255, 0.14);
                display: flex;
                flex-direction: column;
                gap: 18px;
            }

            .profile-summary {
                display: grid;
                grid-template-columns: 56px 1fr;
                gap: 14px;
                align-items: center;
                padding: 16px;
                border-radius: 18px;
                background: rgba(255, 255, 255, 0.12);
                backdrop-filter: blur(6px);
            }

            .profile-summary img {
                width: 56px;
                height: 56px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid rgba(255, 255, 255, 0.5);
            }

            .profile-summary strong {
                font-size: 1rem;
                display: block;
            }

            .logout-btn {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                font-weight: 500;
                color: rgba(255, 255, 255, 0.82);
            }

            .logout-btn button {
                background: none;
                border: none;
                color: inherit;
                font: inherit;
                cursor: pointer;
                padding: 0;
            }

            .main-area {
                display: flex;
                flex-direction: column;
                gap: 24px;
                position: relative;
            }

            .main-header {
                background: var(--card-bg);
                border-radius: 26px;
                padding: 26px 32px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
                border: 1px solid var(--card-border);
                backdrop-filter: blur(14px);
            }

            .header-meta {
                display: flex;
                align-items: center;
                gap: 24px;
            }

            .date-pill {
                padding: 10px 16px;
                border-radius: 999px;
                background: rgba(61, 183, 173, 0.12);
                color: var(--primary-dark);
                font-weight: 500;
                font-size: 0.95rem;
            }

            .header-profile {
                display: grid;
                grid-template-columns: 48px 1fr;
                gap: 12px;
                align-items: center;
            }

            .header-profile img {
                width: 48px;
                height: 48px;
                border-radius: 16px;
                object-fit: cover;
            }

            .header-profile strong {
                font-size: 1rem;
                display: block;
            }

            .page-wrapper {
                position: relative;
                padding-bottom: 48px;
            }

            main {
                flex: 1;
            }

            .page-content {
                display: block;
                max-width: 1240px;
            }

            .flash-message {
                margin-bottom: 24px;
                padding: 16px 20px;
                border-radius: 16px;
                background: rgba(61, 183, 173, 0.14);
                border: 1px solid rgba(61, 183, 173, 0.24);
                color: var(--primary-dark);
                font-weight: 500;
            }

            @media (max-width: 1240px) {
                .dashboard-shell {
                    grid-template-columns: 240px 1fr;
                    padding: 28px;
                }

                .main-header {
                    padding: 22px 26px;
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
                    display: inline-flex;
                    gap: 12px;
                    width: max-content;
                }

                .nav-link {
                    grid-template-columns: auto;
                    grid-auto-flow: column;
                    padding: 12px 16px;
                }

                .nav-icon {
                    width: 40px;
                    height: 40px;
                }

                .nav-footer {
                    display: none;
                }
            }

            @media (max-width: 768px) {
                .main-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 18px;
                }

                .header-meta {
                    width: 100%;
                    justify-content: space-between;
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
                    <span>MayClass Admin</span>
                </div>
                <nav class="navigation">
                    @php
                        $currentRoute = request()->route() ? request()->route()->getName() : null;
                        $menuItems = [
                            [
                                'label' => 'Manajemen Siswa',
                                'abbr' => 'MS',
                                'route' => 'admin.students.index',
                                'patterns' => ['admin.students.*'],
                            ],
                            [
                                'label' => 'Manajemen Paket',
                                'abbr' => 'PK',
                                'route' => 'admin.packages.index',
                                'patterns' => ['admin.packages.*'],
                            ],
                            [
                                'label' => 'Manajemen Keuangan',
                                'abbr' => 'MK',
                                'route' => 'admin.finance.index',
                                'patterns' => ['admin.finance.*'],
                            ],
                        ];
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
                    <div class="profile-summary">
                        <img
                            src="{{ $admin?->avatar_path ? asset('storage/' . $admin->avatar_path) : config('mayclass.images.tutor.banner.fallback') }}"
                            alt="Foto admin"
                        />
                        <div>
                            <strong>{{ $admin?->name ?? 'Admin MayClass' }}</strong>
                            <small>Administrator</small>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="logout-btn">
                        @csrf
                        <span>Keluar</span>
                        <button type="submit">→</button>
                    </form>
                </div>
            </aside>
            <div class="main-area">
                <header class="main-header">
                    <div>
                        <span style="display: inline-flex; align-items: center; gap: 8px; font-weight: 500; color: var(--primary-dark); font-size: 0.95rem;">
                            <span style="display: inline-flex; width: 8px; height: 8px; border-radius: 50%; background: var(--primary);"></span>
                            Panel Admin MayClass
                        </span>
                        <h1 style="margin: 8px 0 0; font-size: 1.9rem;">Halo, {{ $admin?->name ?? 'Admin' }}!</h1>
                    </div>
                    <div class="header-meta">
                        <span class="date-pill">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                        <div class="header-profile">
                            <img
                                src="{{ $admin?->avatar_path ? asset('storage/' . $admin->avatar_path) : config('mayclass.images.tutor.resources.fallback') }}"
                                alt="Profil"
                            />
                            <div>
                                <strong>{{ $admin?->name ?? 'Admin MayClass' }}</strong>
                                <small style="color: var(--text-muted);">Kelola operasi MayClass</small>
                            </div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="page-wrapper">
                        <div class="page-content">
                            @if (session('status'))
                                <div class="flash-message">{{ session('status') }}</div>
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
