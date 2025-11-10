@extends('tutor.layout')

@section('title', 'Manajemen Materi - MayClass')

@push('styles')
    <style>
        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .page-heading h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .page-heading p {
            margin: 6px 0 0;
            color: #6b7280;
        }

        .search-bar {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 16px;
            margin-bottom: 24px;
        }

        .search-bar input[type="search"] {
            border: 1px solid #d9e0ea;
            border-radius: 14px;
            padding: 14px 18px;
            font-family: inherit;
            font-size: 1rem;
        }

        .search-bar button,
        .page-heading a.button {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 14px 22px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: transform 0.2s ease;
        }

        .search-bar button:hover,
        .page-heading a.button:hover {
            transform: translateY(-2px);
        }

        .material-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .material-card {
            background: #fff;
            border-radius: 18px;
            padding: 20px 22px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 16px;
            align-items: center;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
        }

        .material-card h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .material-card .meta {
            color: #6b7280;
            font-size: 0.95rem;
            margin-top: 6px;
        }

        .material-card .actions {
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .material-card .actions a {
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid #d9e0ea;
            font-weight: 500;
            color: #1f2937;
        }

        .material-card .actions a:hover {
            border-color: var(--primary);
            color: var(--primary-dark);
        }

        .empty-state {
            text-align: center;
            padding: 48px;
            background: #fff;
            border-radius: 20px;
            color: #6b7280;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.05);
        }
    </style>
@endpush

@section('content')
    <div class="page-heading">
        <div>
            <h1>Manajemen Materi</h1>
            <p>Kelola dan tambahkan materi pembelajaran untuk siswa.</p>
        </div>
        <a href="{{ route('tutor.materials.create') }}" class="button">+ Tambah Materi</a>
    </div>

    <form method="GET" class="search-bar">
        <input type="search" name="q" value="{{ $search }}" placeholder="Cari materi..." />
        <button type="submit">Cari</button>
    </form>

    @if ($materials->isEmpty())
        <div class="empty-state">Belum ada materi terdaftar. Mulai tambahkan materi pertama Anda.</div>
    @else
        <div class="material-list">
            @foreach ($materials as $material)
                <div class="material-card">
                    <div>
                        <h3>{{ $material->title }}</h3>
                        <div class="meta">{{ $material->subject }} &middot; {{ $material->level }}</div>
                    </div>
                    <div class="actions">
                        <a href="{{ route('tutor.materials.edit', $material) }}">Edit Materi</a>
                        @if ($material->resource_url)
                            <a href="{{ $material->resource_url }}" target="_blank" rel="noopener">Lihat File</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
