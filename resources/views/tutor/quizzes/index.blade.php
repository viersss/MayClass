@extends('tutor.layout')

@section('title', 'Manajemen Quiz - MayClass')

@push('styles')
    <style>
        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 32px;
        }

        .page-heading h1 {
            margin: 0;
            font-size: 2rem;
        }

        .page-heading p {
            margin: 10px 0 0;
            color: var(--text-muted);
        }

        .page-heading .stats-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(155, 93, 229, 0.14);
            color: #6d28d9;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .content-toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 26px;
        }

        .search-field {
            flex: 1 1 320px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
        }

        .search-field input[type='search'] {
            border: 1px solid #d9e0ea;
            border-radius: 14px;
            padding: 14px 18px;
            font-family: inherit;
            font-size: 1rem;
            background: #fff;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.04);
        }

        .search-field button,
        .content-toolbar .primary-action {
            background: linear-gradient(135deg, #9b5de5, #6d28d9);
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 14px 22px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 14px 35px rgba(155, 93, 229, 0.28);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .primary-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 10px;
    background: #3fa67e; /* warna hijau premium */
    color: #fff;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: background 0.2s ease;
}

.primary-btn:hover {
    background: #2f8a67; /* sedikit lebih gelap biar ada efek */
}


        .search-field button:hover,
        .content-toolbar .primary-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 45px rgba(109, 40, 217, 0.35);
        }

        .system-alert {
            background: rgba(250, 204, 21, 0.18);
            border: 1px solid rgba(250, 204, 21, 0.35);
            color: #854d0e;
            border-radius: 18px;
            padding: 20px 22px;
            font-weight: 500;
            margin-bottom: 24px;
        }

        .system-alert strong {
            display: block;
            font-size: 1.05rem;
            margin-bottom: 10px;
        }

        .system-alert ol {
            margin: 12px 0 0 18px;
            padding: 0;
            font-weight: 400;
        }

        .system-alert code {
            font-weight: 600;
            background: rgba(255, 255, 255, 0.55);
            padding: 2px 6px;
            border-radius: 6px;
        }

        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .quiz-card {
            background: #fff;
            border-radius: 24px;
            padding: 22px;
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 18px;
            align-items: center;
            box-shadow: 0 24px 55px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(15, 23, 42, 0.04);
            position: relative;
            overflow: hidden;
        }

        .quiz-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(155, 93, 229, 0.12), transparent 60%);
            pointer-events: none;
        }

        .quiz-thumbnail {
            width: 120px;
            height: 120px;
            border-radius: 18px;
            object-fit: cover;
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.15);
        }

        .quiz-card h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .quiz-card .meta {
            margin: 8px 0 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .quiz-card .summary {
            color: #4b5563;
            font-size: 0.95rem;
            line-height: 1.55;
        }

        .quiz-card .actions {
            display: flex;
            gap: 12px;
            margin-top: 18px;
        }

        .quiz-card .actions a {
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            font-weight: 500;
            color: #1f2937;
            background: rgba(15, 23, 42, 0.02);
            transition: border 0.2s ease, color 0.2s ease, background 0.2s ease;
        }

        .quiz-card .actions a:hover {
            border-color: #9b5de5;
            color: #6d28d9;
            background: rgba(155, 93, 229, 0.1);
        }

        .empty-state {
            background: #fff;
            border-radius: 24px;
            padding: 48px;
            text-align: center;
            color: var(--text-muted);
            box-shadow: 0 22px 55px rgba(15, 23, 42, 0.08);
        }

        .empty-state strong {
            display: block;
            font-size: 1.2rem;
            color: #111827;
            margin-bottom: 12px;
        }

        @media (max-width: 720px) {
            .page-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .quiz-card {
                grid-template-columns: 1fr;
                text-align: left;
            }

            .quiz-thumbnail {
                width: 100%;
                height: 200px;
            }
        }
    </style>
@endpush

@section('content')
    @php($tableReady = $tableReady ?? true)

    <div class="page-heading">
        <div>
            <span class="stats-pill">{{ $tableReady ? $quizzes->count() : 0 }} quiz aktif</span>
            <h1>Manajemen Quiz</h1>
            <p>Siapkan evaluasi pembelajaran yang terstruktur untuk seluruh jenjang.</p>
        </div>
        <a href="{{ route('tutor.quizzes.create') }}" class="primary-btn">+ Tambah Quiz</a>
    </div>

    <div class="content-toolbar">
        <form method="GET" class="search-field">
            <input type="search" name="q" value="{{ $search }}" placeholder="Cari judul, pelajaran, atau jenjang..." />
<button type="submit" style="background:none; border:none; cursor:pointer;">
    <svg width="20" height="20" fill="#333" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387-1.414 1.414-4.387-4.387zM14 8a6 6 0 11-12 0 6 6 0 0112 0z" clip-rule="evenodd" />
    </svg>
</button>
        </form>
    </div>

    @if (! $tableReady)
        <div class="system-alert">
            <strong>Database kuis belum siap.</strong>
            <p>Selesaikan migrasi agar tutor dapat membuat kuis, mengatur jenjang, dan mempublikasikan evaluasi ke siswa.</p>
            <ol>
                <li>Buka terminal pada root project MayClass.</li>
                <li>Eksekusi <code>php artisan migrate</code> (tambahkan <code>--force</code> saat di production).</li>
                <li>Segarkan halaman ini dan mulai buat kuis pertama.</li>
            </ol>
        </div>
    @elseif ($quizzes->isEmpty())
        <div class="empty-state">
            <strong>Belum ada quiz terdaftar</strong>
            Buat quiz pertama Anda dan bagikan tautan evaluasi kepada siswa.
        </div>
    @else
        <div class="quiz-grid">
            @foreach ($quizzes as $quiz)
                <article class="quiz-card">
                    <img src="{{ $quiz->thumbnail_asset }}" alt="{{ $quiz->title }}" class="quiz-thumbnail" />
                    <div>
                        <h3>{{ $quiz->title }}</h3>
                        <div class="meta">{{ $quiz->subject }} &middot; {{ $quiz->class_level ?? 'Semua Kelas' }}</div>
                        <p class="summary">{{ Str::limit($quiz->summary, 140) }}</p>
                        <div class="actions">
                            <a href="{{ route('tutor.quizzes.edit', $quiz) }}">Edit Quiz</a>
                            @if ($quiz->link)
                                <a href="{{ $quiz->link }}" target="_blank" rel="noopener">Buka Quiz</a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection
