<!DOCTYPE html>
<html lang="id" data-page="quiz-detail">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $quiz['title'] }} | MayClass</title>
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
                --text-dark: #1f2a37;
                --text-muted: #6b7280;
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
                background: linear-gradient(150deg, rgba(61, 183, 173, 0.18), rgba(31, 42, 55, 0.75));
                border-radius: 32px;
                padding: clamp(32px, 5vw, 56px);
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 32px;
                align-items: center;
                color: #ffffff;
                position: relative;
                overflow: hidden;
            }

            .hero::after {
                content: "";
                position: absolute;
                inset: 0;
                background: url('{{ $quiz['thumbnail'] }}') center/cover;
                opacity: 0.28;
                pointer-events: none;
            }

            .hero > * {
                position: relative;
            }

            .hero h1 {
                margin: 0 0 16px;
                font-size: clamp(2rem, 3vw, 2.8rem);
            }

            .hero p {
                margin: 0 0 24px;
                color: rgba(255, 255, 255, 0.8);
            }

            .hero .meta {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.85);
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
                background: rgba(255, 255, 255, 0.12);
                border-color: rgba(255, 255, 255, 0.35);
                color: #ffffff;
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            .content-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 32px;
            }

            .card {
                background: var(--card);
                border-radius: 28px;
                padding: 28px;
                box-shadow: 0 28px 60px rgba(45, 133, 126, 0.12);
                display: grid;
                gap: 18px;
            }

            .card h2 {
                margin: 0;
                font-size: 1.4rem;
            }

            .list {
                display: grid;
                gap: 12px;
                color: var(--text-muted);
            }

            .list-item {
                display: flex;
                gap: 12px;
                align-items: flex-start;
            }

            .list-item span {
                display: grid;
                place-items: center;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: rgba(61, 183, 173, 0.12);
                color: var(--primary-dark);
                font-size: 0.85rem;
                flex-shrink: 0;
            }

            footer {
                padding: 32px var(--page-padding) 48px;
                text-align: center;
                color: var(--text-muted);
                font-size: 0.85rem;
            }

            @media (max-width: 960px) {
                .hero,
                .content-grid {
                    grid-template-columns: 1fr;
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
                        <a href="{{ route('student.materials') }}">Materi</a>
                        <a href="{{ route('student.quiz') }}" data-active="true">Quiz</a>
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
                    <span style="display: inline-flex; padding: 6px 16px; border-radius: 999px; background: rgba(255, 255, 255, 0.18); color: #ffffff; font-size: 0.85rem;">{{ $quiz['subject'] }}</span>
                    <h1>{{ $quiz['title'] }}</h1>
                    <p>{{ $quiz['summary'] }}</p>
                    <div class="meta">
                        <span>Durasi {{ $quiz['duration'] }}</span>
                        <span>{{ $quiz['questions'] }} Soal</span>
                        @foreach ($quiz['levels'] as $level)
                            <span>Level {{ $level }}</span>
                        @endforeach
                    </div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 16px;">
                        <a class="btn btn-primary" href="{{ config('mayclass.links.quiz_platform') }}" target="_blank" rel="noopener">Mulai di Wayground</a>
                        <a class="btn btn-outline" href="{{ route('student.quiz') }}">Kembali ke Quiz</a>
                    </div>
                </div>
                <div></div>
            </section>

            <section class="content-grid" id="detail">
                <article class="card">
                    <h2>Kenapa Ikuti Quiz Ini?</h2>
                    <div class="list">
                        @foreach ($quiz['takeaways'] as $takeaway)
                            <div class="list-item">
                                <span>⭐</span>
                                <p style="margin: 0;">{{ $takeaway }}</p>
                            </div>
                        @endforeach
                    </div>
                </article>
                <article class="card">
                    <h2>Persiapan &amp; Panduan</h2>
                    <div class="list">
                        <div class="list-item">
                            <span>📝</span>
                            <div>
                                <p style="margin: 0; font-weight: 600; color: var(--text-dark);">Review Materi</p>
                                <p style="margin: 4px 0 0;">Buka kembali materi terkait sebelum memulai kuis agar hasil lebih maksimal.</p>
                            </div>
                        </div>
                        <div class="list-item">
                            <span>🎯</span>
                            <div>
                                <p style="margin: 0; font-weight: 600; color: var(--text-dark);">Targetkan Skor</p>
                                <p style="margin: 4px 0 0;">Tetapkan target skor pribadi dan evaluasi rekomendasi belajar setelah selesai.</p>
                            </div>
                        </div>
                        <div class="list-item">
                            <span>⏱</span>
                            <div>
                                <p style="margin: 0; font-weight: 600; color: var(--text-dark);">Manajemen Waktu</p>
                                <p style="margin: 4px 0 0;">Siapkan stopwatch atau gunakan timer bawaan agar terbiasa dengan batas waktu.</p>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 12px;">
                        <a class="btn btn-primary" style="padding: 12px 24px; font-size: 0.9rem;" href="{{ config('mayclass.links.materials_drive') }}" target="_blank" rel="noopener">
                            Lihat Materi di Google Drive
                        </a>
                        <a class="btn btn-outline" style="padding: 12px 24px; font-size: 0.9rem;" href="{{ route('student.dashboard') }}">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </article>
            </section>
        </main>
        <footer>© {{ now()->year }} MayClass. Sukseskan setiap sesi evaluasi!</footer>
    </body>
</html>
