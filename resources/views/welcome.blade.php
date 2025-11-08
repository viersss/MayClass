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
                --primary-strong: #28978e;
                --text-dark: #16253d;
                --text-muted: #5e6a80;
                --surface: #ffffff;
                --surface-soft: #f2faf7;
                --border: rgba(40, 151, 142, 0.18);
                --shadow: 0 18px 40px rgba(27, 80, 90, 0.08);
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
                width: 100%;
                max-width: 1180px;
                margin: 0 auto;
                padding: 0 24px;
            }

            header {
                background: linear-gradient(135deg, #f5fbfb 0%, #eaf6ff 50%, #f5f0ff 100%);
                border-bottom-left-radius: 160px;
                overflow: hidden;
            }

            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 32px;
                padding: 28px 0;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 14px;
                font-weight: 600;
                font-size: 1.2rem;
                color: var(--primary-strong);
            }

            .brand img {
                width: 46px;
                height: 46px;
                object-fit: contain;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 28px;
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
                gap: 16px;
            }

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
                color: var(--primary-strong);
            }

            .btn-outline:hover {
                border-color: var(--primary-strong);
                background: rgba(61, 183, 173, 0.16);
            }

            .btn-primary {
                background: var(--primary);
                color: #ffffff;
                box-shadow: 0 14px 32px rgba(61, 183, 173, 0.28);
            }

            .btn-primary:hover {
                filter: brightness(0.95);
                transform: translateY(-1px);
            }

            .hero {
                position: relative;
                isolation: isolate;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                align-items: center;
                gap: 56px;
                padding: 40px 0 80px;
            }

            .hero h1 {
                margin: 0;
                font-size: clamp(2.25rem, 5vw, 3.2rem);
                line-height: 1.15;
                margin: 20px 0 18px;
            }

            .hero p {
                max-width: 560px;
                color: var(--text-muted);
                margin-bottom: 34px;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                margin-bottom: 36px;
            }

            .hero-illustration {
                grid-column: span 5;
                position: relative;
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }

            .hero-card {
                background: var(--surface);
                border-radius: 20px;
                padding: 32px;
                box-shadow: var(--shadow);
                display: grid;
                gap: 22px;
                width: min(360px, 100%);
            }

            .hero-card h3 {
                margin: 0;
                font-size: 1.35rem;
            }

            .hero-art {
                position: relative;
            }

            .hero-art::after {
                content: "";
                position: absolute;
                inset: 12% 10% 0 0;
                border-radius: 32px;
                background: rgba(111, 93, 246, 0.12);
                filter: blur(0);
                z-index: 0;
            }

            .hero-art img {
                position: relative;
                z-index: 1;
                border-radius: 32px;
                box-shadow: 0 28px 52px rgba(31, 42, 55, 0.18);
            }

            .stat-card strong {
                font-size: 1.4rem;
                color: var(--primary-strong);
            }

            section {
                padding: 88px 0;
            }

            .section-header {
                text-align: center;
                margin-bottom: 48px;
                display: grid;
                gap: 12px;
            }

            .section-header h2 {
                margin: 0;
                font-size: clamp(2rem, 4vw, 2.6rem);
            }

            .section-header p {
                margin: 0;
                color: var(--text-muted);
                font-size: 1rem;
            }

            .feature-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 20px;
            }

            .feature-card {
                background: var(--surface);
                border-radius: 18px;
                padding: 24px;
                border: 1px solid var(--border);
                display: grid;
                gap: 14px;
            }

            .feature-card h3 {
                margin: 0;
                font-size: 1.1rem;
            }

            .feature-card p {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.95rem;
            }

            .slider {
                position: relative;
                overflow: hidden;
            }

            .slider-track {
                display: flex;
                transition: transform 0.4s ease;
            }

            .slide {
                flex: 0 0 100%;
                padding: 0 12px;
            }

            .card {
                background: var(--surface);
                border-radius: 20px;
                padding: 32px;
                border: 1px solid var(--border);
                box-shadow: var(--shadow);
                min-height: 240px;
                display: grid;
                gap: 18px;
            }

            .card p {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.98rem;
            }

            .card strong {
                font-size: 1.05rem;
            }

            .slider-controls {
                margin-top: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 14px;
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
                transition: background 0.2s ease;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 32px;
                margin-bottom: 40px;
            }

            .slider-dot {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: rgba(61, 183, 173, 0.25);
                border: none;
                cursor: pointer;
            }

            .slider-dot[aria-current="true"] {
                background: var(--primary-strong);
            }

            footer {
                background: #e6f6f1;
                padding: 40px 0;
                margin-top: auto;
            }

            .footer-inner {
                display: flex;
                flex-direction: column;
                gap: 18px;
                text-align: center;
            }

            .footer-links {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 18px 28px;
                color: var(--text-muted);
                font-size: 0.95rem;
            }

            .footer-meta {
                font-size: 0.85rem;
                color: #6f7b8f;
            }

            @media (max-width: 960px) {
                nav {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .nav-links {
                    flex-wrap: wrap;
                    justify-content: center;
                    text-align: center;
                }

                .hero {
                    grid-template-columns: 1fr;
                    text-align: center;
                }

                .hero p,
                .section-header {
                    margin-left: auto;
                    margin-right: auto;
                }

                .stats {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 640px) {
                .shell {
                    padding: 0 20px;
                }

                header {
                    padding: 24px 0 48px;
                }

                nav {
                    gap: 18px;
                }

                .hero-actions {
                    width: 100%;
                }

                .hero-actions .btn {
                    flex: 1;
                    justify-content: center;
                }

                .stats {
                    grid-template-columns: 1fr;
                }

                section {
                    padding: 68px 0;
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
                    <div>
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
                        <div class="feature-grid">
                            <div class="feature-card">
                                <h3>Pembelajaran Privat</h3>
                                <p>Belajar intensif dengan jadwal fleksibel menyesuaikan rutinitasmu.</p>
                            </div>
                            <div class="feature-card">
                                <h3>Modul Ringkas</h3>
                                <p>Materi ringkas dan mudah dipahami, lengkap dengan latihan terarah.</p>
                            </div>
                            <div class="feature-card">
                                <h3>Progress Tracker</h3>
                                <p>Setiap capaian tercatat rapi sehingga tutor dan siswa selalu selaras.</p>
                            </div>
                            <div class="feature-card">
                                <h3>Komunitas Supportif</h3>
                                <p>Temui teman seperjuangan dan mentor inspiratif dalam satu ekosistem.</p>
                            </div>
                        </div>
                    </div>
                    <div class="hero-art">
                        <img src="{{ \App\Support\ImageRepository::url('hero') }}" alt="Ilustrasi siswa belajar" />
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
                    <div class="slider-controls" aria-hidden="true">
                        <button type="button" data-slider-prev>&larr;</button>
                        <button type="button" data-slider-next>&rarr;</button>
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
                    <div class="slider-controls" aria-hidden="true">
                        <button type="button" data-slider-prev>&larr;</button>
                        <button type="button" data-slider-next>&rarr;</button>
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
