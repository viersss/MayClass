@extends('admin.layout')

@section('title', 'Manajemen Paket - MayClass')

@push('styles')
    <style>
        :root {
            --primary: #0f766e;
            --primary-hover: #115e59;
            --bg-surface: #ffffff;
            --bg-body: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-card: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --radius: 12px;
        }

        .page-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* --- 1. HEADER SECTION --- */
        .page-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            background: var(--bg-surface);
            padding: 24px 32px;
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .header-title h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0 0 4px 0;
        }

        .header-title p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: background 0.2s, transform 0.1s;
            box-shadow: 0 4px 6px -1px rgba(15, 118, 110, 0.2);
        }

        .btn-add:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        /* --- 2. TABLE CARD --- */
        .table-card {
            background: var(--bg-surface);
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .package-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.92rem;
            min-width: 900px;
        }

        .package-table th {
            background: #f8fafc;
            text-align: left;
            padding: 16px 24px;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 700;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color);
        }

        .package-table td {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            vertical-align: middle;
        }

        .package-table tr:last-child td {
            border-bottom: none;
        }

        .package-table tbody tr {
            transition: background 0.2s;
        }

        .package-table tbody tr:hover {
            background: #f1f5f9;
        }

        /* Specific Column Styles */
        .pkg-name {
            font-weight: 700;
            color: var(--text-main);
            display: block;
            font-size: 1rem;
        }

        .pkg-price-label {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .pkg-level {
            display: inline-flex;
            padding: 4px 10px;
            border-radius: 6px;
            background: #f0f9ff;
            color: #0369a1;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid #e0f2fe;
        }

        .pkg-grades {
            display: block;
            margin-top: 4px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .pkg-price {
            font-family: monospace;
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .tag-pill {
            display: inline-flex;
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .tag-default {
            background: #f1f5f9;
            color: #64748b;
        }

        .tag-highlight {
            background: #fff7ed;
            color: #ea580c;
            border: 1px solid #ffedd5;
        }

        /* Orange for active tags */

        /* Actions */
        .action-group {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: flex-end;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            transition: all 0.2s;
            color: var(--text-muted);
            cursor: pointer;
            background: transparent;
        }

        .btn-icon:hover {
            background: #f1f5f9;
            color: var(--text-main);
            border-color: var(--border-color);
        }

        .btn-icon.delete:hover {
            background: #fee2e2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        .subject-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
        }

        .subject-pill {
            display: inline-flex;
            padding: 3px 10px;
            border-radius: 99px;
            background: #e0f2fe;
            color: #0369a1;
            font-size: 0.75rem;
            font-weight: 600;
            border: 1px solid #bae6fd;
        }

        .subject-pill-more {
            display: inline-flex;
            padding: 3px 10px;
            border-radius: 99px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .text-muted {
            color: var(--text-muted);
            font-style: italic;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
<div class="page-container" x-data="{ showModal: {{ $errors->any() ? 'true' : 'false' }} }">

    {{-- Header --}}
    <div class="page-header">
        <div class="header-title">
            <h2>Manajemen Paket Belajar</h2>
            <p>Atur penawaran harga, jenjang pendidikan, dan detail paket untuk siswa.</p>
        </div>
        <button @click="showModal = true" class="btn-add">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Paket Baru
        </button>
    </div>

    {{-- Table --}}
    <div class="table-card">
        <div class="table-responsive">
            <table class="package-table">
                <thead>
                    <tr>
                        <th>Nama Paket</th>
                        <th>Jenjang & Kelas</th>
                        <th>Harga</th>
                        <th>Kuota</th>
                        <th>Mata Pelajaran</th>
                        <th>Tutor</th>
                        <th>Tag / Label</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($packages as $package)
                    <tr>
                        <td>
                            <span class="pkg-name">{{ $package->detail_title }}</span>
                            <span class="pkg-price-label">{{ $package->detail_price_label }}</span>
                        </td>
                        <td>
                            <span
                                class="pkg-level">{{ \App\Support\PackagePresenter::stageLabel($package->level) }}</span>
                            @if ($package->grade_range)
                                <span class="pkg-grades">{{ $package->grade_range }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="pkg-price">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            @php($quota = $package->quotaSnapshot())
                            @if ($quota['limit'] === null)
                                <span class="tag-pill tag-default">Tak terbatas</span>
                            @else
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <strong>{{ $quota['remaining'] }} / {{ $quota['limit'] }} kursi tersisa</strong>
                                    <small style="color: var(--text-muted);">
                                        Aktif: {{ $quota['active_enrollments'] }}, Checkout terkunci:
                                        {{ $quota['checkout_holds'] }}
                                    </small>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($package->subjects->isNotEmpty())
                                <div class="subject-pills">
                                    @foreach($package->subjects->take(3) as $subject)
                                        <span class="subject-pill">{{ $subject->name }}</span>
                                    @endforeach
                                    @if($package->subjects->count() > 3)
                                        <span class="subject-pill-more">+{{ $package->subjects->count() - 3 }} lainnya</span>
                                    @endif
                                </div>
                            @else
                                <span class="text-muted">Belum ada</span>
                            @endif
                        </td>
                        <td>
                            @if($package->tutors->isNotEmpty())
                                <div class="subject-pills">
                                    @foreach($package->tutors->take(3) as $tutor)
                                        <span class="subject-pill"
                                            style="background: #e0f2fe; color: #0369a1; border-color: #bae6fd;">{{ $tutor->name }}</span>
                                    @endforeach
                                    @if($package->tutors->count() > 3)
                                        <span class="subject-pill-more"
                                            style="background: #f1f5f9; color: #64748b;">+{{ $package->tutors->count() - 3 }}</span>
                                    @endif
                                </div>
                            @else
                                <span class="text-muted">Belum ada</span>
                            @endif
                        </td>
                        <td>
                            @if($package->tag)
                                <span class="tag-pill tag-highlight">{{ $package->tag }}</span>
                            @else
                                <span class="tag-pill tag-default">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.packages.edit', $package) }}" class="btn-icon"
                                    title="Edit Paket">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>

                                <form action="{{ route('admin.packages.destroy', $package) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus paket ini? Data yang dihapus tidak bisa dikembalikan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon delete" title="Hapus Paket">
                                        <svg width="18" height="18" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <svg style="width: 48px; height: 48px; margin-bottom: 16px; color: #cbd5e1;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p>Belum ada paket belajar yang tersedia.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL ADD PACKAGE --}}
    <div class="modal-backdrop" :class="{ 'show': showModal }" x-show="showModal" x-transition.opacity x-cloak>
        <div class="modal-content" @click.away="showModal = false" style="max-width: 800px;">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Paket Belajar</h3>
                <button type="button" class="modal-close" @click="showModal = false">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.packages.store') }}" method="POST">
                    @csrf
                    
                    <div class="admin-card">
                        <h4>Informasi Dasar Paket</h4>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">Judul Paket</label>
                                <input type="text" name="detail_title" class="form-input" value="{{ old('detail_title') }}"
                                    required placeholder="Contoh: Paket Intensif UTBK">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Slug (URL)</label>
                                <input type="text" name="slug" class="form-input" value="{{ old('slug') }}" required placeholder="paket-intensif-utbk">
                                @error('slug') <div style="color: #dc2626; font-size: 0.8rem; margin-top: 4px;">{{ $message }}
                                </div> @enderror
                            </div>
                        </div>

                        <div class="form-grid-2" style="margin-top: 20px;">
                            <div class="form-group">
                                <label class="form-label">Jenjang</label>
                                <select name="level" class="form-select" required>
                                    <option value="" disabled selected>Pilih Jenjang</option>
                                    @foreach($stages as $key => $label)
                                        <option value="{{ $key }}" {{ old('level') == $key ? 'selected' : '' }}>{{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Rentang Kelas</label>
                                <input type="text" name="grade_range" class="form-input" value="{{ old('grade_range') }}"
                                    placeholder="Cth: Kelas 10-12" required>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 20px;">
                            <label class="form-label">Ringkasan</label>
                            <textarea name="summary" class="form-textarea" rows="3"
                                required placeholder="Deskripsi singkat paket yang akan muncul di kartu paket.">{{ old('summary') }}</textarea>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h4>Harga & Tampilan</h4>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="price" class="form-input" value="{{ old('price') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Image Key (Unsplash)</label>
                                <input type="text" name="image_url" class="form-input" value="{{ old('image_url') }}"
                                    required placeholder="Contoh: photo-12345678">
                            </div>
                        </div>
                        <div class="form-grid-2" style="margin-top: 20px;">
                            <div class="form-group">
                                <label class="form-label">Label Harga (Kartu)</label>
                                <input type="text" name="card_price_label" class="form-input"
                                    value="{{ old('card_price_label') }}" placeholder="Cth: /Bulan" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Label Harga (Detail)</label>
                                <input type="text" name="detail_price_label" class="form-input"
                                    value="{{ old('detail_price_label') }}" placeholder="Cth: per bulan" required>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h4>Mata Pelajaran</h4>
                        <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 16px;">Pilih mata pelajaran yang termasuk dalam paket ini.</p>
                        
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 12px; max-height: 200px; overflow-y: auto; padding: 16px; border: 1px solid #e2e8f0; border-radius: 12px; background: #fff;">
                            @foreach($subjectsByLevel as $level => $subjects)
                                @if($subjects->isNotEmpty())
                                    <div style="grid-column: 1/-1; font-weight: 700; color: #0f766e; margin-top: 8px; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                        {{ $level }}</div>
                                    @foreach($subjects as $subject)
                                        <label style="display: flex; gap: 10px; align-items: center; font-size: 0.9rem; padding: 6px; border-radius: 8px; transition: background 0.2s; cursor: pointer;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" {{ in_array($subject->id, old('subjects', [])) ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #0f766e;">
                                            {{ $subject->name }}
                                        </label>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                        @error('subjects') <div style="color: #dc2626; font-size: 0.8rem; margin-top: 4px;">
                        {{ $message }}</div> @enderror
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel" @click="showModal = false">Batal</button>
                        <button type="submit" class="btn-submit">Simpan Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection