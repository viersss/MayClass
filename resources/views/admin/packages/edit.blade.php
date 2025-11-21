@extends('admin.layout')

@section('title', 'Ubah Paket - MayClass')

@push('styles')
    <style>
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 26px;
            padding: 28px 32px;
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: 0 24px 48px rgba(15, 23, 42, 0.08);
            max-width: 780px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .form-grid .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-weight: 600;
            font-size: 0.92rem;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            border-radius: 14px;
            border: 1px solid rgba(15, 23, 42, 0.12);
            padding: 12px 14px;
            font-size: 0.95rem;
            font-family: inherit;
            background: rgba(248, 250, 252, 0.9);
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        .form-actions {
            margin-top: 28px;
            display: flex;
            gap: 16px;
        }

        .submit-btn {
            padding: 12px 22px;
            border-radius: 16px;
            border: none;
            background: linear-gradient(135deg, rgba(31, 209, 161, 0.85), rgba(84, 101, 255, 0.85));
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }

        .cancel-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .error-message {
            margin-top: 6px;
            color: #dc2626;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <a href="{{ route('admin.packages.index') }}" class="cancel-link" style="margin-bottom: 22px;">Kembali ke daftar paket</a>

    @php($stageOptions = $stages ?? [])

    <form action="{{ route('admin.packages.update', $package) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')
        <h2 style="margin-top: 0; font-size: 1.6rem;">Ubah Paket Belajar</h2>
        <p style="color: var(--text-muted); margin-top: 6px;">Perbarui detail paket untuk menjaga konsistensi informasi.</p>

        <div class="form-grid">
            <div>
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $package->slug) }}" required />
                @error('slug')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="level">Jenjang Pendidikan</label>
                <select id="level" name="level" required style="width: 100%; border-radius: 14px; border: 1px solid rgba(15, 23, 42, 0.12); padding: 12px 14px; font-size: 0.95rem; background: rgba(248, 250, 252, 0.9);">
                    <option value="" disabled {{ old('level', $package->level) ? '' : 'selected' }}>Pilih jenjang</option>
                    @foreach ($stageOptions as $value => $label)
                        <option value="{{ $value }}" {{ old('level', $package->level) === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('level')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="grade_range">Rentang Kelas</label>
                <input type="text" id="grade_range" name="grade_range" value="{{ old('grade_range', $package->grade_range) }}" placeholder="Contoh: Kelas 10 - 12 &amp; UTBK" required />
                @error('grade_range')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="tag">Tag</label>
                <input type="text" id="tag" name="tag" value="{{ old('tag', $package->tag) }}" />
                @error('tag')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="price">Harga (numerik)</label>
                <input type="number" id="price" name="price" value="{{ old('price', $package->price) }}" min="0" step="1000" required />
                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="max_students">Kuota Maksimum (opsional)</label>
                <input
                    type="number"
                    id="max_students"
                    name="max_students"
                    value="{{ old('max_students', $package->max_students) }}"
                    min="1"
                    step="1"
                    placeholder="Contoh: 25"
                />
                <p style="margin: 6px 0 0; color: var(--text-muted); font-size: 0.85rem;">Biarkan kosong jika kuota tidak dibatasi.</p>
                @error('max_students')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="card_price_label">Label Harga Kartu</label>
                <input type="text" id="card_price_label" name="card_price_label" value="{{ old('card_price_label', $package->card_price_label) }}" required />
                @error('card_price_label')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="detail_price_label">Label Harga Detail</label>
                <input type="text" id="detail_price_label" name="detail_price_label" value="{{ old('detail_price_label', $package->detail_price_label) }}" required />
                @error('detail_price_label')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="full">
                <label for="detail_title">Judul Paket</label>
                <input type="text" id="detail_title" name="detail_title" value="{{ old('detail_title', $package->detail_title) }}" required />
                @error('detail_title')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="full">
                <label for="image_url">Kunci Gambar (unsplash)</label>
                <input type="text" id="image_url" name="image_url" value="{{ old('image_url', $package->image_url) }}" required />
                @error('image_url')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="full">
                <label for="summary">Ringkasan</label>
                <textarea id="summary" name="summary" required>{{ old('summary', $package->summary) }}</textarea>
                @error('summary')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="full">
                <label for="zoom_link">Link Zoom (opsional)</label>
                <input
                    type="url"
                    id="zoom_link"
                    name="zoom_link"
                    value="{{ old('zoom_link', $package->zoom_link) }}"
                    placeholder="https://zoom.us/j/meeting-id"
                    pattern="https?://.*"
                />
                <p style="margin: 6px 0 0; color: var(--text-muted); font-size: 0.85rem;">Isi jika paket menyediakan sesi onl
ine.</p>
                @error('zoom_link')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="submit-btn">Simpan Perubahan</button>
            <a href="{{ route('admin.packages.index') }}" class="cancel-link">Batalkan</a>
        </div>
    </form>
@endsection
