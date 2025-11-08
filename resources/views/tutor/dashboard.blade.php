<!DOCTYPE html>
<html lang="id" data-page="tutor-dashboard">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Tentor - MayClass</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                --primary: #38b6b2;
                --primary-dark: #2f8f87;
                --accent: #7c5dfa;
                --sun: #f6a623;
                --midnight: #1f2a37;
                --text-muted: #6b7280;
                --surface: #ffffff;
                --surface-soft: #f5fbfb;
                --border: rgba(56, 182, 178, 0.15);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: linear-gradient(180deg, #ecfbfa 0%, #ffffff 45%);
                color: var(--midnight);
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
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 24px;
            }

            nav {
                background: var(--surface);
                border-radius: 24px;
                padding: 18px 28px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
                box-shadow: 0 28px 60px rgba(47, 143, 135, 0.16);
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                font-weight: 600;
                color: var(--primary-dark);
                font-size: 1.1rem;
            }

            .brand img {
                width: 42px;
                height: 42px;
                object-fit: cover;
                border-radius: 12px;
            }

            .nav-links {
                display: flex;
                gap: 28px;
                align-items: center;
                color: var(--text-muted);
                font-size: 0.95rem;
            }

            .nav-links a[data-active="true"] {
                color: var(--primary-dark);
                font-weight: 600;
                position: relative;
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

            .profile-chip {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                padding: 10px 18px;
                border-radius: 999px;
                background: rgba(56, 182, 178, 0.1);
                color: var(--primary-dark);
                font-size: 0.9rem;
                font-weight: 500;
            }

            .logout-button {
                padding: 10px 20px;
                border-radius: 999px;
                border: 1px solid var(--border);
                background: rgba(124, 93, 250, 0.08);
                color: var(--accent);
                font-weight: 600;
                cursor: pointer;
            }

            main {
                padding: 52px 0 80px;
                display: grid;
                gap: 48px;
            }

            .hero {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 36px;
                align-items: center;
            }

            .hero-card {
                background: var(--surface);
                border-radius: 28px;
                padding: 36px;
                position: relative;
                overflow: hidden;
                box-shadow: 0 30px 70px rgba(47, 143, 135, 0.18);
            }

            .hero-card::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(160deg, rgba(56, 182, 178, 0.08) 0%, rgba(124, 93, 250, 0.12) 100%);
                pointer-events: none;
            }

            .hero-card h1 {
                margin: 0 0 18px;
                font-size: clamp(2.1rem, 3.8vw, 3rem);
                line-height: 1.2;
            }

            .hero-card p {
                margin: 0;
                color: var(--text-muted);
                max-width: 520px;
            }

            .hero-visual {
                position: relative;
                border-radius: 28px;
                overflow: hidden;
                min-height: 320px;
                background: url("{{ \App\Support\ImageRepository::url('tutor.banner') }}") center/cover;
            }

            .hero-visual::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(160deg, rgba(31, 42, 55, 0.1) 0%, rgba(56, 182, 178, 0.35) 100%);
            }

            .hero-visual-content {
                position: relative;
                z-index: 1;
                color: #fff;
                padding: 32px;
                display: flex;
                flex-direction: column;
                gap: 18px;
                max-width: 360px;
            }

            .hero-visual-content h2 {
                margin: 0;
                font-size: 1.6rem;
                line-height: 1.3;
            }

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 22px;
            }

            .stat-card {
                background: var(--surface);
                border-radius: 24px;
                padding: 24px;
                box-shadow: 0 18px 50px rgba(47, 143, 135, 0.12);
            }

            .stat-card h3 {
                margin: 0;
                font-size: 0.95rem;
                color: var(--text-muted);
                font-weight: 500;
            }

            .stat-card strong {
                display: block;
                margin-top: 12px;
                font-size: 2rem;
                color: var(--midnight);
            }

            .dashboard-grid {
                display: grid;
                grid-template-columns: 2fr 1.3fr;
                gap: 32px;
            }

            section {
                display: grid;
                gap: 24px;
            }

            .panel {
                background: var(--surface);
                border-radius: 24px;
                padding: 24px;
                box-shadow: 0 18px 48px rgba(47, 143, 135, 0.12);
            }

            .panel header {
                padding: 0;
                margin-bottom: 18px;
            }

            .panel header h2 {
                margin: 0;
                font-size: 1.1rem;
                font-weight: 600;
            }

            .panel header p {
                margin: 6px 0 0;
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            .session-list {
                display: grid;
                gap: 16px;
            }

            .session-item {
                padding: 16px;
                border-radius: 18px;
                background: var(--surface-soft);
                border: 1px solid rgba(56, 182, 178, 0.12);
                display: grid;
                gap: 6px;
            }

            .session-item strong {
                font-size: 1rem;
                color: var(--midnight);
            }

            .session-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                font-size: 0.85rem;
                color: var(--text-muted);
            }

            .status-pill {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-size: 0.78rem;
                padding: 6px 12px;
                border-radius: 999px;
                background: rgba(124, 93, 250, 0.12);
                color: var(--accent);
                font-weight: 500;
            }

            .status-pill[data-state="Selesai"] {
                background: rgba(56, 182, 178, 0.12);
                color: var(--primary-dark);
            }

            .status-pill[data-state="Hari ini"] {
                background: rgba(246, 166, 35, 0.12);
                color: var(--sun);
            }

            .calendar {
                display: grid;
                gap: 12px;
            }

            .calendar-grid {
                display: grid;
                grid-template-columns: repeat(7, minmax(0, 1fr));
                gap: 8px;
                text-align: center;
            }

            .calendar-cell {
                padding: 10px 0;
                border-radius: 12px;
                font-size: 0.85rem;
                font-weight: 500;
                color: var(--text-muted);
            }

            .calendar-cell[data-header="true"] {
                font-weight: 600;
                color: var(--primary-dark);
            }

            .calendar-cell[data-active="true"] {
                background: rgba(56, 182, 178, 0.12);
                color: var(--primary-dark);
            }

            .calendar-cell[data-muted="true"] {
                opacity: 0.4;
            }

            .progress {
                width: 100%;
                height: 12px;
                background: rgba(56, 182, 178, 0.12);
                border-radius: 999px;
                overflow: hidden;
            }

            .progress span {
                display: block;
                height: 100%;
                background: linear-gradient(120deg, var(--primary) 0%, var(--accent) 100%);
            }

            .students-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 18px;
            }

            .student-card {
                background: var(--surface);
                border-radius: 20px;
                padding: 18px;
                border: 1px solid rgba(56, 182, 178, 0.14);
                display: grid;
                gap: 10px;
            }

            .student-card strong {
                font-size: 1rem;
            }

            .student-card small {
                color: var(--text-muted);
                font-size: 0.85rem;
            }

            .resource-lists {
                display: grid;
                gap: 16px;
            }

            .resource-group {
                background: var(--surface);
                border-radius: 20px;
                padding: 20px;
                border: 1px solid rgba(124, 93, 250, 0.12);
            }

            .resource-group h3 {
                margin: 0 0 12px;
                font-size: 1rem;
            }

            .resource-group ul {
                list-style: none;
                margin: 0;
                padding: 0;
                display: grid;
                gap: 12px;
            }

            .resource-group li {
                display: flex;
                justify-content: space-between;
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            .empty-state {
                padding: 20px;
                border-radius: 18px;
                background: var(--surface-soft);
                border: 1px dashed rgba(56, 182, 178, 0.3);
                text-align: center;
                color: var(--text-muted);
                font-size: 0.9rem;
            }

            @media (max-width: 1024px) {
                .stats-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .dashboard-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 720px) {
                nav {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .hero {
                    grid-template-columns: 1fr;
                }

                .hero-visual {
                    min-height: 260px;
                }

                .stats-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 520px) {
                .stats-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <a class="brand" href="{{ route('packages.index') }}">
                        <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="Logo MayClass" />
                        <span>MayClass Tutor</span>
                    </a>
                    <div class="nav-links">
                        <a href="{{ route('tutor.dashboard') }}" data-active="true">Dashboard</a>
                        <a href="{{ route('packages.index') }}">Paket</a>
                    </div>
                    <div class="nav-actions">
                        <span class="profile-chip">{{ $tutor->name }}</span>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-button">Keluar</button>
                        </form>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="hero">
                    <div class="hero-card">
                        <h1>Hai {{ $tutor->name }}, selamat mengajar!</h1>
                        <p>
                            Pantau jadwal mengajar, perkembangan siswa, dan sumber belajar terbaru secara terpusat.
                            Optimalkan setiap sesi agar siswa mencapai target terbaiknya.
                        </p>
                    </div>
                    <div class="hero-visual">
                        <div class="hero-visual-content">
                            <h2>Sesi mengajar berikutnya</h2>
                            @if ($upcomingSessions->isNotEmpty())
                                <p>
                                    {{ $upcomingSessions->first()['title'] }}
                                    • {{ $upcomingSessions->first()['date'] }}
                                    • {{ $upcomingSessions->first()['time_range'] }} WIB
                                </p>
                            @else
                                <p>Belum ada jadwal baru. Tambahkan sesi agar kalender Anda tetap teratur.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Siswa aktif</h3>
                        <strong>{{ number_format($stats['students']) }}</strong>
                    </div>
                    <div class="stat-card">
                        <h3>Sesi mendatang</h3>
                        <strong>{{ number_format($stats['upcoming']) }}</strong>
                    </div>
                    <div class="stat-card">
                        <h3>Materi siap pakai</h3>
                        <strong>{{ number_format($stats['materials']) }}</strong>
                    </div>
                    <div class="stat-card">
                        <h3>Quiz interaktif</h3>
                        <strong>{{ number_format($stats['quizzes']) }}</strong>
                    </div>
                </div>

                <div class="dashboard-grid">
                    <section>
                        <div class="panel">
                            <header>
                                <h2>Sesi hari ini</h2>
                                <p>{{ now()->locale('id')->translatedFormat('l, d F Y') }}</p>
                            </header>
                            @if ($todaySessions->isEmpty())
                                <div class="empty-state">
                                    Tidak ada sesi hari ini. Manfaatkan waktu untuk persiapan materi.
                                </div>
                            @else
                                <div class="session-list">
                                    @foreach ($todaySessions as $session)
                                        <div class="session-item">
                                            <div class="session-meta">
                                                <span>{{ $session['day_label'] }}</span>
                                                <span>{{ $session['time_range'] }} WIB</span>
                                                <span>{{ $session['category'] }}</span>
                                            </div>
                                            <strong>{{ $session['title'] }}</strong>
                                            <span class="status-pill" data-state="{{ $session['status'] }}">{{ $session['status'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="panel">
                            <header>
                                <h2>Sesi mendatang</h2>
                                <p>Atur strategi belajar dan catat kebutuhan siswa sejak dini.</p>
                            </header>
                            @if ($upcomingSessions->isEmpty())
                                <div class="empty-state">
                                    Jadwal masih kosong. Tambahkan sesi baru untuk menjaga konsistensi belajar.
                                </div>
                            @else
                                <div class="session-list">
                                    @foreach ($upcomingSessions as $session)
                                        <div class="session-item">
                                            <div class="session-meta">
                                                <span>{{ $session['date'] }}</span>
                                                <span>{{ $session['time_range'] }} WIB</span>
                                                <span>{{ $session['category'] }}</span>
                                            </div>
                                            <strong>{{ $session['title'] }}</strong>
                                            <span class="status-pill" data-state="{{ $session['status'] }}">{{ $session['status'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>
                    <section>
                        <div class="panel">
                            <header>
                                <h2>Ringkasan mingguan</h2>
                                <p>
                                    {{ $weekProgress['completed'] }} dari {{ $weekProgress['total'] }} sesi minggu ini
                                    telah selesai.
                                </p>
                            </header>
                            <div class="progress">
                                <span style="width: {{ $weekProgress['percentage'] }}%"></span>
                            </div>
                            <p style="margin-top: 16px; font-size: 0.9rem; color: var(--text-muted);">
                                {{ $completedSessionCount }} sesi telah terselesaikan secara keseluruhan.
                                Terus pertahankan kualitas pengajaran!
                            </p>
                        </div>
                        <div class="panel">
                            <header>
                                <h2>Kalender jadwal</h2>
                                <p>{{ $schedule['monthLabel'] }}</p>
                            </header>
                            <div class="calendar">
                                <div class="calendar-grid">
                                    @foreach ($schedule['calendar'] as $column)
                                        <div class="calendar-cell" data-header="true">{{ $column['label'] }}</div>
                                    @endforeach
                                    @foreach ($schedule['calendar'][0]['days'] as $index => $day)
                                        @foreach ($schedule['calendar'] as $column)
                                            @php
                                                $currentDay = $column['days'][$index] ?? null;
                                                $isActive = $currentDay && in_array($currentDay, $schedule['activeDays']);
                                                $isMuted = $currentDay && in_array($currentDay, $schedule['mutedCells'][$column['label']] ?? []);
                                            @endphp
                                            <div
                                                class="calendar-cell"
                                                data-active="{{ $isActive ? 'true' : 'false' }}"
                                                data-muted="{{ $isMuted ? 'true' : 'false' }}"
                                            >
                                                {{ $currentDay ?? '' }}
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="panel">
                    <header>
                        <h2>Siswa yang Anda dampingi</h2>
                        <p>Perhatikan kebutuhan dan perkembangan siswa aktif untuk menjaga keterlibatan mereka.</p>
                    </header>
                    @if ($students->isEmpty())
                        <div class="empty-state">
                            Belum ada data siswa aktif. Selesaikan proses pendaftaran siswa terlebih dahulu.
                        </div>
                    @else
                        <div class="students-grid">
                            @foreach ($students as $student)
                                <div class="student-card">
                                    <strong>{{ $student['name'] }}</strong>
                                    <small>Paket: {{ $student['package'] }}</small>
                                    @if ($student['since'])
                                        <small>Bergabung: {{ $student['since'] }}</small>
                                    @endif
                                    @if ($student['phone'])
                                        <small>Kontak: {{ $student['phone'] }}</small>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="resource-lists">
                    <div class="resource-group">
                        <h3>Materi terbaru</h3>
                        @if ($materials->isEmpty())
                            <div class="empty-state" style="border-style: dashed;">
                                Belum ada materi yang diunggah. Unggah materi untuk mendukung sesi Anda.
                            </div>
                        @else
                            <ul>
                                @foreach ($materials as $material)
                                    <li>
                                        <span>{{ $material['title'] }} • {{ $material['subject'] }}</span>
                                        <span>
                                            {{ optional($material['created_at'])->locale('id')->translatedFormat('d M Y') }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="resource-group">
                        <h3>Quiz siap pakai</h3>
                        @if ($quizzes->isEmpty())
                            <div class="empty-state" style="border-style: dashed;">
                                Quiz belum tersedia. Buat atau pilih quiz untuk evaluasi siswa.
                            </div>
                        @else
                            <ul>
                                @foreach ($quizzes as $quiz)
                                    <li>
                                        <span>{{ $quiz['title'] }} • {{ $quiz['subject'] }}</span>
                                        <span>{{ $quiz['level'] ?? 'Semua level' }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
