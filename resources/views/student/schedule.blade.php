<!DOCTYPE html>
<html lang="id" data-page="schedule">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Jadwal Bimbel - MayClass</title>
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
                --background: #f3fbfb;
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
                background: linear-gradient(140deg, rgba(61, 183, 173, 0.18), rgba(95, 106, 248, 0.16));
                border-radius: 32px;
                padding: clamp(32px, 5vw, 56px);
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 32px;
                align-items: center;
                box-shadow: 0 32px 68px rgba(32, 96, 92, 0.12);
            }

            .hero h1 {
                margin: 0 0 16px;
                font-size: clamp(2rem, 3vw, 2.8rem);
            }

            .hero p {
                margin: 0 0 24px;
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

            .hero-card {
                background: rgba(255, 255, 255, 0.85);
                border-radius: 24px;
                padding: 28px;
                display: grid;
                gap: 12px;
                color: var(--text-dark);
                backdrop-filter: blur(6px);
            }

            .hero-card h3 {
                margin: 0;
                font-size: 1.3rem;
            }

            .hero-card span {
                color: var(--text-muted);
                font-size: 0.95rem;
            }

            .tabs {
                display: inline-flex;
                gap: 12px;
                background: rgba(61, 183, 173, 0.12);
                padding: 8px;
                border-radius: 999px;
                margin-bottom: 32px;
            }

            .tabs span {
                padding: 10px 22px;
                border-radius: 999px;
                font-size: 0.9rem;
                color: var(--primary-dark);
                background: transparent;
            }

            .tabs span.is-active {
                background: #ffffff;
                box-shadow: 0 12px 24px rgba(61, 183, 173, 0.18);
                font-weight: 600;
            }

            .class-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 24px;
            }

            .class-card {
                background: var(--card);
                border-radius: 24px;
                padding: 24px;
                display: grid;
                gap: 12px;
                box-shadow: 0 28px 60px rgba(45, 133, 126, 0.12);
                border-top: 5px solid rgba(61, 183, 173, 0.22);
            }

            .class-card h4 {
                margin: 0;
                font-size: 1.1rem;
            }

            .class-card span {
                color: var(--text-muted);
                font-size: 0.9rem;
            }

            .calendar {
                background: var(--card);
                border-radius: 32px;
                padding: 32px;
                box-shadow: 0 32px 68px rgba(32, 96, 92, 0.12);
                display: grid;
                gap: 24px;
            }

            .calendar-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
            }

            .calendar-grid {
                display: grid;
                grid-template-columns: repeat(7, minmax(0, 1fr));
                gap: 16px;
            }

            .calendar-day {
                text-align: center;
                padding: 12px 0;
                border-radius: 14px;
                font-size: 0.95rem;
                color: var(--text-muted);
            }

            .calendar-day.is-active {
                background: linear-gradient(120deg, var(--primary) 0%, #58d2c5 100%);
                color: #ffffff;
                font-weight: 600;
                box-shadow: 0 18px 32px rgba(61, 183, 173, 0.28);
            }

            .calendar-day.is-muted {
                opacity: 0.4;
            }

            footer {
                padding: 32px 0 48px;
                text-align: center;
                color: var(--text-muted);
                font-size: 0.85rem;
            }

            @media (max-width: 960px) {
                nav {
                    flex-wrap: wrap;
                    gap: 16px 24px;
                }

                .hero {
                    grid-template-columns: 1fr;
                }

                .class-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 640px) {
                .class-grid,
                .calendar-grid {
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
                        <a href="{{ route('student.materials') }}">Materi</a>
                        <a href="{{ route('student.quiz') }}">Quiz</a>
                        <a href="{{ route('student.schedule') }}" data-active="true">Jadwal</a>
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
                <div>
                    <h1>Jadwal Bimbel</h1>
                    <p>
                        Pelajari materi TWK, TIU, dan TKP dengan struktur yang terorganisir dan mudah dipahami. Atur
                        ritme belajar, akses rekaman kelas, dan siap hadapi ujian bersama mentor MayClass.
                    </p>
                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#upcoming">Lihat Jadwal</a>
                        <a class="btn btn-outline" href="{{ route('student.dashboard') }}">Kembali ke Beranda</a>
                    </div>
                </div>
                <div class="hero-card">
                    <div style="display: inline-flex; gap: 10px; align-items: center;">
                        <span style="display: grid; place-items: center; width: 36px; height: 36px; border-radius: 50%; background: rgba(61, 183, 173, 0.15); color: var(--primary-dark);">⏰</span>
                        <span style="font-weight: 600;">Jadwal Pembelajaran</span>
                    </div>
                    <h3>{{ $schedule['highlight']['title'] }}</h3>
                    <span>{{ $schedule['highlight']['category'] }}</span>
                    <span>{{ $schedule['highlight']['date'] }} · {{ $schedule['highlight']['time'] }}</span>
                    <span>Mentor: {{ $schedule['highlight']['mentor'] }}</span>
                </div>
            </section>

            <section id="upcoming">
                <div class="tabs">
                    <span class="is-active">Semua</span>
                    <span>Matematika</span>
                    <span>Kimia</span>
                    <span>Bahasa</span>
                </div>
                <div class="class-grid">
                    @foreach ($schedule['upcoming'] as $session)
                        <article class="class-card">
                            <h4>{{ $session['title'] }}</h4>
                            <span>{{ $session['category'] }}</span>
                            <span>{{ $session['date'] }}</span>
                            <span>{{ $session['time'] }}</span>
                            <span>Mentor: {{ $session['mentor'] }}</span>
                            <a class="btn btn-outline" style="justify-self: start; padding: 10px 20px; font-size: 0.9rem;" href="{{ route('student.materials') }}">
                                Lihat Materi
                            </a>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="calendar">
                <div class="calendar-header">
                    <h2 style="margin: 0; font-size: 1.3rem;">Kalender Jadwal</h2>
                    <span style="color: var(--text-muted);">{{ $schedule['monthLabel'] }}</span>
                </div>
                <div class="calendar-grid">
                    @foreach ($schedule['calendar'] as $column)
                        <div style="display: grid; gap: 12px;">
                            <div class="calendar-day" style="font-weight: 600; color: var(--text-dark);">
                                {{ $column['label'] }}
                            </div>
                            @foreach ($column['days'] as $day)
                                @php
                                    $mutedCells = $schedule['mutedCells'][$column['label']] ?? [];
                                    $isMuted = in_array($day, $mutedCells, true);
                                    $isActive = in_array($day, $schedule['activeDays'], true);
                                @endphp
                                <div
                                    class="calendar-day {{ $isMuted ? 'is-muted' : '' }} {{ $isActive ? 'is-active' : '' }}"
                                    aria-hidden="true"
                                >
                                    {{ $day }}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
        <footer>© {{ now()->year }} MayClass. Jadwal dapat berubah sesuai koordinasi mentor.</footer>
    </body>
</html>
