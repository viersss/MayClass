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
                width: min(1200px, 92vw);
                margin: 0 auto;
            }

            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 14px;
                font-weight: 600;
                font-size: 1.35rem;
                color: var(--primary-dark);
            }

            .brand-icon {
                width: 44px;
                height: 44px;
                border-radius: 12px;
                background: var(--primary);
                display: grid;
                place-items: center;
                color: #fff;
                font-weight: 700;
                box-shadow: 0 18px 35px rgba(61, 183, 173, 0.28);
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .nav-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 22px;
                border-radius: 999px;
                border: 1px solid rgba(61, 183, 173, 0.35);
                font-weight: 500;
                font-size: 0.95rem;
                background: rgba(255, 255, 255, 0.75);
                color: var(--primary-dark);
                backdrop-filter: blur(4px);
                transition: all 0.2s ease;
            }

            .nav-btn.primary {
                background: var(--primary);
                color: #fff;
                border-color: transparent;
                box-shadow: 0 20px 40px rgba(61, 183, 173, 0.25);
            }

            .nav-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 16px 30px rgba(47, 137, 131, 0.18);
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

            .packages-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 24px;
                margin: 40px 0 64px;
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
                justify-content: space-between;
                align-items: center;
                gap: 12px;
                margin-top: auto;
            }

            .more-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 18px;
                border-radius: 999px;
                background: var(--primary);
                color: #fff;
                font-weight: 500;
                font-size: 0.92rem;
                box-shadow: 0 18px 35px rgba(61, 183, 173, 0.28);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .more-link:hover {
                transform: translateY(-2px);
                box-shadow: 0 24px 45px rgba(34, 108, 104, 0.25);
            }

            footer {
                background: #102a43;
                color: rgba(255, 255, 255, 0.7);
                padding: 48px 0;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 24px;
            }

            .footer-grid h4 {
                margin: 0 0 16px;
                font-size: 1rem;
                color: #fff;
            }

            .footer-grid ul {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 10px;
                font-size: 0.9rem;
            }

            .subscribe {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .subscribe input {
                border-radius: 999px;
                border: none;
                padding: 12px 18px;
                font-family: inherit;
            }

            .subscribe button {
                border-radius: 999px;
                border: none;
                padding: 12px 18px;
                background: var(--accent);
                color: #102a43;
                font-weight: 600;
                cursor: pointer;
            }

            .copyright {
                margin-top: 36px;
                text-align: center;
                font-size: 0.85rem;
                opacity: 0.7;
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
                        <span class="brand-icon">MC</span>
                        MayClass
                    </a>
                    <div class="nav-actions">
                        <a class="nav-btn" href="{{ route('login') }}">Masuk</a>
                        <a class="nav-btn primary" href="{{ route('register') }}">Daftar</a>
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
            <div class="packages-grid">
                @foreach ($packages as $package)
                    <article class="package-card" data-tag="{{ $package['tag'] }}">
                        <span class="badge">{{ $package['tag'] }}</span>
                        <h3>{{ $package['level'] }}</h3>
                        <p class="price">{{ $package['card_price'] }}</p>
                        <ul class="features">
                            @foreach ($package['card_features'] as $feature)
                                <li><span>✓</span>{{ $feature }}</li>
                            @endforeach
                        </ul>
                        <div class="card-footer">
                            <a class="more-link" href="{{ route('packages.show', $package['slug']) }}">Selengkapnya</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </main>

        <footer>
            <div class="container">
                <div class="footer-grid">
                    <div>
                        <h4>Company</h4>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Help center</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                    </div>
                    <div class="subscribe">
                        <h4>Stay up to date</h4>
                        <input type="email" placeholder="Email kamu" />
                        <button type="button">Subscribe</button>
                    </div>
                </div>
                <p class="copyright">© 2024 MayClass. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
