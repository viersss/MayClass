@extends('tutor.layout')

@section('title', 'Dashboard Tentor - MayClass')

@push('styles')
    <style>
        .hero-card {
            background: linear-gradient(135deg, rgba(61, 183, 173, 0.92), rgba(94, 104, 242, 0.88));
            border-radius: 28px;
            padding: 36px;
            color: #fff;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 36px;
            box-shadow: 0 24px 60px rgba(61, 183, 173, 0.25);
            margin-bottom: 32px;
        }

        .hero-card .meta {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .hero-card .meta h1 {
            font-size: 2rem;
            margin: 0;
            font-weight: 600;
        }

        .hero-card p {
            margin: 0;
            opacity: 0.92;
            font-size: 1rem;
        }

        .hero-stats {
            display: flex;
            gap: 20px;
        }

        .hero-stats .stat {
            background: rgba(255, 255, 255, 0.16);
            padding: 18px 22px;
            border-radius: 18px;
            min-width: 120px;
        }

        .hero-stats .label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .hero-stats .value {
            font-size: 1.8rem;
            font-weight: 600;
            margin-top: 6px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stats-card {
            background: #fff;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .stats-card span.label {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .stats-card span.value {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1f2937;
        }

        .schedule-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .schedule-header h2 {
            margin: 0;
            font-size: 1.4rem;
        }

        .link-small {
            color: var(--primary-dark);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
        }

        .schedule-card {
            border-radius: 20px;
            padding: 22px;
            color: #fff;
            display: flex;
            flex-direction: column;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .schedule-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            pointer-events: none;
        }

        .schedule-card .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.2);
        }

        .schedule-card h3 {
            margin: 6px 0 0;
            font-size: 1.1rem;
        }

        .schedule-card .meta {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .next-schedule {
            margin-top: 36px;
            background: #fff;
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        }

        .next-schedule h3 {
            margin: 0 0 18px;
        }

        .next-item {
            display: grid;
            grid-template-columns: 140px 1fr 120px;
            gap: 18px;
            padding: 14px 0;
            border-bottom: 1px solid #eef2f6;
            align-items: center;
        }

        .next-item:last-child {
            border-bottom: none;
        }

        .next-item .day {
            font-weight: 600;
            color: #1f2937;
        }

        .empty-state {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            color: #6b7280;
            box-shadow: inset 0 0 0 2px rgba(59, 130, 246, 0.04);
        }

        @media (max-width: 900px) {
            .hero-card {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                flex-wrap: wrap;
            }

            .next-item {
                grid-template-columns: 1fr;
                text-align: left;
            }
        }
    </style>
@endpush

@section('content')
    <div class="hero-card">
        <div class="meta">
            <span>{{ $todayLabel }}</span>
            <h1>Dashboard Tentor</h1>
            <p>Selamat datang kembali, {{ $tutor?->name ?? 'Tutor MayClass' }}! 👋</p>
        </div>
        <div class="hero-stats">
            <div class="stat">
                <span class="label">Total Siswa</span>
                <span class="value">{{ number_format($stats['students']) }}</span>
            </div>
            <div class="stat">
                <span class="label">Materi Aktif</span>
                <span class="value">{{ number_format($stats['materials']) }}</span>
            </div>
            <div class="stat">
                <span class="label">Quiz Aktif</span>
                <span class="value">{{ number_format($stats['quizzes']) }}</span>
            </div>
        </div>
    </div>

    <div class="schedule-section">
        <div class="schedule-header">
            <h2>Jadwal Mengajar Hari Ini</h2>
            <a class="link-small" href="{{ route('tutor.schedule.index') }}">Lihat Semua</a>
        </div>
        @if ($todaySessions->isNotEmpty())
            <div class="schedule-grid">
                @foreach ($todaySessions as $session)
                    @php
                        $palette = ['#3db7ad', '#5f6af8', '#f2994a', '#3f83f8'];
                        $color = $palette[$loop->index % count($palette)];
                    @endphp
                    <div class="schedule-card" style="background: {{ $color }};">
                        <span class="badge">{{ $session['subject'] }}</span>
                        <h3>{{ $session['title'] }}</h3>
                        <div class="meta">{{ $session['class_level'] }} &middot; {{ $session['time_range'] }} WIB</div>
                        <div class="meta">Lokasi: {{ $session['location'] }}</div>
                        @if ($session['student_count'])
                            <div class="meta">Peserta: {{ $session['student_count'] }} siswa</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                Jadwal mengajar Anda kosong hari ini. Gunakan waktu untuk menyiapkan materi terbaik untuk siswa MayClass!
            </div>
        @endif
    </div>

    <div class="next-schedule">
        <h3>Agenda Mengajar Berikutnya</h3>
        @if ($nextSessions->isNotEmpty())
            @foreach ($nextSessions as $item)
                <div class="next-item">
                    <div class="day">{{ $item['day'] }}</div>
                    <div>
                        <strong>{{ $item['title'] }}</strong>
                        <div style="color: #6b7280; font-size: 0.95rem;">{{ $item['subject'] }} &middot; {{ $item['class_level'] }}</div>
                    </div>
                    <div style="color: #3db7ad; font-weight: 600;">{{ $item['time_range'] }} WIB</div>
                </div>
            @endforeach
        @else
            <p style="margin: 0; color: #6b7280;">Belum ada agenda lanjutan. Tambahkan jadwal baru melalui tim akademik MayClass.</p>
        @endif
    </div>
@endsection
