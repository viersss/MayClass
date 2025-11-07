<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Langkah Pasti Menuju Prestasi</title>
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
                --primary-dark: #258a83;
                --accent: #6f5df6;
                --text-dark: #152033;
                --text-muted: #5c677d;
                --surface: #ffffff;
                --bg-alt: #f5fbfb;
                --shadow: 0 18px 40px rgba(27, 80, 90, 0.1);
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                color: var(--text-dark);
                background: #ffffff;
                line-height: 1.6;
            }

            img {
                display: block;
                max-width: 100%;
                height: auto;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            /* Use full-bleed sections; keep inner content centered with small side padding */
            .container {
                width: 100%;
                margin: 0;
                padding: 0; /* remove large adaptive paddings to avoid big empty sides */
            }

            .content-width {
                /* full-bleed content: span the entire viewport width with no side margins */
                width: 100%;
                margin: 0;
                padding: 0; /* remove inner horizontal padding to ensure edge-to-edge layout */
            }

            header {
                /* use a green gradient and remove the large curved corner */
                background: linear-gradient(135deg, #f1fdfb 0%, #dff8f4 45%, #e6fff9 100%);
                border-bottom-left-radius: 0;
                overflow: hidden;
            }

            nav {
                display: block; /* we use an inner box for the white navbar */
                padding: 28px 0;
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 14px;
                font-weight: 600;
                font-size: 1.25rem;
                color: var(--primary-dark);
            }

            .brand img {
                width: 44px;
                height: 44px;
                object-fit: contain;
            }

            /* white navbar box */
            .nav-box {
                background: var(--surface);
                border-radius: 12px;
                padding: 10px 18px;
                box-shadow: 0 8px 24px rgba(20, 60, 70, 0.08);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* 3-column grid so center links are perfectly centered regardless of left/right widths */
            .nav-inner {
                display: grid;
                grid-template-columns: 1fr auto 1fr; /* ensures center column stays centered */
                align-items: center;
                width: 100%;
                gap: 16px;
            }

            .nav-left { grid-column: 1; justify-self: start; display: flex; align-items: center; }
            .nav-center { grid-column: 2; justify-self: center; display: flex; justify-content: center; }
            .nav-right { grid-column: 3; justify-self: end; display: flex; justify-content: flex-end; gap: 16px; align-items: center; }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 22px;
                font-size: 0.95rem;
                color: var(--text-muted);
            }

            .nav-links a:hover,
            .nav-actions a:hover {
                color: var(--primary-dark);
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .nav-actions form {
                margin: 0;
                display: inline-flex;
            }

            /* mobile nav toggle */
            .nav-toggle {
                display: none;
                background: transparent;
                border: none;
                width: 44px;
                height: 44px;
                border-radius: 10px;
                align-items: center;
                justify-content: center;
                cursor: pointer;
            }
            .nav-toggle svg { width: 22px; height: 22px; color: var(--primary-dark); }

            /* helper (unused on desktop) */
            .nav-collapsed { display: none; }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 26px;
                border-radius: 999px;
                font-size: 0.95rem;
                font-weight: 500;
                border: 1px solid transparent;
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .btn-outline {
                border-color: rgba(61, 183, 173, 0.3);
                background: rgba(61, 183, 173, 0.08);
                color: var(--primary-dark);
            }

            .btn-outline:hover {
                border-color: var(--primary-dark);
                background: rgba(61, 183, 173, 0.16);
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--primary) 0%, #5ad7c9 100%);
                color: #ffffff;
                box-shadow: 0 14px 32px rgba(61, 183, 173, 0.32);
            }

            .btn-primary:hover {
                filter: brightness(0.95);
                transform: translateY(-1px);
            }

            .pill {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 18px;
                border-radius: 999px;
                background: rgba(61, 183, 173, 0.12);
                color: var(--primary-dark);
                font-size: 0.85rem;
                font-weight: 600;
            }

            .hero {
                position: relative;
                isolation: isolate;
                display: grid;
                gap: clamp(32px, 5vw, 56px);
                grid-template-columns: minmax(0, 1fr);
                align-items: center;
                padding: clamp(36px, 5vw, 72px);
                margin-top: 32px;
                border-radius: 40px;
                background: linear-gradient(115deg, #0d3f2c 0%, #1f7a54 42%, #f5fff9 100%);
                color: #042616;
                box-shadow: 0 40px 80px -50px rgba(4, 61, 40, 0.55);
                overflow: hidden;
            }

            .hero::before,
            .hero::after {
                content: "";
                position: absolute;
                border-radius: 999px;
                pointer-events: none;
                mix-blend-mode: screen;
                opacity: 0.35;
            }

            .hero::before {
                width: 480px;
                height: 480px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.38) 0%, rgba(255, 255, 255, 0) 70%);
                top: -180px;
                right: -160px;
            }

            .hero::after {
                width: 360px;
                height: 360px;
                background: radial-gradient(circle, rgba(80, 197, 141, 0.35) 0%, rgba(80, 197, 141, 0) 70%);
                bottom: -160px;
                left: -120px;
            }

            .hero-copy {
                position: relative;
                z-index: 2;
                display: grid;
                gap: 24px;
            }

            .hero-copy .pill {
                align-self: start;
                background: rgba(255, 255, 255, 0.25);
                color: #0f4c3a;
                border: 1px solid rgba(15, 76, 58, 0.12);
            }

            .hero h1 {
                font-size: clamp(2.6rem, 4.6vw, 3.9rem);
                line-height: 1.1;
                margin: 0;
                max-width: 640px;
            }

            .hero p {
                max-width: 560px;
                color: rgba(4, 38, 22, 0.78);
                margin: 0;
                font-size: 1.05rem;
            }

            .hero-cta {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                justify-content: flex-start;
            }

            .hero-cta .btn-primary {
                box-shadow: 0 18px 34px -16px rgba(5, 64, 36, 0.6);
            }

            .stats {
                display: flex;
                flex-wrap: wrap;
                gap: 18px;
                justify-content: flex-start;
            }

            .stat-card {
                padding: 18px 24px;
                border-radius: 22px;
                background: linear-gradient(160deg, rgba(255, 255, 255, 0.92), rgba(220, 244, 231, 0.88));
                border: 1px solid rgba(18, 95, 60, 0.12);
                backdrop-filter: blur(8px);
                min-width: 180px;
                box-shadow: 0 22px 48px -28px rgba(5, 64, 36, 0.55);
                color: #08442c;
                flex: 1 1 200px;
            }

            .stat-card h3 {
                margin: 0 0 8px;
                font-size: 1.7rem;
                color: #0e5a3b;
            }

            .stat-card p {
                margin: 0;
                color: rgba(8, 68, 44, 0.72);
                font-size: 0.95rem;
            }

            .hero-visual {
                position: relative;
                z-index: 2;
                display: grid;
                place-items: center;
                align-self: stretch;
            }

            .hero-visual-frame {
                position: relative;
                width: min(420px, 80vw);
                aspect-ratio: 5 / 6;
                border-radius: 36px;
                overflow: hidden;
                box-shadow: 0 32px 68px -32px rgba(5, 64, 36, 0.55);
                border: 1px solid rgba(255, 255, 255, 0.6);
                background: linear-gradient(160deg, rgba(8, 59, 36, 0.65), rgba(19, 114, 74, 0.45));
            }

            .hero-visual-frame img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                filter: saturate(1.1);
            }

            .hero-floating-card {
                position: absolute;
                display: grid;
                gap: 2px;
                padding: 16px 20px;
                border-radius: 20px;
                background: linear-gradient(180deg, rgba(255, 255, 255, 0.94), rgba(228, 249, 237, 0.9));
                color: #0d4f36;
                box-shadow: 0 22px 42px -28px rgba(5, 64, 36, 0.45);
                border: 1px solid rgba(18, 95, 60, 0.08);
                text-align: left;
                max-width: 220px;
            }

            .hero-floating-card span {
                font-weight: 700;
                font-size: 1.3rem;
            }

            .hero-floating-card small {
                color: rgba(13, 79, 54, 0.7);
            }

            .hero-floating-card--top {
                top: 10%;
                right: 6%;
            }

            .hero-floating-card--bottom {
                bottom: 10%;
                left: 4%;
            }

            .section {
                padding: 96px 0;
            }

            .section.alt {
                background: var(--bg-alt);
            }

            .section-header {
                display: grid;
                gap: 16px;
                margin-bottom: 64px;
                max-width: 760px;
            }

            .section-title {
                margin: 0;
                font-size: clamp(2rem, 3vw, 2.8rem);
            }

            .section-subtitle {
                margin: 0;
                color: var(--text-muted);
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 28px;
            }

            .feature-card {
                background: var(--surface);
                border-radius: 24px;
                padding: 28px;
                box-shadow: var(--shadow);
                display: grid;
                gap: 16px;
            }

            .feature-icon {
                width: 56px;
                height: 56px;
                border-radius: 16px;
                background: rgba(61, 183, 173, 0.12);
                display: grid;
                place-items: center;
                font-size: 1.6rem;
            }

            .programs-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 32px;
            }

            .program-card {
                border-radius: 28px;
                padding: 32px;
                background: var(--surface);
                box-shadow: var(--shadow);
                display: grid;
                gap: 18px;
            }

            .program-card ul {
                list-style: none;
                margin: 0;
                padding: 0;
                display: grid;
                gap: 12px;
                color: var(--text-muted);
            }

            .program-card .price {
                font-size: 1.5rem;
                margin: 0;
                color: var(--primary-dark);
                font-weight: 600;
            }

            .slider {
                position: relative;
            }

            /* hide previous/next buttons — keep horizontal scrolling when overflowed */
            .slider-controls { display: none !important; }

            .slider-track {
                display: flex;
                gap: 24px;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                scroll-behavior: smooth;
                padding-bottom: 12px;
            }

            .slider-track::-webkit-scrollbar {
                height: 8px;
            }

            .slider-track::-webkit-scrollbar-thumb {
                background: rgba(61, 183, 173, 0.35);
                border-radius: 999px;
            }

            .slider-track > * {
                flex: 0 0 min(320px, 80vw);
                scroll-snap-align: start;
            }

            .slider-controls {
                position: absolute;
                inset: -68px 0 auto auto;
                display: flex;
                gap: 12px;
            }

            .slider button {
                width: 44px;
                height: 44px;
                border-radius: 50%;
                border: none;
                background: var(--surface);
                box-shadow: 0 10px 24px rgba(20, 60, 70, 0.15);
                color: var(--primary-dark);
                cursor: pointer;
                transition: transform 0.2s ease;
            }

            .slider button:hover {
                transform: translateY(-2px);
            }

            .tutor-card,
            .testimonial-card {
                background: var(--surface);
                border-radius: 28px;
                padding: 28px;
                display: grid;
                gap: 18px;
                box-shadow: var(--shadow);
            }

            .testimonial-card {
                background: linear-gradient(170deg, rgba(244, 255, 248, 0.92), rgba(222, 244, 232, 0.9));
                border: 1px solid rgba(22, 93, 63, 0.12);
                box-shadow: 0 30px 70px -45px rgba(6, 60, 36, 0.5);
            }

            .tutor-card img,
            .testimonial-card img {
                width: 100%;
                border-radius: 20px;
            }

            .testimonial-card p {
                margin: 0;
                color: rgba(6, 60, 36, 0.72);
                font-size: 0.98rem;
                line-height: 1.6;
            }

            .faq-list {
                display: grid;
                gap: 18px;
            }

            details {
                border-radius: 20px;
                background: var(--surface);
                padding: 22px 28px;
                box-shadow: var(--shadow);
            }

            summary {
                font-weight: 600;
                cursor: pointer;
                outline: none;
            }

            footer {
                background: #0f172a;
                color: rgba(255, 255, 255, 0.72);
                padding: 64px 0 48px;
            }

            /* give footer some comfortable side padding so it isn't flush to the edges */
            footer .content-width {
                padding-left: 28px;
                padding-right: 28px;
                max-width: 1400px;
                margin: 0 auto;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 32px;
                margin-bottom: 40px;
            }

            .footer-brand {
                display: grid;
                gap: 18px;
            }

            .footer-brand img {
                width: 120px;
            }

            .footer-links {
                display: grid;
                gap: 8px;
            }

            .footer-links a {
                color: rgba(255, 255, 255, 0.72);
            }

            .footer-links a:hover {
                color: #ffffff;
            }

            .copyright {
                margin: 0;
                text-align: center;
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.6);
            }

            @media (min-width: 992px) {
                .hero {
                    grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
                    padding: clamp(56px, 6vw, 88px) clamp(56px, 7vw, 96px);
                }

                .hero-copy {
                    text-align: left;
                }
            }

            @media (max-width: 1080px) {
                .features-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .programs-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .slider-controls {
                    inset: auto 24px -24px auto;
                }
            }

            @media (max-width: 840px) {
                nav {
                    flex-wrap: wrap;
                    justify-content: space-between;
                    text-align: left;
                }

                /* hide regular links and actions by default on small screens; toggle via JS */
                .nav-links,
                .nav-actions { display: none; }
                .nav-inner.open .nav-links,
                .nav-inner.open .nav-actions { display: flex; flex-direction: column; gap: 12px; width: 100%; }
                .nav-toggle { display: inline-flex; }

                .hero {
                    grid-template-columns: 1fr;
                    text-align: center;
                    padding: 48px 28px 64px;
                }

                .hero-copy {
                    text-align: center;
                    justify-items: center;
                }

                .hero-copy .pill {
                    margin: 0 auto;
                }

                .hero p,
                .section-header {
                    margin-left: auto;
                    margin-right: auto;
                }

                .hero-cta,
                .stats {
                    justify-content: center;
                }

                .hero-visual {
                    order: -1;
                }

                .hero-floating-card--top {
                    top: 12%;
                    right: 12%;
                }

                .hero-floating-card--bottom {
                    bottom: 12%;
                    left: 12%;
                }

                .programs-grid {
                    grid-template-columns: 1fr;
                }

                .footer-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 640px) {
                .container {
                    padding: 0 18px;
                }

                .hero {
                    padding: 42px 22px 56px;
                }

                .hero-visual-frame {
                    width: min(360px, 90vw);
                    border-radius: 30px;
                }

                .hero-floating-card {
                    position: static;
                    margin-top: 18px;
                    justify-self: center;
                    text-align: center;
                }

                .hero-visual {
                    gap: 12px;
                }

                .features-grid {
                    grid-template-columns: 1fr;
                }

                .footer-grid {
                    grid-template-columns: 1fr;
                }

                .slider-controls {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <div class="nav-box content-width">
                        <div class="nav-inner">
                            <div class="nav-left">
                                <a class="brand" href="/">
                                    <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="Logo MayClass" />
                                </a>
                            </div>

                            <div class="nav-center nav-links">
                                <a href="#tentang">Tentang</a>
                                <a href="#program">Program</a>
                                <a href="#tentor">Tentor</a>
                                <a href="#testimoni">Testimoni</a>
                                <a href="#faq">FAQ</a>
                            </div>
                            <div class="nav-right nav-actions">
                                @auth
                                    <a class="btn btn-outline" href="{{ route('student.dashboard') }}">Dashboard</a>
                                    <a class="btn btn-primary" href="{{ route('student.profile') }}" style="box-shadow: none;">Profil</a>
                                    <form method="post" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="btn" type="submit" style="gap: 6px; color: var(--primary-dark); background: rgba(31, 42, 55, 0.06); box-shadow: none;">Keluar</button>
                                    </form>
                                @else
                                    <a class="btn btn-outline" href="{{ route('login') }}">Masuk</a>
                                    <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
                                @endauth
                            </div>

                            <button class="nav-toggle" aria-expanded="false" aria-label="Toggle menu">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </nav>
                <section class="hero content-width">
                    <div class="hero-copy">
                        <span class="pill">Langkah Pasti Menuju Prestasi</span>
                        <h1>Platform Bimbingan Belajar Terintegrasi untuk Semua Kebutuhan Akademik</h1>
                        <p>
                            MayClass menghadirkan pengalaman belajar terarah bersama tentor profesional,
                            sistem monitoring real-time, serta fitur fleksibel yang menyesuaikan gaya belajar
                            siswa modern.
                        </p>
                        <div class="hero-cta">
                            <a class="btn btn-primary" href="{{ route('packages.index') }}">Jelajahi Paket</a>
                            <a class="btn btn-outline" href="#kontak">Hubungi Kami</a>
                        </div>
                        <div class="stats">
                            <div class="stat-card">
                                <h3>12K+</h3>
                                <p>Siswa aktif setiap bulan dari berbagai jenjang pendidikan.</p>
                            </div>
                            <div class="stat-card">
                                <h3>500+</h3>
                                <p>Tentor berpengalaman dan tersertifikasi di bidangnya.</p>
                            </div>
                            <div class="stat-card">
                                <h3>97%</h3>
                                <p>Tingkat kelulusan target ujian dari siswa MayClass.</p>
                            </div>
                        </div>
                    </div>
                    <div class="hero-visual">
                        <div class="hero-visual-frame">
                            <img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&w=1400&q=80" alt="Ilustrasi siswa belajar" />
                        </div>
                        <div class="hero-floating-card hero-floating-card--top">
                            <span>98%</span>
                            <small>Kepuasan siswa dan orang tua</small>
                        </div>
                        <div class="hero-floating-card hero-floating-card--bottom">
                            <span>24/7</span>
                            <small>Dukungan belajar dan konsultasi</small>
                        </div>
                    </div>
                </section>
            </div>
        </header>

        <section class="section" id="tentang">
            <div class="container">
                <div class="content-width">
                    <div class="section-header" style="text-align: center; margin: 0 auto;">
                        <span class="pill">Tentang MayClass</span>
                        <h2 class="section-title">Platform Pembelajaran Terlengkap</h2>
                        <p class="section-subtitle">
                            Kami menghadirkan solusi bimbingan belajar end-to-end yang menyatukan siswa, tentor, dan
                            admin dalam satu ekosistem digital yang mudah digunakan.
                        </p>
                    </div>
                    <div class="features-grid">
                        <article class="feature-card">
                            <div class="feature-icon">📚</div>
                            <h3>Materi Lengkap &amp; Terstruktur</h3>
                            <p>
                                Kurikulum mengikuti standar nasional dan internasional dengan materi interaktif
                                untuk meningkatkan pemahaman siswa.
                            </p>
                        </article>
                        <article class="feature-card">
                            <div class="feature-icon">👩‍🏫</div>
                            <h3>Tentor Profesional</h3>
                            <p>
                                Setiap tentor melalui proses seleksi ketat dan pelatihan pedagogik untuk memastikan
                                kualitas pengajaran terbaik.
                            </p>
                        </article>
                        <article class="feature-card">
                            <div class="feature-icon">💳</div>
                            <h3>Pengelolaan Keuangan Aman</h3>
                            <p>
                                Sistem administrasi keuangan transparan dan terintegrasi, memudahkan admin keuangan
                                melakukan pencatatan.
                            </p>
                        </article>
                        <article class="feature-card">
                            <div class="feature-icon">📊</div>
                            <h3>Laporan Real-Time</h3>
                            <p>
                                Pantau perkembangan belajar siswa secara langsung melalui dashboard lengkap untuk
                                admin utama dan wali murid.
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="section alt" id="program">
            <div class="container">
                <div class="content-width">
                    <div class="section-header" style="text-align: center; margin: 0 auto;">
                        <span class="pill">Pilihan Program</span>
                        <h2 class="section-title">Pilih Paket Sesuai Kebutuhan Belajar</h2>
                        <p class="section-subtitle">
                            Didesain untuk berbagai jenjang pendidikan dengan fleksibilitas jadwal, metode hybrid, dan
                            pendampingan intensif dari tentor berpengalaman.
                        </p>
                    </div>
                    <div class="programs-grid">
                        <article class="program-card">
                            <h4>SD Kelas 4-6</h4>
                            <p class="price">Rp 365<span style="font-size: 1rem; font-weight: 400;">/bulan</span></p>
                            <ul>
                                <li>Materi tematik dan persiapan AKM</li>
                                <li>Live class 3x seminggu</li>
                                <li>Monitoring perkembangan mingguan</li>
                            </ul>
                            <a class="btn btn-outline" href="{{ route('packages.index') }}">Selengkapnya</a>
                        </article>
                        <article class="program-card">
                            <h4>SMP Kelas 7-9</h4>
                            <p class="price">Rp 415<span style="font-size: 1rem; font-weight: 400;">/bulan</span></p>
                            <ul>
                                <li>Persiapan ujian semester &amp; AKM</li>
                                <li>Bank soal interaktif</li>
                                <li>Konsultasi belajar personal</li>
                            </ul>
                            <a class="btn btn-outline" href="{{ route('packages.index') }}">Selengkapnya</a>
                        </article>
                        <article class="program-card">
                            <h4>SMA Kelas 10-12</h4>
                            <p class="price">Rp 465<span style="font-size: 1rem; font-weight: 400;">/bulan</span></p>
                            <ul>
                                <li>Persiapan UTBK &amp; ujian mandiri</li>
                                <li>Pemantauan progres real-time</li>
                                <li>Try out berkala dan evaluasi</li>
                            </ul>
                            <a class="btn btn-outline" href="{{ route('packages.index') }}">Selengkapnya</a>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="tentor">
            <div class="container">
                <div class="content-width">
                    <div class="section-header" style="text-align: center; margin: 0 auto;">
                        <span class="pill">Tentor Berpengalaman</span>
                        <h2 class="section-title">Super Tentor Berkualitas</h2>
                        <p class="section-subtitle">
                            Tim tentor kami terdiri dari lulusan terbaik dengan pengalaman mengajar dan sertifikasi
                            profesional untuk memastikan pembelajaran efektif.
                        </p>
                    </div>
                    <div class="slider" data-slider>
                        <div class="slider-track">
                            <article class="tutor-card">
                                <img src="{{ \App\Support\ImageRepository::url('tutors.henny') }}" alt="Kak Henny" />
                                <div>
                                    <h4>Kak Henny</h4>
                                    <p>Super Tutor Bahasa Indonesia &amp; Inggris</p>
                                </div>
                            </article>
                            <article class="tutor-card">
                                <img src="{{ \App\Support\ImageRepository::url('tutors.husein') }}" alt="Kak Husein" />
                                <div>
                                    <h4>Kak Husein</h4>
                                    <p>Super Tutor Matematika &amp; Sains</p>
                                </div>
                            </article>
                            <article class="tutor-card">
                                <img src="{{ \App\Support\ImageRepository::url('tutors.pal') }}" alt="Kak Pal" />
                                <div>
                                    <h4>Kak Pal</h4>
                                    <p>Super Tutor Fisika &amp; Kimia</p>
                                </div>
                            </article>
                        </div>
                        <div class="slider-controls" aria-hidden="true">
                            <button type="button" data-slider-prev>&larr;</button>
                            <button type="button" data-slider-next>&rarr;</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section alt" id="testimoni">
            <div class="container">
                <div class="content-width">
                    <div class="section-header" style="text-align: center; margin: 0 auto;">
                        <span class="pill">Apa Kata Mereka</span>
                        <h2 class="section-title">Cerita Sukses dari Para Siswa</h2>
                        <p class="section-subtitle">
                            Testimoni dari siswa dan orang tua yang merasakan langsung perubahan signifikan dalam proses
                            belajar bersama MayClass.
                        </p>
                    </div>
                    <div class="slider" data-slider>
                        <div class="slider-track">
                            <article class="testimonial-card">
                                <img src="{{ \App\Support\ImageRepository::url('testimonials.yohanna') }}" alt="Foto Yohanna" />
                                <p>
                                    “Saya merasa banyak kemajuan setelah mengikuti kelas online. Kakak tentor sangat sabar
                                    menjelaskan dan materi tersedia lengkap.”
                                </p>
                                <div>
                                    <strong>Yohanna</strong>
                                    <div style="color: var(--text-muted);">SDN Makmur Cibinong</div>
                                </div>
                            </article>
                            <article class="testimonial-card">
                                <img src="{{ \App\Support\ImageRepository::url('testimonials.xavier') }}" alt="Foto Xavier" />
                                <p>
                                    “Pengajaran ini benar-benar membantu. Sistem belajarnya terstruktur dan memudahkan saya
                                    memahami konsep yang sulit.”
                                </p>
                                <div>
                                    <strong>Xavier</strong>
                                    <div style="color: var(--text-muted);">SMA N 79 Jakarta</div>
                                </div>
                            </article>
                            <article class="testimonial-card">
                                <img src="{{ \App\Support\ImageRepository::url('testimonials.lisa') }}" alt="Foto Lisa" />
                                <p>
                                    “Laporan belajarnya detail sehingga saya bisa memantau perkembangan anak. Jadwal juga
                                    fleksibel menyesuaikan kebutuhan kami.”
                                </p>
                                <div>
                                    <strong>Lisa</strong>
                                    <div style="color: var(--text-muted);">Orang tua siswa</div>
                                </div>
                            </article>
                        </div>
                        <div class="slider-controls" aria-hidden="true">
                            <button type="button" data-slider-prev>&larr;</button>
                            <button type="button" data-slider-next>&rarr;</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="faq">
            <div class="container">
                <div class="content-width">
                    <div class="section-header" style="text-align: center; margin: 0 auto 48px;">
                        <span class="pill">Pertanyaan Umum</span>
                        <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
                        <p class="section-subtitle">
                            Temukan jawaban dari pertanyaan yang sering kami terima dari siswa dan orang tua terkait layanan
                            MayClass.
                        </p>
                    </div>
                    <div class="faq-list">
                        <details>
                            <summary>Apakah tersedia bimbingan secara online?</summary>
                            <p>
                                Ya, MayClass menyediakan layanan online dan tatap muka. Jadwal dan metode bisa Anda pilih sesuai
                                preferensi.
                            </p>
                        </details>
                        <details>
                            <summary>Bagaimana sistem penjadwalan kelasnya?</summary>
                            <p>
                                Penjadwalan dapat disesuaikan dengan kebutuhan siswa. Admin kami membantu memastikan koordinasi
                                antara siswa dan tentor.
                            </p>
                        </details>
                        <details>
                            <summary>Apakah bisa pindah jadwal jika ada hal mendadak?</summary>
                            <p>
                                Tentu, cukup hubungi admin kami untuk melakukan penjadwalan ulang minimal 24 jam sebelum kelas
                                dimulai.
                            </p>
                        </details>
                        <details>
                            <summary>Bagaimana cara mengakses materi setelah kelas selesai?</summary>
                            <p>
                                Seluruh materi dan rekaman kelas dapat diakses melalui dashboard siswa kapan pun dan di perangkat apa pun.
                            </p>
                        </details>
                    </div>
                </div>
            </div>
        </section>

        <section class="section alt" id="kontak">
            <div class="container">
                <div class="content-width" style="text-align: center;">
                    <span class="pill">Hubungi Kami</span>
                    <h2 class="section-title" style="margin: 24px 0 16px;">Siap Memulai Bersama MayClass?</h2>
                    <p class="section-subtitle" style="margin: 0 auto 32px; max-width: 620px;">
                        Tim kami siap membantu Anda menentukan program terbaik. Hubungi kami untuk konsultasi gratis dan jadwalkan
                        sesi percobaan sekarang juga.
                    </p>
                    <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
                        <a class="btn btn-primary" href="tel:+6281234567890">Hubungi Admin</a>
                        <a class="btn btn-outline" href="mailto:hello@mayclass.id">Kirim Email</a>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <div class="container">
                <div class="content-width">
                    <div class="footer-grid">
                        <div class="footer-brand">
                            <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="Logo MayClass" />
                            <p>
                                MayClass menghadirkan pengalaman belajar terpadu dengan tentor profesional, materi interaktif, dan
                                dukungan admin yang responsif.
                            </p>
                        </div>
                        <div>
                            <h4>Program</h4>
                            <div class="footer-links">
                                <a href="{{ route('packages.index') }}">Katalog Paket</a>
                                <a href="#tentor">Super Tentor</a>
                                <a href="#testimoni">Testimoni</a>
                            </div>
                        </div>
                        <div>
                            <h4>Bantuan</h4>
                            <div class="footer-links">
                                <a href="#faq">FAQ</a>
                                <a href="#kontak">Kontak</a>
                                <a href="#">Panduan Pembayaran</a>
                            </div>
                        </div>
                        <div>
                            <h4>Ikuti Kami</h4>
                            <div class="footer-links">
                                <a href="#">Instagram</a>
                                <a href="#">YouTube</a>
                                <a href="#">TikTok</a>
                            </div>
                        </div>
                    </div>
                    <p class="copyright">© {{ now()->year }} MayClass. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <script>
            // Mobile nav toggle behavior: toggle `open` on .nav-inner
            (function () {
                const navToggle = document.querySelector('.nav-toggle');
                const navInner = document.querySelector('.nav-inner');
                if (navToggle && navInner) {
                    navToggle.addEventListener('click', () => {
                        const isOpen = navInner.classList.toggle('open');
                        navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    });
                }
            })();

            document.querySelectorAll('[data-slider]').forEach((slider) => {
                const track = slider.querySelector('.slider-track');
                if (!track) {
                    return;
                }

                const prev = slider.querySelector('[data-slider-prev]');
                const next = slider.querySelector('[data-slider-next]');
                const itemWidth = () => {
                    const firstItem = track.querySelector(':scope > *');
                    return firstItem ? firstItem.getBoundingClientRect().width + 24 : track.clientWidth;
                };

                if (prev) {
                    prev.addEventListener('click', () => {
                        track.scrollBy({ left: -itemWidth(), behavior: 'smooth' });
                    });
                }

                if (next) {
                    next.addEventListener('click', () => {
                        track.scrollBy({ left: itemWidth(), behavior: 'smooth' });
                    });
                }
            });
        </script>
    </body>
</html>
