<!DOCTYPE html>
<html lang="id" data-page="dashboard">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Beranda Siswa - MayClass</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
        <style>
            :root {
                --primary: #3db7ad;
                --primary-dark: #2c938b;
                --accent: #5f6af8;
                --sunrise: #f9b233;
                --night: #1f2a37;
                --text-muted: #6b7280;
                --bg-soft: #f3fbfb;
                --card: #ffffff;
                --page-padding: clamp(16px, 3vw, 40px);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: linear-gradient(180deg, #eff9f8 0%, #ffffff 40%);
                color: var(--night);
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
                margin: 0;
                padding: 0;
            }

            nav {
                background: var(--card);
                border-radius: 20px;
                padding: 18px var(--page-padding);
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

            .nav-links a {
                position: relative;
                padding-bottom: 4px;
            }

            .nav-links a[data-active="true"] {
                color: var(--primary-dark);
                font-weight: 600;
            }

            .nav-links a[data-active="true"]::after {
                content: "";
                position: absolute;
                left: 0;
                right: 0;
                bottom: -8px;
                height: 4px;
                border-radius: 999px;
                background: linear-gradient(120deg, var(--primary), var(--accent));
            }

            .nav-actions {
                display: inline-flex;
                align-items: center;
                gap: 16px;
            }

            .nav-actions form {
                margin: 0;
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

            .logout-button {
                padding: 10px 18px;
                border-radius: 999px;
                border: 1px solid rgba(61, 183, 173, 0.25);
                background: rgba(61, 183, 173, 0.12);
                color: var(--primary-dark);
                font-weight: 600;
            }

            .logout-button:hover {
                background: rgba(44, 147, 139, 0.2);
                border-color: rgba(44, 147, 139, 0.3);
            }

            main {
                padding: 48px var(--page-padding) 80px;
                display: grid;
                gap: 48px;
            }

            .hero {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 36px;
                align-items: center;
            }

            .hero h1 {
                margin: 0 0 18px;
                font-size: clamp(2.1rem, 3.6vw, 3rem);
                line-height: 1.2;
            }

            .hero p {
                margin: 0 0 28px;
                color: var(--text-muted);
                max-width: 520px;
            }

            .hero-cta {
                display: inline-flex;
                align-items: center;
                gap: 12px;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 14px 28px;
                border-radius: 999px;
                font-weight: 500;
                border: 1px solid transparent;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--primary) 0%, #58d2c5 100%);
                color: #ffffff;
                box-shadow: 0 20px 40px rgba(61, 183, 173, 0.28);
            }

            .btn-outline {
                background: rgba(61, 183, 173, 0.1);
                color: var(--primary-dark);
                border-color: rgba(61, 183, 173, 0.25);
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            .hero-visual {
                position: relative;
                background: linear-gradient(150deg, rgba(61, 183, 173, 0.18), rgba(95, 106, 248, 0.15));
                border-radius: 28px;
                padding: 32px;
                min-height: 280px;
                box-shadow: 0 32px 68px rgba(32, 96, 92, 0.12);
                overflow: hidden;
            }

            .hero-visual::after {
                content: "";
                position: absolute;
                inset: 0;
                background: url("{{ \App\Support\ImageRepository::url('dashboard_banner') }}") center/cover;
                opacity: 0.32;
            }

            .hero-visual-inner {
                position: relative;
                display: grid;
                gap: 16px;
                color: #ffffff;
            }

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 16px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.2);
                font-size: 0.85rem;
                width: max-content;
            }

            .schedule-grid {
                display: grid;
                gap: 28px;
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .schedule-card {
                background: var(--card);
                border-radius: 24px;
                padding: 24px;
                display: grid;
                gap: 12px;
                box-shadow: 0 28px 60px rgba(45, 133, 126, 0.12);
            }

            .schedule-card h3 {
                margin: 0;
                font-size: 1.15rem;
            }

            .schedule-card span {
                color: var(--text-muted);
                font-size: 0.9rem;
            }

            .materials {
                display: grid;
                gap: 24px;
            }

            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
            }

            .cards-row {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 24px;
            }

            .material-card {
                background: var(--card);
                padding: 24px;
                border-radius: 24px;
                display: grid;
                gap: 14px;
                box-shadow: 0 24px 48px rgba(95, 106, 248, 0.12);
                border-top: 5px solid rgba(95, 106, 248, 0.3);
            }

            .material-card h4 {
                margin: 0;
                font-size: 1.1rem;
            }

            .material-card p {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.92rem;
            }

            .status-card {
                background: linear-gradient(140deg, rgba(61, 183, 173, 0.18), rgba(95, 106, 248, 0.18));
                border-radius: 24px;
                padding: 28px;
                color: var(--night);
                display: grid;
                gap: 12px;
            }

            .status-card h3 {
                margin: 0;
                font-size: 1.2rem;
            }

            footer {
                padding: 32px var(--page-padding) 48px;
                text-align: center;
                color: var(--text-muted);
                font-size: 0.85rem;
            }

            @media (max-width: 960px) {
                nav {
                    flex-wrap: wrap;
                    gap: 16px 24px;
                }

                .hero,
                .cards-row,
                .schedule-grid {
                    grid-template-columns: 1fr;
                }

                .hero-visual {
                    min-height: 220px;
                }
            }
        </style>
    </head>
    <body>
        @php($materialsLink = config('mayclass.links.materials_drive'))
        @php($quizLink = config('mayclass.links.quiz_platform'))
        <header>
            <div class="container">
                <nav>
                    <a href="{{ route('student.dashboard') }}" class="brand">
                        <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="Logo MayClass" />
                    </a>
                    <div class="nav-links">
                        <a href="{{ route('student.dashboard') }}" data-active="true">Beranda</a>
                        <a href="{{ route('student.materials') }}">Materi</a>
                        <a href="{{ route('student.quiz') }}">Quiz</a>
                        <a href="{{ route('student.schedule') }}">Jadwal</a>
                    </div>
                    <div class="nav-actions">
                        <a class="profile-chip" href="{{ route('student.profile') }}">
                            <span>👋</span>
                            <span>Siswa</span>
                        </a>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-button">Keluar</button>
                        </form>
                    </div>
                </nav>
            </div>
        </header>
        <main class="container">
            <section class="hero">
                <div>
                    <div class="badge">Jadwal Terdekat</div>
                    <h1>Siap menjadi juara?</h1>
                    <p>
                        Pelajari materi TWK, TIU, dan TKP dengan struktur yang terorganisir serta mentor profesional.
                        Mulai dari jadwal live class hingga bank soal adaptif, semuanya ada dalam satu dashboard.
                    </p>
                    <div class="hero-cta">
                        <a class="btn btn-primary" href="{{ $materialsLink }}" target="_blank" rel="noopener">Mulai Belajar</a>
                        <a class="btn btn-outline" href="{{ route('student.schedule') }}">Lihat Jadwal</a>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="hero-visual-inner">
                        <div class="badge">{{ $schedule['highlight']['category'] }}</div>
                        <h3 style="margin: 0; font-size: 1.5rem;">{{ $schedule['highlight']['title'] }}</h3>
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.85);">
                            {{ $schedule['highlight']['date'] }} · {{ $schedule['highlight']['time'] }}
                        </p>
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.7);">Mentor: {{ $schedule['highlight']['mentor'] }}</p>
                    </div>
                </div>
            </section>

            <section class="schedule">
                <div class="section-header">
                    <h2 style="margin: 0; font-size: 1.4rem;">Jadwal Terdekat</h2>
                    <a class="btn btn-outline" href="{{ route('student.schedule') }}">Lihat Semua</a>
                </div>
                <div class="schedule-grid">
                    @foreach ($schedule['upcoming'] as $session)
                        <article class="schedule-card">
                            <div class="badge" style="background: rgba(61, 183, 173, 0.12); color: var(--primary-dark);">
                                {{ $session['category'] }}
                            </div>
                            <h3>{{ $session['title'] }}</h3>
                            <span>{{ $session['date'] }}</span>
                            <span>{{ $session['time'] }}</span>
                            <span>Mentor: {{ $session['mentor'] }}</span>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="materials">
                <div class="section-header">
                    <h2 style="margin: 0; font-size: 1.4rem;">Materi Terbaru</h2>
                    <a class="btn btn-outline" href="{{ $materialsLink }}" target="_blank" rel="noopener">Lihat Materi</a>
                </div>
                <div class="cards-row">
                    @foreach ($recentMaterials as $material)
                        <article class="material-card">
                            <div class="badge" style="background: rgba(95, 106, 248, 0.12); color: var(--accent);">
                                {{ $material['subject'] }}
                            </div>
                            <h4>{{ $material['title'] }}</h4>
                            <p>{{ $material['summary'] }}</p>
                            <div style="display: flex; gap: 12px;">
                                <a class="btn btn-primary" style="padding: 12px 20px; font-size: 0.9rem;" href="{{ $materialsLink }}" target="_blank" rel="noopener">
                                    Lihat Materi
                                </a>
                                <a class="btn btn-outline" style="padding: 12px 20px; font-size: 0.9rem;" href="{{ $quizLink }}" target="_blank" rel="noopener">
                                    Mulai Quiz
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="status-card">
                <h3>Paket Aktif</h3>
                <p style="margin: 0; color: rgba(31, 42, 55, 0.78);">{{ $activePackage['title'] }}</p>
                <p style="margin: 0; color: rgba(31, 42, 55, 0.6);">{{ $activePackage['period'] }}</p>
                <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 8px;">
                    <span class="badge" style="background: rgba(255, 255, 255, 0.35); color: var(--primary-dark);">
                        Status: {{ $activePackage['status'] }}
                    </span>
                    <a class="btn btn-primary" style="padding: 12px 24px; font-size: 0.9rem;" href="{{ route('student.profile') }}">
                        Kelola Profil
                    </a>
                </div>
            </section>
        </main>
        <footer>© {{ now()->year }} MayClass. Semua hak dilindungi.</footer>
    </body>
</html>
