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

            .page {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .shell {
                width: min(1120px, 100%);
                margin: 0 auto;
                padding: 0 28px;
            }

            header {
                background: #e6f6f1;
                padding: 28px 0 64px;
            }

            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
                padding-bottom: 32px;
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
                gap: 20px;
                font-size: 0.95rem;
                color: var(--text-muted);
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
                display: grid;
                grid-template-columns: repeat(12, 1fr);
                align-items: center;
                gap: 32px;
            }

            .hero-copy {
                grid-column: span 7;
                display: flex;
                flex-direction: column;
                gap: 24px;
            }

            .hero-eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 16px;
                border-radius: 999px;
                background: rgba(61, 183, 173, 0.12);
                color: var(--primary-strong);
                font-size: 0.85rem;
                font-weight: 500;
            }

            .hero h1 {
                margin: 0;
                font-size: clamp(2.25rem, 5vw, 3.2rem);
                line-height: 1.15;
            }

            .hero p {
                margin: 0;
                font-size: 1.05rem;
                color: var(--text-muted);
                max-width: 520px;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 14px;
            }

            .hero-illustration {
                grid-column: span 5;
                position: relative;
                display: flex;
                justify-content: center;
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

            .hero-points {
                display: grid;
                gap: 16px;
            }

            .point {
                display: grid;
                grid-template-columns: auto 1fr;
                gap: 12px;
                align-items: start;
                font-size: 0.95rem;
                color: var(--text-muted);
            }

            .point-icon {
                width: 36px;
                height: 36px;
                border-radius: 12px;
                background: var(--surface-soft);
                display: grid;
                place-items: center;
                color: var(--primary-strong);
                font-size: 1.1rem;
                font-weight: 600;
            }

            .stats {
                margin-top: 40px;
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 18px;
            }

            .stat-card {
                background: var(--surface);
                border-radius: 16px;
                padding: 22px;
                border: 1px solid var(--border);
                text-align: center;
                display: grid;
                gap: 6px;
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

            .slider-button:hover {
                background: rgba(61, 183, 173, 0.25);
            }

            .slider-dots {
                display: flex;
                align-items: center;
                gap: 8px;
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
                    justify-content: flex-start;
                }

                .hero {
                    grid-template-columns: 1fr;
                }

                .hero-copy,
                .hero-illustration {
                    grid-column: span 1;
                }

                .hero-card {
                    margin: 0 auto;
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
        <div class="page">
            <header>
                <div class="shell">
                    <nav>
                        <a class="brand" href="#">
                            <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="MayClass" />
                            MayClass
                        </a>
                        <div class="nav-links">
                            <a href="#layanan">Layanan</a>
                            <a href="#tentang">Tentang</a>
                            <a href="#testimoni">Testimoni</a>
                            <a href="#tentor">Tentor</a>
                        </div>
                        <div class="nav-links">
                            <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                        </div>
                    </nav>

                    <div class="hero">
                        <div class="hero-copy">
                            <span class="hero-eyebrow">Bimbingan privat yang menyenangkan</span>
                            <h1>Bersama MayClass, belajar makin fokus dan terarah.</h1>
                            <p>
                                MayClass membantu siswa menaklukkan UTBK-SNBT dan ujian sekolah lewat pendampingan tutor
                                pilihan, modul terstruktur, serta pemantauan progres yang nyata.
                            </p>
                            <div class="hero-actions">
                                <a class="btn btn-primary" href="{{ route('packages.index') }}">Lihat Paket Belajar</a>
                                <a class="btn btn-outline" href="#tentang">Pelajari MayClass</a>
                            </div>
                        </div>
                        <div class="hero-illustration">
                            <div class="hero-card">
                                <h3>Kenapa siswa suka MayClass?</h3>
                                <div class="hero-points">
                                    <div class="point">
                                        <span class="point-icon">A</span>
                                        <span>Rencana belajar adaptif sesuai target kampus impianmu.</span>
                                    </div>
                                    <div class="point">
                                        <span class="point-icon">Q</span>
                                        <span>Bank soal premium dan pembahasan lengkap tiap pekan.</span>
                                    </div>
                                    <div class="point">
                                        <span class="point-icon">🧑‍🏫</span>
                                        <span>Tutor berpengalaman siap mendampingi sampai lolos seleksi.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stats" id="layanan">
                        <div class="stat-card">
                            <strong>1500+</strong>
                            <span>Siswa aktif yang belajar bersama mentor MayClass.</span>
                        </div>
                        <div class="stat-card">
                            <strong>92%</strong>
                            <span>Peserta menyelesaikan program dengan peningkatan nilai signifikan.</span>
                        </div>
                        <div class="stat-card">
                            <strong>30+</strong>
                            <span>Materi tematik dan modul eksklusif siap pakai.</span>
                        </div>
                        <div class="stat-card">
                            <strong>24/7</strong>
                            <span>Monitoring dan konsultasi belajar kapan pun dibutuhkan.</span>
                        </div>
                    </div>
                </div>
            </header>

            <main>
                <section id="tentang">
                    <div class="shell">
                        <div class="section-header">
                            <h2>Tentang MayClass</h2>
                            <p>
                                Kami hadir sebagai partner belajar yang sederhana namun berdampak: fokus pada kebutuhanmu,
                                nyaman dijalani, dan konsisten mengantar kamu ke gerbang kampus impian.
                            </p>
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
                </section>

                <section id="testimoni" style="background: var(--surface-soft);">
                    <div class="shell">
                        <div class="section-header">
                            <h2>Kata Mereka</h2>
                            <p>Testimoni tulus dari siswa yang telah merasakan dampak nyata MayClass.</p>
                        </div>
                        <div class="slider" data-slider="testimonials">
                            <div class="slider-track">
                                <div class="slide">
                                    <div class="card">
                                        <p>
                                            “Modulnya ringkas tapi mengena. Mentor aku bantu breakdown soal-soal sulit jadi sederhana,
                                            hasilnya nilai try out naik drastis.”
                                        </p>
                                        <strong>Amelia • SMA Negeri 8</strong>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="card">
                                        <p>
                                            “Coaching mingguan bikin aku disiplin. Mentor MayClass benar-benar peduli dan siap bantu kapan
                                            aja.”
                                        </p>
                                        <strong>Rafi • Alumni SNBT 2024</strong>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="card">
                                        <p>
                                            “Simulasi ujiannya mirip seleksi asli. Aku jadi lebih tenang saat hari H karena sudah terbiasa.”
                                        </p>
                                        <strong>Dinda • Fakultas Kedokteran UNDIP</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-controls">
                                <button class="slider-button" data-action="prev" aria-label="Sebelumnya">&#10094;</button>
                                <div class="slider-dots" role="tablist"></div>
                                <button class="slider-button" data-action="next" aria-label="Berikutnya">&#10095;</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="tentor">
                    <div class="shell">
                        <div class="section-header">
                            <h2>Temui Para Tentor</h2>
                            <p>Pakar di bidangnya, ramah, dan siap mendampingi belajarmu dari awal hingga lolos.</p>
                        </div>
                        <div class="slider" data-slider="mentors">
                            <div class="slider-track">
                                <div class="slide">
                                    <div class="card">
                                        <strong>Nadya Putri</strong>
                                        <p>Spesialis Literasi &amp; Bahasa. Alumni Pendidikan Bahasa UI.</p>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="card">
                                        <strong>Fahri Nugraha</strong>
                                        <p>Pakar Numerasi dan Logika. Pengajar favorit SNBT bidang Saintek.</p>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="card">
                                        <strong>Imelda Astari</strong>
                                        <p>Mentor Psikotes &amp; Kesiapan Mental. Pengalaman 7 tahun mendampingi siswa.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-controls">
                                <button class="slider-button" data-action="prev" aria-label="Sebelumnya">&#10094;</button>
                                <div class="slider-dots" role="tablist"></div>
                                <button class="slider-button" data-action="next" aria-label="Berikutnya">&#10095;</button>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer>
                <div class="shell">
                    <div class="footer-inner">
                        <div class="footer-links">
                            <a href="#layanan">Program</a>
                            <a href="#tentang">Tentang</a>
                            <a href="#testimoni">Testimoni</a>
                            <a href="https://instagram.com/mayclass.id" target="_blank" rel="noreferrer">@mayclass.id</a>
                            <a href="mailto:hello@mayclass.id">hello@mayclass.id</a>
                        </div>
                        <div class="footer-meta">© {{ date('Y') }} MayClass. Semua hak cipta dilindungi.</div>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            function initSlider(root) {
                const track = root.querySelector('.slider-track');
                const slides = Array.from(track.children);
                const prevBtn = root.querySelector('[data-action="prev"]');
                const nextBtn = root.querySelector('[data-action="next"]');
                const dotsContainer = root.querySelector('.slider-dots');
                let index = 0;

                function renderDots() {
                    dotsContainer.innerHTML = '';
                    slides.forEach((_, idx) => {
                        const dot = document.createElement('button');
                        dot.className = 'slider-dot';
                        dot.type = 'button';
                        dot.setAttribute('aria-label', `Slide ${idx + 1}`);
                        if (idx === index) {
                            dot.setAttribute('aria-current', 'true');
                        }
                        dot.addEventListener('click', () => {
                            index = idx;
                            update();
                        });
                        dotsContainer.appendChild(dot);
                    });
                }

                function update() {
                    const offset = -index * 100;
                    track.style.transform = `translateX(${offset}%)`;
                    renderDots();
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
