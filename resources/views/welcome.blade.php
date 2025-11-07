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

            html {
                scroll-behavior: smooth;
            }
            
            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                color: var(--text-dark);
                background: #ffffff;
                line-height: 1.6;
                font-size: 16px;
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
                width: 100%;
                max-width: 1180px;
                margin: 0 auto;
                padding: 0 24px;
            }

            /* full-width variant to make specific sections (eg. header/hero)
               extend to the viewport edges without large left/right gutters */
            .container.full {
                max-width: 100%;
                padding: 0 18px; /* small inner padding to avoid content touching exact edge */
            }

            header {
                background: linear-gradient(135deg, #f7fffe 0%, rgba(61,183,173,0.08) 50%, #ffffff 100%);
                overflow: hidden;
            }

            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                padding: 0 18px; /* keep horizontal padding, remove vertical padding to fix box height */
                height: 135px; /* fixed height so nav box doesn't grow */
                line-height: 56px;
                background: rgba(255, 255, 255, 0.95);
                border-radius: 12px;
                box-shadow: 0 6px 18px rgba(20, 60, 70, 0.06);
                margin: 10px 0;
                backdrop-filter: blur(8px);
                overflow: visible; /* allow logo to overflow visually without expanding nav */
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                font-weight: 600;
                font-size: 1.25rem;
                color: var(--primary-dark);
            }

            .brand img {
                width: 44px;
                height: 44px;
                object-fit: contain;
            }

            .nav-links {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 20px;
                font-size: 0.95rem; /* reduced from 1.1rem to match previous size */
                color: var(--text-muted);
                margin: 0 auto;
                flex: 1;
            }

            .nav-links a {
                padding: 8px 16px;
                border-radius: 8px;
                transition: all 0.2s ease;
                font-weight: 500;
            }

            .nav-links a:hover {
                color: var(--primary-dark);
                background: rgba(61, 183, 173, 0.08);
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-left: auto;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 26px;
                border-radius: 999px;
                font-size: 1rem; /* increase button font for accessibility */
                font-weight: 600;
                border: 1px solid transparent;
                transition: all 0.18s ease;
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
                display: block;
                width: fit-content;
                margin: 0 auto;
                padding: 8px 18px;
                border-radius: 999px;
                background: rgba(61, 183, 173, 0.12);
                color: var(--primary-dark);
                font-size: 0.85rem;
                font-weight: 600;
                text-align: center;
            }

            /* hero uses full-bleed background; inner wrapper centers and constrains content */
            .hero {
                padding: 40px 0 80px;
            }

            .hero-inner {
                display: grid;
                grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.8fr);
                align-items: center;
                gap: 40px;
                max-width: 1280px;
                margin: 0 auto;
                padding: 20px 24px 0;
            }

            .hero-copy {
                max-width: 800px;
            }

            .hero h1 {
                font-size: clamp(2.8rem, 5vw, 4.2rem);
                line-height: 1.1;
                margin: 24px 0 20px;
                letter-spacing: -0.02em;
                max-width: 100%;
                color: var(--text-dark);
            }

            .hero p {
                width: 100%;
                max-width: 720px;
                color: var(--text-muted);
                margin-bottom: 32px;
                font-size: 1.125rem;
                line-height: 1.7;
            }

            .hero-cta {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                margin-bottom: 36px;
            }

            .stats {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }

            .stat-card {
                padding: 18px 24px;
                border-radius: 20px;
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(6px);
                min-width: 180px;
                box-shadow: 0 10px 22px rgba(40, 110, 120, 0.12);
            }

            .stat-card h3 {
                margin: 0 0 8px;
                font-size: 1.6rem;
            }

            .hero-art {
                position: relative;
            }

            .hero-art::after {
                content: "";
                position: absolute;
                inset: 12% 10% 0 0;
                border-radius: 32px;
                background: rgba(61, 183, 173, 0.12);
                filter: blur(0);
                z-index: 0;
            }

            .hero-art img {
                position: relative;
                z-index: 1;
                border-radius: 32px;
                box-shadow: 0 28px 52px rgba(31, 42, 55, 0.18);
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

            .section-header {
                text-align: center;
                margin-left: auto;
                margin-right: auto;
            }

            .section-title {
                margin: 0;
                font-size: clamp(2.1rem, 3vw, 3rem);
            }

            .section-subtitle {
                margin: 0;
                color: var(--text-muted);
                font-size: 1.05rem;
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
                padding: 18px 0; /* vertical spacing around slider */
            }

            .slider-track {
                display: flex;
                gap: 28px;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                scroll-behavior: smooth;
                padding: 12px 6px;
                -webkit-overflow-scrolling: touch;
                align-items: center; /* vertically center cards inside track */
            }

            .slider-track::-webkit-scrollbar {
                height: 8px;
            }

            .slider-track::-webkit-scrollbar-thumb {
                background: rgba(61, 183, 173, 0.35);
                border-radius: 999px;
            }

            .slider-track > * {
                flex: 0 0 320px; /* fixed card width for consistent layout */
                width: 320px;
                max-width: 320px;
                scroll-snap-align: start;
            }

            /* Place controls in normal flow below the track so they don't overlap
               the following content and don't require extra bottom padding. */
            .slider-controls {
                position: relative;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 24px; /* align with container horizontal padding */
                z-index: 3;
                pointer-events: auto;
                gap: 12px;
            }

            .slider-controls button {
                width: 44px;
                height: 44px;
                border-radius: 50%;
                border: none;
                background: var(--surface);
                box-shadow: 0 10px 24px rgba(20, 60, 70, 0.15);
                color: var(--primary-dark);
                cursor: pointer;
                transition: transform 0.16s ease, box-shadow 0.16s ease;
            }

            .slider-controls button:hover {
                transform: translateY(-2px);
                box-shadow: 0 14px 32px rgba(20, 60, 70, 0.16);
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
                padding: 20px 20px 22px;
                display: flex;
                flex-direction: column;
                gap: 12px;
                box-shadow: var(--shadow);
                min-height: 220px;
                transition: transform 0.16s ease, box-shadow 0.16s ease;
            }

            .tutor-card img,
            .testimonial-card img {
                width: 100%;
                border-radius: 12px;
                object-fit: cover;
                height: 140px;
            }

            .tutor-card:hover,
            .testimonial-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 22px 46px rgba(20,60,70,0.12);
            }

            .testimonial-card p {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.95rem;
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
                background: linear-gradient(to bottom, #0f172a, #1e293b);
                color: rgba(255, 255, 255, 0.72);
                padding: 80px 0 48px;
                position: relative;
            }

            footer::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            }

            .footer-grid {
                display: grid;
                grid-template-columns: 1.5fr repeat(3, 1fr);
                gap: 48px;
                margin-bottom: 60px;
            }

            .footer-brand {
                display: grid;
                gap: 20px;
            }

            .footer-brand img {
                width: 140px;
                filter: brightness(1.1);
            }

            .footer-brand p {
                font-size: 0.95rem;
                line-height: 1.7;
                opacity: 0.9;
            }

            .footer-links {
                display: grid;
                gap: 12px;
            }

            .footer-links h4 {
                color: #fff;
                font-size: 1.1rem;
                margin: 0 0 16px;
            }

            .footer-links a {
                color: rgba(255, 255, 255, 0.72);
                font-size: 0.95rem;
                transition: all 0.2s ease;
                width: fit-content;
                padding: 4px 0;
            }

            .footer-links a:hover {
                color: #ffffff;
                transform: translateX(4px);
            }

            .copyright {
                margin: 0;
                text-align: center;
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.6);
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
                    justify-content: center;
                    text-align: center;
                }

                .hero-inner {
                    grid-template-columns: 1fr;
                    text-align: center;
                }

                .hero p {
                    margin-left: auto;
                    margin-right: auto;
                }

                /* Keep section headers left-aligned on mobile */
                .section:not(#testimoni, #faq, #kontak) .section-header {
                    text-align: left;
                    margin-left: 0;
                    margin-right: 0;
                }

                .hero-cta,
                .stats {
                    justify-content: center;
                }

                .hero-art::after {
                    inset: 12% 4% 0 4%;
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
                <div class="container full">
                <nav>
                    <a class="brand" href="/">
                            <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass"
                                style="width: 250px; height: auto !important; display: block;" />
                    </a>



                    <div class="nav-links">
                        <a href="#tentang">Tentang</a>
                        <a href="#program">Program</a>
                        <a href="#tentor">Tentor</a>
                        <a href="#testimoni">Testimoni</a>
                        <a href="#faq">FAQ</a>
                    </div>
                    <div class="nav-actions">
                        <a class="btn btn-outline" href="{{ route('login') }}">Masuk</a>
                        <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
                    </div>
                </nav>
                <section class="hero">
                    <div class="hero-inner">
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
                            </div>
                        </div>
                        <div class="hero-art">
                            <img src="https://img.freepik.com/free-vector/online-tutorials-concept_52683-37480.jpg" 
                                 alt="Ilustrasi pembelajaran online" 
                                 style="width: 100%; height: auto; object-fit: contain;" />
                        </div>
                    </div>
                </section>
            </div>
        </header>

        <section class="section" id="tentang">
            <div class="container">
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
        </section>

        <section class="section alt" id="program">
            <div class="container">
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
        </section>

        <section class="section" id="tentor">
            <div class="container">
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
                </div>
            </div>
        </section>

        <section class="section alt" id="testimoni">
            <div class="container">
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
                </div>
            </div>
        </section>

        <section class="section" id="faq">
            <div class="container">
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
        </section>

        <section class="section alt" id="kontak">
            <div class="container" style="text-align: center;">
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
        </section>

        <footer>
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-brand">
                        <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass"
                                style="width: 300px; height: auto !important;" />                        <p>
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
        </footer>

        <script>
            // Keep sliders as simple horizontal scroll areas. No JS controls needed.
            // Optional: if you want auto-scroll later, I can add a small script.
        </script>
    </body>
</html>
