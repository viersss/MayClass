@extends('admin.layout')

@section('title', 'Dashboard Admin MayClass')

@push('styles')
    <style>
        .hero-card {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
            gap: 36px;
            padding: 40px;
            border-radius: 32px;
            background: linear-gradient(130deg, rgba(84, 101, 255, 0.18), rgba(61, 183, 173, 0.22));
            border: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow: 0 32px 70px rgba(15, 23, 42, 0.12);
            overflow: hidden;
        }

        .hero-card::after {
            content: '';
            position: absolute;
            inset: -120px -100px auto auto;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.35), transparent 65%);
            pointer-events: none;
        }

        .hero-main {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 18px;
            color: #0f172a;
        }

        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.55);
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 0.9rem;
            width: fit-content;
        }

        .hero-main h2 {
            margin: 0;
            font-size: 2.4rem;
            line-height: 1.25;
        }

        .hero-main p {
            margin: 0;
            font-size: 1rem;
            color: rgba(15, 23, 42, 0.72);
            max-width: 560px;
        }

        .hero-actions {
            margin-top: 8px;
            display: inline-flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .hero-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 22px;
            border-radius: 14px;
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            box-shadow: 0 16px 32px rgba(61, 183, 173, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hero-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(61, 183, 173, 0.28);
        }

        .hero-link--ghost {
            background: rgba(255, 255, 255, 0.65);
            color: var(--primary-dark);
            box-shadow: none;
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .hero-side {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 18px;
            align-content: start;
        }

        .hero-metric {
            display: grid;
            gap: 10px;
            padding: 26px 28px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .hero-metric small {
            font-weight: 600;
            color: rgba(15, 23, 42, 0.65);
            letter-spacing: 0.3px;
        }

        .hero-metric strong {
            font-size: 2rem;
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
            gap: 16px;
        }

        .mini-metric {
            padding: 18px 20px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(15, 23, 42, 0.08);
            display: grid;
            gap: 6px;
        }

        .mini-metric small {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .mini-metric strong {
            font-size: 1.3rem;
        }

        .mini-metric span {
            font-size: 0.85rem;
            color: rgba(15, 23, 42, 0.6);
        }

        .stat-grid {
            margin-top: 32px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .stat-card {
            position: relative;
            padding: 24px 26px;
            border-radius: 24px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.08);
            display: grid;
            gap: 14px;
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-weight: 600;
            color: #0f172a;
            background: rgba(61, 183, 173, 0.16);
        }

        .stat-card span {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stat-card strong {
            font-size: 1.6rem;
        }

        .stat-card em {
            font-style: normal;
            font-size: 0.85rem;
            color: rgba(15, 23, 42, 0.6);
        }

        .insights-grid {
            margin-top: 36px;
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
            gap: 28px;
        }

        .card-panel {
            background: var(--card-bg);
            border-radius: 26px;
            padding: 28px 30px;
            border: 1px solid var(--card-border);
            box-shadow: 0 26px 55px rgba(15, 23, 42, 0.08);
            display: grid;
            gap: 24px;
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
            height: 260px;
            display: flex;
            align-items: flex-end;
            gap: 18px;
        }

        .chart-bar {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
        }

        .chart-bar div {
            width: 100%;
            border-radius: 18px 18px 8px 8px;
            background: linear-gradient(180deg, rgba(84, 101, 255, 0.85), rgba(31, 209, 161, 0.7));
            transition: transform 0.25s ease;
        }

        .chart-bar div:hover {
            transform: translateY(-4px);
        }

        .chart-bar span {
            font-size: 0.85rem;
            color: var(--text-muted);
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
            background: linear-gradient(90deg, rgba(61, 183, 173, 0.85), rgba(84, 101, 255, 0.75));
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

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 12px 0;
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
            text-align: left;
            font-size: 0.92rem;
        }

        .data-table th {
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.4px;
        }

        .data-table td:last-child,
        .data-table th:last-child {
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

        .sparkline {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
            align-items: end;
        }

        .spark-bar {
            display: grid;
            gap: 6px;
            justify-items: center;
        }

        .spark-bar span {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .spark-bar div {
            width: 100%;
            border-radius: 12px 12px 6px 6px;
            background: rgba(84, 101, 255, 0.28);
        }

        .spark-bar small {
            font-size: 0.82rem;
            font-weight: 600;
            color: rgba(15, 23, 42, 0.72);
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
            <div class="hero-actions">
                <a href="{{ route('admin.finance.index') }}" class="hero-link">Verifikasi pembayaran</a>
                <a href="{{ route('admin.packages.index') }}" class="hero-link hero-link--ghost">Kelola paket belajar</a>
            </div>
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
            @if ($monthlyRevenue->isEmpty())
                <div class="empty-state">Belum ada transaksi lunas yang tercatat pada tahun ini.</div>
            @else
                @php
                    $maxValue = max($monthlyRevenue->pluck('value')->all() ?: [1]);
                @endphp
                <div class="chart-wrapper">
                    @foreach ($monthlyRevenue as $entry)
                        @php
                            $height = $maxValue > 0 ? max(($entry['value'] / $maxValue) * 100, 6) : 6;
                        @endphp
                        <div class="chart-bar">
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

    <section class="card-panel" style="margin-top: 32px;">
        <div class="card-header">
            <h3>Pertumbuhan Siswa 6 Bulan Terakhir</h3>
            <span class="card-subtitle">Jumlah siswa baru setiap bulan</span>
        </div>
        @if ($studentGrowth->sum('total') === 0)
            <div class="empty-state">Belum ada pertambahan siswa pada enam bulan terakhir.</div>
        @else
            @php
                $maxStudent = max($studentGrowth->pluck('total')->all() ?: [1]);
            @endphp
            <div class="sparkline">
                @foreach ($studentGrowth as $point)
                    @php
                        $height = $maxStudent > 0 ? max(($point['total'] / $maxStudent) * 100, 8) : 8;
                    @endphp
                    <div class="spark-bar">
                        <div style="height: {{ $height }}%;"></div>
                        <span>{{ $point['label'] }}</span>
                        <small>{{ number_format($point['total']) }}</small>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection
