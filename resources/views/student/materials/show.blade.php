@extends('student.layouts.app')

@section('title', $material['title'])

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

        .sidebar-objectives-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .objective-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .objective-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            color: var(--student-primary); /* Menggunakan warna primary program */
        }

        .objective-item p {
            margin: 0;
            padding-top: 2px; /* Sejajarkan teks dengan ikon */
            color: var(--student-text-main, #333);
            line-height: 1.5;
        }

        .sidebar-download-actions {
            margin-top: 32px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* Tombol di sidebar jadi full-width */
        .sidebar-download-actions .student-button {
            width: 100%;
            text-align: center;
            padding-top: 12px;
            padding-bottom: 12px;
            font-weight: 600;
        }

        /* 4. Section Rangkuman Bab (Di Bawah) */
        .chapters-section {
            margin-top: 60px; /* Beri jarak dari layout di atas */
        }

        .chapters-grid {
            display: grid;
            gap: 16px;
        }

        .chapter-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
        }

        .chapter-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        }

        .chapter-card h3 {
            margin: 0 0 8px;
            font-size: 1.1rem;
            color: var(--student-primary, #2f988c);
        }

        .chapter-card p {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 0.95rem;
        }

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
                    <a href="{{ route('student.materials') }}">Materi</a>
                    <span>/</span>
                    <span>{{ $material['subject'] }}</span>
                </div>
                
                <span class="student-chip">{{ $material['subject'] }} • Level {{ $material['level'] }}</span>
                
                <h1>{{ $material['title'] }}</h1>
                
                <p class="summary">{{ $material['summary'] }}</p>
                
                <div class="detail-actions">
                    <a class="student-button student-button--primary" href="{{ $material['view_url'] }}" target="_blank" rel="noopener">
                        Lihat Materi
                    </a>
                    
                    {{-- Sesuai desain, tombol "Lihat Bank Soal" tidak ada datanya di backend lama --}}
                    {{-- Saya ganti menggunakan link "Kelola" yang sudah ada, dengan style outline --}}
                    <a class="student-button student-button--outline" href="{{ $materialsLink }}" target="_blank" rel="noopener">
                        Kelola di Google Drive
                    </a>
                </div>
            </div>

            <!-- KOLOM KANAN (SIDEBAR) -->
            <aside class="detail-sidebar">
                <div class="sidebar-card">
                    <h3>Deskripsi Materi</h3>
                    <p class="subtitle">Dalam materi ini, kamu akan mempelajari:</p>

                    @if (! empty($material['objectives']))
                        <div class="sidebar-objectives-list">
                            @foreach ($material['objectives'] as $index => $objective)
                                <div class="objective-item">
                                    <!-- Ikon Checkmark Sesuai Desain -->
                                    <svg class="objective-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="currentColor"/>
                                    </svg>
                                    <p>{{ $objective }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: var(--student-text-muted); font-size: 0.9rem;">Tujuan pembelajaran akan segera ditambahkan.</p>
                    @endif

                    <!-- Tombol Download (diambil dari data lama) -->
                    <div class="sidebar-download-actions">
                        <a class="student-button student-button--primary" href="{{ $material['download_url'] }}" target="_blank" rel="noopener" download>
                            Download Materi ({{ $material['download_label'] }})
                        </a>
                        {{-- Tombol "Download Bank Soal" tidak ada datanya di kode lama, jadi saya sembunyikan --}}
                    </div>
                </div>
            </aside>

        </div>
    </section>

    <!-- SECTION RANGKUMAN BAB (Tetap dipertahankan) -->
    @if (! empty($material['chapters']))
        <section class="student-section chapters-section">
            <div class="student-section__header">
                <h2 class="student-section__title">Rangkuman Bab</h2>
            </div>
            <div class="chapters-grid">
                @foreach ($material['chapters'] as $chapter)
                    <article class="chapter-card">
                        <h3>{{ $chapter['title'] }}</h3>
                        <p>{{ $chapter['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection