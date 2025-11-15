@extends('tutor.layout')

@section('title', 'Manajemen Materi - MayClass')

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
            background: rgba(84, 101, 255, 0.12);
            color: #3730a3;
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
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 14px 22px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 14px 35px rgba(61, 183, 173, 0.28);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .search-field button:hover,
        .content-toolbar .primary-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 45px rgba(61, 183, 173, 0.35);
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

        .material-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .material-card {
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

        .material-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(61, 183, 173, 0.12), transparent 60%);
            pointer-events: none;
        }

        .material-thumbnail {
            width: 120px;
            height: 120px;
            border-radius: 18px;
            object-fit: cover;
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.15);
        }

        .material-card h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .material-card .meta {
            margin: 8px 0 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .material-card .summary {
            color: #4b5563;
            font-size: 0.95rem;
            line-height: 1.55;
        }

        .material-card .actions {
            display: flex;
            gap: 12px;
            margin-top: 18px;
        }

        .material-card .actions a {
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            font-weight: 500;
            color: #1f2937;
            background: rgba(15, 23, 42, 0.02);
            transition: border 0.2s ease, color 0.2s ease, background 0.2s ease;
        }

        .material-card .actions a:hover {
            border-color: var(--primary);
            color: var(--primary-dark);
            background: rgba(61, 183, 173, 0.1);
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

            .material-card {
                grid-template-columns: 1fr;
                text-align: left;
            }

            .material-thumbnail {
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
            <span class="stats-pill">{{ $tableReady ? $materials->count() : 0 }} materi aktif</span>
            <h1>Manajemen Materi</h1>
            <p>Kelola modul pembelajaran dan bagikan sumber belajar kepada siswa MayClass.</p>
        </div>
        <a href="{{ route('tutor.materials.create') }}" class="primary-action">+ Tambah Materi</a>
    </div>

    <div class="content-toolbar">
        <form method="GET" class="search-field">
            <input type="search" name="q" value="{{ $search }}" placeholder="Cari judul, pelajaran, atau jenjang..." />
            <button type="submit">Cari</button>
        </form>
    </div>

    @if (! $tableReady)
        <div class="system-alert">
            <strong>Database materi belum siap.</strong>
            <p>Jalankan migrasi sekali saja agar tutor dapat menambahkan dan mengelola materi langsung dari dashboard.</p>
            <ol>
                <li>Buka terminal pada root project MayClass.</li>
                <li>Jalankan perintah <code>php artisan migrate</code> (gunakan opsi <code>--force</code> pada production).</li>
                <li>Muat ulang halaman ini dan mulai unggah materi baru.</li>
            </ol>
        </div>
    @elseif ($materials->isEmpty())
        <div class="empty-state">
            <strong>Belum ada materi terdaftar</strong>
            Tambahkan materi pertama Anda untuk membagikan modul belajar secara profesional.
        </div>
    @else
        <div class="material-grid">
            @foreach ($materials as $material)
                <article class="material-card">
                    <img src="{{ $material->thumbnail_asset }}" alt="{{ $material->title }}" class="material-thumbnail" />
                    <div>
                        <h3>{{ $material->title }}</h3>
                        <div class="meta">{{ $material->subject }} &middot; {{ $material->level }}</div>
                        <p class="summary">{{ Str::limit($material->summary, 140) }}</p>
                        <div class="actions">
                            <a href="{{ route('tutor.materials.edit', $material) }}">Edit Materi</a>
                            @if ($material->resource_path)
                                @php($isExternal = str_starts_with($material->resource_path, 'http'))
                                <a href="{{ $isExternal ? $material->resource_path : route('tutor.materials.preview', $material->slug) }}"
                                    target="_blank" rel="noopener">Lihat Lampiran</a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection
