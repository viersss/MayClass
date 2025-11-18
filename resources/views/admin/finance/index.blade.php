@extends('admin.layout')

@section('title', 'Manajemen Keuangan - MayClass')

@push('styles')
    <style>
        .finance-wrapper {
            display: grid;
            gap: 24px;
        }

        /* Header */
        .finance-header {
            padding: 32px;
            border-radius: 20px;
            background: var(--surface);
            border: 1px solid var(--border);
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.08);
        }

        .finance-header h2 {
            margin: 0;
            font-size: 1.9rem;
        }

        .finance-header p {
            margin: 8px 0 0;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Stats Grid */
        .finance-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .finance-card {
            background: var(--surface);
            border-radius: 16px;
            padding: 22px;
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            display: grid;
            gap: 10px;
        }

        .finance-card span {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .finance-card strong {
            font-size: 1.6rem;
        }

        /* Status Grid */
        .finance-status-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .status-card {
            background: var(--surface);
            border-radius: 18px;
            padding: 22px;
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            display: grid;
            gap: 12px;
        }

        .status-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .status-card h4 {
            margin: 0;
            font-size: 1rem;
        }

        .status-card strong {
            font-size: 1.8rem;
        }

        .status-card p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .status-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-chip[data-type="pending"] {
            background: rgba(234, 179, 8, 0.16);
            color: #b45309;
        }

        .status-chip[data-type="paid"] {
            background: rgba(21, 128, 61, 0.12);
            color: #15803d;
        }

        .status-chip[data-type="rejected"] {
            background: rgba(185, 28, 28, 0.16);
            color: #b91c1c;
        }

        .status-chip[data-type="failed"] {
            background: rgba(185, 28, 28, 0.16);
            color: #b91c1c;
        }

        /* Main Content */
        .finance-columns {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .panel {
            background: var(--surface);
            border-radius: 20px;
            padding: 28px;
            border: 1px solid var(--border);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            display: grid;
            gap: 20px;
        }

        .panel-header {
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .panel h3 {
            margin: 0;
            font-size: 1.3rem;
        }

        .panel-header p {
            margin: 4px 0 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Chart */
        .chart-wrapper {
            height: 280px;
            padding: 24px 18px 12px;
            border-radius: 16px;
            border: 1px solid var(--border);
            background: linear-gradient(180deg, rgba(37, 99, 235, 0.08) 0%, rgba(37, 99, 235, 0.02) 40%, transparent 100%), #fff;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            position: relative;
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
            align-items: center;
            gap: 8px;
            position: relative;
            z-index: 2;
        }

        .chart-bar div {
            width: 100%;
            border-radius: 12px 12px 6px 6px;
            background: linear-gradient(180deg, rgba(37, 99, 235, 0.95), rgba(59, 130, 246, 0.75));
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.25);
        }

        .chart-bar span {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* Table */
        .table-scroll {
            overflow-x: auto;
        }

        .pending-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            min-width: 900px;
        }

        .pending-table thead {
            background: var(--surface-muted);
        }

        .pending-table th {
            padding: 14px 16px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pending-table th:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .pending-table th:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .pending-table tbody tr {
            background: var(--surface-muted);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .pending-table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(15, 23, 42, 0.12);
        }

        .pending-table td {
            padding: 14px 16px;
            font-size: 0.9rem;
        }

        .pending-table tbody td:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .pending-table tbody td:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 90px;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pill--pending {
            background: rgba(234, 179, 8, 0.16);
            color: #b45309;
        }

        .status-pill--paid {
            background: rgba(21, 128, 61, 0.12);
            color: #15803d;
        }

        .status-pill--rejected {
            background: rgba(185, 28, 28, 0.16);
            color: #b91c1c;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .approve-btn,
        .reject-btn {
            padding: 8px 14px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .approve-btn {
            background: var(--primary);
            color: #fff;
        }

        .approve-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .reject-btn {
            background: rgba(239, 68, 68, 0.12);
            color: #b91c1c;
        }

        .reject-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            transform: translateY(-1px);
        }

        .proof-link {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .proof-link:hover {
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: var(--text-muted);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .finance-stats,
            .finance-status-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .finance-stats,
            .finance-status-grid {
                grid-template-columns: 1fr;
            }

            .finance-header {
                padding: 24px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="finance-wrapper">
        <!-- Header -->
        <div class="finance-header">
            <h2>Manajemen Keuangan</h2>
            <p>Monitor pendapatan, verifikasi pembayaran siswa, dan kelola transaksi secara real-time</p>
        </div>

        <!-- Stats Cards -->
        <div class="finance-stats">
            <div class="finance-card">
                <span>Total Pemasukan</span>
                <strong>{{ $stats['totalRevenue'] }}</strong>
            </div>
            <div class="finance-card">
                <span>Pendapatan Tahun Ini</span>
                <strong>{{ $stats['yearRevenue'] }}</strong>
            </div>
            <div class="finance-card">
                <span>Total Siswa Aktif</span>
                <strong>{{ number_format($stats['totalStudents']) }}</strong>
            </div>
            <div class="finance-card">
                <span>Pembayaran Pending</span>
                <strong>{{ number_format($stats['pendingPayments']) }}</strong>
            </div>
        </div>

        <!-- Status Summary -->
        <div class="finance-status-grid">
            <div class="status-card">
                <div class="status-card-header">
                    <h4>{{ $statusSummary['pending']['label'] }}</h4>
                    <span class="status-chip" data-type="pending">
                        <span>⏳</span> Pending
                    </span>
                </div>
                <strong>{{ number_format($statusSummary['pending']['count']) }}</strong>
                <p>{{ $statusSummary['pending']['description'] }}</p>
            </div>
            <div class="status-card">
                <div class="status-card-header">
                    <h4>{{ $statusSummary['paid']['label'] }}</h4>
                    <span class="status-chip" data-type="paid">
                        <span>✔️</span> Paid
                    </span>
                </div>
                <strong>{{ number_format($statusSummary['paid']['count']) }}</strong>
                <p>{{ $statusSummary['paid']['description'] }}</p>
            </div>
            <div class="status-card">
                <div class="status-card-header">
                    <h4>{{ $statusSummary['rejected']['label'] }}</h4>
                    <span class="status-chip" data-type="rejected">
                        <span>⚠️</span> Rejected
                    </span>
                </div>
                <strong>{{ number_format($statusSummary['rejected']['count']) }}</strong>
                <p>{{ $statusSummary['rejected']['description'] }}</p>
            </div>
            <div class="status-card">
                <div class="status-card-header">
                    <h4>{{ $statusSummary['failed']['label'] }}</h4>
                    <span class="status-chip" data-type="failed">
                        <span>⏱️</span> Timeout
                    </span>
                </div>
                <strong>{{ number_format($statusSummary['failed']['count']) }}</strong>
                <p>{{ $statusSummary['failed']['description'] }}</p>
            </div>
        </div>

        <!-- Chart Section -->
        <section class="panel">
            <div class="panel-header">
                <h3>Grafik Pendapatan {{ now()->year }}</h3>
                <p>Visualisasi pemasukan bulanan berdasarkan transaksi yang sudah diverifikasi</p>
            </div>
            <div class="chart-wrapper">
                @php
                    $maxValue = max($monthlyRevenue->pluck('value')->all() ?: [1]);
                @endphp
                @foreach ($monthlyRevenue as $entry)
                    @php
                        $height = $maxValue > 0 ? max(($entry['value'] / $maxValue) * 100, 4) : 4;
                    @endphp
                    <div class="chart-bar">
                        <div style="height: {{ $height }}%;"></div>
                        <span>{{ $entry['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Verification Table -->
        <section class="panel">
            <div class="panel-header">
                <h3>Verifikasi Pembayaran</h3>
                <p>Periksa bukti transfer dan lakukan approval transaksi siswa</p>
            </div>
            <div class="table-scroll">
                <table class="pending-table">
                    <thead>
                        <tr>
                            <th>Paket</th>
                            <th>Siswa</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order['package'] }}</td>
                                <td>{{ $order['student'] }}</td>
                                <td>{{ $order['total'] }}</td>
                                <td>{{ $order['due_at'] }}</td>
                                <td>
                                    <span class="{{ $order['status_class'] }}">{{ $order['status_label'] }}</span>
                                </td>
                                <td>
                                    @if ($order['proof'])
                                        <a class="proof-link" href="{{ $order['proof'] }}" target="_blank" rel="noopener">
                                            {{ $order['proof_name'] ?? __('Lihat') }}
                                        </a>
                                    @else
                                        <span style="color: var(--text-muted);">Tidak ada</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order['canApprove'] || $order['canReject'])
                                        <div class="action-buttons">
                                            @if ($order['canApprove'])
                                                <form action="{{ route('admin.finance.approve', $order['id']) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="approve-btn">Verifikasi</button>
                                                </form>
                                            @endif
                                            @if ($order['canReject'])
                                                <form action="{{ route('admin.finance.reject', $order['id']) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="reject-btn">Tolak</button>
                                                </form>
                                            @endif
                                        </div>
                                    @else
                                        <span style="color: var(--text-muted);">Tidak ada aksi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    Belum ada transaksi pembayaran yang tercatat
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection