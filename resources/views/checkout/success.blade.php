<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Pembayaran Berhasil - MayClass</title>
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
                --primary-dark: #2a938a;
                --accent: #58d2c5;
                --text-dark: #1f2a37;
                --text-muted: #64748b;
                --surface: #ffffff;
                --background: linear-gradient(180deg, #e9f8f7 0%, #f6fffe 100%);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: var(--background);
                color: var(--text-dark);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            header {
                padding: 32px 0 0;
            }

            .container {
                width: min(1100px, 92vw);
                margin: 0 auto;
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

            .brand-badge {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                display: grid;
                place-items: center;
                background: var(--primary);
                color: #ffffff;
                font-weight: 700;
                box-shadow: 0 20px 36px rgba(61, 183, 173, 0.22);
            }

            main {
                flex: 1;
                display: grid;
                place-items: center;
                padding: 32px 0 64px;
            }

            .success-card {
                background: var(--surface);
                border-radius: 32px;
                padding: clamp(32px, 4vw, 56px);
                width: min(760px, 100%);
                box-shadow: 0 48px 80px rgba(32, 96, 92, 0.15);
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .success-card::before {
                content: "";
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at top right, rgba(88, 210, 197, 0.25), transparent 55%);
                pointer-events: none;
            }

            .status-icon {
                width: 88px;
                height: 88px;
                border-radius: 50%;
                background: rgba(61, 183, 173, 0.12);
                margin: 0 auto 24px;
                display: grid;
                place-items: center;
                color: var(--primary);
            }

            .status-icon svg {
                width: 42px;
                height: 42px;
            }

            h1 {
                margin: 0 0 16px;
                font-size: clamp(1.9rem, 3vw, 2.6rem);
                line-height: 1.3;
            }

            p {
                margin: 0 0 32px;
                color: var(--text-muted);
                line-height: 1.7;
            }

            .order-summary {
                margin: 0 auto 32px;
                padding: 24px 28px;
                border-radius: 20px;
                background: rgba(61, 183, 173, 0.08);
                display: grid;
                gap: 12px;
                text-align: left;
                color: var(--primary-dark);
            }

            .order-summary strong {
                color: var(--text-dark);
            }

            .cta-group {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                justify-content: center;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 14px 28px;
                border-radius: 999px;
                font-weight: 500;
                border: 1px solid transparent;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                cursor: pointer;
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--primary) 0%, var(--accent) 100%);
                color: #ffffff;
                box-shadow: 0 22px 45px rgba(61, 183, 173, 0.28);
            }

            .btn-outline {
                background: transparent;
                border-color: rgba(61, 183, 173, 0.35);
                color: var(--primary-dark);
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            footer {
                padding: 24px 0 40px;
                text-align: center;
                color: var(--text-muted);
                font-size: 0.85rem;
            }

            @media (max-width: 600px) {
                .success-card {
                    padding: 28px;
                }

                .order-summary {
                    padding: 18px 20px;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <a href="/" class="brand">
                        <span class="brand-badge">MC</span>
                        MayClass
                    </a>
                    <a class="btn btn-outline" href="{{ route('packages.index') }}">Lihat Paket Lain</a>
                </nav>
            </div>
        </header>
        <main>
            <div class="success-card">
                <div class="status-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M9.00016 16.2001L4.80016 12.0001L3.40016 13.4001L9.00016 19.0001L21.0002 7.00006L19.6002 5.60006L9.00016 16.2001Z"
                            fill="currentColor"
                        />
                    </svg>
                </div>
                <h1>Pembayaran Berhasil!</h1>
                <p>
                    Terima kasih telah mempercayakan perjalanan belajar bersama MayClass. Akses paket
                    <strong>{{ $package['detail_title'] }}</strong> kini aktif. Silakan masuk kembali untuk menikmati
                    materi, quiz, dan jadwal terbaru sesuai akunmu.
                </p>
                <div class="order-summary">
                    <div><strong>Paket:</strong> {{ $package['detail_title'] }}</div>
                    <div><strong>Status:</strong> Aktif &amp; Terverifikasi</div>
                    <div><strong>Email Konfirmasi:</strong> Telah dikirim ke {{ $package['level'] ?? 'akun MayClass Anda' }}</div>
                </div>
                <div class="cta-group">
                    <a class="btn btn-primary" href="{{ route('login') }}">Login Ulang Sekarang</a>
                    <a class="btn btn-outline" href="{{ route('student.dashboard') }}">Masuk ke Dashboard</a>
                </div>
            </div>
        </main>
        <footer>© 2024 MayClass. Tetap semangat belajar!</footer>
    </body>
</html>
