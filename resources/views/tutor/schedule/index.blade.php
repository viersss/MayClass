@extends('tutor.layout')

@section('title', 'Jadwal Mengajar - MayClass')

@push('styles')
    <style>
        .hero-card {
            background: linear-gradient(135deg, rgba(61, 183, 173, 0.12), rgba(84, 101, 255, 0.14));
            border: 1px solid rgba(84, 101, 255, 0.12);
            border-radius: 24px;
            padding: 24px;
            display: grid;
            gap: 12px;
            box-shadow: 0 18px 38px rgba(15, 23, 42, 0.08);
        }

        .hero-card h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .hero-subtitle {
            margin: 0;
            color: var(--text-muted);
        }

        .info-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid var(--border-subtle);
            color: var(--text-main);
            padding: 10px 14px;
            border-radius: 14px;
            font-weight: 600;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
        }

        .metric-card {
            background: #fff;
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 16px;
            display: grid;
            gap: 4px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        }

        .metric-card span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .metric-card strong {
            font-size: 1.6rem;
            color: #0f172a;
        }

        .schedule-section {
            background: #fff;
            border: 1px solid var(--border-subtle);
            border-radius: 24px;
            padding: 22px;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
            display: grid;
            gap: 16px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .section-header h2 {
            margin: 0;
            font-size: 1.25rem;
        }

        .session-list {
            display: grid;
            gap: 14px;
        }

        .session-card {
            border: 1px solid rgba(15, 23, 42, 0.06);
            border-radius: 18px;
            padding: 16px;
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 16px;
            background: rgba(15, 23, 42, 0.02);
        }

        .session-time {
            display: grid;
            gap: 6px;
        }

        .session-day {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 0.95rem;
        }

        .session-date {
            font-weight: 800;
            font-size: 1.05rem;
        }

        .session-range {
            color: var(--text-muted);
        }

        .session-body {
            display: grid;
            gap: 8px;
        }

        .session-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            font-size: 1.05rem;
        }

        .session-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .status-pill[data-variant='info'] {
            background: rgba(59, 130, 246, 0.12);
            color: #1d4ed8;
        }

        .status-pill[data-variant='success'] {
            background: rgba(34, 197, 94, 0.14);
            color: #15803d;
        }

        .status-pill[data-variant='danger'] {
            background: rgba(239, 68, 68, 0.14);
            color: #b91c1c;
        }

        .empty-state {
            text-align: center;
            padding: 32px;
            border: 1px dashed var(--border-subtle);
            border-radius: 16px;
            background: var(--surface-muted);
            color: var(--text-muted);
        }

        .badge-plain {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            background: rgba(15, 23, 42, 0.06);
            border-radius: 12px;
            font-weight: 600;
            color: #0f172a;
            font-size: 0.92rem;
        }

        .layout-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 960px) {
            .session-card {
                grid-template-columns: 1fr;
            }

            .layout-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="hero-card">
            <div>
                <span class="info-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 6v6l4 2" />
                    </svg>
                    Jadwal Tentor
                </span>
                <h1>Agenda mengajar Anda</h1>
                <p class="hero-subtitle">Semua jadwal diatur oleh admin MayClass. Perubahan waktu, paket, atau tentor akan langsung tercermin di halaman ini.</p>
            </div>
            <div class="metrics-grid">
                <div class="metric-card">
                    <span>Agenda Mendatang</span>
                    <strong>{{ $metrics['upcoming'] }}</strong>
                </div>
                <div class="metric-card">
                    <span>Riwayat Sesi</span>
                    <strong>{{ $metrics['history'] }}</strong>
                </div>
                <div class="metric-card">
                    <span>Total Jadwal</span>
                    <strong>{{ $metrics['total'] }}</strong>
                </div>
            </div>
        </div>

        <div class="layout-grid">
            <section class="schedule-section">
                <div class="section-header">
                    <h2>Agenda Mendatang</h2>
                    <span class="badge-plain">Hari ini & seterusnya</span>
                </div>

                @if ($upcomingSessions->isEmpty())
                    <div class="empty-state">Belum ada agenda mengajar. Jadwal baru akan muncul setelah admin menugaskannya.</div>
                @else
                    <div class="session-list">
                        @foreach ($upcomingSessions as $session)
                            <article class="session-card">
                                <div class="session-time">
                                    <span class="session-day">{{ $session['date_label'] }}</span>
                                    <span class="session-range">{{ $session['time_range'] }}</span>
                                </div>
                                <div class="session-body">
                                    <h3 class="session-title">
                                        {{ $session['title'] }}
                                        <span class="status-pill" data-variant="{{ $session['status_variant'] }}">{{ $session['status_label'] }}</span>
                                    </h3>
                                    <div class="session-meta">
                                        <span class="badge-plain">{{ $session['package'] }}</span>
                                        <span class="badge-plain">{{ $session['subject'] }}</span>
                                        <span class="badge-plain">{{ $session['location'] }}</span>
                                    </div>
                                    <div class="session-meta">
                                        <span>{{ $session['participant_summary'] }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>

            <section class="schedule-section">
                <div class="section-header">
                    <h2>Riwayat Sesi</h2>
                    <span class="badge-plain">Sudah berlangsung</span>
                </div>

                @if ($historySessions->isEmpty())
                    <div class="empty-state">Belum ada sesi selesai atau dibatalkan.</div>
                @else
                    <div class="session-list">
                        @foreach ($historySessions as $session)
                            <article class="session-card">
                                <div class="session-time">
                                    <span class="session-day">{{ $session['date_label'] }}</span>
                                    <span class="session-range">{{ $session['time_range'] }}</span>
                                </div>
                                <div class="session-body">
                                    <h3 class="session-title">
                                        {{ $session['title'] }}
                                        <span class="status-pill" data-variant="{{ $session['status_variant'] }}">{{ $session['status_label'] }}</span>
                                    </h3>
                                    <div class="session-meta">
                                        <span class="badge-plain">{{ $session['package'] }}</span>
                                        <span class="badge-plain">{{ $session['subject'] }}</span>
                                        <span class="badge-plain">{{ $session['location'] }}</span>
                                    </div>
                                    <div class="session-meta">
                                        <span>{{ $session['participant_summary'] }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection
