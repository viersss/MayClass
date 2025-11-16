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
                --shadow: 0 24px 45px rgba(25, 77, 76, 0.1);
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

            header {
                padding: 32px 0 16px;
            }

            .container {
                width: 100%;
                max-width: 1180px;
                margin: 0 auto;
                padding: 0 24px;
            }

            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
                padding: 18px 24px;
                border-radius: 28px;
                background: rgba(255, 255, 255, 0.72);
                box-shadow: 0 18px 40px rgba(25, 76, 75, 0.08);
                backdrop-filter: blur(14px);
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 14px;
                font-weight: 600;
                font-size: 1.25rem;
                color: #000;
            }

            .brand img {
                width: 120px;
                height: auto;
                object-fit: contain;
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 14px;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .nav-chip {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 8px 18px;
                border-radius: 999px;
                border: 1px solid rgba(0, 0, 0, 0.12);
                background: rgba(255, 255, 255, 0.65);
                color: #000;
                font-weight: 500;
                text-decoration: none;
                box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
            }

            .nav-chip__avatar {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                overflow: hidden;
                background: rgba(0, 0, 0, 0.08);
                display: grid;
                place-items: center;
            }

            .nav-chip__avatar img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .nav-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 10px 22px;
                border-radius: 999px;
                border: 1px solid rgba(0, 0, 0, 0.12);
                background: rgba(255, 255, 255, 0.55);
                color: #000;
                font-weight: 500;
                font-size: 0.95rem;
                text-decoration: none;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .nav-btn--filled {
                background: rgba(255, 255, 255, 0.9);
                border-color: rgba(0, 0, 0, 0.1);
                box-shadow: 0 16px 35px rgba(15, 23, 42, 0.15);
            }

            .nav-btn--ghost {
                background: transparent;
            }

            .nav-btn:hover,
            .nav-chip:hover {
                transform: translateY(-2px);
                box-shadow: 0 18px 32px rgba(15, 23, 42, 0.12);
            }

            .page-title {
                margin: 48px 0 24px;
                text-align: center;
            }

            .page-title h1 {
                margin: 0;
                font-size: clamp(2rem, 3vw, 2.8rem);
                font-weight: 600;
            }

            .page-title p {
                margin: 12px auto 0;
                max-width: 620px;
                color: var(--text-muted);
                font-size: 1rem;
            }

            .stage-group {
                margin: 48px 0 64px;
                display: grid;
                gap: 24px;
            }

            .stage-group__header {
                display: grid;
                gap: 8px;
            }

            .stage-group__description {
                color: var(--text-muted);
                font-size: 0.95rem;
                margin: 0;
            }

            .packages-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 28px;
                margin: 0;
            }

            .package-card {
                background: var(--card);
                border-radius: 28px;
                padding: 28px 24px;
                box-shadow: var(--shadow);
                border: 1px solid transparent;
                display: flex;
                flex-direction: column;
                gap: 18px;
                position: relative;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .package-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 32px 55px rgba(25, 76, 75, 0.18);
            }

            .package-card[data-tag="Best"] {
                border-color: rgba(249, 178, 51, 0.65);
                box-shadow: 0 28px 58px rgba(249, 178, 51, 0.15);
            }

            .badge {
                position: absolute;
                top: 20px;
                right: 24px;
                padding: 6px 14px;
                border-radius: 999px;
                background: rgba(47, 143, 135, 0.1);
                color: var(--primary-dark);
                font-size: 0.78rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.02em;
            }

            .price {
                font-size: 1.8rem;
                font-weight: 600;
                color: var(--primary-dark);
            }

            .package-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 6px 12px;
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            .features {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .features li {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 0.95rem;
                color: var(--text-muted);
            }

            .features li span {
                width: 26px;
                height: 26px;
                border-radius: 50%;
                background: rgba(61, 183, 173, 0.14);
                display: grid;
                place-items: center;
                color: var(--primary-dark);
                font-size: 0.8rem;
                font-weight: 600;
            }

            .card-footer {
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                gap: 12px;
                margin-top: auto;
            }

            .more-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 18px;
                border-radius: 999px;
                border: 1px solid rgba(61, 183, 173, 0.35);
                background: rgba(61, 183, 173, 0.08);
                color: var(--primary-dark);
                font-weight: 500;
                font-size: 0.92rem;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .more-link:hover {
                transform: translateY(-2px);
                box-shadow: 0 18px 36px rgba(47, 137, 131, 0.2);
            }

            .checkout-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 18px;
                border-radius: 999px;
                background: var(--primary);
                color: #fff;
                font-weight: 600;
                font-size: 0.92rem;
                box-shadow: 0 18px 35px rgba(61, 183, 173, 0.28);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .checkout-link:hover {
                transform: translateY(-2px);
                box-shadow: 0 24px 45px rgba(34, 108, 104, 0.25);
            }

            footer.student-footer {
                margin-top: 80px;
                padding: 32px 24px 60px;
                text-align: center;
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            @media (max-width: 768px) {
                nav {
                    flex-wrap: wrap;
                }

                .page-title {
                    margin-top: 24px;
                }

                .package-card {
                    padding: 24px 20px;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <a href="/" class="brand">
                        <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass" />
                    </a>
                    <div class="nav-actions">
                        @include('components.nav.public-actions')
                    </div>
                </nav>
                <div class="page-title">
                    <h1>Pilih Paket Belajar Terbaik untuk Kamu</h1>
                    <p>
                        Tersedia pilihan paket lengkap dari tingkat dasar hingga program intensif.
                        Semua dirancang untuk membantu kamu mencapai target akademik secara maksimal.
                    </p>
                </div>
            </div>
        </header>

        <main class="container">
            @php($catalog = collect($catalog ?? []))

            @if ($catalog->isNotEmpty())
                @foreach ($catalog as $group)
                    <section class="stage-group">
                        <div class="stage-group__header">
                            <h2 style="margin: 0; font-size: clamp(1.8rem, 3vw, 2.2rem);">
                                {{ $group['stage_label'] ?? $group['stage'] }}
                            </h2>
                            @php($stageDescription = $group['stage_description'] ?? '')
                            @if (! empty($stageDescription))
                                <p class="stage-group__description">{{ $stageDescription }}</p>
                            @endif
                        </div>
                        <div class="packages-grid">
                            @foreach ($group['packages'] as $package)
                                @php($features = collect($package['card_features'] ?? $package['features'] ?? [])->take(4))
                                <article class="package-card" data-tag="{{ $package['tag'] }}">
                                    @if (! empty($package['tag']))
                                        <span class="badge">{{ $package['tag'] }}</span>
                                    @endif
                                    <h3 style="margin: 0; font-size: 1.3rem;">{{ $package['detail_title'] }}</h3>
                                    <div class="package-meta">
                                        <span>{{ $group['stage_label'] ?? $group['stage'] }}</span>
                                        @if (! empty($package['grade_range']))
                                            <span>• {{ $package['grade_range'] }}</span>
                                        @endif
                                    </div>
                                    <p class="price">{{ $package['card_price'] }}</p>
                                    @if (! empty($package['detail_price']))
                                        <p style="margin: -10px 0 0; color: var(--text-muted); font-size: 0.9rem;">{{ $package['detail_price'] }}</p>
                                    @endif
                                    @if ($package['summary'] ?? false)
                                        <p style="margin: 12px 0 0; color: var(--text-muted);">{{ $package['summary'] }}</p>
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
                                            <a class="checkout-link" href="{{ route('checkout.show', $package['slug']) }}">Checkout</a>
                                        @else
                                            <a class="checkout-link" href="{{ route('register') }}">Daftar &amp; Checkout</a>
                                        @endauth
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            @else
                <section class="stage-group" style="text-align: center;">
                    <h2 style="margin: 0 0 12px;">Paket belum tersedia</h2>
                    <p class="stage-group__description" style="margin: 0 auto; max-width: 560px;">
                        Admin MayClass dapat menambahkan paket melalui dashboard untuk menampilkan katalog jenjang SD, SMP, dan SMA secara otomatis.
                    </p>
                </section>
            @endif
        </main>

        <footer class="student-footer">© {{ now()->year }} MayClass. Portal siswa diperbarui otomatis.</footer>
    </body>
</html>
