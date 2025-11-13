@extends('student.layouts.app')

@section('title', 'Materi Pembelajaran')

@push('styles')
    <style>
        /* Layout Umum */
        .student-section {
            margin-bottom: 60px;
        }

        /* 1. Hero Section (Banner Style) */
        .student-materials__hero {
            background: linear-gradient(135deg, var(--student-primary) 0%, #2a8c82 100%); /* Menggunakan warna program */
            border-radius: 24px;
            padding: clamp(30px, 5vw, 60px);
            color: white;
            text-align: left;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(47, 152, 140, 0.2);
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .student-materials__hero h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            line-height: 1.2;
        }

        .student-materials__hero p {
            margin: 0;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            max-width: 600px;
            line-height: 1.6;
        }

        .student-materials__actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        /* Tombol Custom untuk Hero */
        .hero-btn {
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero-btn--primary {
            background: #FFA726; /* Warna aksen oranye seperti desain, atau ganti var(--student-accent) */
            color: white;
            box-shadow: 0 4px 15px rgba(255, 167, 38, 0.4);
        }

        .hero-btn--outline {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .hero-btn:hover {
            transform: translateY(-2px);
        }

        /* 2. Section Header (Centered) */
        .section-header-center {
            text-align: center;
            margin-bottom: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-header-center h2 {
            font-size: 2rem;
            color: var(--student-primary);
            margin-bottom: 12px;
        }

        .section-header-center p {
            color: var(--student-text-muted);
        }

        /* 3. Grid Kartu Materi (Blue Cards Style) */
        .student-materials__collections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .student-materials__collection-card {
            background: var(--student-surface);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }

        /* Header Kartu (Bagian Berwarna) */
        .collection-header {
            background: var(--student-primary); /* Warna biru/teal program */
            padding: 30px;
            color: white;
            position: relative;
            min-height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .collection-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(4px);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            color: white;
        }

        .collection-title {
            margin: 0 0 8px 0;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .collection-desc {
            margin: 0;
            font-size: 0.95rem;
            opacity: 0.9;
            line-height: 1.5;
        }

        /* Body Kartu (List Item) */
        .collection-body {
            padding: 20px;
            background: #f8f9fa; /* Background abu sangat muda */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* Item Materi (Baris Putih) */
        .material-list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 16px 20px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--student-text-main, #333);
            border: 1px solid rgba(0,0,0,0.04);
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .material-list-item:hover {
            transform: translateX(5px);
            border-color: var(--student-primary);
            box-shadow: 0 4px 12px rgba(47, 152, 140, 0.1);
        }

        .material-list-item span {
            font-weight: 500;
            font-size: 1rem;
        }

        .material-arrow {
            color: var(--student-text-muted);
        }

        /* Empty State */
        .student-materials__empty {
            text-align: center;
            padding: 40px;
            background: var(--student-surface);
            border-radius: 20px;
            grid-column: 1 / -1;
        }

        @media (max-width: 768px) {
            .student-materials__collections {
                grid-template-columns: 1fr;
            }
            .collection-header {
                min-height: auto;
                padding: 24px;
            }
        }
    </style>
@endpush

@php($materialsLink = $materialsLink ?? config('mayclass.links.materials_drive'))
@php($quizLink = $quizLink ?? config('mayclass.links.quiz_platform'))

@section('content')
    <section class="student-section">
        <div class="student-materials__hero">
            <div>
                <h1>Mulai Belajar</h1>
                <p>
                    Pelajari materi 
                    @if (! empty($activePackage))
                        paket {{ $activePackage->detail_title ?? $activePackage->title }}.
                    @endif
                    Akses {{ number_format($stats['total']) }} materi terstruktur dan mudah dipahami untuk persiapan ujianmu.
                </p>
            </div>
            
            <div class="student-materials__actions">
                <a class="hero-btn hero-btn--primary" href="{{ $materialsLink }}" target="_blank" rel="noopener">
                    Mulai Belajar
                </a>
                <a class="hero-btn hero-btn--outline" href="{{ route('student.dashboard') }}">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

    <section class="student-section">
        <div class="section-header-center">
            <h2>Materi Pembelajaran & Bank Soal</h2>
            <p>
                Belajar terarah dan menyenangkan. Kuasai materi pelajaran serta TWK, TIU, dan TKP dengan metode yang mudah dipahami.
            </p>
        </div>

        @if ($collections->isNotEmpty())
            <div class="student-materials__collections">
                @foreach ($collections as $collection)
                    <article class="student-materials__collection-card">
                        <div class="collection-header">
                            <span class="collection-badge">
                                {{ count($collection['items']) }} Bab
                            </span>
                            <h3 class="collection-title">{{ $collection['label'] }}</h3>
                            <p class="collection-desc">
                                Materi tentang {{ $collection['label'] }}, Peluang, Aritmatika dll.
                            </p>
                        </div>

                        <div class="collection-body">
                            @foreach ($collection['items'] as $material)
                                <a href="{{ route('student.materials.show', $material['slug']) }}" class="material-list-item">
                                    <div style="display: flex; flex-direction: column;">
                                        <span>{{ $material['title'] }}</span>
                                        <small style="color: var(--student-text-muted); font-size: 0.8rem;">Level {{ $material['level'] }}</small>
                                    </div>
                                    
                                    <svg class="material-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            @endforeach

                            @if(count($collection['items']) === 0)
                                <div style="text-align: center; padding: 20px; color: var(--student-text-muted);">
                                    Belum ada materi
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="student-materials__empty">
                <p>Belum ada materi yang tercatat. Unggah materi melalui dashboard tutor untuk mulai membagikannya.</p>
                <a class="student-button student-button--primary" href="{{ $materialsLink }}" target="_blank" rel="noopener">Buka Google Drive</a>
            </div>
        @endif
    </section>
@endsection