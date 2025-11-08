@extends('tutor.layout')

@section('title', 'Tambah Materi Baru - MayClass')

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
        input[type="email"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #d9e0ea;
            border-radius: 16px;
            font-family: inherit;
            font-size: 1rem;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        .upload-field {
            border: 2px dashed #d9e0ea;
            border-radius: 18px;
            padding: 28px;
            text-align: center;
            color: #6b7280;
            font-size: 0.95rem;
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
        <h1>Tambah Materi Baru</h1>
        <p>Buat materi pembelajaran untuk siswa MayClass.</p>

        <form method="POST" action="{{ route('tutor.materials.store') }}" enctype="multipart/form-data" class="form-grid">
            @csrf
            <label>
                <span>Judul Materi</span>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Persamaan Linear Satu Variabel" required />
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
                <input type="text" name="level" value="{{ old('level') }}" placeholder="Contoh: Kelas 10A" required />
                @error('level')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Deskripsi Materi</span>
                <textarea name="summary" placeholder="Jelaskan isi materi..." required>{{ old('summary') }}</textarea>
                @error('summary')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Upload File (PDF, PPT, DOC)</span>
                <div class="upload-field">
                    <input type="file" name="attachment" accept=".pdf,.ppt,.pptx,.doc,.docx" />
                    <div style="margin-top: 8px; font-size: 0.85rem;">Ukuran maksimal 10MB.</div>
                </div>
                @error('attachment')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <div class="form-actions">
                <a href="{{ route('tutor.materials.index') }}">Batal</a>
                <button type="submit">Simpan Draft</button>
            </div>
        </form>
    </div>
@endsection
