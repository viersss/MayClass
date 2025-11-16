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
        <style>
            :root {
                --surface: #ffffff;
                --surface-muted: #f1f5f9;
                --border: #e2e8f0;
                --text: #0f172a;
                --text-muted: #6b7280;
                --primary: #2563eb;
                --primary-dark: #1d4ed8;
                --sidebar: #0f172a;
                --sidebar-muted: #1f2937;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: 'Poppins', sans-serif;
                background: var(--surface-muted);
                color: var(--text);
                min-height: 100vh;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .dashboard-shell {
                min-height: 100vh;
                display: grid;
                grid-template-columns: 280px 1fr;
                gap: 32px;
                padding: 32px 40px;
            }

            .nav-panel {
                background: var(--sidebar);
                border-radius: 24px;
                padding: 28px 24px;
                color: #fff;
                display: flex;
                flex-direction: column;
                gap: 24px;
                position: sticky;
                top: 32px;
                align-self: start;
                min-height: calc(100vh - 64px);
            }

            .navigation {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .nav-link {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px 16px;
                border-radius: 14px;
                font-weight: 500;
                color: rgba(255, 255, 255, 0.85);
                transition: background 0.2s ease, color 0.2s ease;
                font-size: 0.95rem;
            }

            .nav-link[data-active='true'] {
                background: rgba(255, 255, 255, 0.12);
                color: #fff;
            }

            .nav-link:hover {
                background: rgba(255, 255, 255, 0.18);
                color: #fff;
            }

            .nav-icon {
                width: 40px;
                height: 40px;
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.1);
                display: grid;
                place-items: center;
            }

            .nav-icon svg {
                width: 22px;
                height: 22px;
            }

            .nav-footer {
                margin-top: auto;
                padding-top: 20px;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .profile-summary {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px;
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.1);
                color: inherit;
            }

            .profile-summary img {
                width: 48px;
                height: 48px;
                border-radius: 999px;
                object-fit: cover;
                border: 2px solid rgba(255, 255, 255, 0.3);
            }

            .profile-summary strong {
                display: block;
                font-size: 1rem;
            }

            .profile-summary small {
                color: rgba(255, 255, 255, 0.7);
            }

            .logout-btn {
                width: 100%;
            }

            .logout-btn button {
                width: 100%;
                padding: 14px 20px;
                border-radius: 16px;
                border: 1px solid rgba(255, 255, 255, 0.28);
                background: #0d162d;
                color: #fff;
                font: inherit;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                cursor: pointer;
                transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
                box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.05);
            }

            .logout-btn button:hover {
                background: #0f1c3d;
                border-color: rgba(255, 255, 255, 0.45);
                transform: translateY(-1px);
            }

            .main-area {
                display: flex;
                flex-direction: column;
                gap: 24px;
            }

            .main-header {
                background: var(--surface);
                border-radius: 20px;
                padding: 24px 28px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border: 1px solid var(--border);
                box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            }

            .header-meta {
                display: flex;
                align-items: center;
                gap: 16px;
                color: var(--text-muted);
                font-weight: 500;
            }

            .date-pill {
                padding: 8px 14px;
                border-radius: 999px;
                background: var(--surface-muted);
                border: 1px solid var(--border);
                color: var(--text);
                font-size: 0.9rem;
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
                padding: 14px 18px;
                border-radius: 14px;
                background: #dcfce7;
                border: 1px solid #bbf7d0;
                color: #15803d;
                font-weight: 500;
            }

            @media (max-width: 1240px) {
                .dashboard-shell {
                    grid-template-columns: 240px 1fr;
                    padding: 24px;
                }
            }

            @media (max-width: 1024px) {
                .dashboard-shell {
                    grid-template-columns: 1fr;
                    padding: 20px;
                }

                .nav-panel {
                    position: static;
                    flex-direction: row;
                    flex-wrap: wrap;
                    gap: 16px;
                    max-height: none;
                }

                .navigation {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 12px;
                }

                .nav-footer {
                    width: 100%;
                }
            }

            @media (max-width: 768px) {
                .main-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 16px;
                }

                .header-meta {
                    width: 100%;
                    flex-wrap: wrap;
                    gap: 10px;
                }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        <div class="dashboard-shell">
            <aside class="nav-panel">
                <nav class="navigation">
                    @php
                        $currentRoute = request()->route() ? request()->route()->getName() : null;
                        $menuItems = [
                            [
                                'label' => 'Dashboard',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9.5 12 3l9 6.5V20a1 1 0 0 1-1 1h-5v-5h-6v5H4a1 1 0 0 1-1-1z" /></svg>',
                                'route' => 'admin.dashboard',
                                'patterns' => ['admin.dashboard'],
                            ],
                            [
                                'label' => 'Manajemen Siswa',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M7 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm10 0a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2 20a4.5 4.5 0 0 1 4.5-4.5H9a4.5 4.5 0 0 1 4.5 4.5v1H2zm9.5 1v-1A4.5 4.5 0 0 1 16 15.5h2.5A4.5 4.5 0 0 1 23 20v1z" /></svg>',
                                'route' => 'admin.students.index',
                                'patterns' => ['admin.students.*'],
                            ],
                            [
                                'label' => 'Manajemen Paket',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7 12 3l9 4v10l-9 4-9-4z" /><path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 4 9-4" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 11v10" /></svg>',
                                'route' => 'admin.packages.index',
                                'patterns' => ['admin.packages.*'],
                            ],
                            [
                                'label' => 'Manajemen Keuangan',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h14a2 2 0 0 1 2 2v8a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V9a2 2 0 0 1 2-2z" /><path stroke-linecap="round" stroke-linejoin="round" d="M18 11h3v4h-3a2 2 0 0 1 0-4z" /></svg>',
                                'route' => 'admin.finance.index',
                                'patterns' => ['admin.finance.*'],
                            ],
                        ];
                        $avatarPlaceholder = asset('images/avatar-placeholder.svg');
                        $adminSummaryAvatar = \App\Support\AvatarResolver::resolve([$admin?->avatar_path]) ?? $avatarPlaceholder;
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
                            <span class="nav-icon" aria-hidden="true">{!! $item['icon'] !!}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
                <div class="nav-footer">
                    <a class="profile-summary" href="{{ route('admin.account.edit') }}" title="Kelola profil admin">
                        <img
                            src="{{ $adminSummaryAvatar }}"
                            alt="Foto admin"
                        />
                        <div>
                            <strong>{{ $admin?->name ?? 'Admin MayClass' }}</strong>
                            <small>Administrator</small>
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
                    <div>
                        <p style="margin: 0; color: var(--text-muted); font-weight: 500;">Panel Admin MayClass</p>
                        <h1 style="margin: 4px 0 0; font-size: 1.8rem;">Halo, {{ $admin?->name ?? 'Admin' }}!</h1>
                    </div>
                    <div class="header-meta">
                        <span class="date-pill">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
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
