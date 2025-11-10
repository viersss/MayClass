<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Belajar Nyaman, Prestasi Gemilang</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                --color-base: #313647;
                --color-secondary: #435663;
                --color-accent: #a3b087;
                --color-background: #fff8d4;
                --color-surface: #ffffff;
                --color-text: #222631;
                --color-muted: #5b6170;
                --radius-lg: 24px;
                --radius-md: 18px;
                --shadow: 0 14px 32px rgba(49, 54, 71, 0.12);
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: var(--color-background);
                color: var(--color-text);
                line-height: 1.6;
            }

            img {
                display: block;
                max-width: 100%;
                height: auto;
                border-radius: var(--radius-lg);
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .container {
                width: min(1200px, 100% - 48px);
                margin: 0 auto;
            }

            header {
                padding: 32px 0 72px;
            }

            nav {
                display: grid;
                grid-template-columns: auto 1fr auto;
                align-items: center;
                gap: 24px;
                margin-bottom: 56px;
            }

            .nav-logo {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                font-weight: 700;
                font-size: 1.2rem;
                color: var(--color-base);
            }

            .nav-logo img {
                width: 40px;
                height: 40px;
                object-fit: contain;
                border-radius: 12px;
            }

            .nav-links {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 28px;
                font-weight: 500;
                color: var(--color-muted);
            }

            .nav-links a {
                position: relative;
                padding: 6px 0;
            }

            .nav-links a::after {
                content: "";
                position: absolute;
                left: 0;
                right: 0;
                bottom: -6px;
                height: 2px;
                background: transparent;
                transition: background 0.2s ease;
            }

            .nav-links a:hover::after,
            .nav-links a:focus-visible::after {
                background: var(--color-accent);
            }

            .nav-action {
                justify-self: end;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 28px;
                border-radius: 999px;
                border: none;
                font-weight: 600;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .btn-primary {
                background: var(--color-accent);
                color: var(--color-base);
                box-shadow: var(--shadow);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
            }

            .hero {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 48px;
                align-items: center;
            }

            .hero-text {
                display: grid;
                gap: 24px;
            }

            .hero-text h1 {
                margin: 0;
                font-size: clamp(2.2rem, 4vw, 3.2rem);
                line-height: 1.2;
                color: var(--color-base);
            }

            .hero-text p {
                margin: 0;
                font-size: 1.05rem;
                color: var(--color-muted);
                max-width: 540px;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
            }

            .btn-secondary {
                background: var(--color-base);
                color: var(--color-background);
            }

            .hero-visual {
                position: relative;
            }

            .hero-visual::after {
                content: "";
                position: absolute;
                inset: 10% 12% -12% 12%;
                background: rgba(163, 176, 135, 0.25);
                border-radius: var(--radius-lg);
                z-index: 0;
            }

            .hero-visual img {
                position: relative;
                z-index: 1;
                box-shadow: var(--shadow);
            }

            .section {
                padding: 96px 0;
            }

            .section-header {
                text-align: center;
                margin-bottom: 48px;
                display: grid;
                gap: 16px;
            }

            .section-header h2 {
                margin: 0;
                font-size: clamp(1.9rem, 3vw, 2.4rem);
                color: var(--color-base);
            }

            .section-header p {
                margin: 0;
                color: var(--color-muted);
                max-width: 640px;
                justify-self: center;
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 28px;
            }

            .feature-card {
                background: var(--color-surface);
                padding: 28px;
                border-radius: var(--radius-md);
                box-shadow: var(--shadow);
                display: grid;
                gap: 16px;
            }

            .feature-icon {
                width: 56px;
                height: 56px;
                border-radius: 16px;
                display: grid;
                place-items: center;
                background: rgba(67, 86, 99, 0.12);
                color: var(--color-base);
                font-weight: 600;
            }

            .feature-card p {
                margin: 0;
                color: var(--color-muted);
            }

            .steps {
                background: rgba(163, 176, 135, 0.18);
                border-radius: var(--radius-lg);
                padding: 40px;
                display: grid;
                gap: 24px;
            }

            .steps-list {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 24px;
            }

            .step {
                display: grid;
                gap: 12px;
            }

            .step strong {
                font-size: 2.8rem;
                color: rgba(49, 54, 71, 0.12);
            }

            .step h3 {
                margin: 0;
                color: var(--color-base);
            }

            .step p {
                margin: 0;
                color: var(--color-muted);
            }

            .cta {
                background: var(--color-secondary);
                color: var(--color-background);
                border-radius: var(--radius-lg);
                padding: 48px;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 32px;
                align-items: center;
            }

            .cta p {
                margin: 12px 0 0;
                max-width: 520px;
            }

            footer {
                background: var(--color-secondary);
                color: rgba(255, 248, 212, 0.78);
                padding: 56px 0;
            }

            .footer-top {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 32px;
            }

            .footer-brand span {
                font-weight: 600;
                font-size: 1.1rem;
                color: var(--color-background);
            }

            .footer-brand p {
                margin: 16px 0 0;
            }

            .footer-links {
                display: grid;
                gap: 8px;
            }

            .footer-links a {
                color: rgba(255, 248, 212, 0.78);
            }

            .footer-bottom {
                margin-top: 48px;
                padding-top: 24px;
                border-top: 1px solid rgba(255, 248, 212, 0.2);
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 16px;
            }

            @media (max-width: 960px) {
                nav {
                    grid-template-columns: 1fr;
                    justify-items: center;
                    row-gap: 16px;
                }

                .nav-action {
                    justify-self: center;
                }

                .hero {
                    text-align: center;
                }

                .hero-text p,
                .hero-actions {
                    justify-content: center;
                }

                .hero-visual::after {
                    inset: 8% 18% -18% 18%;
                }

                .cta {
                    text-align: center;
                }

                .cta p {
                    justify-self: center;
                }
            }

            @media (max-width: 600px) {
                .container {
                    width: calc(100% - 32px);
                }

                header {
                    padding: 24px 0 56px;
                }

                .steps {
                    padding: 32px;
                }
            }
        </style>
    </head>
    <body>
        @php
            $joinLink = route('join');
        @endphp

        <header>
            <div class="container">
                <nav>
                    <a href="#" class="nav-logo">
                        <img src="{{ config('mayclass.brand.logo') }}" alt="MayClass" />
                        <span>MayClass</span>
                    </a>
                    <div class="nav-links">
                        <a href="#tentang">Tentang</a>
                        <a href="#fitur">Fitur</a>
                        <a href="#kontak">Kontak</a>
                    </div>
                    <div class="nav-action">
                        <a class="btn btn-primary" href="{{ route('join') }}">Gabung Sekarang</a>
                    </div>
                </nav>
                <div class="hero">
                    <div class="hero-text">
                        <h1>Belajar personal dengan mentor terbaik MayClass.</h1>
                        <p>
                            Rancang perjalanan belajar sesuai kebutuhanmu. Dashboard interaktif MayClass membantu siswa,
                            tentor, dan admin memantau kemajuan secara real-time tanpa data dummy.
                        </p>
                        <div class="hero-actions">
                            <a class="btn btn-primary" href="{{ route('join') }}">Mulai dari Login</a>
                            <a class="btn btn-secondary" href="#tentang">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                    <div class="hero-visual">
                        <img
                            src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80"
                            alt="Sesi belajar MayClass"
                        />
                    </div>
                </div>
            </div>
        </header>
        <main>
            <section class="section" id="tentang">
                <div class="container">
                    <div class="section-header">
                        <h2>Platform terpadu untuk semua peran</h2>
                        <p>
                            Siswa, tentor, dan admin utama mendapatkan tampilan dashboard yang bersih serta data yang
                            selalu diperbarui dari basis data MayClass.
                        </p>
                    </div>
                    <div class="features-grid">
                        <article class="feature-card">
                            <div class="feature-icon">S</div>
                            <h3>Dashboard Siswa</h3>
                            <p>
                                Lihat jadwal, materi, dan progres quiz dengan antarmuka responsif yang memakai data
                                aktual setiap saat.
                            </p>
                        </article>
                        <article class="feature-card">
                            <div class="feature-icon">T</div>
                            <h3>Ruang Tentor</h3>
                            <p>
                                Kelola materi, quiz, dan jadwal mengajar dalam satu tempat dengan navigasi sederhana dan
                                warna yang konsisten.
                            </p>
                        </article>
                        <article class="feature-card">
                            <div class="feature-icon">A</div>
                            <h3>Admin Utama</h3>
                            <p>
                                Manajemen siswa, paket belajar, dan verifikasi pembayaran dilakukan secara real-time tanpa
                                data dummy.
                            </p>
                        </article>
                    </div>
                </div>
            </section>
            <section class="section" id="fitur">
                <div class="container">
                    <div class="section-header">
                        <h2>Alur onboarding yang mudah</h2>
                        <p>Ikuti langkah singkat berikut untuk mulai belajar dengan MayClass.</p>
                    </div>
                    <div class="steps">
                        <div class="steps-list">
                            <div class="step">
                                <strong>01</strong>
                                <h3>Buat akun</h3>
                                <p>Daftar dengan username dan password lalu lengkapi data profilmu.</p>
                            </div>
                            <div class="step">
                                <strong>02</strong>
                                <h3>Pilih paket</h3>
                                <p>Admin menyiapkan paket belajar yang bisa langsung kamu pilih dan aktivasi.</p>
                            </div>
                            <div class="step">
                                <strong>03</strong>
                                <h3>Mulai belajar</h3>
                                <p>Akses materi, ikuti quiz, dan pantau progres belajar secara berkala.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section" id="kontak">
                <div class="container">
                    <div class="cta">
                        <div>
                            <h2>Mari kembangkan potensi terbaikmu bersama MayClass.</h2>
                            <p>
                                Tim kami siap membantu menyiapkan data, tutor, dan paket belajar agar dapat langsung kamu
                                gunakan. Semuanya tersaji dengan tampilan profesional dan bersih.
                            </p>
                        </div>
                        <div>
                            <a class="btn btn-primary" href="mailto:hello@mayclass.id">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer>
            <div class="container">
                <div class="footer-top">
                    <div class="footer-brand">
                        <span>MayClass</span>
                        <p>
                            Platform bimbingan belajar yang menyatukan siswa, tentor, dan admin dengan tampilan seragam
                            dan data yang selalu akurat.
                        </p>
                    </div>
                    <div class="footer-links">
                        <strong>Menu</strong>
                        <a href="#tentang">Tentang</a>
                        <a href="#fitur">Fitur</a>
                        <a href="#kontak">Kontak</a>
                    </div>
                    <div class="footer-links">
                        <strong>Kontak</strong>
                        <a href="mailto:hello@mayclass.id">hello@mayclass.id</a>
                        <span>Jl. Pembelajaran No. 12, Jakarta</span>
                    </div>
                </div>
                <div class="footer-bottom">
                    <span>&copy; {{ date('Y') }} MayClass. Seluruh hak cipta dilindungi.</span>
                    <span>Didesain ulang dengan tema warna solid MayClass.</span>
                </div>
            </div>
        </footer>
    </body>
</html>
