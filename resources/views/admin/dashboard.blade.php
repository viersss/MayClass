@extends('admin.layout')

@section('title', 'Dashboard Admin MayClass')

@push('styles')
    <style>
        .hero-card {
            position: relative;
            border-radius: 28px;
            padding: 38px;
            background: linear-gradient(145deg, rgba(61, 183, 173, 0.18), rgba(84, 101, 255, 0.22));
            overflow: hidden;
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 32px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow: 0 28px 60px rgba(15, 23, 42, 0.15);
        }

        .hero-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.25), transparent 55%);
            pointer-events: none;
        }

        .hero-copy {
            position: relative;
            z-index: 1;
            color: #0f172a;
        }

        .hero-copy h2 {
            margin: 0;
            font-size: 2.2rem;
            line-height: 1.25;
        }

        .hero-copy p {
            margin: 18px 0 0;
            color: rgba(15, 23, 42, 0.72);
            font-size: 1rem;
            max-width: 520px;
        }

        .hero-metric {
            position: relative;
            background: rgba(255, 255, 255, 0.55);
            border-radius: 22px;
            padding: 24px;
            display: grid;
            gap: 12px;
            align-content: center;
            justify-items: flex-start;
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .hero-metric small {
            font-weight: 500;
            color: rgba(15, 23, 42, 0.68);
            letter-spacing: 0.3px;
        }

        .hero-metric strong {
            font-size: 2rem;
            line-height: 1.1;
            color: #0f172a;
        }

        .stat-grid {
            margin-top: 32px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.92);
            border-radius: 24px;
            padding: 24px 26px;
            display: grid;
            gap: 12px;
            border: 1px solid var(--card-border);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            inset: auto 18px -24px;
            height: 70px;
            border-radius: 30px;
            background: linear-gradient(120deg, rgba(61, 183, 173, 0.35), transparent);
        }

        .stat-card span {
            color: var(--text-muted);
            font-size: 0.92rem;
            font-weight: 500;
        }

        .stat-card strong {
            font-size: 1.6rem;
            color: #0f172a;
        }

        .stat-card em {
            font-style: normal;
            font-size: 0.9rem;
            color: rgba(15, 23, 42, 0.6);
        }

        .dashboard-columns {
            margin-top: 32px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 28px;
        }

        .card-panel {
            background: var(--card-bg);
            border-radius: 26px;
            padding: 26px 28px;
            border: 1px solid var(--card-border);
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.08);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.25rem;
        }

        .chart-wrapper {
            height: 260px;
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

        .chart-bar span {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .chart-bar div {
            width: 100%;
            border-radius: 16px 16px 6px 6px;
            background: linear-gradient(180deg, rgba(84, 101, 255, 0.85), rgba(31, 209, 161, 0.7));
            transition: transform 0.3s ease;
        }

        .chart-bar div:hover {
            transform: translateY(-4px);
        }

        .student-list {
            display: grid;
            gap: 18px;
        }

        .student-card {
            padding: 18px 20px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.05);
        }

        .student-card strong {
            display: block;
            font-size: 1rem;
        }

        .student-card small {
            color: var(--text-muted);
        }

        @media (max-width: 1024px) {
            .hero-card {
                grid-template-columns: 1fr;
            }

            .stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dashboard-columns {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .stat-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <section class="hero-card">
        <div class="hero-copy">
            <h2>Selamat datang di pusat kendali MayClass</h2>
            <p>
                Pantau performa bisnis, kelola siswa, dan pastikan setiap pembayaran terverifikasi. Semua metrik penting
                tersaji secara real-time untuk membantu Anda mengambil keputusan yang tepat.
            </p>
        </div>
        <div class="hero-metric">
            <small>Total pemasukan terverifikasi</small>
            <strong>{{ $stats['totalRevenue'] }}</strong>
            <span style="color: var(--text-muted); font-size: 0.9rem;">Pendapatan bersih sepanjang waktu</span>
        </div>
    </section>

    <section class="stat-grid">
        <article class="stat-card">
            <span>Pendapatan Tahun Ini</span>
            <strong>{{ $stats['yearRevenue'] }}</strong>
            <em>Diperbarui otomatis setiap verifikasi pembayaran.</em>
        </article>
        <article class="stat-card">
            <span>Total Siswa Terdaftar</span>
            <strong>{{ number_format($stats['totalStudents']) }}</strong>
            <em>Mencakup seluruh siswa aktif maupun pasif.</em>
        </article>
        <article class="stat-card">
            <span>Pembayaran Pending</span>
            <strong>{{ number_format($stats['pendingPayments']) }}</strong>
            <em>Menunggu verifikasi admin.</em>
        </article>
        <article class="stat-card">
            <span>Nilai Rata-rata Transaksi</span>
            <strong>{{ $stats['averageTicket'] }}</strong>
            <em>Rerata omset per transaksi yang sukses.</em>
        </article>
    </section>

    <section class="dashboard-columns">
        <div class="card-panel">
            <div class="card-header">
                <h3>Grafik Pendapatan {{ now()->year }}</h3>
                <span style="color: var(--text-muted); font-size: 0.9rem;">Data berdasarkan transaksi terverifikasi</span>
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
        </div>
        <div class="card-panel">
            <div class="card-header">
                <h3>Siswa Terbaru</h3>
                <a href="{{ route('admin.students.index') }}" style="color: var(--primary-dark); font-weight: 500;">Lihat semua</a>
            </div>
            <div class="student-list">
                @forelse ($recentStudents as $student)
                    <div class="student-card">
                        <strong>{{ $student['name'] }}</strong>
                        <small>{{ $student['email'] }}</small><br />
                        <small>ID: {{ $student['student_id'] ?? 'Belum ditetapkan' }}</small><br />
                        <small>Bergabung: {{ $student['joined_at'] }}</small>
                    </div>
                @empty
                    <p style="color: var(--text-muted);">Belum ada data siswa yang bisa ditampilkan.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
