@extends('admin.layout')

@section('title', 'Dashboard Admin MayClass')

@push('styles')
    <style>
        .hero-card {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
            gap: 32px;
            padding: 32px;
            border-radius: 20px;
            background: var(--surface);
            border: 1px solid var(--border);
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.08);
        }

        .hero-main {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            background: var(--surface-muted);
            border: 1px solid var(--border);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.85rem;
            width: fit-content;
        }

        .hero-main h2 {
            margin: 0;
            font-size: 2rem;
            line-height: 1.3;
        }

        .hero-main p {
            margin: 0;
            font-size: 1rem;
            color: var(--text-muted);
            max-width: 560px;
        }

        .hero-side {
            display: grid;
            gap: 16px;
            align-content: start;
        }

        .hero-metric {
            display: grid;
            gap: 6px;
            padding: 20px;
            border-radius: 16px;
            background: var(--surface-muted);
            border: 1px solid var(--border);
        }

        .hero-metric small {
            font-weight: 600;
            color: rgba(15, 23, 42, 0.65);
            letter-spacing: 0.3px;
        }

        .hero-metric strong {
            font-size: 1.8rem;
            line-height: 1.2;
        }

        .hero-trend {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .hero-trend[data-direction="1"] {
            color: #15803d;
        }

        .hero-trend[data-direction="-1"] {
            color: #b91c1c;
        }

        .hero-trend[data-direction="0"] {
            color: rgba(15, 23, 42, 0.65);
        }

        .hero-trend::before {
            content: attr(data-icon);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 8px;
            background: rgba(15, 23, 42, 0.08);
            color: inherit;
            font-size: 0.75rem;
        }

        .hero-trend[data-direction="1"]::before {
            background: rgba(21, 128, 61, 0.12);
        }

        .hero-trend[data-direction="-1"]::before {
            background: rgba(185, 28, 28, 0.12);
        }

        .hero-mini-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .mini-metric {
            padding: 16px;
            border-radius: 14px;
            background: var(--surface);
            border: 1px solid var(--border);
            display: grid;
            gap: 4px;
        }

        .mini-metric small {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .mini-metric strong {
            font-size: 1.2rem;
        }

        .mini-metric span {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .stat-grid {
            margin-top: 32px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .stat-card {
            padding: 20px;
            border-radius: 16px;
            background: var(--surface);
            border: 1px solid var(--border);
            display: grid;
            gap: 8px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-weight: 600;
            color: var(--primary);
            background: rgba(37, 99, 235, 0.12);
        }

        .stat-card span {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stat-card strong {
            font-size: 1.4rem;
        }

        .stat-card em {
            font-style: normal;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .insights-grid {
            margin-top: 36px;
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
            gap: 28px;
        }

        .card-panel {
            background: var(--surface);
            border-radius: 18px;
            padding: 24px;
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            display: grid;
            gap: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .card-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .chart-wrapper {
            position: relative;
            min-height: 260px;
            padding: 24px 18px 12px;
            border-radius: 18px;
            border: 1px solid var(--border);
            background:
                linear-gradient(180deg, rgba(37, 99, 235, 0.08) 0%, rgba(37, 99, 235, 0.02) 40%, transparent 100%),
                #fff;
            display: flex;
            align-items: flex-end;
            gap: 12px;
            overflow: hidden;
        }

        .chart-wrapper::after,
        .chart-wrapper::before {
            content: '';
            position: absolute;
            left: 18px;
            right: 18px;
            border-top: 1px dashed rgba(15, 23, 42, 0.08);
        }

        .chart-wrapper::after {
            top: 24px;
        }

        .chart-wrapper::before {
            top: 50%;
        }

        .chart-bar {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .chart-bar strong {
            font-size: 0.82rem;
            color: rgba(15, 23, 42, 0.75);
        }

        .chart-bar div {
            width: 100%;
            border-radius: 14px 14px 8px 8px;
            background: linear-gradient(180deg, rgba(37, 99, 235, 0.95), rgba(59, 130, 246, 0.75));
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.25);
        }

        .chart-bar span {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .empty-state {
            padding: 16px 18px;
            border-radius: 16px;
            background: rgba(15, 23, 42, 0.04);
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .pipeline {
            display: grid;
            gap: 18px;
        }

        .pipeline-row {
            display: grid;
            gap: 10px;
        }

        .pipeline-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .pipeline-progress {
            position: relative;
            height: 8px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .pipeline-progress span {
            position: absolute;
            inset: 0 auto 0 0;
            border-radius: inherit;
            background: rgba(37, 99, 235, 0.4);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge[data-type='paid'] {
            background: rgba(21, 128, 61, 0.12);
            color: #15803d;
        }

        .status-badge[data-type='pending'] {
            background: rgba(234, 179, 8, 0.16);
            color: #b45309;
        }

        .status-badge[data-type='failed'] {
            background: rgba(185, 28, 28, 0.16);
            color: #b91c1c;
        }

        .status-badge[data-type='initiated'] {
            background: rgba(59, 130, 246, 0.16);
            color: #1d4ed8;
        }

        .table-scroll {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            min-width: 720px;
        }

        .data-table th,
        .data-table td {
            text-align: left;
            font-size: 0.92rem;
            padding: 12px 16px;
        }

        .data-table th {
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.4px;
            padding-bottom: 6px;
        }

        .data-table tbody tr {
            background: var(--surface-muted);
            border-radius: 14px;
            box-shadow: 0 6px 12px rgba(15, 23, 42, 0.08);
        }

        .data-table tbody td {
            border: none;
        }

        .data-table tbody td:first-child {
            border-top-left-radius: 14px;
            border-bottom-left-radius: 14px;
        }

        .data-table tbody td:last-child {
            border-top-right-radius: 14px;
            border-bottom-right-radius: 14px;
            text-align: right;
        }

        .data-table thead tr th:last-child {
            text-align: right;
        }

        .detail-grid {
            margin-top: 32px;
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
            gap: 28px;
        }

        .stacked {
            display: grid;
            gap: 24px;
        }

        .top-package-list,
        .student-list {
            display: grid;
            gap: 18px;
        }

        .package-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(15, 23, 42, 0.06);
        }

        .package-item strong {
            display: block;
            font-size: 1rem;
        }

        .package-item span {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .student-card {
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(15, 23, 42, 0.06);
            display: grid;
            gap: 4px;
        }

        .student-card strong {
            font-size: 1rem;
        }

        @media (max-width: 1200px) {
            .stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .hero-card {
                grid-template-columns: 1fr;
            }

            .insights-grid,
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .hero-card {
                padding: 28px;
                gap: 24px;
            }

            .hero-mini-grid {
                grid-template-columns: 1fr;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }
        }

        .schedule-admin {
            margin-top: 48px;
            display: grid;
            gap: 28px;
        }

        .schedule-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 18px;
            align-items: flex-end;
        }

        .schedule-header h3 {
            margin: 6px 0 8px;
            font-size: 1.6rem;
        }

        .schedule-header p {
            margin: 0;
            color: var(--text-muted);
            max-width: 520px;
        }

        .tutor-filter {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .tutor-filter label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-muted);
            display: grid;
            gap: 8px;
        }

        .tutor-filter select {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 10px 14px;
            font-family: inherit;
            background: #fff;
        }

        .schedule-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
        }

        .schedule-metric {
            padding: 18px;
            border-radius: 16px;
            border: 1px solid var(--border);
            background: var(--surface);
            display: grid;
            gap: 6px;
        }

        .schedule-metric span {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .schedule-metric strong {
            font-size: 1.4rem;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
            gap: 24px;
        }

        .calendar-card,
        .schedule-panel {
            border-radius: 20px;
            border: 1px solid var(--border);
            background: var(--surface);
            padding: 24px;
            display: grid;
            gap: 20px;
        }

        .calendar-stack {
            display: grid;
            gap: 18px;
        }

        .calendar-day {
            border-radius: 18px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            padding: 18px;
            display: grid;
            gap: 16px;
        }

        .calendar-sessions {
            display: grid;
            gap: 12px;
        }

        .calendar-day header {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
        }

        .calendar-day header div span {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .session-card {
            border-radius: 16px;
            border: 1px solid rgba(15, 23, 42, 0.06);
            padding: 16px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 16px;
            background: var(--surface-muted);
        }

        .session-card h4 {
            margin: 6px 0;
            font-size: 1.1rem;
        }

        .session-card .subject-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 0.8rem;
            background: rgba(37, 99, 235, 0.15);
            color: #1d4ed8;
            font-weight: 600;
        }

        .session-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .session-time {
            text-align: right;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .session-time strong {
            font-size: 1.1rem;
        }

        .session-actions {
            display: flex;
            justify-content: flex-end;
        }

        .session-actions form button,
        .history-table button {
            border: none;
            border-radius: 10px;
            padding: 8px 14px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .session-actions form button {
            background: rgba(239, 68, 68, 0.12);
            color: #b91c1c;
        }

        .history-table button {
            background: rgba(34, 197, 94, 0.15);
            color: #15803d;
        }

        .template-form,
        .template-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
        }

        .template-form label,
        .template-row label {
            display: grid;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .template-form input,
        .template-form select,
        .template-row input,
        .template-row select {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 10px 12px;
            font-family: inherit;
        }

        .template-list {
            display: grid;
            gap: 16px;
        }

        .template-card {
            border-radius: 18px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            padding: 18px;
            display: grid;
            gap: 12px;
            background: var(--surface-muted);
        }

        .template-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .template-actions button {
            border: none;
            border-radius: 12px;
            padding: 10px 16px;
            font-weight: 600;
            cursor: pointer;
            background: var(--primary);
            color: #fff;
        }

        .template-actions form:last-child button {
            background: rgba(239, 68, 68, 0.12);
            color: #b91c1c;
        }

        .history-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .history-table th {
            text-align: left;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-muted);
            padding-bottom: 6px;
        }

        .history-table td {
            background: var(--surface-muted);
            padding: 12px 14px;
            border-top: 1px solid rgba(15, 23, 42, 0.04);
            border-bottom: 1px solid rgba(15, 23, 42, 0.04);
        }

        .history-table td:first-child {
            border-left: 1px solid rgba(15, 23, 42, 0.04);
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .history-table td:last-child {
            border-right: 1px solid rgba(15, 23, 42, 0.04);
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
            text-align: right;
        }

        @media (max-width: 1024px) {
            .schedule-grid {
                grid-template-columns: 1fr;
            }

            .session-card {
                grid-template-columns: 1fr;
            }

            .session-time {
                text-align: left;
            }
        }
    </style>
@endpush

@section('content')
    <section class="hero-card">
        <div class="hero-main">
            <span class="hero-chip">Ringkasan operasional</span>
            <h2>Monitor seluruh aktivitas MayClass dalam satu tempat</h2>
            <p>
                Data finansial, pendaftaran siswa, dan performa paket belajar diperbarui secara langsung sehingga tim administrasi
                dapat mengambil keputusan cepat setiap hari.
            </p>
        </div>
        <div class="hero-side">
            @php
                $direction = $monthComparison['direction'];
                $trendIcon = $direction === 1 ? '▲' : ($direction === -1 ? '▼' : '●');
            @endphp
            <div class="hero-metric">
                <small>Pendapatan terverifikasi bulan ini</small>
                <strong>{{ $monthComparison['formatted'] }}</strong>
                <span class="hero-trend" data-direction="{{ $direction }}" data-icon="{{ $trendIcon }}">
                    {{ $direction === 0 ? 'Stabil' : ($direction === 1 ? 'Naik' : 'Turun') }}
                    {{ number_format(abs($monthComparison['delta']), 1, ',', '.') }}%
                    dibanding bulan lalu
                </span>
            </div>
            <div class="hero-mini-grid">
                <article class="mini-metric">
                    <small>Total siswa aktif</small>
                    <strong>{{ number_format($stats['totalStudents']) }}</strong>
                    <span>Seluruh siswa terdaftar</span>
                </article>
                <article class="mini-metric">
                    <small>Pembayaran menunggu aksi</small>
                    <strong>{{ number_format($stats['pendingPayments']) }}</strong>
                    <span>Perlu verifikasi admin</span>
                </article>
            </div>
        </div>
    </section>

    <section class="stat-grid">
        <article class="stat-card">
            <div class="stat-icon">Rp</div>
            <span>Pendapatan Tahun Ini</span>
            <strong>{{ $stats['yearRevenue'] }}</strong>
            <em>Akumulasi transaksi berstatus lunas {{ now()->year }}.</em>
        </article>
        <article class="stat-card">
            <div class="stat-icon">Σ</div>
            <span>Pendapatan Sepanjang Waktu</span>
            <strong>{{ $stats['totalRevenue'] }}</strong>
            <em>Total pemasukan bersih yang tercatat.</em>
        </article>
        <article class="stat-card">
            <div class="stat-icon">Ø</div>
            <span>Nilai Rata-rata Transaksi</span>
            <strong>{{ $stats['averageTicket'] }}</strong>
            <em>Rerata nominal dari setiap pembayaran sukses.</em>
        </article>
        <article class="stat-card">
            <div class="stat-icon">✓</div>
            <span>Transaksi Selesai</span>
            <strong>{{ number_format($stats['paidOrders']) }}</strong>
            <em>Jumlah order berstatus lunas sepanjang waktu.</em>
        </article>
    </section>

    <section class="insights-grid">
        <div class="card-panel">
            <div class="card-header">
                <h3>Grafik Pendapatan {{ now()->year }}</h3>
                <span class="card-subtitle">Berdasarkan transaksi lunas per bulan</span>
            </div>
            @if ($monthlyRevenue->sum('value') === 0)
                <div class="empty-state">Belum ada transaksi lunas yang tercatat pada tahun ini.</div>
            @else
                @php
                    $maxValue = max($monthlyRevenue->pluck('value')->all() ?: [1]);
                @endphp
                <div class="chart-wrapper" role="img" aria-label="Grafik pendapatan bulanan">
                    @foreach ($monthlyRevenue as $entry)
                        @php
                            $height = $maxValue > 0 ? max(($entry['value'] / $maxValue) * 100, 6) : 6;
                        @endphp
                        <div class="chart-bar">
                            <strong>{{ $entry['formatted'] }}</strong>
                            <div style="height: {{ $height }}%;"></div>
                            <span>{{ $entry['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="card-panel">
            <div class="card-header">
                <h3>Pipeline Pembayaran</h3>
                <span class="card-subtitle">Distribusi status order terbaru</span>
            </div>
            @if ($paymentPipeline['total'] === 0)
                <div class="empty-state">Belum ada order yang tercatat pada sistem.</div>
            @else
                <div class="pipeline">
                    @foreach ($paymentPipeline['rows'] as $row)
                        <div class="pipeline-row">
                            <div class="pipeline-header">
                                <span class="status-badge" data-type="{{ $row['status'] }}">{{ $row['label'] }}</span>
                                <strong>{{ number_format($row['count']) }}</strong>
                                <small class="card-subtitle">{{ $row['percentage'] }}%</small>
                            </div>
                            <div class="pipeline-progress">
                                <span style="width: {{ max($row['percentage'], 6) }}%;"></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="detail-grid">
        <div class="card-panel">
            <div class="card-header">
                <h3>Transaksi Terbaru</h3>
                <span class="card-subtitle">6 order terakhir yang masuk ke sistem</span>
            </div>
            @if ($recentPayments->isEmpty())
                <div class="empty-state">Belum ada transaksi yang tercatat.</div>
            @else
                <div class="table-scroll">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Siswa</th>
                                <th>Paket</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentPayments as $payment)
                                <tr>
                                    <td>{{ $payment['invoice'] }}</td>
                                    <td>{{ $payment['student'] }}</td>
                                    <td>{{ $payment['package'] }}</td>
                                    <td>
                                        <span class="status-badge" data-type="{{ $payment['status'] }}">{{ $payment['status_label'] }}</span>
                                    </td>
                                    <td>{{ $payment['total'] }}</td>
                                    <td>{{ $payment['paid_at'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="stacked">
            <div class="card-panel">
                <div class="card-header">
                    <h3>Paket Teratas</h3>
                    <span class="card-subtitle">Berdasarkan jumlah transaksi lunas</span>
                </div>
                @if ($topPackages->isEmpty())
                    <div class="empty-state">Belum ada data paket yang terhubung dengan transaksi.</div>
                @else
                    <div class="top-package-list">
                        @foreach ($topPackages as $package)
                            <div class="package-item">
                                <div>
                                    <strong>{{ $package['title'] }}</strong>
                                    <span>{{ number_format($package['orders']) }} transaksi lunas</span>
                                </div>
                                <strong>{{ $package['revenue'] }}</strong>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="card-panel">
                <div class="card-header">
                    <h3>Siswa Terbaru</h3>
                    <a href="{{ route('admin.students.index') }}" class="card-subtitle">Lihat semua siswa</a>
                </div>
                @if ($recentStudents->isEmpty())
                    <div class="empty-state">Belum ada pendaftaran siswa baru.</div>
                @else
                    <div class="student-list">
                        @foreach ($recentStudents as $student)
                            <div class="student-card">
                                <strong>{{ $student['name'] }}</strong>
                                <small>{{ $student['email'] }}</small>
                                <small>ID: {{ $student['student_id'] ?? 'Belum ditetapkan' }}</small>
                                <small>Bergabung {{ $student['joined_at'] }}</small>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="schedule-admin">
        <div class="schedule-header">
            <div>
                <span class="hero-chip">Penjadwalan tutor</span>
                <h3>Kalender pengajaran MayClass</h3>
                <p>Admin dapat meninjau jadwal setiap tutor, mengatur pola pertemuan, serta memindahkan sesi yang sudah selesai ke histori.</p>
            </div>
            @if ($schedule['tutors']->isNotEmpty())
                <form method="GET" action="{{ route('admin.dashboard') }}" class="tutor-filter">
                    <label>
                        <span>Pilih tutor</span>
                        <select name="tutor_id" onchange="this.form.submit()">
                            <option value="all" @selected($schedule['activeFilter'] === 'all')>Semua tutor</option>
                            @foreach ($schedule['tutors'] as $tutor)
                                <option value="{{ $tutor->id }}" @selected($schedule['activeFilter'] === (string) $tutor->id)>
                                    {{ $tutor->name }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                </form>
            @endif
        </div>
        <div class="schedule-metrics">
            <article class="schedule-metric">
                <span>Sesi akan datang</span>
                <strong>{{ number_format($schedule['metrics']['upcoming']) }}</strong>
            </article>
            <article class="schedule-metric">
                <span>Histori selesai</span>
                <strong>{{ number_format($schedule['metrics']['history']) }}</strong>
            </article>
            <article class="schedule-metric">
                <span>Dibatalkan</span>
                <strong>{{ number_format($schedule['metrics']['cancelled']) }}</strong>
            </article>
            <article class="schedule-metric">
                <span>Pola aktif</span>
                <strong>{{ number_format($schedule['metrics']['templates']) }}</strong>
            </article>
        </div>
        <div class="schedule-grid">
            <article class="calendar-card">
                <div class="card-header">
                    <div>
                        <h3>Agenda mendatang</h3>
                        <span class="card-subtitle">Kelompokkan jadwal berdasarkan tanggal kalender</span>
                    </div>
                </div>
                @if (! $schedule['ready'])
                    <div class="empty-state">Sistem jadwal belum siap. Pastikan migrasi jadwal telah dijalankan.</div>
                @elseif ($schedule['upcomingDays']->isEmpty())
                    <div class="empty-state">Belum ada sesi mengajar yang tercatat.</div>
                @else
                    <div class="calendar-stack">
                        @foreach ($schedule['upcomingDays'] as $day)
                            <article class="calendar-day">
                                <header>
                                    <div>
                                        <strong>{{ $day['weekday'] }}</strong>
                                        <span>{{ $day['full_date'] }}</span>
                                    </div>
                                    <span class="card-subtitle">{{ count($day['items']) }} sesi</span>
                                </header>
                                <div class="calendar-sessions">
                                    @foreach ($day['items'] as $session)
                                        <div class="session-card">
                                            <div>
                                                <span class="subject-badge">{{ $session['subject'] }}</span>
                                                <h4>{{ $session['title'] }}</h4>
                                                <div class="session-meta">
                                                    <span>{{ $session['package'] }}</span>
                                                    <span>&middot;</span>
                                                    <span>{{ $session['class_level'] }}</span>
                                                </div>
                                                <div class="session-meta">
                                                    <span>Pengajar: {{ $session['tutor'] }}</span>
                                                </div>
                                                <div class="session-meta">
                                                    <span>Lokasi: {{ $session['location'] }}</span>
                                                    @if ($session['student_count'])
                                                        <span>&middot;</span>
                                                        <span>{{ $session['student_count'] }} siswa</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="session-time">
                                                <strong>{{ $session['time_range'] }}</strong>
                                                <small>Waktu belajar</small>
                                                <div class="session-actions">
                                                    <form method="POST" action="{{ route('admin.schedule.sessions.cancel', $session['id']) }}" onsubmit="return confirm('Batalkan sesi ini?');">
                                                        @csrf
                                                        <input type="hidden" name="redirect_tutor_id" value="{{ $schedule['activeFilter'] }}">
                                                        <button type="submit">Batalkan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </article>
            <div class="schedule-panel">
                <div>
                    <div class="card-header">
                        <h3>Atur pola jadwal</h3>
                        <span class="card-subtitle">Gunakan tanggal spesifik untuk menentukan hari, tanggal, bulan, dan tahun pertama sesi.</span>
                    </div>
                    @if (! $schedule['selectedTutorId'])
                        <div class="empty-state">Pilih tutor tertentu untuk menambahkan atau mengubah pola jadwal.</div>
                    @elseif ($schedule['packages']->isEmpty())
                        <div class="empty-state">Belum ada paket belajar yang bisa dihubungkan. Tambahkan paket terlebih dahulu.</div>
                    @else
                        <form class="template-form" method="POST" action="{{ route('admin.schedule.templates.store') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $schedule['selectedTutorId'] }}" />
                            <label>
                                <span>Paket</span>
                                <select name="package_id" required>
                                    @foreach ($schedule['packages'] as $package)
                                        <option value="{{ $package->id }}" @selected(old('package_id') == $package->id)>
                                            {{ $package->detail_title ?? __('Paket MayClass') }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label>
                                <span>Judul</span>
                                <input type="text" name="title" value="{{ old('title') }}" required />
                            </label>
                            <label>
                                <span>Mata Pelajaran</span>
                                <input type="text" name="category" value="{{ old('category') }}" />
                            </label>
                            <label>
                                <span>Tingkat</span>
                                <input type="text" name="class_level" value="{{ old('class_level') }}" />
                            </label>
                            <label>
                                <span>Lokasi</span>
                                <input type="text" name="location" value="{{ old('location') }}" />
                            </label>
                            <label>
                                <span>Tanggal pertama</span>
                                <input type="date" name="reference_date" value="{{ old('reference_date', $schedule['referenceDate']) }}" required />
                            </label>
                            <label>
                                <span>Jam mulai</span>
                                <input type="time" name="start_time" value="{{ old('start_time', '16:00') }}" required />
                            </label>
                            <label>
                                <span>Durasi (menit)</span>
                                <input type="number" name="duration_minutes" min="30" max="240" step="15" value="{{ old('duration_minutes', 90) }}" required />
                            </label>
                            <label>
                                <span>Kuota siswa</span>
                                <input type="number" name="student_count" min="1" max="200" value="{{ old('student_count') }}" />
                            </label>
                            <div class="template-actions" style="grid-column: 1 / -1;">
                                <button type="submit">Tambah pola</button>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="system-alert" style="margin: 0;">
                                <strong>Gagal menyimpan pola jadwal.</strong>
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif
                    @if ($schedule['templates']->isNotEmpty())
                        <div class="template-list">
                            @foreach ($schedule['templates'] as $template)
                                <div class="template-card">
                                    <form method="POST" action="{{ route('admin.schedule.templates.update', $template['id']) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="user_id" value="{{ $template['user_id'] }}" />
                                        <div class="template-row">
                                            <label>
                                                <span>Paket</span>
                                                <select name="package_id" required>
                                                    @foreach ($schedule['packages'] as $package)
                                                        <option value="{{ $package->id }}" @selected($package->id === $template['package_id'])>
                                                            {{ $package->detail_title ?? __('Paket MayClass') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </label>
                                            <label>
                                                <span>Judul</span>
                                                <input type="text" name="title" value="{{ $template['title'] }}" required />
                                            </label>
                                            <label>
                                                <span>Pelajaran</span>
                                                <input type="text" name="category" value="{{ $template['category'] }}" />
                                            </label>
                                            <label>
                                                <span>Tingkat</span>
                                                <input type="text" name="class_level" value="{{ $template['class_level'] }}" />
                                            </label>
                                            <label>
                                                <span>Lokasi</span>
                                                <input type="text" name="location" value="{{ $template['location'] }}" />
                                            </label>
                                            <label>
                                                <span>Tanggal pertama</span>
                                                <input type="date" name="reference_date" value="{{ $template['reference_date_value'] ?? $schedule['referenceDate'] }}" required />
                                            </label>
                                            <label>
                                                <span>Jam mulai</span>
                                                <input type="time" name="start_time" value="{{ $template['start_time'] }}" required />
                                            </label>
                                            <label>
                                                <span>Durasi</span>
                                                <input type="number" name="duration_minutes" min="30" max="240" step="15" value="{{ $template['duration_minutes'] }}" required />
                                            </label>
                                            <label>
                                                <span>Kuota</span>
                                                <input type="number" name="student_count" min="1" max="200" value="{{ $template['student_count'] }}" />
                                            </label>
                                        </div>
                                        <div class="template-actions">
                                            <button type="submit">Simpan</button>
                                        </div>
                                    </form>
                                    <div class="template-actions">
                                        <form method="POST" action="{{ route('admin.schedule.templates.destroy', $template['id']) }}" onsubmit="return confirm('Hapus pola jadwal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="redirect_tutor_id" value="{{ $schedule['activeFilter'] }}" />
                                            <button type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="history-stack" style="display: grid; gap: 20px;">
                    <div>
                        <div class="card-header">
                            <h3>Histori sesi selesai</h3>
                            <span class="card-subtitle">Pertemuan yang telah dilaksanakan otomatis dipindahkan ke daftar ini.</span>
                        </div>
                        @if ($schedule['historySessions']->isEmpty())
                            <div class="empty-state">Belum ada sesi yang selesai.</div>
                        @else
                            <table class="history-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Pengajar</th>
                                        <th>Paket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedule['historySessions'] as $history)
                                        <tr>
                                            <td>{{ $history['label'] }}</td>
                                            <td>{{ $history['time_range'] }}</td>
                                            <td>{{ $history['tutor'] }}</td>
                                            <td>{{ $history['package'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div>
                        <div class="card-header">
                            <h3>Sesi dibatalkan</h3>
                            <span class="card-subtitle">Pulihkan jadwal jika pertemuan dijadwalkan ulang.</span>
                        </div>
                        @if ($schedule['cancelledSessions']->isEmpty())
                            <div class="empty-state">Tidak ada sesi yang dibatalkan.</div>
                        @else
                            <table class="history-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Pengajar</th>
                                        <th>Paket</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedule['cancelledSessions'] as $cancelled)
                                        <tr>
                                            <td>{{ $cancelled['label'] }}</td>
                                            <td>{{ $cancelled['time_range'] }}</td>
                                            <td>{{ $cancelled['tutor'] }}</td>
                                            <td>{{ $cancelled['package'] }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.schedule.sessions.restore', $cancelled['id']) }}">
                                                    @csrf
                                                    <input type="hidden" name="redirect_tutor_id" value="{{ $schedule['activeFilter'] }}" />
                                                    <button type="submit">Pulihkan</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
