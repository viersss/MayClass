<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Pilihan Paket Belajar</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                color-scheme: light;
                --primary: #3db7ad;
                --primary-dark: #2c8c84;
                --accent: #f9b233;
                --text-dark: #1f2a37;
                --text-muted: #6b7280;
                --bg-soft: #f4fbfb;
                --card: #ffffff;
                --border: rgba(61, 183, 173, 0.15);
                --shadow: 0 12px 30px rgba(25, 77, 76, 0.08);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: linear-gradient(180deg, #f7ffff 0%, #edf7f6 100%);
                color: var(--text-dark);
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            /* Header & Navigation */
            header {
                padding: 24px 0;
                background: rgba(255, 255, 255, 0.6);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid var(--border);
                position: sticky;
                top: 0;
                z-index: 100;
            }

            .container {
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 24px;
            }

            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                font-weight: 600;
                font-size: 1.2rem;
                color: var(--primary-dark);
            }

            .brand img {
                width: 40px;
                height: 40px;
                object-fit: contain;
            }

            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .nav-actions form {
                margin: 0;
            }

            .profile-icon-btn {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 1px solid rgba(61, 183, 173, 0.35);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: var(--primary-dark);
                background: rgba(61, 183, 173, 0.12);
                transition: transform 0.2s, background 0.2s;
                overflow: hidden;
            }

            .profile-icon-btn:hover {
                transform: scale(1.05);
                background: rgba(61, 183, 173, 0.18);
            }

            .profile-icon-btn img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .nav-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 20px;
                border-radius: 10px;
                border: 1px solid rgba(61, 183, 173, 0.35);
                font-weight: 600;
                font-size: 0.9rem;
                background: rgba(255, 255, 255, 0.75);
                color: var(--primary-dark);
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .nav-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 16px rgba(47, 137, 131, 0.15);
            }

            .nav-btn.primary {
                background: var(--primary);
                color: #fff;
                border-color: transparent;
                box-shadow: 0 4px 12px rgba(61, 183, 173, 0.25);
            }

            .nav-btn.primary:hover {
                box-shadow: 0 8px 20px rgba(61, 183, 173, 0.35);
            }

            /* Page Title */
            .page-title {
                padding: 48px 0 32px;
                text-align: center;
            }

            .page-title h1 {
                margin: 0;
                font-size: clamp(1.8rem, 4vw, 2.5rem);
                font-weight: 700;
                line-height: 1.3;
            }

            .page-title p {
                margin: 16px auto 0;
                max-width: 640px;
                color: var(--text-muted);
                font-size: 1.05rem;
                line-height: 1.6;
            }

            /* Stage Groups */
            .stage-group {
                margin-bottom: 56px;
            }

            .stage-group__header {
                margin-bottom: 28px;
            }

            .stage-group__header h2 {
                margin: 0 0 8px;
                font-size: clamp(1.5rem, 3vw, 2rem);
                font-weight: 700;
            }

            .stage-group__description {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.95rem;
                line-height: 1.6;
            }

            /* Packages Grid */
            .packages-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 24px;
            }

            .package-card {
                background: var(--card);
                border-radius: 20px;
                padding: 28px;
                box-shadow: var(--shadow);
                border: 1px solid var(--border);
                display: flex;
                flex-direction: column;
                gap: 16px;
                position: relative;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .package-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 20px 40px rgba(25, 76, 75, 0.15);
            }

            .package-card[data-tag="Best"] {
                border-color: rgba(249, 178, 51, 0.5);
                box-shadow: 0 16px 35px rgba(249, 178, 51, 0.12);
            }

            .badge {
                position: absolute;
                top: 20px;
                right: 24px;
                padding: 6px 12px;
                border-radius: 8px;
                background: rgba(47, 143, 135, 0.12);
                color: var(--primary-dark);
                font-size: 0.75rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .package-card h3 {
                margin: 0;
                font-size: 1.25rem;
                font-weight: 600;
                padding-right: 80px;
            }

            .package-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 6px 12px;
                font-size: 0.85rem;
                color: var(--text-muted);
                font-weight: 500;
            }

            .price {
                font-size: 1.8rem;
                font-weight: 700;
                color: var(--primary-dark);
                margin: 8px 0;
            }

            .detail-price {
                margin: -8px 0 0;
                color: var(--text-muted);
                font-size: 0.9rem;
            }

            .summary {
                margin: 8px 0;
                color: var(--text-muted);
                line-height: 1.5;
                font-size: 0.95rem;
            }

            /* Features List */
            .features {
                list-style: none;
                padding: 0;
                margin: 12px 0 0;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .features li {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            .features li span {
                width: 24px;
                height: 24px;
                border-radius: 6px;
                background: rgba(61, 183, 173, 0.12);
                display: grid;
                place-items: center;
                color: var(--primary-dark);
                font-size: 0.75rem;
                font-weight: 700;
                flex-shrink: 0;
            }

            /* Card Footer */
            .card-footer {
                display: flex;
                gap: 10px;
                margin-top: auto;
                padding-top: 16px;
                border-top: 1px solid var(--border);
            }

            .more-link {
                flex: 1;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                padding: 12px 20px;
                border-radius: 10px;
                border: 1px solid rgba(61, 183, 173, 0.35);
                background: rgba(61, 183, 173, 0.08);
                color: var(--primary-dark);
                font-weight: 600;
                font-size: 0.9rem;
                transition: all 0.2s ease;
            }

            .more-link:hover {
                transform: translateY(-2px);
                background: rgba(61, 183, 173, 0.15);
                box-shadow: 0 8px 16px rgba(47, 137, 131, 0.15);
            }

            .checkout-link {
                flex: 1;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                padding: 12px 20px;
                border-radius: 10px;
                background: var(--primary);
                color: #fff;
                font-weight: 600;
                font-size: 0.9rem;
                box-shadow: 0 4px 12px rgba(61, 183, 173, 0.25);
                transition: all 0.2s ease;
            }

            .checkout-link:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(34, 108, 104, 0.3);
            }

            /* Empty State */
            .empty-state {
                text-align: center;
                padding: 64px 24px;
                border-radius: 20px;
                background: rgba(61, 183, 173, 0.04);
                border: 1px dashed var(--border);
            }

            .empty-state h2 {
                margin: 0 0 12px;
                font-size: 1.5rem;
                font-weight: 600;
            }

            .empty-state p {
                margin: 0 auto;
                max-width: 560px;
                color: var(--text-muted);
                line-height: 1.6;
            }

            /* Footer */
            .student-footer {
                margin-top: 64px;
                padding: 32px 24px;
                text-align: center;
                font-size: 0.9rem;
                color: var(--text-muted);
                border-top: 1px solid var(--border);
            }

            /* Responsive */
            @media (max-width: 768px) {
                header {
                    padding: 16px 0;
                }

                .page-title {
                    padding: 32px 0 24px;
                }

                .page-title h1 {
                    font-size: 1.8rem;
                }

                .packages-grid {
                    grid-template-columns: 1fr;
                }

                .package-card {
                    padding: 24px;
                }

                .nav-actions {
                    gap: 8px;
                }

                .nav-btn {
                    padding: 8px 16px;
                    font-size: 0.85rem;
                }
            }
        </style>
    </head>
    <body>
        @php($profileLink = $profileLink ?? null)
        @php($profileAvatar = $profileAvatar ?? asset('images/avatar-placeholder.svg'))
        <header>
            <div class="container">
                <nav>
                    <a href="/" class="brand">
                        <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass" />
                    </a>
                    @auth
                        <div class="nav-actions">
                            <a class="profile-icon-btn" href="{{ $profileLink ?? route('student.profile') }}" aria-label="Lihat profil">
                                <img src="{{ $profileAvatar }}" alt="Foto profil MayClass" />
                                <span class="sr-only">Profil</span>
                            </a>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-btn">Keluar</button>
                            </form>
                        </div>
                    @else
                        <div class="nav-actions">
                            <a class="nav-btn" href="{{ route('login') }}">Masuk</a>
                            <a class="nav-btn primary" href="{{ route('register') }}">Daftar</a>
                        </div>
                    @endauth
                </nav>
            </div>
        </header>

        <div class="container">
            <div class="page-title">
                <h1>Pilih Paket Belajar Terbaik untuk Kamu</h1>
                <p>
                    Tersedia pilihan paket lengkap dari tingkat dasar hingga program intensif.
                    Semua dirancang untuk membantu kamu mencapai target akademik secara maksimal.
                </p>
            </div>
        </div>

        <main class="container">
            @php($catalog = collect($catalog ?? []))

            @if ($catalog->isNotEmpty())
                @foreach ($catalog as $group)
                    <section class="stage-group">
                        <div class="stage-group__header">
                            <h2>{{ $group['stage_label'] ?? $group['stage'] }}</h2>
                            @php($stageDescription = $group['stage_description'] ?? '')
                            @if (!empty($stageDescription))
                                <p class="stage-group__description">{{ $stageDescription }}</p>
                            @endif
                        </div>
                        <div class="packages-grid">
                            @foreach ($group['packages'] as $package)
                                @php($features = collect($package['card_features'] ?? $package['features'] ?? [])->take(4))
                                <article class="package-card" data-tag="{{ $package['tag'] }}">
                                    @if (!empty($package['tag']))
                                        <span class="badge">{{ $package['tag'] }}</span>
                                    @endif
                                    <h3>{{ $package['detail_title'] }}</h3>
                                    <div class="package-meta">
                                        <span>{{ $group['stage_label'] ?? $group['stage'] }}</span>
                                        @if (!empty($package['grade_range']))
                                            <span>• {{ $package['grade_range'] }}</span>
                                        @endif
                                    </div>
                                    <p class="price">{{ $package['card_price'] }}</p>
                                    @if (!empty($package['detail_price']))
                                        <p class="detail-price">{{ $package['detail_price'] }}</p>
                                    @endif
                                    @if ($package['summary'] ?? false)
                                        <p class="summary">{{ $package['summary'] }}</p>
                                    @endif
                                    @if ($features->isNotEmpty())
                                        <ul class="features">
                                            @foreach ($features as $feature)
                                                <li><span>✓</span>{{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <div class="card-footer">
                                        <a class="more-link" href="{{ route('packages.show', $package['slug']) }}">Detail Paket</a>
                                        @auth
                                        @endauth
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            @else
                <div class="empty-state">
                    <h2>Paket belum tersedia</h2>
                    <p>
                        Admin MayClass dapat menambahkan paket melalui dashboard untuk menampilkan katalog jenjang SD, SMP, dan SMA secara otomatis.
                    </p>
                </div>
            @endif
        </main>

        <footer class="student-footer">
            © {{ now()->year }} MayClass. Portal siswa diperbarui otomatis.
        </footer>
    </body>
</html>