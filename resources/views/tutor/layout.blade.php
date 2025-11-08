<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'Dashboard Tentor - MayClass')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                --sidebar: #0f172a;
                --sidebar-accent: #1e2a48;
                --sidebar-highlight: #3db7ad;
                --text-muted: #6b7280;
                --bg: #f6f8fb;
                --card: #ffffff;
                --primary: #3db7ad;
                --primary-dark: #2c938b;
                --warning: #f2994a;
                --danger: #eb5757;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: var(--bg);
                color: #0f172a;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .app-shell {
                display: grid;
                grid-template-columns: 280px 1fr;
                min-height: 100vh;
                background: linear-gradient(120deg, rgba(61, 183, 173, 0.06), rgba(94, 104, 242, 0.05));
            }

            .sidebar {
                background: linear-gradient(180deg, var(--sidebar), var(--sidebar-accent));
                color: #fff;
                padding: 32px 28px;
                display: flex;
                flex-direction: column;
                gap: 28px;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 12px;
                font-weight: 600;
                font-size: 1.2rem;
            }

            .brand-logo {
                width: 42px;
                height: 42px;
                border-radius: 12px;
                overflow: hidden;
                background: rgba(255, 255, 255, 0.08);
                display: grid;
                place-items: center;
                font-weight: 600;
                letter-spacing: 0.4px;
            }

            .menu {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .menu a {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px 16px;
                border-radius: 12px;
                color: rgba(255, 255, 255, 0.74);
                font-weight: 500;
                transition: background 0.2s ease, color 0.2s ease;
                font-size: 0.96rem;
            }

            .menu a[data-active="true"] {
                background: rgba(61, 183, 173, 0.18);
                color: #fff;
            }

            .menu a:hover {
                background: rgba(61, 183, 173, 0.12);
                color: #fff;
            }

            .menu a span.icon {
                width: 28px;
                height: 28px;
                display: grid;
                place-items: center;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                font-size: 0.85rem;
            }

            .sidebar-footer {
                margin-top: auto;
                padding-top: 16px;
                border-top: 1px solid rgba(255, 255, 255, 0.08);
            }

            .profile-card {
                display: grid;
                grid-template-columns: 56px 1fr;
                gap: 14px;
                align-items: center;
                padding: 16px;
                background: rgba(61, 183, 173, 0.15);
                border-radius: 16px;
            }

            .profile-card img {
                width: 56px;
                height: 56px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid rgba(255, 255, 255, 0.4);
            }

            .profile-card strong {
                font-size: 1rem;
                display: block;
            }

            .logout-btn {
                margin-top: 18px;
                display: inline-flex;
                align-items: center;
                gap: 12px;
                color: rgba(255, 255, 255, 0.78);
                font-weight: 500;
            }

            .logout-btn button {
                background: none;
                border: none;
                color: inherit;
                font: inherit;
                cursor: pointer;
                padding: 0;
            }

            main {
                padding: 36px 48px;
            }

            .page-wrapper {
                max-width: 1160px;
                margin: 0 auto;
            }

            .flash-message {
                margin-bottom: 24px;
                padding: 16px 20px;
                background: rgba(61, 183, 173, 0.12);
                border: 1px solid rgba(61, 183, 173, 0.28);
                color: var(--primary-dark);
                border-radius: 14px;
                font-weight: 500;
            }

            @media (max-width: 1100px) {
                .app-shell {
                    grid-template-columns: 240px 1fr;
                }

                main {
                    padding: 32px;
                }
            }

            @media (max-width: 960px) {
                .app-shell {
                    grid-template-columns: 1fr;
                }

                .sidebar {
                    position: sticky;
                    top: 0;
                    z-index: 20;
                    flex-direction: row;
                    align-items: center;
                    overflow-x: auto;
                }

                .sidebar-footer {
                    display: none;
                }

                main {
                    padding: 28px;
                }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        <div class="app-shell">
            <aside class="sidebar">
                <div class="brand">
                    <div class="brand-logo">MC</div>
                    <span>MayClass Tutor</span>
                </div>
                <nav class="menu">
                    @php
                        $currentRoute = request()->route() ? request()->route()->getName() : null;
                        $menuItems = [
                            ['label' => 'Dashboard', 'route' => 'tutor.dashboard', 'patterns' => ['tutor.dashboard']],
                            ['label' => 'Manajemen Materi', 'route' => 'tutor.materials.index', 'patterns' => ['tutor.materials.*']],
                            ['label' => 'Manajemen Quiz', 'route' => 'tutor.quizzes.index', 'patterns' => ['tutor.quizzes.*']],
                            ['label' => 'Jadwal Mengajar', 'route' => 'tutor.schedule.index', 'patterns' => ['tutor.schedule.*']],
                            ['label' => 'Pengaturan Akun', 'route' => 'tutor.account.edit', 'patterns' => ['tutor.account.*']],
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
                        <a href="{{ route($item['route']) }}" data-active="{{ $isActive ? 'true' : 'false' }}">
                            <span class="icon">•</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
                <div class="sidebar-footer">
                    <div class="profile-card">
                        <img
                            src="{{ $tutorProfile?->avatar_path ? asset('storage/' . $tutorProfile->avatar_path) : config('mayclass.images.tutor.banner.fallback') }}"
                            alt="Profil Tutor"
                        />
                        <div>
                            <strong>{{ $tutor?->name ?? 'Tutor MayClass' }}</strong>
                            <small>{{ $tutorProfile?->specializations ?? 'Pengajar MayClass' }}</small>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="logout-btn">
                        @csrf
                        <span>Keluar</span>
                        <button type="submit">→</button>
                    </form>
                </div>
            </aside>
            <main>
                <div class="page-wrapper">
                    @if (session('status'))
                        <div class="flash-message">{{ session('status') }}</div>
                    @endif
                    @yield('content')
                </div>
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
