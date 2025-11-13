@extends('student.layouts.app')

@section('title', $quiz['title'])

@push('styles')
    <style>
        /* 1. Layout Utama (Main Content + Sidebar) */
        .detail-layout {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(0, 1fr); /* 66% / 33% split */
            gap: 48px;
            align-items: start;
        }

        /* 2. Kolom Kiri (Main Content) */
        .detail-main-content {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .detail-main-content .student-chip {
            /* Pastikan chip ada di atas judul */
            margin-bottom: -12px;
        }

        .detail-main-content h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 2.8rem); /* Ukuran judul dari kode lama */
            line-height: 1.2;
        }

        .detail-main-content .summary {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 1.1rem; /* Sedikit lebih besar untuk keterbacaan */
            line-height: 1.6;
        }

        .detail-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 16px;
        }

        /* 3. Kolom Kanan (Sidebar Card) */
        .sidebar-card {
            background: #ffffff;
            border-radius: 20px;
            padding: clamp(24px, 4vw, 32px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.03);
            position: sticky; /* Membuat sidebar tetap terlihat saat scroll */
            top: 100px; /* Sesuaikan dengan tinggi navbar */
        }

        .sidebar-card h3 {
            margin: 0 0 8px 0;
            font-size: 1.3rem;
            color: var(--student-text-main, #333);
        }

        .sidebar-card .subtitle {
            margin: 0 0 24px 0;
            font-size: 0.95rem;
            color: var(--student-text-muted);
        }

        .sidebar-takeaways-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .takeaway-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .takeaway-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            color: var(--student-accent); /* Menggunakan warna accent untuk quiz */
        }

        .takeaway-item p {
            margin: 0;
            padding-top: 2px; /* Sejajarkan teks dengan ikon */
            color: var(--student-text-main, #333);
            line-height: 1.5;
        }

        .sidebar-actions {
            margin-top: 32px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* Tombol di sidebar jadi full-width */
        .sidebar-actions .student-button {
            width: 100%;
            text-align: center;
            padding-top: 12px;
            padding-bottom: 12px;
            font-weight: 600;
        }

        /* 4. Section Rangkuman Bab (Di Bawah) - Tidak ada untuk quiz */

        /* 5. Responsive */
        @media (max-width: 900px) {
            .detail-layout {
                grid-template-columns: 1fr; /* Stack kolom di mobile */
                gap: 32px;
            }
            .sidebar-card {
                position: static; /* Hapus sticky di mobile */
            }
        }
    </style>
@endpush

@section('content')
    <section class="student-section">
        <div class="detail-layout">

            <!-- KOLOM KIRI (MAIN CONTENT) -->
            <div class="detail-main-content">
                <div class="student-breadcrumbs">
                    <a href="{{ route('student.quiz') }}">Quiz</a>
                    <span>/</span>
                    <span>{{ $quiz['subject'] }}</span>
                </div>

                <span class="student-chip">{{ $quiz['subject'] }} • Level {{ $quiz['level'] }}</span>

                <h1>{{ $quiz['title'] }}</h1>

                <p class="summary">{{ $quiz['summary'] }}</p>

                <div class="detail-actions">
                    <a class="student-button student-button--primary" href="{{ $quiz['link'] }}" target="_blank" rel="noopener">
                        Mulai Latihan
                    </a>

                    <a class="student-button student-button--outline" href="{{ route('student.quiz') }}">
                        Lihat Semua Quiz
                    </a>
                </div>
            </div>

            <!-- KOLOM KANAN (SIDEBAR) -->
            <aside class="detail-sidebar">
                <div class="sidebar-card">
                    <h3>Informasi Quiz</h3>
                    <p class="subtitle">Detail lengkap kuis ini:</p>

                    <div style="display: grid; gap: 16px; margin-bottom: 24px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: var(--student-text-muted);">Durasi</span>
                            <span class="student-chip" style="background: rgba(47, 152, 140, 0.12); color: var(--student-primary);">{{ $quiz['duration'] }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: var(--student-text-muted);">Jumlah Soal</span>
                            <span class="student-chip" style="background: rgba(47, 152, 140, 0.12); color: var(--student-primary);">{{ number_format($quiz['questions']) }} soal</span>
                        </div>
                        @if (! empty($quiz['levels']))
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <span style="color: var(--student-text-muted);">Jenjang</span>
                                <div style="display: flex; flex-wrap: wrap; gap: 6px; justify-content: flex-end;">
                                    @foreach ($quiz['levels'] as $level)
                                        <span class="student-chip" style="background: rgba(47, 152, 140, 0.12); color: var(--student-primary); font-size: 0.8rem;">{{ $level }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    @if (! empty($quiz['takeaways']))
                        <h3 style="margin: 24px 0 8px 0; font-size: 1.1rem;">Yang Akan Kamu Kuasai</h3>
                        <div class="sidebar-takeaways-list">
                            @foreach ($quiz['takeaways'] as $takeaway)
                                <div class="takeaway-item">
                                    <svg class="takeaway-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="currentColor"/>
                                    </svg>
                                    <p>{{ $takeaway }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Tombol Aksi -->
                    <div class="sidebar-actions">
                        <a class="student-button student-button--primary" href="{{ $quiz['link'] }}" target="_blank" rel="noopener">
                            Mulai Latihan Sekarang
                        </a>
                        <a class="student-button student-button--outline" href="{{ $quizLink }}" target="_blank" rel="noopener">
                            Buka Platform Quiz
                        </a>
                    </div>
                </div>
            </aside>

        </div>
    </section>
@endsection
