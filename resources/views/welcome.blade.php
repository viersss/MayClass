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
                --primary-dark: #2b8f87;
                --accent: #6f5df6;
                --text-dark: #1f2a37;
                --text-muted: #6b7280;
                --bg-light: #f5fbfb;
                --bg-card: #ffffff;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                color: var(--text-dark);
                background-color: #ffffff;
                line-height: 1.6;
            }

            img {
                max-width: 100%;
                display: block;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            header {
                background: linear-gradient(140deg, #f5fbfb 0%, #e6f3f6 50%, #f8f4ff 100%);
                border-bottom-left-radius: 160px;
                overflow: hidden;
            }

            .container {
                width: min(1160px, 90vw);
                margin: 0 auto;
            }

            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 24px 0;
                gap: 32px;
            }

            .logo {
                display: flex;
                align-items: center;
                gap: 12px;
                font-weight: 600;
                font-size: 1.3rem;
                color: var(--primary-dark);
            }

            .logo-icon {
                width: 42px;
                height: 42px;
                border-radius: 12px;
                background: var(--primary);
                display: grid;
                place-items: center;
                color: #fff;
                font-weight: 700;
                letter-spacing: 0.5px;
                box-shadow: 0 10px 35px rgba(61, 183, 173, 0.25);
            }

            .nav-links {
                display: flex;
                gap: 32px;
                align-items: center;
                font-size: 0.95rem;
                color: var(--text-muted);
            }

            .nav-links a:hover {
                color: var(--primary-dark);
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
                padding: 12px 24px;
                border-radius: 999px;
                font-size: 0.95rem;
                font-weight: 500;
                border: 1px solid transparent;
                transition: all 0.2s ease;
            }

            .btn-outline {
                border-color: rgba(61, 183, 173, 0.3);
                color: var(--primary-dark);
                background: rgba(61, 183, 173, 0.08);
            }

            .btn-outline:hover {
                border-color: var(--primary-dark);
                background: rgba(61, 183, 173, 0.16);
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--primary) 0%, #58d2c5 100%);
                color: #fff;
                box-shadow: 0 12px 35px rgba(61, 183, 173, 0.32);
            }

            .btn-primary:hover {
                filter: brightness(0.95);
                transform: translateY(-1px);
            }

            .hero {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                align-items: center;
                gap: 48px;
                padding: 48px 0 72px;
            }

            .hero h1 {
                font-size: clamp(2.5rem, 4vw, 3.6rem);
                margin-bottom: 16px;
                line-height: 1.2;
            }

            .hero p {
                color: var(--text-muted);
                margin-bottom: 32px;
                max-width: 540px;
            }

            .hero-cta {
                display: flex;
                gap: 16px;
                flex-wrap: wrap;
            }

            .stats {
                display: flex;
                gap: 32px;
                margin-top: 48px;
                flex-wrap: wrap;
            }

            .stat-card {
                background: #fff;
                padding: 20px 24px;
                border-radius: 20px;
                box-shadow: 0 16px 40px rgba(50, 85, 92, 0.08);
                min-width: 180px;
            }

            .stat-card h3 {
                margin: 0;
                font-size: 1.6rem;
                color: var(--primary-dark);
            }

            .section {
                padding: 96px 0;
            }

            .section-title {
                text-align: center;
                margin-bottom: 16px;
                font-size: clamp(2rem, 3vw, 2.8rem);
            }

            .section-subtitle {
                text-align: center;
                color: var(--text-muted);
                margin-bottom: 64px;
            }

            .pill {
                display: inline-block;
                background: rgba(61, 183, 173, 0.12);
                color: var(--primary-dark);
                border-radius: 999px;
                padding: 8px 18px;
                font-size: 0.85rem;
                font-weight: 500;
                letter-spacing: 0.02em;
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 24px;
            }

            .feature-card {
                background: var(--bg-card);
                padding: 28px;
                border-radius: 24px;
                box-shadow: 0 20px 45px rgba(29, 83, 89, 0.07);
                border: 1px solid rgba(61, 183, 173, 0.12);
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .feature-icon {
                width: 52px;
                height: 52px;
                border-radius: 14px;
                background: rgba(61, 183, 173, 0.12);
                display: grid;
                place-items: center;
                color: var(--primary-dark);
                font-size: 1.3rem;
                font-weight: 600;
            }

            .programs {
                background: var(--bg-light);
            }

            .programs-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 24px;
            }

            .program-card {
                background: #fff;
                border-radius: 28px;
                padding: 32px 28px;
                border: 1px solid rgba(61, 183, 173, 0.14);
                box-shadow: 0 20px 50px rgba(29, 83, 89, 0.08);
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .program-card h4 {
                margin: 0;
                font-size: 1.35rem;
            }

            .price {
                font-size: 2.2rem;
                font-weight: 600;
                color: var(--accent);
            }

            .program-card ul {
                list-style: none;
                padding: 0;
                margin: 12px 0 20px;
                color: var(--text-muted);
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .tutors-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 28px;
            }

            .tutor-card {
                background: #fff;
                border-radius: 24px;
                padding: 24px;
                text-align: center;
                box-shadow: 0 20px 40px rgba(29, 83, 89, 0.08);
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .tutor-card img {
                border-radius: 18px;
                object-fit: cover;
                width: 100%;
                height: 240px;
            }

            .testimonials-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 24px;
            }

            .testimonial-card {
                background: #fff;
                padding: 24px;
                border-radius: 22px;
                border: 1px solid rgba(61, 183, 173, 0.12);
                box-shadow: 0 16px 42px rgba(29, 83, 89, 0.06);
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .faq {
                background: var(--bg-light);
            }

            .faq-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
                max-width: 720px;
                margin: 0 auto;
            }

            details {
                background: #fff;
                border-radius: 16px;
                padding: 16px 24px;
                border: 1px solid rgba(61, 183, 173, 0.18);
                box-shadow: 0 15px 32px rgba(29, 83, 89, 0.06);
            }

            details summary {
                cursor: pointer;
                font-weight: 600;
                list-style: none;
            }

            details[open] summary {
                color: var(--primary-dark);
            }

            details summary::-webkit-details-marker {
                display: none;
            }

            details p {
                margin: 12px 0 0;
                color: var(--text-muted);
            }

            footer {
                background: #0d1b2a;
                color: rgba(255, 255, 255, 0.76);
                padding: 64px 0 32px;
            }

            footer .top {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 32px;
                margin-bottom: 48px;
            }

            footer h5 {
                margin: 0 0 16px;
                font-size: 1rem;
                color: #ffffff;
            }

            footer ul {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
                gap: 10px;
                font-size: 0.95rem;
            }

            .newsletter {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
            }

            .newsletter input {
                flex: 1 1 220px;
                padding: 12px 16px;
                border-radius: 999px;
                border: none;
                outline: none;
            }

            .footer-bottom {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 16px;
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.6);
            }

            .badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.1);
                font-size: 0.78rem;
            }

            @media (max-width: 960px) {
                .hero {
                    grid-template-columns: 1fr;
                    text-align: center;
                }

                .hero p,
                .hero-cta,
                .stats {
                    margin-left: auto;
                    margin-right: auto;
                    justify-content: center;
                }

                .nav-links {
                    display: none;
                }

                nav {
                    flex-wrap: wrap;
                }
            }

            @media (max-width: 640px) {
                header {
                    border-bottom-left-radius: 80px;
                }

                .section {
                    padding: 72px 0;
                }

                .hero {
                    padding: 32px 0 56px;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <div class="logo">
                        <div class="logo-icon">MC</div>
                        MayClass
                    </div>
                    <div class="nav-links">
                        <a href="#tentang">Tentang</a>
                        <a href="#program">Program</a>
                        <a href="#testimoni">Testimoni</a>
                        <a href="#faq">FAQ</a>
                    </div>
                    <div class="nav-actions">
                        <a class="btn btn-outline" href="{{ route('login') }}">Masuk</a>
                        <a class="btn btn-primary" href="{{ route('register') }}">Daftar Tutor</a>
                    </div>
                </nav>
                <section class="hero">
                    <div>
                        <span class="pill">Langkah Pasti Menuju Prestasi</span>
                        <h1>Platform Bimbingan Belajar Komprehensif untuk Semua Kebutuhan Akademik</h1>
                        <p>
                            MayClass menghadirkan pengalaman belajar terarah bersama tentor profesional,
                            sistem monitoring real-time, dan fitur fleksibel yang menyesuaikan gaya belajar
                            siswa modern.
                        </p>
                        <div class="hero-cta">
                            <a class="btn btn-primary" href="#program">Jelajahi Program</a>
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
                    <div>
                        <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=900&q=80" alt="Siswa belajar" />
                    </div>
                </section>
            </div>
        </header>

        <section class="section" id="tentang">
            <div class="container">
                <div class="section-header" style="text-align: center; max-width: 760px; margin: 0 auto 64px;">
                    <span class="pill">Tentang MayClass</span>
                    <h2 class="section-title">Platform Pembelajaran Terlengkap</h2>
                    <p class="section-subtitle">
                        Kami menghadirkan solusi bimbingan belajar end-to-end yang menyatukan siswa, tentor,
                        dan admin dalam satu ekosistem digital yang mudah digunakan.
                    </p>
                </div>
                <div class="features-grid">
                    <article class="feature-card">
                        <div class="feature-icon">📚</div>
                        <h3>Materi Lengkap & Terstruktur</h3>
                        <p>
                            Kurikulum mengikuti standar nasional dan internasional dengan materi interaktif
                            untuk meningkatkan pemahaman siswa.
                        </p>
                    </article>
                    <article class="feature-card">
                        <div class="feature-icon">👩‍🏫</div>
                        <h3>Tentor Profesional</h3>
                        <p>
                            Setiap tentor telah melewati proses seleksi ketat dan pelatihan pedagogik untuk
                            memastikan kualitas pengajaran terbaik.
                        </p>
                    </article>
                    <article class="feature-card">
                        <div class="feature-icon">💳</div>
                        <h3>Pengelolaan Keuangan Aman</h3>
                        <p>
                            Sistem administrasi keuangan transparan dan terintegrasi, memudahkan admin
                            keuangan melakukan pencatatan.
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

        <section class="section programs" id="program">
            <div class="container">
                <div class="section-header" style="text-align: center; max-width: 720px; margin: 0 auto 64px;">
                    <span class="pill">Pilihan Program</span>
                    <h2 class="section-title">Pilih Paket Sesuai Kebutuhan Belajar</h2>
                    <p class="section-subtitle">
                        Didesain untuk berbagai jenjang pendidikan dengan fleksibilitas jadwal, metode hybrid,
                        dan pendampingan intensif dari tentor berpengalaman.
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
                        <a class="btn btn-outline" href="{{ route('register') }}">Selengkapnya</a>
                    </article>
                    <article class="program-card">
                        <h4>SMP Kelas 7-9</h4>
                        <p class="price">Rp 415<span style="font-size: 1rem; font-weight: 400;">/bulan</span></p>
                        <ul>
                            <li>Persiapan ujian semester & AKM</li>
                            <li>Bank soal interaktif</li>
                            <li>Konsultasi belajar personal</li>
                        </ul>
                        <a class="btn btn-primary" href="{{ route('register') }}">Daftar Sekarang</a>
                    </article>
                    <article class="program-card">
                        <h4>SMA Kelas 10-12</h4>
                        <p class="price">Rp 485<span style="font-size: 1rem; font-weight: 400;">/bulan</span></p>
                        <ul>
                            <li>Persiapan UTBK & ujian mandiri</li>
                            <li>Pemantauan progres real-time</li>
                            <li>Try out berkala dan evaluasi</li>
                        </ul>
                        <a class="btn btn-outline" href="{{ route('register') }}">Selengkapnya</a>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" id="tentor">
            <div class="container">
                <div class="section-header" style="text-align: center; max-width: 720px; margin: 0 auto 64px;">
                    <span class="pill">Tentor Berpengalaman</span>
                    <h2 class="section-title">Super Tentor Berkualitas</h2>
                    <p class="section-subtitle">
                        Tim tentor kami terdiri dari lulusan terbaik dengan pengalaman mengajar dan sertifikasi
                        profesional untuk memastikan pembelajaran efektif.
                    </p>
                </div>
                <div class="tutors-grid">
                    <article class="tutor-card">
                        <img src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=700&q=80" alt="Kak Henny" />
                        <div>
                            <h4>Kak Henny</h4>
                            <p>Super Tutor Bahasa Indonesia &amp; Inggris</p>
                        </div>
                    </article>
                    <article class="tutor-card">
                        <img src="https://images.unsplash.com/photo-1520975922131-c04737f9e02b?auto=format&fit=crop&w=700&q=80" alt="Kak Husein" />
                        <div>
                            <h4>Kak Husein</h4>
                            <p>Super Tutor Matematika &amp; Sains</p>
                        </div>
                    </article>
                    <article class="tutor-card">
                        <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=700&q=80" alt="Kak Pal" />
                        <div>
                            <h4>Kak Pal</h4>
                            <p>Super Tutor Fisika &amp; Kimia</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" id="testimoni">
            <div class="container">
                <div class="section-header" style="text-align: center; max-width: 720px; margin: 0 auto 64px;">
                    <span class="pill">Apa Kata Mereka</span>
                    <h2 class="section-title">Cerita Sukses dari Para Siswa</h2>
                    <p class="section-subtitle">
                        Testimoni dari siswa dan orang tua yang merasakan langsung perubahan signifikan dalam
                        proses belajar bersama MayClass.
                    </p>
                </div>
                <div class="testimonials-grid">
                    <article class="testimonial-card">
                        <p>
                            “Saya merasa banyak kemajuan setelah mengikuti kelas online. Kakak tentor sangat
                            sabar menjelaskan dan materi tersedia lengkap.”
                        </p>
                        <div>
                            <strong>Yohanna</strong>
                            <div style="color: var(--text-muted);">SDN Makmur Cibinong</div>
                        </div>
                    </article>
                    <article class="testimonial-card">
                        <p>
                            “Pengajaran ini benar-benar membantu. Sistem belajarnya terstruktur dan memudahkan
                            saya memahami konsep yang sulit.”
                        </p>
                        <div>
                            <strong>Xavier</strong>
                            <div style="color: var(--text-muted);">SMA N 79 Jakarta</div>
                        </div>
                    </article>
                    <article class="testimonial-card">
                        <p>
                            “Laporan belajarnya detail sehingga saya bisa memantau perkembangan anak. Jadwal
                            juga fleksibel menyesuaikan kebutuhan kami.”
                        </p>
                        <div>
                            <strong>Lisa</strong>
                            <div style="color: var(--text-muted);">Orang tua siswa</div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section faq" id="faq">
            <div class="container">
                <div class="section-header" style="text-align: center; max-width: 720px; margin: 0 auto 48px;">
                    <span class="pill">Pertanyaan Umum</span>
                    <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
                    <p class="section-subtitle">
                        Temukan jawaban dari beberapa pertanyaan yang sering kami terima dari siswa dan orang
                        tua terkait layanan MayClass.
                    </p>
                </div>
                <div class="faq-list">
                    <details>
                        <summary>Apakah tersedia bimbingan secara online?</summary>
                        <p>
                            Ya, MayClass menyediakan layanan online dan tatap muka. Jadwal dan metode bisa Anda
                            pilih sesuai preferensi.
                        </p>
                    </details>
                    <details>
                        <summary>Bagaimana sistem penjadwalan kelasnya?</summary>
                        <p>
                            Penjadwalan dapat disesuaikan dengan kebutuhan siswa. Admin kami membantu memastikan
                            koordinasi antara siswa dan tentor.
                        </p>
                    </details>
                    <details>
                        <summary>Apakah bisa pindah jadwal jika ada hal mendadak?</summary>
                        <p>
                            Tentu, cukup hubungi admin kami untuk melakukan penjadwalan ulang minimal 24 jam
                            sebelum kelas dimulai.
                        </p>
                    </details>
                    <details>
                        <summary>Bagaimana metode belajar yang digunakan?</summary>
                        <p>
                            Kami menggunakan pendekatan blended learning dengan kombinasi live class, modul
                            interaktif, dan sesi konsultasi personal.
                        </p>
                    </details>
                </div>
            </div>
        </section>

        <footer id="kontak">
            <div class="container">
                <div class="top">
                    <div>
                        <div class="logo" style="color: #fff;">
                            <div class="logo-icon" style="background: rgba(255, 255, 255, 0.12); color: #fff; box-shadow: none;">MC</div>
                            MayClass
                        </div>
                        <p style="margin-top: 16px; color: rgba(255, 255, 255, 0.65);">
                            Langkah pasti menuju prestasi dengan MayClass. Solusi bimbingan belajar modern yang
                            mendukung siswa, tentor, dan admin dalam satu platform.
                        </p>
                    </div>
                    <div>
                        <h5>Company</h5>
                        <ul>
                            <li><a href="#tentang">Tentang</a></li>
                            <li><a href="#program">Program</a></li>
                            <li><a href="#testimoni">Testimoni</a></li>
                            <li><a href="#faq">FAQ</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5>Support</h5>
                        <ul>
                            <li><a href="#kontak">Hubungi kami</a></li>
                            <li><a href="#">Ketentuan layanan</a></li>
                            <li><a href="#">Kebijakan privasi</a></li>
                            <li><a href="#">Karier</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5>Stay up to date</h5>
                        <form class="newsletter">
                            <input type="email" placeholder="Email kamu" aria-label="Email" />
                            <button class="btn btn-primary" type="submit">Berlangganan</button>
                        </form>
                    </div>
                </div>
                <div class="footer-bottom">
                    <span>© {{ date('Y') }} MayClass. All rights reserved.</span>
                    <div style="display: flex; gap: 12px;">
                        <span class="badge">IG</span>
                        <span class="badge">YT</span>
                        <span class="badge">FB</span>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
