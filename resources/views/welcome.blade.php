<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Bimbingan Belajar Premium untuk Raih Prestasi</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                color-scheme: light;
                --maroon-900: #6d0f18;
                --maroon-800: #8e1d24;
                --maroon-700: #a42b2e;
                --gold-500: #f2b859;
                --gold-400: #ffd38a;
                --neutral-900: #1f2328;
                --neutral-700: #4d5660;
                --neutral-100: #f6f7f8;
                --surface: #ffffff;
                --shadow-lg: 0 24px 60px rgba(66, 10, 17, 0.2);
                --shadow-md: 0 18px 40px rgba(66, 10, 17, 0.12);
                --radius-xl: 32px;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                color: var(--neutral-900);
                background: #ffffff;
                line-height: 1.7;
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

            .container {
                width: min(1180px, 100%);
                margin: 0 auto;
                padding: 0 32px;
            }

            header {
                position: relative;
                background: linear-gradient(135deg, var(--maroon-900) 0%, var(--maroon-700) 100%);
                color: #ffffff;
                border-bottom-left-radius: 120px;
                overflow: hidden;
            }

            header::after {
                content: "";
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at 20% 20%, rgba(255, 211, 138, 0.35), transparent 55%),
                    radial-gradient(circle at 80% 0%, rgba(255, 255, 255, 0.18), transparent 45%);
                pointer-events: none;
            }

            nav {
                position: relative;
                z-index: 1;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 28px 0;
                gap: 32px;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 14px;
                font-weight: 600;
                font-size: 1.25rem;
            }

            .brand img {
                width: 48px;
                height: 48px;
                object-fit: contain;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 28px;
                font-size: 0.95rem;
            }

            .nav-links a {
                color: rgba(255, 255, 255, 0.78);
                transition: color 0.2s ease;
            }

            .nav-links a:hover {
                color: #ffffff;
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 16px;
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

            .btn-gold {
                background: linear-gradient(120deg, var(--gold-400) 0%, var(--gold-500) 100%);
                color: #6d3d09;
                box-shadow: 0 16px 40px rgba(242, 184, 89, 0.36);
            }

            .btn-gold:hover {
                transform: translateY(-1px);
            }

            .hero {
                position: relative;
                z-index: 1;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 56px;
                align-items: center;
                padding: 48px 0 120px;
            }

            .hero h1 {
                font-size: clamp(2.7rem, 4vw, 3.9rem);
                line-height: 1.15;
                margin: 18px 0;
            }

            .hero p {
                color: rgba(255, 255, 255, 0.84);
                margin: 0 0 32px;
                max-width: 520px;
            }

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 18px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.16);
                font-weight: 600;
                letter-spacing: 0.02em;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                margin-bottom: 40px;
            }

            .hero-stats {
                display: grid;
                gap: 18px;
                background: rgba(255, 255, 255, 0.12);
                border-radius: 24px;
                padding: 22px 28px;
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.16);
                max-width: 440px;
            }

            .hero-stats-row {
                display: flex;
                flex-wrap: wrap;
                gap: 18px;
            }

            .hero-stat {
                flex: 1 1 160px;
                display: grid;
                gap: 2px;
            }

            .hero-stat strong {
                font-size: 1.6rem;
            }

            .hero-art {
                position: relative;
            }

            .hero-art::after {
                content: "";
                position: absolute;
                inset: 10% 0 -6% 12%;
                background: radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.22), transparent 65%);
                border-radius: var(--radius-xl);
                z-index: 0;
            }

            .hero-art img {
                position: relative;
                z-index: 1;
                border-radius: var(--radius-xl);
                box-shadow: var(--shadow-lg);
            }

            .stat-card strong {
                font-size: 1.4rem;
                color: var(--primary-strong);
            }

            .section-header {
                max-width: 760px;
                margin: 0 auto 56px;
                text-align: center;
                display: grid;
                gap: 16px;
            }

            .section-header h2 {
                margin: 0;
                font-size: clamp(2rem, 3vw, 2.7rem);
                color: var(--neutral-900);
            }

            .section-header p {
                margin: 0;
                color: var(--neutral-700);
            }

            .articles-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 28px;
            }

            .article-card {
                background: var(--surface);
                border-radius: 28px;
                box-shadow: var(--shadow-md);
                overflow: hidden;
                display: grid;
                grid-template-rows: 220px 1fr;
            }

            .article-card img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .article-content {
                padding: 24px 26px 32px;
                display: grid;
                gap: 10px;
            }

            .article-content h3 {
                margin: 0;
                font-size: 1.15rem;
                color: var(--neutral-900);
            }

            .article-content p {
                margin: 0;
                color: var(--neutral-700);
                font-size: 0.95rem;
            }

            .link-muted {
                color: var(--maroon-800);
                font-weight: 600;
            }

            .pricing-section {
                background: linear-gradient(135deg, #fff6ec 0%, #fff9f2 100%);
            }

            .pricing-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 32px;
            }

            .pricing-card {
                background: var(--surface);
                border-radius: 32px;
                padding: 36px 32px;
                box-shadow: var(--shadow-md);
                display: grid;
                gap: 18px;
                position: relative;
            }

            .pricing-card::after {
                content: "";
                position: absolute;
                inset: 18px;
                border-radius: 26px;
                border: 1px dashed rgba(162, 43, 46, 0.18);
                pointer-events: none;
            }

            .pricing-card strong {
                font-size: 1.4rem;
            }

            .pricing-price {
                font-size: 2rem;
                color: var(--maroon-800);
                font-weight: 700;
            }

            .pricing-features {
                list-style: none;
                margin: 0;
                padding: 0;
                display: grid;
                gap: 12px;
                color: var(--neutral-700);
            }

            .pricing-features li::before {
                content: "•";
                margin-right: 8px;
                color: var(--gold-500);
            }

            .highlight-section {
                position: relative;
                background: linear-gradient(110deg, rgba(141, 27, 36, 0.96), rgba(81, 11, 17, 0.92)),
                    url("https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1600&q=80")
                        center/cover;
                color: #ffffff;
                border-radius: 100px 0 0 100px;
                overflow: hidden;
                margin: 0 32px;
            }

            .highlight-content {
                padding: 90px clamp(32px, 6vw, 96px);
                display: grid;
                gap: 32px;
            }

            .highlight-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 24px;
            }

            .highlight-card {
                background: rgba(255, 255, 255, 0.12);
                border-radius: 24px;
                padding: 22px;
                backdrop-filter: blur(12px);
                display: grid;
                gap: 12px;
            }

            .slider {
                position: relative;
            }

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
                background: rgba(109, 15, 24, 0.32);
                border-radius: 999px;
            }

            .slider-track > * {
                flex: 0 0 min(320px, 80vw);
                scroll-snap-align: start;
            }

            .slider-controls {
                position: absolute;
                inset: -72px 0 auto auto;
                display: flex;
                gap: 12px;
            }

            .slider button {
                width: 46px;
                height: 46px;
                border-radius: 50%;
                border: none;
                background: var(--surface);
                color: var(--maroon-800);
                box-shadow: var(--shadow-md);
                cursor: pointer;
                transition: transform 0.2s ease;
            }

            .slide {
                flex: 0 0 100%;
                padding: 0 12px;
            }

            .testimonial-card,
            .mentor-card {
                background: #ffffff;
                border-radius: 28px;
                padding: 28px;
                display: grid;
                gap: 16px;
                box-shadow: var(--shadow-md);
            }

            .testimonial-card img,
            .mentor-card img {
                width: 100%;
                border-radius: 20px;
            }

            .testimonial-card p {
                margin: 0;
                color: var(--neutral-700);
                font-size: 0.95rem;
            }

            .mentor-card {
                text-align: center;
            }

            .mentor-role {
                color: var(--neutral-700);
                font-size: 0.95rem;
            }

            .faq-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            details {
                border-radius: 22px;
                background: var(--surface);
                padding: 20px 24px;
                box-shadow: var(--shadow-md);
            }

            .slider-button {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                border: none;
                display: grid;
                place-items: center;
                background: rgba(61, 183, 173, 0.15);
                color: var(--primary-strong);
                cursor: pointer;
                outline: none;
            }

            footer {
                background: #f0f1f3;
                padding: 72px 0 48px;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 32px;
            }

            .footer-brand {
                display: grid;
                gap: 16px;
            }

            .slider-dot[aria-current="true"] {
                background: var(--primary-strong);
            }

            .footer-links {
                display: grid;
                gap: 10px;
                color: var(--neutral-700);
                font-size: 0.95rem;
            }

            .footer-links a {
                color: inherit;
            }

            .footer-links a:hover {
                color: var(--maroon-800);
            }

            .copyright {
                margin: 48px 0 0;
                text-align: center;
                color: var(--neutral-700);
                font-size: 0.9rem;
            }

            @media (max-width: 1080px) {
                .hero {
                    grid-template-columns: 1fr;
                    text-align: center;
                }

                .hero p,
                .hero-stats {
                    margin-left: auto;
                    margin-right: auto;
                }

                .hero-actions {
                    justify-content: center;
                }
            }

                .hero-art::after {
                    inset: 12% 12% -6% 12%;
                }

                .articles-grid,
                .pricing-grid,
                .highlight-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .highlight-section {
                    border-radius: 80px 0 0 80px;
                }

                .slider-controls {
                    inset: -56px 24px auto auto;
                }

                nav {
                    gap: 18px;
                }

            @media (max-width: 760px) {
                nav {
                    flex-wrap: wrap;
                    justify-content: center;
                    text-align: center;
                }

                .nav-links {
                    flex-wrap: wrap;
                    justify-content: center;
                }

                .container {
                    padding: 0 20px;
                }

                .articles-grid,
                .pricing-grid,
                .highlight-grid,
                .faq-grid {
                    grid-template-columns: 1fr;
                }

                .hero-stats {
                    max-width: none;
                    width: 100%;
                }

                .highlight-section {
                    margin: 0 20px;
                    border-radius: 48px;
                }

                section {
                    padding: 68px 0;
                }

                .footer-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <a class="brand" href="/">
                        <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="Logo MayClass" />
                        <span>MayClass</span>
                    </a>
                    <div class="nav-links">
                        <a href="#beranda">Beranda</a>
                        <a href="#artikel">Artikel</a>
                        <a href="#paket">Paket Belajar</a>
                        <a href="#keunggulan">Keunggulan</a>
                        <a href="#testimoni">Testimoni</a>
                        <a href="#faq">FAQ</a>
                    </div>
                    <div class="nav-actions">
                        <a class="btn btn-outline" href="{{ route('login') }}">Masuk</a>
                        <a class="btn btn-gold" href="{{ route('register') }}">Daftar</a>
                    </div>
                </nav>
                <div class="hero" id="beranda">
                    <div>
                        <span class="badge">Bimbel Digital MayClass</span>
                        <h1>Belajar Nyaman, Prestasi Mengesankan</h1>
                        <p>
                            Bertemu dengan tentor terbaik MayClass dan rasakan perjalanan belajar yang terarah, fleksibel, dan
                            penuh dukungan menuju kampus impianmu.
                        </p>
                        <div class="hero-actions">
                            <a class="btn btn-gold" href="{{ route('packages.index') }}">Lihat Paket Belajar</a>
                            <a class="btn btn-outline" href="{{ route('login') }}">Masuk sebagai Siswa</a>
                        </div>
                        <div class="hero-stats">
                            <div>Dipercaya ribuan pelajar dan orang tua di seluruh Indonesia.</div>
                            <div class="hero-stats-row">
                                <div class="hero-stat">
                                    <strong>2.000+</strong>
                                    <span>Siswa aktif MayClass</span>
                                </div>
                                <div class="hero-stat">
                                    <strong>120+</strong>
                                    <span>Tentor profesional</span>
                                </div>
                                <div class="hero-stat">
                                    <strong>98%</strong>
                                    <span>Tingkat kepuasan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-art">
                        <img src="{{ \App\Support\ImageRepository::url('hero') }}" alt="Ilustrasi siswa MayClass" />
                    </div>
                </div>
            </div>
        </header>

        <section class="section" id="artikel">
            <div class="container">
                <div class="section-header">
                    <span class="badge" style="background: rgba(142, 29, 36, 0.08); color: var(--maroon-800);">
                        Artikel Terupdate
                    </span>
                    <h2 class="section-title">Wawasan Terbaru untuk Dukung Persiapanmu</h2>
                    <p class="section-subtitle">
                        Nikmati rangkuman materi, strategi ujian, dan cerita motivasi dari tim akademik MayClass agar kamu
                        selalu selangkah di depan.
                    </p>
                </div>
                <div class="articles-grid">
                    <article class="article-card">
                        <img src="{{ \App\Support\ImageRepository::url('materials.persamaan_linear') }}" alt="Artikel UTBK" />
                        <div class="article-content">
                            <h3>Kenali 7 Subtes UTBK yang Harus Kamu Taklukkan</h3>
                            <p>
                                Panduan lengkap memahami struktur TPS dan Literasi dengan latihan intensif dari mentor MayClass.
                            </p>
                            <a class="link-muted" href="{{ route('packages.index') }}">Baca Program Unggulan →</a>
                        </div>
                    </article>
                    <article class="article-card">
                        <img src="{{ \App\Support\ImageRepository::url('materials.kimia_termokimia') }}" alt="Artikel SKD" />
                        <div class="article-content">
                            <h3>Strategi Lulus SKD ASN &amp; PPPK Bersama Mentor Ahli</h3>
                            <p>
                                Kisi-kisi terbaru, tips manajemen waktu, dan latihan soal real untuk skor maksimal di seleksi CPNS.
                            </p>
                            <a class="link-muted" href="{{ route('packages.index') }}">Ikuti Tryout Interaktif →</a>
                        </div>
                    </article>
                    <article class="article-card">
                        <img src="{{ \App\Support\ImageRepository::url('materials.bahasa_grammar') }}" alt="Artikel motivasi" />
                        <div class="article-content">
                            <h3>Cerita Alumni: Raih Kampus Impian dari Nol</h3>
                            <p>
                                Belajar dari pengalaman siswa MayClass yang berhasil masuk kampus favorit berkat program intensif.
                            </p>
                            <a class="link-muted" href="{{ route('packages.index') }}">Pelajari Rencana Belajar →</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section pricing-section" id="paket">
            <div class="container">
                <div class="section-header">
                    <span class="badge" style="background: rgba(242, 184, 89, 0.18); color: var(--maroon-800);">
                        Paket Belajar
                    </span>
                    <h2 class="section-title">Pilih Paket Favoritmu &amp; Belajar Bareng Mentor Andal</h2>
                    <p class="section-subtitle">
                        Mulai dari kelas reguler, persiapan UTBK, hingga bimbingan CPNS—MayClass siap menemanimu dengan sesi
                        interaktif dan laporan perkembangan rutin.
                    </p>
                </div>
                <div class="pricing-grid">
                    <article class="pricing-card">
                        <span class="badge" style="background: rgba(162, 43, 46, 0.12); color: var(--maroon-800);">Tryout SKD</span>
                        <strong>Simulasi Premium</strong>
                        <div class="pricing-price">Rp30K</div>
                        <div style="color: var(--neutral-700);">Diskon spesial dari Rp60K/paket</div>
                        <ul class="pricing-features">
                            <li>Bank soal HOTS + pembahasan video</li>
                            <li>Analisis skor otomatis &amp; ranking nasional</li>
                            <li>Group coaching bersama mentor ASN</li>
                        </ul>
                        <a class="btn btn-gold" href="{{ route('packages.index') }}">Beli Paket</a>
                    </article>
                    <article class="pricing-card">
                        <span class="badge" style="background: rgba(162, 43, 46, 0.12); color: var(--maroon-800);">Tryout TPA</span>
                        <strong>Bundling Stan/Polstat</strong>
                        <div class="pricing-price">Rp30K</div>
                        <div style="color: var(--neutral-700);">Diskon spesial dari Rp60K/paket</div>
                        <ul class="pricing-features">
                            <li>8 set TO intensif + pembahasan LIVE</li>
                            <li>Pembinaan mindset &amp; habit belajar</li>
                            <li>Prediksi soal dari mentor berpengalaman</li>
                        </ul>
                        <a class="btn btn-gold" href="{{ route('packages.index') }}">Beli Paket</a>
                    </article>
                    <article class="pricing-card">
                        <span class="badge" style="background: rgba(162, 43, 46, 0.12); color: var(--maroon-800);">Tryout Matematika</span>
                        <strong>Spesialis STIS</strong>
                        <div class="pricing-price">Rp20K</div>
                        <div style="color: var(--neutral-700);">Diskon spesial dari Rp40K/paket</div>
                        <ul class="pricing-features">
                            <li>Pembahasan konsep mendalam setiap sesi</li>
                            <li>Latihan adaptif sesuai level kemampuan</li>
                            <li>Group diskusi eksklusif bersama mentor</li>
                        </ul>
                        <a class="btn btn-gold" href="{{ route('packages.index') }}">Beli Paket</a>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" id="keunggulan">
            <div class="highlight-section">
                <div class="highlight-content">
                    <div>
                        <span class="badge" style="background: rgba(255, 255, 255, 0.16); color: #ffffff;">Mengapa MayClass?</span>
                        <h2 style="margin: 18px 0 12px; font-size: clamp(2.1rem, 3vw, 3rem);">Bersama MayClass Belajarmu Lebih Seru</h2>
                        <p style="margin: 0; max-width: 620px; color: rgba(255, 255, 255, 0.84);">
                            Rasakan pengalaman belajar intensif, hangat, dan profesional. Tim MayClass memastikan setiap sesi
                            berjalan menyenangkan dengan target capaian yang jelas.
                        </p>
                    </div>
                    <div class="highlight-grid">
                        <div class="highlight-card">
                            <strong>Super Teacher</strong>
                            <p style="margin: 0; color: rgba(255, 255, 255, 0.82);">
                                Mentor pilihan dengan pengalaman mengajar panjang dan capaian prestisius.
                            </p>
                        </div>
                        <div class="highlight-card">
                            <strong>Materi Lengkap</strong>
                            <p style="margin: 0; color: rgba(255, 255, 255, 0.82);">
                                Silabus terbaru, bank soal adaptif, dan rekaman kelas siap diputar kapan pun.
                            </p>
                        </div>
                        <div class="highlight-card">
                            <strong>Analisis Mendalam</strong>
                            <p style="margin: 0; color: rgba(255, 255, 255, 0.82);">
                                Pantau progres lewat laporan mingguan dan rekomendasi belajar personal.
                            </p>
                        </div>
                        <div class="highlight-card">
                            <strong>Komunitas Aktif</strong>
                            <p style="margin: 0; color: rgba(255, 255, 255, 0.82);">
                                Saling dukung bersama teman sefrekuensi dan dapatkan motivasi harian.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="testimoni">
            <div class="container">
                <div class="section-header">
                    <span class="badge" style="background: rgba(142, 29, 36, 0.08); color: var(--maroon-800);">
                        Testimoni Siswa
                    </span>
                    <h2 class="section-title">Cerita Mereka yang Sudah Mewujudkan Mimpi</h2>
                    <p class="section-subtitle">
                        Dengar langsung pengalaman siswa MayClass yang berhasil menembus kampus favorit dan meraih skor tinggi
                        di ujian bergengsi.
                    </p>
                </div>
                <div class="slider" data-slider>
                    <div class="slider-track">
                        <article class="testimonial-card">
                            <img src="{{ \App\Support\ImageRepository::url('testimonials.yohanna') }}" alt="Testimoni Yohanna" />
                            <div style="display: grid; gap: 4px;">
                                <strong>Yohanna • Skor UTBK 640</strong>
                                <p>
                                    "Mentor MayClass ramah banget dan jelas saat jelasin materi. Tryoutnya bikin aku makin percaya diri
                                    masuk kampus impian."
                                </p>
                            </div>
                        </article>
                        <article class="testimonial-card">
                            <img src="{{ \App\Support\ImageRepository::url('testimonials.xavier') }}" alt="Testimoni Xavier" />
                            <div style="display: grid; gap: 4px;">
                                <strong>Xavier • Skor SKD 433</strong>
                                <p>
                                    "Latihan soal dan pembahasan detailnya sangat membantu. Nilai SKD-ku naik signifikan setelah ikut
                                    program intensif."
                                </p>
                            </div>
                        </article>
                        <article class="testimonial-card">
                            <img src="{{ \App\Support\ImageRepository::url('testimonials.lisa') }}" alt="Testimoni Lisa" />
                            <div style="display: grid; gap: 4px;">
                                <strong>Lisa • Orang Tua Siswa</strong>
                                <p>
                                    "Progres anakku dipantau terus dan laporan mingguannya bikin kami tenang. MayClass responsif banget."
                                </p>
                            </div>
                        </article>
                    </div>
                    <div class="slider-controls" aria-hidden="true">
                        <button type="button" data-slider-prev>&larr;</button>
                        <button type="button" data-slider-next>&rarr;</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="tentor">
            <div class="container">
                <div class="section-header">
                    <span class="badge" style="background: rgba(142, 29, 36, 0.08); color: var(--maroon-800);">
                        Super Teacher MayClass
                    </span>
                    <h2 class="section-title">Mentor Berkualitas Siap Mendampingi Belajarmu</h2>
                    <p class="section-subtitle">
                        Tenaga pendidik terbaik dari berbagai kampus unggulan siap memastikan setiap sesi belajar terasa dekat dan
                        menyenangkan.
                    </p>
                </div>
                <div class="slider" data-slider>
                    <div class="slider-track">
                        <article class="mentor-card">
                            <img src="{{ \App\Support\ImageRepository::url('tutors.henny') }}" alt="Tutor Henny" />
                            <div>
                                <strong>Kak Henny</strong>
                                <div class="mentor-role">Mentor Bahasa Indonesia &amp; Inggris</div>
                            </div>
                            <p class="mentor-role">"Bangun mindset juara dengan konsistensi dan disiplin belajar."</p>
                        </article>
                        <article class="mentor-card">
                            <img src="{{ \App\Support\ImageRepository::url('tutors.husein') }}" alt="Tutor Husein" />
                            <div>
                                <strong>Kak Husein</strong>
                                <div class="mentor-role">Mentor Matematika &amp; TPS</div>
                            </div>
                            <p class="mentor-role">"Tidak ada perjalanan sulit jika kita fokus sama tujuan besar."</p>
                        </article>
                        <article class="mentor-card">
                            <img src="{{ \App\Support\ImageRepository::url('tutors.pal') }}" alt="Tutor Pal" />
                            <div>
                                <strong>Kak Pal</strong>
                                <div class="mentor-role">Mentor SKD &amp; TPA</div>
                            </div>
                            <p class="mentor-role">"Strategi tepat dan evaluasi rutin bikin kamu siap setiap ujian."</p>
                        </article>
                    </div>
                    <div class="slider-controls" aria-hidden="true">
                        <button type="button" data-slider-prev>&larr;</button>
                        <button type="button" data-slider-next>&rarr;</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="faq">
            <div class="container">
                <div class="section-header">
                    <span class="badge" style="background: rgba(142, 29, 36, 0.08); color: var(--maroon-800);">
                        Pertanyaan yang Sering Diajukan
                    </span>
                    <h2 class="section-title">FAQ MayClass</h2>
                    <p class="section-subtitle">
                        Temukan jawaban singkat terkait layanan, metode belajar, hingga cara mengakses materi di platform
                        MayClass.
                    </p>
                </div>
                <div class="faq-grid">
                    <details>
                        <summary>Apakah MayClass menyediakan kelas online dan tatap muka?</summary>
                        <p>
                            Ya. Kamu bisa memilih mode belajar sesuai kebutuhan. Tim kami bantu atur jadwal dan mentor terbaik
                            untukmu.
                        </p>
                    </details>
                    <details>
                        <summary>Bagaimana cara mengakses materi dan rekaman kelas?</summary>
                        <p>
                            Siswa dapat login ke dashboard MayClass untuk melihat materi, rekaman kelas, dan rangkuman progres
                            belajar.
                        </p>
                    </details>
                    <details>
                        <summary>Apakah bisa reschedule jika ada jadwal mendadak?</summary>
                        <p>
                            Bisa. Hubungi admin maksimal 24 jam sebelum sesi dimulai dan kami akan bantu atur ulang jadwalmu.
                        </p>
                    </details>
                    <details>
                        <summary>Bagaimana sistem evaluasi progres siswa?</summary>
                        <p>
                            Kami menyediakan laporan mingguan, evaluasi tryout, dan coaching pribadi agar target belajar tercapai.
                        </p>
                    </details>
                    <details>
                        <summary>Apakah ada grup diskusi komunitas?</summary>
                        <p>
                            Ada. Semua siswa akan bergabung di komunitas eksklusif untuk diskusi, motivasi, dan info terbaru.
                        </p>
                    </details>
                    <details>
                        <summary>Metode pembayaran apa yang tersedia?</summary>
                        <p>
                            Pembayaran dapat melalui transfer bank, e-wallet, dan virtual account dengan konfirmasi otomatis.
                        </p>
                    </details>
                </div>
            </div>
        </section>

        <footer>
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-brand">
                        <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="Logo MayClass" />
                        <p>
                            MayClass menghadirkan bimbingan belajar terpadu dengan tentor profesional, materi interaktif, dan
                            layanan pelanggan responsif.
                        </p>
                    </div>
                    <div>
                        <h4>Produk</h4>
                        <div class="footer-links">
                            <a href="#paket">Tryout &amp; Paket Belajar</a>
                            <a href="#tentor">Super Teacher</a>
                            <a href="#testimoni">Testimoni</a>
                        </div>
                    </div>
                    <div>
                        <h4>Bantuan</h4>
                        <div class="footer-links">
                            <a href="#faq">FAQ</a>
                            <a href="mailto:hello@mayclass.id">Email Support</a>
                            <a href="tel:+6281234567890">Hubungi Admin</a>
                        </div>
                    </div>
                    <div>
                        <h4>Ikuti Kami</h4>
                        <div class="footer-links">
                            <a href="https://www.instagram.com" target="_blank" rel="noreferrer">Instagram</a>
                            <a href="https://www.tiktok.com" target="_blank" rel="noreferrer">TikTok</a>
                            <a href="https://www.youtube.com" target="_blank" rel="noreferrer">YouTube</a>
                        </div>
                        <div class="footer-meta">© {{ date('Y') }} MayClass. Semua hak cipta dilindungi.</div>
                    </div>
                </div>
                <p class="copyright">© {{ now()->year }} MayClass. All rights reserved.</p>
            </div>
        </footer>

        <script>
            document.querySelectorAll('[data-slider]').forEach((slider) => {
                const track = slider.querySelector('.slider-track');
                if (!track) {
                    return;
                }

                prevBtn.addEventListener('click', () => {
                    index = (index - 1 + slides.length) % slides.length;
                    update();
                });

                nextBtn.addEventListener('click', () => {
                    index = (index + 1) % slides.length;
                    update();
                });

                renderDots();
                update();
            }

            document.querySelectorAll('[data-slider]').forEach(initSlider);
        </script>
    </body>
</html>
