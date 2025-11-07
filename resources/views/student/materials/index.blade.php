<!DOCTYPE html>
<html lang="id" data-page="materials">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Materi Pembelajaran - MayClass</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                --primary: #3db7ad;
                --primary-dark: #2c938b;
                --accent: #5f6af8;
                --text-dark: #1f2a37;
                --text-muted: #6b7280;
                --card: #ffffff;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: linear-gradient(180deg, #eff9f8 0%, #ffffff 40%);
                color: var(--text-dark);
                min-height: 100vh;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            header {
                padding: 28px 0 0;
            }

            .container {
                width: 100%;
                max-width: 1180px;
                margin: 0 auto;
                padding: 0 24px;
            }

            nav {
                background: var(--card);
                border-radius: 20px;
                padding: 18px 26px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: 0 24px 60px rgba(45, 133, 126, 0.12);
                gap: 24px;
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                font-weight: 600;
                font-size: 1.1rem;
                color: var(--primary-dark);
            }

            .brand img {
                width: 40px;
                height: 40px;
                object-fit: contain;
            }

            .nav-links {
                display: flex;
                gap: 28px;
                align-items: center;
                font-size: 0.95rem;
                color: var(--text-muted);
            }

            .nav-links a[data-active="true"] {
                color: var(--primary-dark);
                font-weight: 600;
            }

            .nav-links a[data-active="true"]::after {
                content: "";
                display: block;
                height: 4px;
                border-radius: 999px;
                margin-top: 8px;
                background: linear-gradient(120deg, var(--primary), var(--accent));
            }

            .profile-chip {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                padding: 10px 16px;
                border-radius: 999px;
                background: rgba(61, 183, 173, 0.12);
                font-size: 0.9rem;
                color: var(--primary-dark);
            }

            main {
                padding: 48px 0 80px;
                display: grid;
                gap: 48px;
            }

            .hero {
                background: linear-gradient(140deg, rgba(61, 183, 173, 0.18), rgba(95, 106, 248, 0.18));
                border-radius: 32px;
                padding: clamp(32px, 5vw, 56px);
                display: flex;
                flex-direction: column;
                gap: 18px;
                box-shadow: 0 32px 68px rgba(32, 96, 92, 0.12);
            }

            .hero h1 {
                margin: 0;
                font-size: clamp(2rem, 3vw, 2.8rem);
            }

            .hero p {
                margin: 0;
                color: rgba(31, 42, 55, 0.78);
            }

            .hero-actions {
                display: flex;
                gap: 16px;
                flex-wrap: wrap;
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
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--primary) 0%, #58d2c5 100%);
                color: #ffffff;
                box-shadow: 0 20px 40px rgba(61, 183, 173, 0.28);
            }

            .btn-outline {
                background: rgba(61, 183, 173, 0.08);
                border-color: rgba(61, 183, 173, 0.22);
                color: var(--primary-dark);
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            .collection {
                background: var(--card);
                border-radius: 28px;
                padding: 32px;
                box-shadow: 0 28px 60px rgba(45, 133, 126, 0.12);
                display: grid;
                gap: 24px;
            }

            .collection-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            }

            .collection-header h2 {
                margin: 0;
                font-size: 1.4rem;
            }

            .cards-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 24px;
            }

            .material-card {
                border-radius: 24px;
                padding: 24px;
                display: grid;
                gap: 14px;
                background: rgba(61, 183, 173, 0.08);
                position: relative;
                overflow: hidden;
            }

            .material-card::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(140deg, rgba(255, 255, 255, 0.4), transparent 60%);
                pointer-events: none;
            }

            .material-card h3 {
                margin: 0;
                font-size: 1.15rem;
            }

            .material-card p {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.92rem;
            }

            .material-card .badge {
                display: inline-flex;
                padding: 6px 14px;
                border-radius: 999px;
                font-size: 0.8rem;
                font-weight: 500;
                background: rgba(255, 255, 255, 0.55);
                width: max-content;
            }

            .material-card .actions {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
            }

            footer {
                padding: 32px 0 48px;
                text-align: center;
                color: var(--text-muted);
                font-size: 0.85rem;
            }

            @media (max-width: 1024px) {
                .cards-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 640px) {
                .cards-grid {
                    grid-template-columns: repeat(1, minmax(0, 1fr));
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <a href="{{ route('student.dashboard') }}" class="brand">
                        <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="Logo MayClass" />
                    </a>
                    <div class="nav-links">
                        <a href="{{ route('student.dashboard') }}">Beranda</a>
                        <a href="{{ route('student.materials') }}" data-active="true">Materi</a>
                        <a href="{{ route('student.quiz') }}">Quiz</a>
                        <a href="{{ route('student.schedule') }}">Jadwal</a>
                    </div>
                    <a class="profile-chip" href="{{ route('student.profile') }}">
                        <span>👋</span>
                        <span>Siswa</span>
                    </a>
                </nav>
            </div>
        </header>
        <main class="container">
            <section class="hero">
                <h1>Mulai Belajar</h1>
                <p>
                    Materi terkurasi dan menyenangkan untuk semua jenjang, mulai dari SD, SMP, SMA, dan pejuang seleksi.
                    Konsol materi kami tersusun agar TWK, TIU, dan TKP dipahami dengan metode yang mudah.
                </p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="#collections">Lihat Materi</a>
                    <a class="btn btn-outline" href="{{ route('student.dashboard') }}">Kembali ke Beranda</a>
                </div>
            </section>

            <section id="collections" style="display: grid; gap: 32px;">
                @foreach ($collections as $collection)
                    <article class="collection">
                        <div class="collection-header">
                            <h2>{{ $collection['label'] }}</h2>
                            <a class="btn btn-outline" href="{{ route('student.quiz') }}">Mulai Quiz</a>
                        </div>
                        <div class="cards-grid">
                            @foreach ($collection['items'] as $material)
                                <div class="material-card" style="background: linear-gradient(150deg, {{ $collection['accent'] }}22, rgba(255, 255, 255, 0.85));">
                                    <span class="badge">{{ $material['level'] }}</span>
                                    <h3>{{ $material['title'] }}</h3>
                                    <p>{{ $material['summary'] }}</p>
                                    <div class="actions">
                                        <a class="btn btn-primary" style="padding: 10px 20px; font-size: 0.9rem;" href="{{ route('student.materials.show', $material['slug']) }}">
                                            Lihat Materi
                                        </a>
                                        <a class="btn btn-outline" style="padding: 10px 20px; font-size: 0.9rem;" href="{{ route('student.quiz.show', $material['slug']) }}">
                                            Lihat Bank Soal
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </section>
        </main>
        <footer>© {{ now()->year }} MayClass. Materi diperbarui setiap pekan.</footer>
    </body>
</html>
