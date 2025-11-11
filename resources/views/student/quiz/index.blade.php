@extends('student.layouts.app')

@section('title', 'Koleksi Quiz')

@push('styles')
    <style>
        .student-quiz__hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: clamp(20px, 4vw, 40px);
            align-items: center;
        }

        .student-quiz__hero h1 {
            margin: 0;
            font-size: clamp(1.9rem, 4vw, 2.6rem);
        }

        .student-quiz__hero p {
            margin: 0;
            color: var(--student-text-muted);
        }

        .student-quiz__stats {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .student-quiz__collections {
            display: grid;
            gap: clamp(24px, 4vw, 40px);
        }

        .student-quiz__collection-card {
            display: grid;
            gap: 18px;
            background: var(--student-surface);
            border-radius: var(--student-radius-lg);
            padding: clamp(22px, 4vw, 32px);
            box-shadow: 0 28px 56px rgba(34, 118, 108, 0.14);
        }

        .student-quiz__collection-header {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .student-quiz__collection-title {
            margin: 0;
            font-size: 1.4rem;
        }

        .student-quiz__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: clamp(18px, 3vw, 28px);
        }

        .student-quiz__card {
            display: grid;
            gap: 12px;
            border-radius: var(--student-radius-md);
            padding: clamp(18px, 3vw, 24px);
            background: rgba(95, 106, 248, 0.08);
            border: 1px solid rgba(95, 106, 248, 0.12);
        }

        .student-quiz__card h3 {
            margin: 0;
            font-size: 1.1rem;
        }

        .student-quiz__card p {
            margin: 0;
            color: var(--student-text-muted);
            font-size: 0.92rem;
        }

        .student-quiz__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--student-text-muted);
        }

        .student-quiz__empty {
            padding: clamp(24px, 4vw, 32px);
            border-radius: var(--student-radius-lg);
            background: rgba(95, 106, 248, 0.08);
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
        <div class="student-quiz__hero">
            <div>
                <span class="student-chip">Bank soal MayClass</span>
                <h1>Koleksi quiz siap pakai</h1>
                <p>
                    {{ number_format($stats['total']) }} kuis aktif dengan {{ number_format($stats['total_questions']) }} soal dan
                    dukungan {{ number_format(count($stats['levels'])) }} jenjang belajar.
                </p>
                <div class="student-quiz__stats">
                    @foreach ($stats['levels'] as $level)
                        <span class="student-chip">Level {{ $level }}</span>
                    @endforeach
                </div>
            </div>
            <div style="display: grid; gap: 12px; justify-items: start;">
                <a class="student-button student-button--primary" href="{{ $quizLink }}" target="_blank" rel="noopener">Buka platform quiz</a>
                <a class="student-button student-button--outline" href="{{ $materialsLink }}" target="_blank" rel="noopener">Lihat materi pendamping</a>
            </div>
        </div>
    </section>

    <section class="student-section">
        <div class="student-section__header">
            <h2 class="student-section__title">Daftar quiz</h2>
        </div>
        @if ($collections->isNotEmpty())
            <div class="student-quiz__collections">
                @foreach ($collections as $collection)
                    <article class="student-quiz__collection-card">
                        <div class="student-quiz__collection-header">
                            <span class="student-chip" style="background: rgba(95, 106, 248, 0.12); color: var(--student-accent);">{{ $collection['label'] }}</span>
                            <h3 class="student-quiz__collection-title">{{ $collection['label'] }}</h3>
                            <span class="student-card__subtitle">{{ count($collection['items']) }} kuis tersedia</span>
                        </div>
                        <div class="student-quiz__grid">
                            @foreach ($collection['items'] as $quiz)
                                <article class="student-quiz__card" style="border-color: {{ $collection['accent'] }}33; background: {{ $collection['accent'] }}14;">
                                    <span class="student-chip" style="background: #ffffff; color: {{ $collection['accent'] }};">{{ $quiz['duration'] }} • {{ $quiz['questions'] }} soal</span>
                                    <h3>{{ $quiz['title'] }}</h3>
                                    <p>{{ $quiz['summary'] }}</p>
                                    <div class="student-quiz__meta">
                                        @foreach ($quiz['levels'] as $level)
                                            <span>Level {{ $level }}</span>
                                        @endforeach
                                    </div>
                                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                                        <a class="student-button student-button--primary" style="padding: 10px 20px;" href="{{ $quiz['link'] }}" target="_blank" rel="noopener">Mulai kuis</a>
                                        <a class="student-button student-button--outline" style="padding: 10px 20px;" href="{{ $materialsLink }}" target="_blank" rel="noopener">Materi pendamping</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="student-quiz__empty">
                <p>Belum ada kuis yang tercatat. Tambahkan kuis melalui dashboard tutor untuk memulai latihan.</p>
                <a class="student-button student-button--primary" href="{{ $quizLink }}" target="_blank" rel="noopener">Buka platform quiz</a>
            </div>
        @endif
    </section>
@endsection
