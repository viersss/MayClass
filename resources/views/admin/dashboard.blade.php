@extends('admin.layout')

@section('title', 'Dashboard Admin MayClass')

@push('styles')
<style>
    /* =========================
       TOKENS & UTILITIES
    ========================== */
    :root{
        --success: #15803d;
        --warn:    #b45309;
        --danger:  #b91c1c;
    }
    .dashboard { display:grid; gap:28px; }
    .muted     { color: var(--text-muted); }
    .row       { display:flex; gap:12px; align-items:center; flex-wrap:wrap; }

    /* =========================
       HERO
    ========================== */
    .hero-card{
        display:grid;
        grid-template-columns: minmax(0,1.5fr) minmax(0,1fr);
        gap:28px;
        padding:28px;
        border-radius:18px;
        background:var(--surface);
        border:1px solid var(--border);
        box-shadow:0 8px 22px rgba(15,23,42,.06);
    }
    .hero-main{ display:flex; flex-direction:column; gap:14px; }
    .hero-chip{
        display:inline-flex; align-items:center; gap:8px;
        padding:6px 14px; border-radius:999px;
        background:var(--surface-muted); border:1px solid var(--border);
        color:var(--text-muted); font-weight:600; font-size:.85rem; width:fit-content;
    }
    .hero-main h2{ margin:0; font-size:1.9rem; line-height:1.35; }
    .hero-main p { margin:0; color:var(--text-muted); max-width:640px; }
    .hero-side   { display:grid; gap:14px; align-content:start; }
    .hero-metric{
        display:grid; gap:6px; padding:18px;
        border-radius:14px; background:var(--surface-muted); border:1px solid var(--border);
    }
    .hero-metric small{ font-weight:600; letter-spacing:.3px; color:rgba(15,23,42,.7); }
    .hero-metric strong{ font-size:1.7rem; line-height:1.2; }
    .hero-trend{
        display:inline-flex; align-items:center; gap:8px; font-weight:600; font-size:.92rem;
        color:rgba(15,23,42,.8);
    }
    .hero-trend[data-direction="1"]{ color: var(--success); }
    .hero-trend[data-direction="-1"]{ color: var(--danger); }
    .hero-trend::before{
        content: attr(data-icon);
        display:inline-grid; place-items:center;
        width:22px; height:22px; border-radius:8px; background:rgba(15,23,42,.08);
        font-size:.75rem;
    }
    .hero-trend[data-direction="1"]::before{ background: rgba(21,128,61,.12); }
    .hero-trend[data-direction="-1"]::before{ background: rgba(185,28,28,.12); }

    .hero-mini-grid{
        display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;
    }
    .mini-metric{
        padding:14px; border-radius:12px; background:var(--surface);
        border:1px solid var(--border); display:grid; gap:4px;
    }
    .mini-metric small{ color:var(--text-muted); font-weight:600; }
    .mini-metric strong{ font-size:1.15rem; }
    .mini-metric span{ color:var(--text-muted); font-size:.9rem; }

    /* =========================
       KPI GRID
    ========================== */
    .stat-grid{
        display:grid;
        grid-template-columns:repeat(4, minmax(220px,1fr));
        gap:20px;
    }
    .stat-card{
        padding:18px; border-radius:14px; background:var(--surface);
        border:1px solid var(--border); display:grid; gap:8px;
    }
    .stat-icon{
        width:40px; height:40px; border-radius:12px; display:grid; place-items:center;
        color:var(--primary); font-weight:700; background:rgba(37,99,235,.12);
    }
    .stat-card span{ color:var(--text-muted); font-weight:600; }
    .stat-card strong{ font-size:1.35rem; }
    .stat-card em{ font-style:normal; color:var(--text-muted); font-size:.9rem; }

    /* =========================
       PANELS & HEADERS
    ========================== */
    .insights-grid{ display:grid; grid-template-columns:minmax(0,1.35fr) minmax(0,1fr); gap:26px; }
    .detail-grid  { display:grid; grid-template-columns:minmax(0,1.35fr) minmax(0,1fr); gap:26px; }
    .card-panel{
        background:var(--surface); border-radius:16px; padding:22px; border:1px solid var(--border);
        box-shadow:0 8px 18px rgba(15,23,42,.06); display:grid; gap:18px;
    }
    .card-header{ display:flex; justify-content:space-between; align-items:center; gap:12px; }
    .card-header h3{ margin:0; font-size:1.15rem; }
    .card-subtitle{ color:var(--text-muted); font-size:.92rem; }

    /* =========================
       CHART (bar)
    ========================== */
    .chart-wrapper{
        position:relative; min-height:260px;
        padding:22px 16px 12px; border-radius:14px;
        border:1px solid var(--border);
        background:
            linear-gradient(180deg, rgba(37,99,235,.07) 0%, rgba(37,99,235,.02) 45%, transparent 100%),
            var(--surface);
        display:flex; align-items:flex-end; gap:12px; overflow:hidden;
    }
    .chart-wrapper::before,
    .chart-wrapper::after{
        content:''; position:absolute; left:16px; right:16px; border-top:1px dashed rgba(15,23,42,.08);
    }
    .chart-wrapper::after{ top:24px; }   /* guide line atas */
    .chart-wrapper::before{ top:50%; }   /* guide line tengah */

    .chart-bar{ flex:1; display:flex; flex-direction:column; gap:8px; align-items:center; position:relative; z-index:2; }
    .chart-bar strong{ font-size:.85rem; color:rgba(15,23,42,.8); }
    .chart-bar div{
        width:100%; border-radius:12px 12px 8px 8px;
        background:linear-gradient(180deg, rgba(37,99,235,.95), rgba(59,130,246,.75));
        box-shadow:0 8px 18px rgba(37,99,235,.25);
    }
    .chart-bar span{ font-size:.85rem; color:var(--text-muted); font-weight:600; }

    .empty-state{
        padding:16px 18px; border-radius:12px;
        background:rgba(15,23,42,.04); color:var(--text-muted); font-size:.92rem;
    }

    /* =========================
       PIPELINE
    ========================== */
    .pipeline{ display:grid; gap:16px; }
    .pipeline-row{ display:grid; gap:10px; }
    .pipeline-header{ display:flex; justify-content:space-between; align-items:center; gap:12px; }
    .pipeline-progress{
        position:relative; height:8px; border-radius:999px; background:rgba(15,23,42,.08); overflow:hidden;
    }
    .pipeline-progress span{ position:absolute; inset:0 auto 0 0; border-radius:inherit; background:rgba(37,99,235,.45); }
    .status-badge{
        display:inline-flex; align-items:center; justify-content:center;
        padding:6px 12px; border-radius:999px; font-size:.8rem; font-weight:700; letter-spacing:.3px; text-transform:uppercase;
    }
    .status-badge[data-type='paid']{ background:rgba(21,128,61,.12); color:#15803d; }
    .status-badge[data-type='pending']{ background:rgba(234,179,8,.16); color:#b45309; }
    .status-badge[data-type='failed']{ background:rgba(185,28,28,.16); color:#b91c1c; }
    .status-badge[data-type='initiated']{ background:rgba(59,130,246,.16); color:#1d4ed8; }

    /* =========================
       TABLES
    ========================== */
    .table-scroll{ overflow-x:auto; }
    .data-table{ width:100%; min-width:720px; border-collapse:separate; border-spacing:0 10px; }
    .data-table th, .data-table td{ text-align:left; padding:12px 16px; font-size:.95rem; }
    .data-table th{
        color:var(--text-muted); font-weight:700; text-transform:uppercase; font-size:.78rem; letter-spacing:.4px; padding-bottom:4px;
    }
    .data-table tbody tr{ background:var(--surface-muted); border-radius:14px; box-shadow:0 6px 12px rgba(15,23,42,.08); }
    .data-table tbody td:first-child{ border-top-left-radius:14px; border-bottom-left-radius:14px; }
    .data-table tbody td:last-child { border-top-right-radius:14px; border-bottom-right-radius:14px; text-align:right; }
    .data-table thead tr th:last-child{ text-align:right; }

    /* =========================
       SIDE LISTS
    ========================== */
    .stacked{ display:grid; gap:20px; }
    .top-package-list, .student-list{ display:grid; gap:14px; }
    .package-item{
        display:flex; align-items:center; justify-content:space-between;
        padding:14px 16px; border-radius:14px; background:var(--surface);
        border:1px solid var(--border);
    }
    .package-item strong{ display:block; font-size:1rem; }
    .package-item span{ color:var(--text-muted); font-size:.9rem; }
    .student-card{
        padding:14px 16px; border-radius:14px; background:var(--surface);
        border:1px solid var(--border); display:grid; gap:4px;
    }
    .student-card strong{ font-size:1rem; }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width:1200px){
        .hero-card{ grid-template-columns:1fr; }
        .insights-grid, .detail-grid{ grid-template-columns:1fr; }
        .stat-grid{ grid-template-columns:repeat(2,minmax(0,1fr)); }
    }
    @media (max-width:768px){
        .hero-card{ padding:24px; gap:20px; }
        .hero-mini-grid{ grid-template-columns:1fr; }
        .stat-grid{ grid-template-columns:1fr; }
    }
</style>
@endpush

@section('content')
<section class="dashboard">

    {{-- ============== HERO ============== --}}
    <section class="hero-card">
        <div class="hero-main">
            <span class="hero-chip">Ringkasan operasional</span>
            <h2>Monitor seluruh aktivitas MayClass dalam satu tempat</h2>
            <p>Data finansial, pendaftaran siswa, dan performa paket belajar diperbarui secara langsung sehingga tim administrasi dapat mengambil keputusan cepat setiap hari.</p>
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

    {{-- ============== KPI ============== --}}
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

    {{-- ============== INSIGHTS ============== --}}
    <section class="insights-grid">
        <div class="card-panel">
            <div class="card-header">
                <h3>Grafik Pendapatan {{ now()->year }}</h3>
                <span class="card-subtitle">Berdasarkan transaksi lunas per bulan</span>
            </div>

            @if ($monthlyRevenue->sum('value') === 0)
                <div class="empty-state">Belum ada transaksi lunas yang tercatat pada tahun ini.</div>
            @else
                @php $maxValue = max($monthlyRevenue->pluck('value')->all() ?: [1]); @endphp
                <div class="chart-wrapper" role="img" aria-label="Grafik pendapatan bulanan">
                    @foreach ($monthlyRevenue as $entry)
                        @php $h = $maxValue > 0 ? max(($entry['value'] / $maxValue) * 100, 6) : 6; @endphp
                        <div class="chart-bar">
                            <strong>{{ $entry['formatted'] }}</strong>
                            <div style="height: {{ $h }}%;"></div>
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

    {{-- ============== DETAIL: TABLE + SIDEBAR LISTS ============== --}}
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
                                    <td><span class="status-badge" data-type="{{ $payment['status'] }}">{{ $payment['status_label'] }}</span></td>
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

</section>
@endsection