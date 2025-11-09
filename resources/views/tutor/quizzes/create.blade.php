@extends('tutor.layout')

@section('title', 'Tambah Quiz Baru - MayClass')

@push('styles')
    <style>
        .form-card {
            background: #fff;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 22px 55px rgba(15, 23, 42, 0.08);
        }

        .form-card h1 {
            margin-top: 0;
        }

        .form-grid {
            display: grid;
            gap: 18px;
            margin-top: 24px;
        }

        label span {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="url"],
        textarea {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #d9e0ea;
            border-radius: 16px;
            font-family: inherit;
            font-size: 1rem;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 28px;
        }

        .form-actions a,
        .form-actions button {
            padding: 14px 24px;
            border-radius: 16px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
        }

        .form-actions a {
            border: 1px solid #d9e0ea;
            color: #1f2937;
        }

        .form-actions button {
            border: none;
            background: var(--primary);
            color: #fff;
        }

        .error-text {
            color: #dc2626;
            font-size: 0.9rem;
            margin-top: 6px;
        }
    </style>
@endpush

@section('content')
    <div class="form-card">
        <h1>Tambah Quiz Baru</h1>
        <p>Buat quiz untuk siswa MayClass lengkap dengan tautan pelaksanaan.</p>

        <form method="POST" action="{{ route('tutor.quizzes.store') }}" class="form-grid">
            @csrf
            <label>
                <span>Judul Quiz</span>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Quiz Persamaan Linear" required />
                @error('title')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Mata Pelajaran</span>
                <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Contoh: Matematika" required />
                @error('subject')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Kelas</span>
                <input type="text" name="class_level" value="{{ old('class_level') }}" placeholder="Contoh: Kelas 10A" required />
                @error('class_level')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Deskripsi</span>
                <textarea name="summary" placeholder="Tuliskan deskripsi singkat quiz..." required>{{ old('summary') }}</textarea>
                @error('summary')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Link Quiz</span>
                <input type="url" name="link_url" value="{{ old('link_url') }}" placeholder="https://" required />
                @error('link_url')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <div class="form-actions">
                <a href="{{ route('tutor.quizzes.index') }}">Batal</a>
                <button type="submit">Simpan Draft</button>
            </div>
        </form>
    </div>
@endsection
