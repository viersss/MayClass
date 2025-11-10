@extends('tutor.layout')

@section('title', 'Edit Materi - MayClass')

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

        .current-file {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #374151;
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
        <h1>Edit Materi</h1>
        <p>Perbarui informasi materi pembelajaran.</p>

        <form method="POST" action="{{ route('tutor.materials.update', $material) }}" enctype="multipart/form-data" class="form-grid">
            @csrf
            @method('PUT')
            <label>
                <span>Judul Materi</span>
                <input type="text" name="title" value="{{ old('title', $material->title) }}" required />
                @error('title')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Mata Pelajaran</span>
                <input type="text" name="subject" value="{{ old('subject', $material->subject) }}" required />
                @error('subject')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Kelas</span>
                <input type="text" name="level" value="{{ old('level', $material->level) }}" required />
                @error('level')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Deskripsi Singkat</span>
                <textarea name="summary" required>{{ old('summary', $material->summary) }}</textarea>
                @error('summary')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Upload File (PDF, PPT, DOC)</span>
                <div class="upload-field">
                    <input type="file" name="attachment" accept=".pdf,.ppt,.pptx,.doc,.docx" />
                    <div style="margin-top: 8px; font-size: 0.85rem;">Unggah file baru untuk mengganti lampiran.</div>
                    @if ($material->resource_url)
                        <div class="current-file">File saat ini: <a href="{{ $material->resource_url }}" target="_blank" rel="noopener">Lihat Lampiran</a></div>
                    @else
                        <div class="current-file">Belum ada file terunggah.</div>
                    @endif
                </div>
                @error('attachment')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <div class="form-actions">
                <a href="{{ route('tutor.materials.index') }}">Batal</a>
                <button type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
