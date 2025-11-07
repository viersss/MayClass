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
                --primary: #3db7ad;
                --primary-dark: #2c8c84;
                --accent: #f9b233;
                --text-dark: #1f2a37;
                --text-muted: #6b7280;
                --bg: #f4fbfb;
                --card: #ffffff;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: linear-gradient(160deg, #f9ffff 0%, #e7f3f3 100%);
                color: var(--text-dark);
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            header {
                padding: 28px 0 16px;
            }

            .container {
                width: min(1180px, 92vw);
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
                font-size: 1.3rem;
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
                box-shadow: 0 18px 32px rgba(61, 183, 173, 0.28);
            }

            .nav-actions {
                display: flex;
                gap: 16px;
            }

            .nav-btn {
                padding: 10px 22px;
                border-radius: 999px;
                border: 1px solid rgba(61, 183, 173, 0.35);
                font-weight: 500;
                font-size: 0.95rem;
                background: rgba(255, 255, 255, 0.8);
                color: var(--primary-dark);
            }

            .nav-btn.primary {
                background: var(--primary);
                color: #fff;
                border-color: transparent;
                box-shadow: 0 18px 36px rgba(61, 183, 173, 0.25);
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
                background: #102a43;
                color: rgba(255, 255, 255, 0.7);
                padding: 48px 0;
                margin-top: 64px;
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

            .copyright {
                margin-top: 36px;
                text-align: center;
                font-size: 0.85rem;
                opacity: 0.7;
            }

            @media (max-width: 960px) {
                main {
                    grid-template-columns: 1fr;
                }

                .detail-card img {
                    height: 220px;
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
                        <a class="nav-btn" href="{{ route('packages.index') }}">Paket Lainnya</a>
                        <a class="nav-btn primary" href="{{ route('register') }}">Gabung Sekarang</a>
                    </div>
                </nav>
                <a class="breadcrumb" href="{{ route('packages.index') }}">← Kembali ke semua paket</a>
            </div>
        </header>

        <div class="container">
            <main>
                <section class="summary">
                    <span class="tag">{{ $package['tag'] }} Program</span>
                    <h1>{{ $package['detail_title'] }}</h1>
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
                            <a class="buy-btn" href="{{ route('checkout.show', $package['slug']) }}">Buy Now</a>
                        </div>
                        <div>
                            <h3 style="margin: 0 0 12px">This course included</h3>
                            <ul class="included">
                                @foreach ($package['included'] as $item)
                                    <li><span>✓</span>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h3 style="margin: 24px 0 12px">Share this course</h3>
                            <div style="display: flex; gap: 12px; flex-wrap: wrap">
                                <a class="nav-btn" style="border-color: transparent; background: rgba(61, 183, 173, 0.15);" href="#">WhatsApp</a>
                                <a class="nav-btn" style="border-color: transparent; background: rgba(249, 178, 51, 0.15);" href="#">Instagram</a>
                                <a class="nav-btn" style="border-color: transparent; background: rgba(31, 42, 55, 0.08);" href="#">Copy Link</a>
                            </div>
                        </div>
                    </div>
                </aside>
            </main>
        </div>

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
                    <div>
                        <h4>Stay up to date</h4>
                        <ul>
                            <li>Tips belajar mingguan</li>
                            <li>Info promo terbaru</li>
                            <li>Event dan webinar eksklusif</li>
                        </ul>
                    </div>
                </div>
                <p class="copyright">© 2024 MayClass. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
