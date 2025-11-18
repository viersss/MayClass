<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $package['detail_title'] }} - MayClass</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                color-scheme: light;
                --nav-height: 64px;
                --primary: #3fa67e;
                --primary-dark: #1b6d4f;
                --primary-light: #84d986;
                --primary-accent: #a8e6a1;
                --accent: #a8e6a1;
                --text-dark: #102029;
                --text-muted: #5f6c7b;
                --bg: #f3fbfb;
                --bg-secondary: #e0f4f3;
                --card: #ffffff;
                --nav-surface: linear-gradient(135deg, rgba(80, 190, 150, 0.98), rgba(63, 166, 126, 0.98));
                --footer-surface: #e8f3ef;
                --ink-strong: #14352c;
                --ink-muted: rgba(20, 59, 46, 0.78);
                --ink-soft: rgba(20, 59, 46, 0.62);
                --shadow-lg: 0 24px 60px rgba(31, 107, 79, 0.2);
                --shadow-md: 0 18px 40px rgba(31, 107, 79, 0.12);
                --radius-lg: 20px;
                --radius-xl: 28px;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: linear-gradient(180deg, #f6ffff 0%, #e7f3f3 40%, #f9ffff 100%);
                color: var(--text-dark);
                padding-top: calc(var(--nav-height) + 32px);
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .container {
                width: 100%;
                max-width: 1180px;
                margin: 0 auto;
                padding: 0 24px;
            }

            header {
                overflow: visible;
                padding-top: 0;
            }

            nav {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                width: 100%;
                padding: 12px clamp(12px, 3vw, 24px);
                background: rgba(255, 255, 255, 0.4);
                backdrop-filter: blur(16px) saturate(180%);
                -webkit-backdrop-filter: blur(16px) saturate(180%);
                border-bottom: 1px solid rgba(255, 255, 255, 0.25);
                box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
                transition: background 0.3s ease, box-shadow 0.3s ease;
            }

            .nav-inner {
                display: grid;
                grid-template-columns: auto 1fr auto;
                align-items: center;
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 32px;
                gap: 20px;
            }

            @media (max-width: 1024px) {
                nav {
                    padding: 24px clamp(8px, 4vw, 20px);
                }

                .nav-inner {
                    gap: clamp(18px, 4vw, 32px);
                }
            }

            @media (max-width: 768px) {
                nav {
                    padding: 20px clamp(8px, 6vw, 16px);
                }

                .nav-inner {
                    grid-template-columns: 1fr;
                    justify-items: center;
                    gap: 18px;
                }

                .nav-inner > * {
                    width: 100%;
                    justify-self: center;
                }
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 14px;
                font-weight: 600;
                font-size: 1.25rem;
                flex-shrink: 0;
                justify-self: start;
            }

            .brand img {
                width: 130px;
                height: auto;
                object-fit: contain;
            }

            .nav-links {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 28px;
                font-size: 0.95rem;
                margin-left: 57px;
            }

            @media (max-width: 768px) {
                .nav-links {
                    flex-wrap: wrap;
                    justify-content: center;
                    gap: 16px;
                    margin-left: 0;
                }
            }

            .nav-links a {
                color: rgba(255, 255, 255, 0.78);
                transition: color 0.2s ease;
            }

            .nav-links a:hover,
            .nav-links a.is-active {
                color: #ffffff;
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 16px;
                justify-content: flex-end;
                justify-self: end;
            }

            .nav-actions form {
                margin: 0;
            }

            .nav-profile {
                width: 46px;
                height: 46px;
                border-radius: 50%;
                border: 2px solid rgba(20, 59, 46, 0.25);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                background: rgba(255, 255, 255, 0.65);
                box-shadow: 0 8px 18px rgba(20, 59, 46, 0.18);
            }

            .nav-profile img {
                width: 100%;
                height: 100%;
                object-fit: cover;
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

            @media (max-width: 768px) {
                .nav-actions {
                    width: 100%;
                    justify-content: center;
                    flex-wrap: wrap;
                }
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 28px;
                border-radius: 999px;
                font-size: 0.95rem;
                font-weight: 500;
                border: 1px solid transparent;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-outline {
                border-color: rgba(255, 255, 255, 0.38);
                color: #ffffff;
                background: transparent;
            }

            .btn-outline:hover {
                transform: translateY(-1px);
                box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--primary-light) 0%, var(--primary-accent) 100%);
                color: var(--primary-dark);
                box-shadow: 0 16px 40px rgba(132, 217, 134, 0.36);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
            }

            .btn-ghost {
                border-color: rgba(63, 166, 126, 0.35);
                background: rgba(63, 166, 126, 0.08);
                color: var(--primary-dark);
            }

            .btn-ghost:hover {
                transform: translateY(-1px);
                box-shadow: 0 14px 32px rgba(63, 166, 126, 0.2);
            }

            .btn-muted {
                border-color: rgba(31, 42, 55, 0.1);
                background: rgba(31, 42, 55, 0.05);
                color: var(--ink-strong);
            }

            .page-header {
                margin-top: 16px;
            }

            .breadcrumb {
                margin: 32px 0;
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            main {
                display: grid;
                grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
                gap: 48px;
                align-items: flex-start;
                padding-bottom: 64px;
                background: rgba(255, 255, 255, 0.65);
                border-radius: 36px;
                padding: 48px;
                box-shadow: 0 35px 80px rgba(17, 82, 79, 0.12);
            }

            .summary {
                display: grid;
                gap: 20px;
            }

            .summary h1 {
                margin: 0;
                font-size: clamp(2.1rem, 3vw, 2.8rem);
            }

            .summary p {
                margin: 0;
                color: var(--text-muted);
                line-height: 1.7;
            }

            .package-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 8px 12px;
                font-size: 0.95rem;
                color: var(--text-muted);
                margin: 12px 0 0;
            }

            .tag {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 18px;
                border-radius: 999px;
                background: rgba(61, 183, 173, 0.1);
                color: var(--primary-dark);
                font-weight: 500;
                font-size: 0.9rem;
            }

            .learn-points {
                background: rgba(255, 255, 255, 0.8);
                border-radius: 24px;
                padding: 28px 32px;
                box-shadow: 0 26px 50px rgba(28, 87, 86, 0.15);
                display: grid;
                gap: 18px;
            }

            .learn-points h3 {
                margin: 0;
            }

            .learn-points ul {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 12px;
            }

            .learn-points li {
                display: flex;
                gap: 12px;
                align-items: center;
                color: var(--text-muted);
            }

            .learn-points span {
                width: 26px;
                height: 26px;
                border-radius: 50%;
                background: rgba(61, 183, 173, 0.16);
                display: grid;
                place-items: center;
                color: var(--primary-dark);
                font-size: 0.82rem;
                font-weight: 600;
            }

            .detail-card {
                background: var(--card);
                border-radius: 32px;
                overflow: hidden;
                box-shadow: 0 32px 58px rgba(23, 65, 63, 0.2);
                display: flex;
                flex-direction: column;
            }

            .detail-card img {
                width: 100%;
                height: 240px;
                object-fit: cover;
            }

            .detail-body {
                padding: 32px;
                display: grid;
                gap: 20px;
            }

            .detail-body h2 {
                margin: 0;
                font-size: 1.4rem;
            }

            .price-box {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            }

            .price {
                font-size: 2rem;
                font-weight: 600;
                color: var(--primary-dark);
            }

            .buy-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 14px 28px;
                border-radius: 999px;
                background: var(--primary);
                color: #fff;
                font-weight: 600;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .buy-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 20px 40px rgba(36, 110, 107, 0.25);
            }

            .chip-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 10px 22px;
                border-radius: 999px;
                border: 1px solid rgba(63, 166, 126, 0.2);
                font-weight: 500;
                font-size: 0.92rem;
                color: var(--primary-dark);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .chip-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 14px 32px rgba(63, 166, 126, 0.12);
            }

            .included {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 12px;
                color: var(--text-muted);
            }

            .included li {
                display: flex;
                gap: 12px;
                align-items: center;
            }

            .included li span {
                width: 24px;
                height: 24px;
                border-radius: 50%;
                background: rgba(47, 143, 135, 0.1);
                display: grid;
                place-items: center;
                color: var(--primary-dark);
                font-size: 0.78rem;
                font-weight: 600;
            }

            footer {
                background: var(--footer-surface);
                padding: 80px 0 52px;
                width: 100%;
                border-top: 1px solid rgba(31, 107, 79, 0.12);
                margin-top: 64px;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 32px;
                width: 100%;
                max-width: 1200px;
                margin: 0 auto 48px;
                padding: 0 32px;
            }

            .footer-brand {
                display: grid;
                gap: 16px;
                color: var(--ink-soft);
            }

            .footer-brand img {
                width: 64px;
                height: auto;
            }

            .footer-grid h4 {
                margin: 0 0 12px;
                font-size: 1rem;
                color: var(--ink-strong);
            }

            .footer-links {
                display: grid;
                gap: 10px;
                color: var(--ink-soft);
                font-size: 0.95rem;
            }

            .footer-links a {
                color: inherit;
            }

            .footer-links a:hover {
                color: var(--primary);
            }

            .copyright {
                margin: 0;
                text-align: center;
                color: var(--ink-soft);
                font-size: 0.9rem;
                padding: 0 32px;
            }

            @media (max-width: 768px) {
                footer {
                    padding: 60px 0 40px;
                }

                .footer-grid {
                    grid-template-columns: 1fr;
                    padding: 0 16px;
                    margin: 0 auto 40px;
                }

                .copyright {
                    padding: 0 16px;
                }
            }

            @media (max-width: 960px) {
                main {
                    grid-template-columns: 1fr;
                    padding: 32px 24px;
                }

                .detail-card img {
                    height: 220px;
                }

                .nav-links {
                    width: 100%;
                    justify-content: center;
                }

                .nav-actions {
                    width: 100%;
                    justify-content: center;
                }
            }
        </style>
    </head>
    <body>
        @php($profileLink = $profileLink ?? null)
        @php($profileAvatar = $profileAvatar ?? asset('images/avatar-placeholder.svg'))

        <header>
            <nav>
                <div class="nav-inner">
                    <a class="brand" href="/">
                        <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass" />
                    </a>
                    <div class="nav-links">
                        <a href="{{ route('packages.index') }}" class="is-active">Paket Belajar</a>
                        <a href="{{ route('join') }}">Gabung</a>
                        <a href="#included">Fasilitas</a>
                    </div>
                    <div class="nav-actions">
                        <a class="btn btn-ghost" href="{{ route('packages.index') }}">Kembali</a>
                        @auth
                            <a class="nav-profile" href="{{ $profileLink ?? route('student.profile') }}" aria-label="Lihat profil">
                                <img src="{{ $profileAvatar }}" alt="Foto profil MayClass" />
                                <span class="sr-only">Profil</span>
                            </a>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline" type="submit">Keluar</button>
                            </form>
                        @else
                            <a class="btn btn-outline" href="{{ route('login') }}">Masuk</a>
                            <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <div class="container">
            <main>
                <section class="summary">
                    <span class="tag">{{ $package['tag'] ?? ($package['stage_label'] ?? 'Program MayClass') }}</span>
                    <h1>{{ $package['detail_title'] }}</h1>
                    <div class="package-meta">
                        <span>{{ $package['stage_label'] ?? $package['stage'] ?? 'Program' }}</span>
                        @if (! empty($package['grade_range']))
                            <span>• {{ $package['grade_range'] }}</span>
                        @endif
                    </div>
                    <p>{{ $package['summary'] }}</p>

                    <div class="learn-points">
                        <h3>Apa yang akan kamu pelajari</h3>
                        <ul>
                            @foreach ($package['card_features'] as $feature)
                                <li><span>✓</span>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                <aside class="detail-card">
                    <img src="{{ $package['image'] }}" alt="{{ $package['detail_title'] }}" />
                    <div class="detail-body">
                        <h2>Investasi Belajar</h2>
                        <div class="price-box">
                            <p class="price">{{ $package['detail_price'] }}</p>
                            @auth
                                <a class="buy-btn" href="{{ route('checkout.show', $package['slug']) }}">Checkout</a>
                            @else
                                <a class="buy-btn" href="{{ route('register') }}">Checkout</a>
                            @endauth
                        </div>
                        <div class="package-meta" style="margin-top: -6px;">
                            <span>{{ $package['stage_label'] ?? $package['stage'] ?? 'Program' }}</span>
                            @if (! empty($package['grade_range']))
                                <span>• {{ $package['grade_range'] }}</span>
                            @endif
                        </div>
                        <div>
                            <h3 style="margin: 0 0 12px">This course included</h3>
                              <ul class="included" id="included">
                                @foreach ($package['included'] as $item)
                                    <li><span>✓</span>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </aside>
            </main>
        </div>
    </body>
</html>
