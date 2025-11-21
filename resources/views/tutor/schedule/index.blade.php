@extends('tutor.layout')

@section('title', $pageTitle ?? 'Jadwal Mengajar - MayClass')

@push('styles')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .page-header h1 {
            margin: 8px 0 6px;
            font-size: 2rem;
        }

        .page-header p {
            margin: 0;
            color: var(--text-muted);
        }

        .eyebrow {
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.75rem;
            color: #94a3b8;
            margin: 0;
        }

        .stat-pills {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }

        .stat-pill {
            background: var(--surface);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 12px 14px;
            display: grid;
            gap: 6px;
            min-width: 140px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.06);
        }

        .stat-pill span {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .stat-pill strong {
            font-size: 1.4rem;
        }

        .section-grid {
            display: grid;
            grid-template-columns: 2fr 1.2fr;
            gap: 20px;
        }

        .panel {
            background: var(--surface);
            border: 1px solid var(--border-subtle);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08);
            display: grid;
            gap: 16px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .panel-head h2 {
            margin: 6px 0 0;
        }

        .panel-head p {
            margin: 0;
            color: var(--text-muted);
        }

        .session-list {
            display: grid;
            gap: 12px;
        }

        .session-card {
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 14px 16px;
            background: #f8fafc;
            display: grid;
            gap: 10px;
        }

        .card-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .date-block {
            display: grid;
            gap: 4px;
        }

        .date-block .date-label {
            font-weight: 700;
            color: var(--text-main);
        }

        .date-block .time-range {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .status-badge {
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            border: 1px solid transparent;
        }

        .status-badge[data-tone="info"] {
            background: #e0e7ff;
            color: #1d4ed8;
            border-color: #c7d2fe;
        }

        .status-badge[data-tone="neutral"] {
            background: #e2e8f0;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        .status-badge[data-tone="danger"] {
            background: #fee2e2;
            color: #b91c1c;
            border-color: #fecdd3;
        }

        .session-title {
            margin: 0;
            font-size: 1.1rem;
        }

        .session-subtitle {
            margin: 0;
            color: var(--text-muted);
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 8px 12px;
        }

        .meta-item {
            display: grid;
            gap: 4px;
        }

        .meta-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
        }

        .meta-value {
            margin: 0;
            font-weight: 600;
        }

        .package-tag {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 0.9rem;
        }

        .empty-state {
            padding: 18px;
            border: 1px dashed var(--border-subtle);
            border-radius: 14px;
            text-align: center;
            color: var(--text-muted);
            background: #f8fafc;
        }

        @media (max-width: 1024px) {
            .section-grid { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; }
            .stat-pills { width: 100%; }
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">Ringkasan aktivitas</p>
            <h1>{{ $pageTitle ?? 'Jadwal Mengajar' }}</h1>
            <p>Kelola agenda mengajar pribadi dan pantau sesi terkini tanpa melihat jadwal tentor lain.</p>
        </div>
        <div class="stat-pills">
            <div class="stat-pill">
                <span>Agenda Mendatang</span>
                <strong>{{ number_format($summary['upcoming'] ?? 0) }}</strong>
            </div>
            <div class="stat-pill">
                <span>Selesai</span>
                <strong>{{ number_format($summary['completed'] ?? 0) }}</strong>
            </div>
            <div class="stat-pill">
                <span>Dibatalkan</span>
                <strong>{{ number_format($summary['cancelled'] ?? 0) }}</strong>
            </div>
        </div>
    </div>

    <div class="section-grid">
        <div class="panel">
            <div class="panel-head">
                <div>
                    <p class="eyebrow">Agenda berikutnya</p>
                    <h2>Sesi Mendatang</h2>
                    <p>Sesi yang sudah dijadwalkan untuk Anda dengan urutan terdekat.</p>
                </div>
            </div>

            <div class="session-list">
                @forelse ($upcomingSessions as $session)
                    <article class="session-card" aria-label="Sesi {{ $session['title'] }}">
                        <div class="card-head">
                            <div class="date-block">
                                <span class="date-label">{{ $session['date_label'] }}</span>
                                <span class="time-range">{{ $session['time_range'] }}</span>
                            </div>
                            <span class="status-badge" data-tone="{{ $session['status_meta']['tone'] }}">{{ $session['status_meta']['label'] }}</span>
                        </div>

                        <div class="content">
                            <h3 class="session-title">{{ $session['title'] }}</h3>
                            <p class="session-subtitle">{{ $session['subject'] }}</p>
                        </div>

                        <div class="meta-grid">
                            <div class="meta-item">
                                <p class="meta-label">Paket</p>
                                <p class="meta-value">
                                    <span class="package-tag">{{ $session['package'] }}</span>
                                </p>
                            </div>
                            <div class="meta-item">
                                <p class="meta-label">Siswa</p>
                                <p class="meta-value">{{ $session['students'] }}</p>
                            </div>
                            <div class="meta-item">
                                <p class="meta-label">Lokasi</p>
                                @php
                                    $location = $session['location'];
                                    $isLink = \Illuminate\Support\Str::startsWith($location, ['http://', 'https://']);
                                @endphp
                                <p class="meta-value">
                                    @if ($isLink)
                                        <a href="{{ $location }}" target="_blank" rel="noopener noreferrer">{{ $location }}</a>
                                    @else
                                        {{ $location }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        Belum ada agenda mengajar yang terjadwal. Jadwal akan muncul setelah admin menambahkan sesi untuk Anda.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <div>
                    <p class="eyebrow">Riwayat</p>
                    <h2>Riwayat Sesi</h2>
                    <p>Pertemuan yang sudah berlangsung atau dibatalkan tetap tercatat di sini.</p>
                </div>
            </div>

            <div class="session-list">
                @forelse ($historySessions as $session)
                    <article class="session-card" aria-label="Riwayat {{ $session['title'] }}">
                        <div class="card-head">
                            <div class="date-block">
                                <span class="date-label">{{ $session['date_label'] }}</span>
                                <span class="time-range">{{ $session['time_range'] }}</span>
                            </div>
                            <span class="status-badge" data-tone="{{ $session['status_meta']['tone'] }}">{{ $session['status_meta']['label'] }}</span>
                        </div>

                        <div class="content">
                            <h3 class="session-title">{{ $session['title'] }}</h3>
                            <p class="session-subtitle">{{ $session['subject'] }}</p>
                        </div>

                        <div class="meta-grid">
                            <div class="meta-item">
                                <p class="meta-label">Paket</p>
                                <p class="meta-value">
                                    <span class="package-tag">{{ $session['package'] }}</span>
                                </p>
                            </div>
                            <div class="meta-item">
                                <p class="meta-label">Siswa</p>
                                <p class="meta-value">{{ $session['students'] }}</p>
                            </div>
                            <div class="meta-item">
                                <p class="meta-label">Lokasi</p>
                                @php
                                    $location = $session['location'];
                                    $isLink = \Illuminate\Support\Str::startsWith($location, ['http://', 'https://']);
                                @endphp
                                <p class="meta-value">
                                    @if ($isLink)
                                        <a href="{{ $location }}" target="_blank" rel="noopener noreferrer">{{ $location }}</a>
                                    @else
                                        {{ $location }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        Riwayat sesi belum tersedia. Aktivitas yang selesai atau dibatalkan akan muncul otomatis di sini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
