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
<div class="page-container">

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
                                    <span class="pkg-level">{{ \App\Support\PackagePresenter::stageLabel($package->level) }}</span>
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
                                                Aktif: {{ $quota['active_enrollments'] }}, Checkout terkunci: {{ $quota['checkout_holds'] }}
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
                                                <span class="subject-pill" style="background: #e0f2fe; color: #0369a1; border-color: #bae6fd;">{{ $tutor->name }}</span>
                                            @endforeach
                                            @if($package->tutors->count() > 3)
                                                <span class="subject-pill-more" style="background: #f1f5f9; color: #64748b;">+{{ $package->tutors->count() - 3 }}</span>
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
                                        <a href="{{ route('admin.packages.edit', $package) }}" class="btn-icon" title="Edit Paket">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paket ini? Data yang dihapus tidak bisa dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon delete" title="Hapus Paket">
                                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <button type="button"
                                    onclick="addInputRow('program-inputs-container', 'program_points[]', 'Contoh: Modul tematik mingguan')"
                                    style="background: #e0f2fe; color: #0284c7; border: none; padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 500; cursor: pointer; margin-top: 4px;">
                                    + Tambah Program
                                </button>
                            </div>

                            <!-- Facility Points -->
                            <div class="tentor-form-group">
                                <label>Fasilitas</label>
                                <div id="facility-inputs-container">
                                    <div class="dynamic-input-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                                        <input type="text" name="facility_points[]"
                                            placeholder="Contoh: Pendampingan belajar 120 menit/sesi">
                                        <button type="button" class="btn-icon-danger"
                                            onclick="this.parentElement.remove()"
                                            style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button"
                                    onclick="addInputRow('facility-inputs-container', 'facility_points[]', 'Contoh: Bank soal literasi')"
                                    style="background: #e0f2fe; color: #0284c7; border: none; padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 500; cursor: pointer; margin-top: 4px;">
                                    + Tambah Fasilitas
                                </button>
                            </div>
                        </div>

                        <div class="tentor-form-group" style="margin-top: 20px;">
                            <label>Jadwal Belajar</label>
                            <div id="schedule-inputs-container">
                                <div class="dynamic-input-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                                    <input type="text" name="schedule_info[]"
                                        placeholder="Contoh: Senin (15.30–17.30 WIB)">
                                    <button type="button" class="btn-icon-danger" onclick="this.parentElement.remove()"
                                        style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button"
                                onclick="addInputRow('schedule-inputs-container', 'schedule_info[]', 'Contoh: Kamis (15.30–17.30 WIB)')"
                                style="background: #e0f2fe; color: #0284c7; border: none; padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 500; cursor: pointer; margin-top: 4px;">
                                + Tambah Jadwal
                            </button>
                        </div>
                    </div>

                    <div class="tentor-form-card">
                        <h2>Pengaturan Tambahan</h2>
                        <div class="tentor-form-grid">
                            <div class="tentor-form-group">
                                <label>Label Harga Kartu</label>
                                <input type="text" name="card_price_label"
                                    value="{{ old('card_price_label', '/Bulan') }}" required>
                            </div>
                            <div class="tentor-form-group">
                                <label>Tag (Opsional)</label>
                                <input type="text" name="tag" value="{{ old('tag') }}" placeholder="Contoh: Terpopuler">
                            </div>
                        </div>
                    </div>

                    <div class="tentor-form-actions" style="margin-top: 24px;">
                        <button type="button" class="btn-secondary"
                            onclick="closeModal('addPackageModal')">Batal</button>
                        <button type="submit" class="btn-primary">Simpan Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
                // Small delay to allow display:flex to apply before opacity transition
                setTimeout(() => {
                    modal.classList.add('show');
                }, 10);
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('show');
                // Wait for transition to finish before hiding
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300); // Matches CSS transition duration
            }
        }

        function addInputRow(containerId, inputName, placeholder, value = '') {
            const container = document.getElementById(containerId);
            const div = document.createElement('div');
            div.className = 'dynamic-input-row';
            div.style.cssText = 'display: flex; gap: 8px; margin-bottom: 8px;';

            div.innerHTML = `
                <input type="text" name="${inputName}" value="${value}" placeholder="${placeholder}" style="flex: 1;">
                <button type="button" class="btn-icon-danger" onclick="this.parentElement.remove()" style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;

            container.appendChild(div);
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            if (event.target.classList.contains('modal-backdrop')) {
                event.target.classList.remove('show');
                setTimeout(() => {
                    event.target.style.display = 'none';
                }, 300);
            }
        }

        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function () {
                openModal('addPackageModal');
            });
        @endif
    </script>
    @endsection