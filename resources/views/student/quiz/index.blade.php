<!DOCTYPE html>
<html lang="id" data-page="quiz">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Quiz Pembelajaran - MayClass</title>
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
                padding: 48px 0 80px;
                display: grid;
                gap: 48px;
            }

            .hero {
                background: linear-gradient(140deg, rgba(61, 183, 173, 0.18), rgba(95, 106, 248, 0.16));
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

            .quiz-card {
                border-radius: 24px;
                padding: 24px;
                display: grid;
                gap: 14px;
                background: rgba(95, 106, 248, 0.08);
                position: relative;
                overflow: hidden;
            }

            .quiz-card::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(140deg, rgba(255, 255, 255, 0.4), transparent 60%);
                pointer-events: none;
            }

            .quiz-card h3 {
                margin: 0;
                font-size: 1.15rem;
            }

            .quiz-card p {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.92rem;
            }

            .quiz-card .badge {
                display: inline-flex;
                padding: 6px 14px;
                border-radius: 999px;
                font-size: 0.8rem;
                font-weight: 500;
                background: rgba(255, 255, 255, 0.55);
                width: max-content;
            }

            .quiz-card .meta {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
                font-size: 0.85rem;
                color: var(--text-muted);
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
        @php($materialsLink = config('mayclass.links.materials_drive'))
        @php($quizLink = config('mayclass.links.quiz_platform'))
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
                <h1>Mulai Quiz</h1>
                <p>
                    Tingkatkan pemahamanmu melalui kuis interaktif yang adaptif. Cocok untuk siswa SD, SMP, SMA, dan
                    pejuang seleksi kedinasan agar siap menghadapi materi TWK, TIU, dan TKP.
                </p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="{{ $quizLink }}" target="_blank" rel="noopener">Mulai Quiz</a>
                    <a class="btn btn-outline" href="{{ $materialsLink }}" target="_blank" rel="noopener">Lihat Materi</a>
                    <a class="btn btn-outline" href="{{ route('student.dashboard') }}">Kembali ke Beranda</a>
                </div>
            </section>

            <section id="collections" style="display: grid; gap: 32px;">
                @forelse ($collections as $collection)
                    <article class="collection">
                        <div class="collection-header">
                            <h2>{{ $collection['label'] }}</h2>
                            <a class="btn btn-outline" href="{{ $materialsLink }}" target="_blank" rel="noopener">Lihat Materi</a>
                        </div>
                        <div class="cards-grid">
                            @foreach ($collection['items'] as $quiz)
                                <div class="quiz-card" style="background: linear-gradient(150deg, {{ $collection['accent'] }}22, rgba(255, 255, 255, 0.85));">
                                    <span class="badge">{{ $quiz['duration'] }} · {{ $quiz['questions'] }} soal</span>
                                    <h3>{{ $quiz['title'] }}</h3>
                                    <p>{{ $quiz['summary'] }}</p>
                                    <div class="meta">
                                        @foreach ($quiz['levels'] as $level)
                                            <span>Level {{ $level }}</span>
                                        @endforeach
                                    </div>
                                    <a class="btn btn-primary" style="padding: 10px 20px; font-size: 0.9rem;" href="{{ $quizLink }}" target="_blank" rel="noopener">
                                        Mulai Quiz
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </article>
                @empty
                    <article class="collection" style="text-align: center;">
                        <h2 style="margin: 0 0 12px;">Quiz siap dimainkan</h2>
                        <p style="margin: 0 0 18px; color: var(--text-muted);">
                            Bank soal interaktif tersedia langsung melalui platform Wayground.
                        </p>
                        <a class="btn btn-primary" style="justify-self: center;" href="{{ $quizLink }}" target="_blank" rel="noopener">
                            Buka Platform Quiz
                        </a>
                    </article>
                @endforelse
            </section>
        </main>
        <footer>© {{ now()->year }} MayClass. Selamat mengasah kemampuanmu!</footer>
    </body>
</html>
