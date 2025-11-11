@extends('tutor.layout')

@section('title', 'Jadwal Mengajar - MayClass')

@push('styles')
    <style>
        .schedule-hero {
            position: relative;
            padding: 32px;
            border-radius: 28px;
            background: linear-gradient(135deg, rgba(61, 183, 173, 0.85), rgba(84, 101, 255, 0.85));
            color: #fff;
            overflow: hidden;
            margin-bottom: 28px;
            box-shadow: 0 28px 65px rgba(15, 23, 42, 0.25);
        }

        .schedule-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.18), transparent 55%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            display: grid;
            gap: 18px;
        }

        .hero-title {
            margin: 0;
            font-size: 2.1rem;
        }

        .hero-subtitle {
            margin: 0;
            font-size: 1rem;
            max-width: 520px;
            color: rgba(255, 255, 255, 0.85);
        }

        .hero-highlight {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
            margin-top: 12px;
        }

        .hero-highlight-card {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 20px;
            backdrop-filter: blur(6px);
        }

        .hero-highlight-card h3 {
            margin: 0 0 8px;
            font-size: 1.2rem;
        }

        .hero-highlight-card p {
            margin: 4px 0;
            font-size: 0.95rem;
        }

        .metric-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .metric-card {
            background: #fff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.1);
            border: 1px solid rgba(15, 23, 42, 0.04);
        }

        .metric-card span {
            display: block;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .metric-card strong {
            display: block;
            font-size: 1.8rem;
            margin-top: 6px;
            color: #111827;
        }

        .schedule-wrapper {
            display: grid;
            gap: 22px;
        }

        .day-card {
            background: #fff;
            border-radius: 24px;
            padding: 26px;
            box-shadow: 0 20px 48px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(15, 23, 42, 0.04);
        }

        .day-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .day-card h2 {
            margin: 0;
            font-size: 1.35rem;
        }

        .day-card span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .session {
            margin-top: 18px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 18px;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 16px;
            align-items: center;
            background: rgba(15, 23, 42, 0.02);
        }

        .session h3 {
            margin: 0;
            font-size: 1.1rem;
        }

        .session .meta {
            color: #6b7280;
            font-size: 0.95rem;
            margin-top: 6px;
        }

        .session .badge {
            display: inline-flex;
            padding: 6px 14px;
            background: rgba(61, 183, 173, 0.14);
            color: var(--primary-dark);
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .session .time {
            font-weight: 600;
            color: #1f2937;
            text-align: right;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .session .time span {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 48px;
            background: #fff;
            border-radius: 24px;
            color: var(--text-muted);
            box-shadow: 0 20px 48px rgba(15, 23, 42, 0.08);
        }

        .empty-state strong {
            display: block;
            font-size: 1.25rem;
            color: #111827;
            margin-bottom: 12px;
        }

        @media (max-width: 760px) {
            .session {
                grid-template-columns: 1fr;
                text-align: left;
            }

            .session .time {
                text-align: left;
                flex-direction: row;
                align-items: center;
            }
        }
    </style>
@endpush

@section('content')
    @php($metrics = $metrics ?? ['session_count' => 0, 'day_count' => 0, 'subject_count' => 0])

    <section class="schedule-hero">
        <div class="hero-content">
            <div>
                <h1 class="hero-title">Jadwal Mengajar</h1>
                <p class="hero-subtitle">Pantau seluruh sesi bimbingan dan pastikan setiap pertemuan berjalan sesuai
                    rencana.</p>
            </div>
            @if ($nextSessionHighlight)
                <div class="hero-highlight">
                    <div class="hero-highlight-card">
                        <h3>Sesi Berikutnya</h3>
                        <p><strong>{{ $nextSessionHighlight['title'] }}</strong></p>
                        <p>{{ $nextSessionHighlight['subject'] }} &middot;
                            {{ $nextSessionHighlight['class_level'] }}</p>
                        <p>{{ $nextSessionHighlight['date_label'] }}</p>
                        <p>{{ $nextSessionHighlight['time_range'] }}</p>
                        <p>Lokasi: {{ $nextSessionHighlight['location'] }}</p>
                        @if ($nextSessionHighlight['student_count'])
                            <p>Peserta: {{ $nextSessionHighlight['student_count'] }} siswa</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>

    <div class="metric-grid">
        <div class="metric-card">
            <span>Total Sesi</span>
            <strong>{{ $metrics['session_count'] }}</strong>
        </div>
        <div class="metric-card">
            <span>Hari Terjadwal</span>
            <strong>{{ $metrics['day_count'] }}</strong>
        </div>
        <div class="metric-card">
            <span>Variasi Mata Pelajaran</span>
            <strong>{{ $metrics['subject_count'] }}</strong>
        </div>
    </div>

    @if ($days->isEmpty())
        <div class="empty-state">
            <strong>Belum ada jadwal yang ditugaskan</strong>
            Silakan hubungi admin MayClass untuk menambahkan jadwal mengajar Anda.
        </div>
    @else
        <div class="schedule-wrapper">
            @foreach ($days as $day)
                <article class="day-card">
                    <div class="day-card-header">
                        <div>
                            <h2>{{ $day['day_label'] }}</h2>
                            <span>{{ $day['date_label'] }}</span>
                        </div>
                        <span style="font-weight: 600; color: var(--primary-dark);">{{ count($day['items']) }} sesi</span>
                    </div>

                    @foreach ($day['items'] as $item)
                        <div class="session">
                            <div>
                                <span class="badge">{{ $item['subject'] }}</span>
                                <h3>{{ $item['title'] }}</h3>
                                <div class="meta">{{ $item['class_level'] }} &middot; {{ $item['location'] }}</div>
                                @if ($item['student_count'])
                                    <div class="meta">Peserta: {{ $item['student_count'] }} siswa</div>
                                @endif
                            </div>
                            <div class="time">
                                {{ $item['time_range'] }}
                                <span>Waktu belajar</span>
                            </div>
                        </div>
                    @endforeach
                </article>
            @endforeach
        </div>
    @endif
@endsection
