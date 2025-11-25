@extends('tutor.layout')

@section('title', 'Jadwal Mengajar - MayClass')

@push('styles')
    <style>
        /* --- CSS Variables & Reset --- */
        :root {
            /* Colors derived from your request and clean UI standards */
            --primary-solid: #0f766e; /* Diambil dari warna awal gradasi Anda */
            --primary-dark: #115e59;
            --bg-page: #f8fafc;
            --bg-surface: #ffffff;

            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-subtle: #e2e8f0;

            --action-blue: #2563eb;
            --action-blue-hover: #1d4ed8;

            /* Your provided variables */
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            --card-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-main);
        }

        /* --- Page Header Area --- */
        .page-header {
            margin-bottom: 32px;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-solid);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 12px;
            background: rgba(15, 118, 110, 0.1); /* Solid color with opacity for subtle badge */
            padding: 6px 12px;
            border-radius: 30px;
        }

        .page-header h1 {
            margin: 0 0 8px 0;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: var(--text-main);
        }

        .page-subtitle {
            margin: 0;
            color: var(--text-muted);
            font-size: 1.05rem;
            max-width: 600px;
        }

        /* --- Metrics Grid --- */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .metric-card {
            background: var(--bg-surface);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-subtle);
            display: flex;
            flex-direction: column;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .metric-card:hover {
            box-shadow: var(--card-shadow-hover);
            border-color: var(--primary-solid);
            transform: translateY(-2px);
        }

        .metric-card span {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .metric-card strong {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary-solid);
            line-height: 1;
        }

        /* --- Layout & Sections --- */
        .layout-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            align-items: start;
        }

        .schedule-section {
            background: var(--bg-surface);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-subtle);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-subtle);
        }

        .section-header h2 {
            margin: 0;
            font-size: 1.35rem;
            font-weight: 700;
        }

        /* --- Session Cards --- */
        .session-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .session-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            padding: 20px;
            display: grid;
            grid-template-columns: 160px 1fr; /* Fixed width for date column */
            gap: 24px;
            transition: all 0.2s ease;
        }

        .session-card:hover {
            box-shadow: var(--card-shadow);
            border-color: var(--primary-solid);
        }

        .session-time {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding-right: 20px;
            border-right: 2px solid var(--border-subtle);
            justify-content: center;
        }

        .session-day {
            font-weight: 700;
            color: var(--primary-solid);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .session-range {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--text-main);
        }

        .session-body {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .session-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            flex-wrap: wrap;
        }

        .session-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-main);
        }

        /* --- Badges & Pills --- */
        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Keeping opacity for status for better visual hierarchy, but colors are cleaner */
        .status-pill[data-variant='info'] { background: #dbeafe; color: #1e40af; }
        .status-pill[data-variant='success'] { background: #dcfce7; color: #166534; }
        .status-pill[data-variant='danger'] { background: #fee2e2; color: #991b1b; }
        .status-pill[data-variant='warning'] { background: #fef3c7; color: #92400e; } /* Added warning just in case */

        .badge-plain {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            background: var(--bg-page); /* Solid light gray */
            border-radius: 8px;
            font-weight: 600;
            color: var(--text-muted);
            font-size: 0.85rem;
            border: 1px solid var(--border-subtle);
        }

        .session-meta-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .participant-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* --- Zoom Actions --- */
        .zoom-button {
            background: var(--action-blue);
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            transition: background 0.2s;
            border: none;
            margin-top: 8px;
        }

        .zoom-button:hover {
            background: var(--action-blue-hover);
            color: #fff;
        }

        .zoom-note {
            margin-top: 8px;
            color: var(--text-muted);
            font-size: 0.9rem;
            font-style: italic;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .zoom-note::before {
            content: 'ℹ️';
            font-style: normal;
        }

        /* --- States & Responsive --- */
        .empty-state {
            text-align: center;
            padding: 40px 24px;
            border: 2px dashed var(--border-subtle);
            border-radius: var(--radius-md);
            background: var(--bg-page);
            color: var(--text-muted);
            font-weight: 500;
        }

        @media (max-width: 960px) {
            .layout-grid {
                grid-template-columns: 1fr;
            }

            .session-card {
                grid-template-columns: 1fr; /* Stack time on top of details on mobile */
                gap: 16px;
            }

            .session-time {
                border-right: none;
                border-bottom: 2px solid var(--border-subtle);
                padding-right: 0;
                padding-bottom: 16px;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .session-range {
                font-size: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="page-header">
            <span class="header-badge">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Dashboard Tentor
            </span>
            <h1>Agenda Mengajar Anda</h1>
            <p class="page-subtitle">Semua jadwal diatur oleh admin MayClass. Perubahan waktu, paket, atau siswa akan langsung tercermin di sini.</p>
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
                <span>Total Selesai</span>
                <strong>{{ $metrics['total'] }}</strong>
            </div>
        </div>

        <div class="layout-grid">
            <section class="schedule-section">
                <div class="section-header">
                    <h2>Agenda Mendatang</h2>
                </div>

                @if ($upcomingSessions->isEmpty())
                    <div class="empty-state">
                        Belum ada agenda mengajar mendatang.
                        <br>Jadwal baru akan muncul setelah admin menugaskannya.
                    </div>
                @else
                    <div class="session-list">
                        @foreach ($upcomingSessions as $session)
                            <article class="session-card">
                                <div class="session-time">
                                    <span class="session-day">{{ $session['date_label'] }}</span>
                                    <span class="session-range">{{ $session['time_range'] }}</span>
                                </div>
                                <div class="session-body">
                                    <div class="session-header-row">
                                        <h3 class="session-title">{{ $session['title'] }}</h3>
                                        <span class="status-pill" data-variant="{{ $session['status_variant'] }}">{{ $session['status_label'] }}</span>
                                    </div>

                                    <div class="session-meta-group">
                                        <span class="badge-plain">{{ $session['package'] }}</span>
                                        <span class="badge-plain">{{ $session['subject'] }}</span>
                                        <span class="badge-plain">📍 {{ $session['location'] }}</span>
                                    </div>

                                    <div class="participant-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18" style="color: var(--text-muted)">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span>{{ $session['participant_summary'] }}</span>
                                    </div>

                                    @if (($session['is_online'] ?? false) && ! empty($session['zoom_link']))
                                        <a href="{{ $session['zoom_link'] }}" class="zoom-button" target="_blank" rel="noopener noreferrer">
                                            Gabung Zoom Meeting
                                        </a>
                                    @elseif (($session['is_online'] ?? false))
                                        <div class="zoom-note">Sesi Online. Link Zoom belum tersedia, hubungi admin.</div>
                                    @elseif (! empty($session['zoom_link']))
                                        <div class="zoom-note">Sesi ini tercatat offline, tidak menggunakan Zoom.</div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>

            <section class="schedule-section">
                <div class="section-header">
                    <h2>Riwayat Sesi</h2>
                </div>

                @if ($historySessions->isEmpty())
                    <div class="empty-state">Belum ada riwayat sesi yang selesai atau dibatalkan.</div>
                @else
                    <div class="session-list">
                        @foreach ($historySessions as $session)
                            <article class="session-card" style="opacity: 0.9;"> <div class="session-time">
                                    <span class="session-day" style="color: var(--text-muted);">{{ $session['date_label'] }}</span>
                                    <span class="session-range" style="color: var(--text-muted);">{{ $session['time_range'] }}</span>
                                </div>
                                <div class="session-body">
                                    <div class="session-header-row">
                                        <h3 class="session-title" style="color: var(--text-muted);">{{ $session['title'] }}</h3>
                                        <span class="status-pill" data-variant="{{ $session['status_variant'] }}">{{ $session['status_label'] }}</span>
                                    </div>

                                    <div class="session-meta-group">
                                        <span class="badge-plain">{{ $session['package'] }}</span>
                                        <span class="badge-plain">{{ $session['subject'] }}</span>
                                    </div>

                                    <div class="participant-info">
                                        <span>{{ $session['participant_summary'] }}</span>
                                    </div>

                                     {{-- Zoom buttons/notes are rarely needed for history, but kept logic intact --}}
                                     @if (($session['is_online'] ?? false) && ! empty($session['zoom_link']))
                                        <a href="{{ $session['zoom_link'] }}" class="zoom-button" style="background: var(--text-muted); pointer-events: none;" target="_blank" rel="noopener noreferrer">Link Zoom (Berakhir)</a>
                                     @elseif (($session['is_online'] ?? false))
                                        <div class="zoom-note">Sesi Online Berakhir.</div>
                                     @elseif (! empty($session['zoom_link']))
                                        <div class="zoom-note">Sesi Offline Berakhir.</div>
                                     @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection