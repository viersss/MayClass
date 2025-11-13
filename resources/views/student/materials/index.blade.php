@extends('student.layouts.app')

@section('title', 'Materi Pembelajaran')

@push('styles')
    <style>
        .student-materials__hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: clamp(20px, 4vw, 40px);
            align-items: center;
        }

        .student-materials__hero h1 {
            margin: 0;
            font-size: clamp(1.9rem, 4vw, 2.6rem);
        }

        .student-materials__hero p {
            margin: 0;
            color: var(--student-text-muted);
        }

        .student-materials__stats {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .student-materials__collections {
            display: grid;
            gap: clamp(24px, 4vw, 40px);
        }

        .student-materials__collection-card {
            display: grid;
            gap: 18px;
            background: var(--student-surface);
            border-radius: var(--student-radius-lg);
            padding: clamp(22px, 4vw, 32px);
            box-shadow: 0 28px 56px rgba(34, 118, 108, 0.14);
        }

        .student-materials__collection-header {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .student-materials__collection-title {
            margin: 0;
            font-size: 1.4rem;
        }

        .student-materials__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: clamp(18px, 3vw, 28px);
        }

        .student-materials__card {
            display: grid;
            gap: 12px;
            border-radius: var(--student-radius-md);
            padding: clamp(18px, 3vw, 24px);
            background: rgba(47, 152, 140, 0.08);
            border: 1px solid rgba(47, 152, 140, 0.12);
        }

        .student-materials__card h3 {
            margin: 0;
            font-size: 1.1rem;
        }

        .student-materials__card p {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 0.92rem;
        }

        .student-materials__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--student-text-muted);
        }

        .student-materials__empty {
            padding: clamp(24px, 4vw, 32px);
            border-radius: var(--student-radius-lg);
            background: rgba(47, 152, 140, 0.08);
            text-align: center;
            color: var(--student-text-muted);
            display: grid;
            gap: 12px;
        }
    </style>
@endpush

@php($materialsLink = $materialsLink ?? config('mayclass.links.materials_drive'))
@php($quizLink = $quizLink ?? config('mayclass.links.quiz_platform'))

@section('content')
    <section class="student-section">
        <div class="student-materials__hero">
            <div>
                <span class="student-chip">Koleksi materi</span>
                <h1>Materi siap dipelajari</h1>
                <p>
                    {{ number_format($stats['total']) }} materi aktif mencakup {{ number_format($stats['subjects']) }} mata pelajaran
                    dan {{ number_format(count($stats['levels'])) }} jenjang belajar.
                </p>
                <div class="student-materials__stats">
                    @foreach ($stats['levels'] as $level)
                        <span class="student-chip">Level {{ $level }}</span>
                    @endforeach
                </div>
            </div>
            <div style="display: grid; gap: 12px; justify-items: start;">
                <a class="student-button student-button--primary" href="{{ $materialsLink }}" target="_blank" rel="noopener">Buka Google Drive</a>
                <a class="student-button student-button--outline" href="{{ $quizLink }}" target="_blank" rel="noopener">Mulai latihan</a>
            </div>
        </div>
    </section>

    <section class="student-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Daftar materi</h2>
        </div>
        @if ($collections->isNotEmpty())
            <div class="student-materials__collections">
                @foreach ($collections as $collection)
                    <article class="student-materials__collection-card">
                        <div class="student-materials__collection-header">
                            <span class="student-chip" style="background: rgba(47, 152, 140, 0.12); color: var(--student-primary);">{{ $collection['label'] }}</span>
                            <h3 class="student-materials__collection-title">{{ $collection['label'] }}</h3>
                            <span class="student-card__subtitle">{{ count($collection['items']) }} materi tersedia</span>
                        </div>
                        <div class="student-materials__grid">
                            @foreach ($collection['items'] as $material)
                                <article class="student-materials__card" style="border-color: {{ $collection['accent'] }}33; background: {{ $collection['accent'] }}14;">
                                    <span class="student-chip" style="background: #ffffff; color: {{ $collection['accent'] }};">Level {{ $material['level'] }}</span>
                                    <h3>{{ $material['title'] }}</h3>
                                    <p>{{ $material['summary'] }}</p>
                                    <div class="student-materials__meta">
                                        <span>{{ $material['chapter_count'] }} bab</span>
                                        <span>{{ $material['objective_count'] }} tujuan</span>
                                    </div>
                                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                                        <a class="student-button student-button--primary" style="padding: 10px 20px;" href="{{ route('student.materials.show', $material['slug']) }}">Detail materi</a>
                                        <a class="student-button student-button--outline" style="padding: 10px 20px;" href="{{ $materialsLink }}" target="_blank" rel="noopener">Kelola file</a>
                                    </div>
                                </article>
                            @endforeach
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
