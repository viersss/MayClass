@extends('admin.layout')

@section('title', 'Manajemen Keuangan - MayClass')

@push('styles')
    <style>
        .finance-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .finance-header h2 {
            margin: 0;
            font-size: 1.7rem;
        }

        .finance-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .finance-card {
            background: rgba(255, 255, 255, 0.92);
            border-radius: 24px;
            padding: 22px 24px;
            border: 1px solid var(--card-border);
            box-shadow: 0 22px 44px rgba(15, 23, 42, 0.1);
        }

        .finance-card span {
            display: block;
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .finance-card strong {
            display: block;
            margin-top: 8px;
            font-size: 1.6rem;
        }

        .finance-status-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            margin-bottom: 32px;
        }

        .status-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 20px 22px;
            border: 1px solid rgba(84, 101, 255, 0.12);
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .status-card header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-card h4 {
            margin: 0;
            font-size: 1rem;
        }

        .status-card strong {
            font-size: 1.8rem;
        }

        .status-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-chip[data-type="pending"] {
            background: rgba(249, 181, 59, 0.12);
            color: #d97706;
        }

        .status-chip[data-type="paid"] {
            background: rgba(59, 177, 118, 0.14);
            color: #047857;
        }

        .status-chip[data-type="rejected"] {
            background: rgba(248, 113, 113, 0.16);
            color: #b91c1c;
        }

        .finance-columns {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 28px;
        }

        .panel {
            background: var(--card-bg);
            border-radius: 26px;
            padding: 26px 28px;
            border: 1px solid var(--card-border);
            box-shadow: 0 24px 48px rgba(15, 23, 42, 0.08);
        }

        .panel h3 {
            margin-top: 0;
            font-size: 1.3rem;
        }

        .chart-wrapper {
            margin-top: 24px;
            height: 280px;
            display: flex;
            align-items: flex-end;
            gap: 18px;
        }

        .chart-bar {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .chart-bar div {
            width: 100%;
            border-radius: 18px 18px 6px 6px;
            background: linear-gradient(180deg, rgba(84, 101, 255, 0.9), rgba(61, 183, 173, 0.8));
        }

        .chart-bar span {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .pending-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        .pending-table thead {
            background: rgba(84, 101, 255, 0.12);
        }

        .pending-table th,
        .pending-table td {
            padding: 16px 18px;
            text-align: left;
            font-size: 0.93rem;
        }

        .pending-table tbody tr:not(:last-child) {
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 110px;
            padding: 6px 14px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-pill--pending {
            background: rgba(249, 181, 59, 0.16);
            color: #b45309;
        }

        .status-pill--paid {
            background: rgba(59, 177, 118, 0.16);
            color: #047857;
        }

        .status-pill--rejected {
            background: rgba(248, 113, 113, 0.18);
            color: #b91c1c;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .approve-btn,
        .reject-btn {
            padding: 8px 16px;
            border-radius: 999px;
            border: none;
            font-weight: 600;
            cursor: pointer;
        }

        .approve-btn {
            background: linear-gradient(135deg, rgba(31, 209, 161, 0.85), rgba(84, 101, 255, 0.85));
            color: #fff;
        }

        .reject-btn {
            background: rgba(239, 68, 68, 0.12);
            color: #b91c1c;
        }

        .reject-btn:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .proof-link {
            color: var(--primary-dark);
            font-weight: 500;
        }

        @media (max-width: 1024px) {
            .finance-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .finance-status-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .finance-columns {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .finance-stats {
                grid-template-columns: 1fr;
            }

            .finance-status-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="finance-header">
        <div>
            <span style="color: var(--primary-dark); font-weight: 500;">Kelola transaksi dan pemasukan MayClass</span>
            <h2>Manajemen Keuangan</h2>
        </div>
    </div>

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

    <div class="finance-status-grid">
        <div class="status-card">
            <header>
                <h4>{{ $statusSummary['pending']['label'] }}</h4>
                <span class="status-chip" data-type="pending">
                    <span>⏳</span> Pending
                </span>
            </header>
            <strong>{{ number_format($statusSummary['pending']['count']) }}</strong>
            <p style="margin: 0; color: var(--text-muted);">{{ $statusSummary['pending']['description'] }}</p>
        </div>
        <div class="status-card">
            <header>
                <h4>{{ $statusSummary['paid']['label'] }}</h4>
                <span class="status-chip" data-type="paid">
                    <span>✔️</span> Paid
                </span>
            </header>
            <strong>{{ number_format($statusSummary['paid']['count']) }}</strong>
            <p style="margin: 0; color: var(--text-muted);">{{ $statusSummary['paid']['description'] }}</p>
        </div>
        <div class="status-card">
            <header>
                <h4>{{ $statusSummary['rejected']['label'] }}</h4>
                <span class="status-chip" data-type="rejected">
                    <span>⚠️</span> Rejected
                </span>
            </header>
            <strong>{{ number_format($statusSummary['rejected']['count']) }}</strong>
            <p style="margin: 0; color: var(--text-muted);">{{ $statusSummary['rejected']['description'] }}</p>
        </div>
    </div>

    <div class="finance-columns">
        <section class="panel">
            <h3>Grafik Pendapatan {{ now()->year }}</h3>
            <p style="color: var(--text-muted); margin-top: 6px;">Visualisasi pemasukan bulanan berdasarkan transaksi yang sudah diverifikasi.</p>
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
        <section class="panel">
            <h3>Verifikasi Pembayaran</h3>
            <p style="color: var(--text-muted);">Periksa bukti transfer dan lakukan approval transaksi siswa.</p>
            <table class="pending-table">
                <thead>
                    <tr>
                        <th>Paket</th>
                        <th>Siswa</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th style="width: 180px;">Aksi</th>
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
                            <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 36px 0;">
                                Belum ada transaksi pembayaran yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
@endsection
