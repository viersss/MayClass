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

        .help-text {
            margin: 6px 0 12px;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .subject-selection {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 12px;
        }

        .subject-group h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0 0 10px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid rgba(15, 23, 42, 0.1);
        }

        .subject-checkboxes {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(248, 250, 252, 0.5);
            border: 1px solid rgba(15, 23, 42, 0.08);
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .checkbox-label:hover {
            background: rgba(248, 250, 252, 1);
            border-color: rgba(15, 23, 42, 0.15);
        }

        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin: 0;
        }

        /* Pricing Features Styles */
        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 12px;
        }

        .feature-item {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .feature-item input {
            flex: 1;
        }

        .btn-remove {
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            background: #fee2e2;
            color: #b91c1c;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .btn-add {
            padding: 10px 18px;
            border-radius: 10px;
            border: none;
            background: rgba(31, 209, 161, 0.15);
            color: #0f766e;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            margin-top: 8px;
        }

        .btn-add:hover {
            background: rgba(31, 209, 161, 0.25);
        }

        .btn-remove:hover {
            background: #fecaca;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .subject-checkboxes {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="header-content">
                <h1>Edit Paket Belajar</h1>
                <p>Perbarui informasi paket belajar MayClass.</p>
            </div>

            <div class="full">
                <label>Fitur Pricing (Ditampilkan di Kartu Paket)</label>
                <p class="help-text">Tambahkan fitur-fitur yang akan ditampilkan pada kartu paket di landing page. Contoh: "6x kelas live per bulan", "Tryout AKM & evaluasi mendalam"</p>
                
                <div class="feature-list" id="feature-list">
                    <?php
                    $existingFeatures = $package->cardFeatures->pluck('label')->toArray();
                    $oldFeatures = old('card_features', $existingFeatures);
                    if (empty($oldFeatures)) {
                        $oldFeatures = [''];
                    }
                    ?>
                    @foreach($oldFeatures as $index => $feature)
                        <div class="feature-item">
                            <input type="text" name="card_features[]" value="{{ $feature }}" placeholder="Contoh: 6x kelas live per bulan" />
                            <button type="button" class="btn-remove" onclick="removeFeature(this)">Hapus</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn-add" onclick="addFeature()">+ Tambah Fitur</button>
                
                @error('card_features')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="full">
                <label>Mata Pelajaran yang Termasuk *</label>
                <p class="help-text">Pilih minimal 1 mata pelajaran yang akan diajarkan dalam paket ini.</p>
                
                <div class="subject-selection">
                    @foreach(['SD', 'SMP', 'SMA'] as $level)
                        @if($subjectsByLevel[$level]->isNotEmpty())
                            <div class="subject-group">
                                <h4>{{ $level }}</h4>
                                <div class="subject-checkboxes">
                                    @foreach($subjectsByLevel[$level] as $subject)
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" 
                                                {{ in_array($subject->id, old('subjects', $package->subjects->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            {{ $subject->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                @error('subjects')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="full">
                <label>Tutor Pengampu (Opsional)</label>
                <p class="help-text">Pilih tutor yang ditugaskan untuk mengajar paket ini. Tutor yang dipilih akan dapat membuat jadwal untuk paket ini.</p>
                
                <div class="subject-selection">
                    @if($tutors->isEmpty())
                        <div class="empty-state">Belum ada tutor aktif.</div>
                    @else
                        <div class="subject-group">
                            <h4>Daftar Tutor</h4>
                            <div class="subject-checkboxes">
                                @foreach($tutors as $tutor)
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="tutors[]" value="{{ $tutor->id }}" 
                                            {{ in_array($tutor->id, old('tutors', $package->tutors->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        {{ $tutor->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="admin-card">
            <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Judul Paket</label>
                        <input type="text" name="detail_title" class="form-input"
                            value="{{ old('detail_title', $package->detail_title) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenjang Pendidikan</label>
                        <select name="level" class="form-select" required>
                            <option value="" disabled>Pilih jenjang</option>
                            @foreach ($stages as $value => $label)
                                <option value="{{ $value }}" {{ old('level', $package->level) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-grid-2" style="margin-top: 20px;">
                    <div class="form-group">
                        <label class="form-label">Rentang Kelas</label>
                        <input type="text" name="grade_range" class="form-input"
                            value="{{ old('grade_range', $package->grade_range) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="price" class="form-input" value="{{ old('price', $package->price) }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kuota Siswa per Kelas (Opsional)</label>
                        <input type="number" name="max_students" class="form-input"
                            value="{{ old('max_students', $package->max_students) }}"
                            placeholder="Kosongkan jika tak terbatas">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah Kelas Tersedia</label>
                        <input type="number" name="available_class" class="form-input"
                            value="{{ old('available_class', $package->available_class ?? 1) }}" min="1" required>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label class="form-label">Ringkasan</label>
                    <textarea name="summary" class="form-textarea" rows="2"
                        required>{{ old('summary', $package->summary) }}</textarea>
                </div>

                <div class="form-grid-2" style="margin-top: 20px;">
                    <!-- Program Points Dynamic Input -->
                    <div class="form-group">
                        <label class="form-label">Program</label>
                        <div id="program-inputs-container">
                            @forelse($package->program_points ?? [] as $point)
                                <div class="dynamic-input-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                                    <input type="text" name="program_points[]" class="form-input" value="{{ $point }}"
                                        placeholder="Contoh: 2x kelas live interaktif/minggu" style="flex: 1;">
                                    <button type="button" class="btn-icon-danger" onclick="this.parentElement.remove()"
                                        style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            @empty
                                <div class="dynamic-input-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                                    <input type="text" name="program_points[]" class="form-input"
                                        placeholder="Contoh: 2x kelas live interaktif/minggu" style="flex: 1;">
                                    <button type="button" class="btn-icon-danger" onclick="this.parentElement.remove()"
                                        style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            @endforelse
                        </div>
                        <button type="button"
                            onclick="addInputRow('program-inputs-container', 'program_points[]', 'Contoh: Modul tematik mingguan')"
                            style="background: #e0f2fe; color: #0284c7; border: none; padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 500; cursor: pointer; margin-top: 4px;">
                            + Tambah Program
                        </button>
                    </div>

                    <!-- Facility Points Dynamic Input -->
                    <div class="form-group">
                        <label class="form-label">Fasilitas</label>
                        <div id="facility-inputs-container">
                            @forelse($package->facility_points ?? [] as $point)
                                <div class="dynamic-input-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                                    <input type="text" name="facility_points[]" class="form-input" value="{{ $point }}"
                                        placeholder="Contoh: Pendampingan belajar 120 menit/sesi" style="flex: 1;">
                                    <button type="button" class="btn-icon-danger" onclick="this.parentElement.remove()"
                                        style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            @empty
                                <div class="dynamic-input-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                                    <input type="text" name="facility_points[]" class="form-input"
                                        placeholder="Contoh: Pendampingan belajar 120 menit/sesi" style="flex: 1;">
                                    <button type="button" class="btn-icon-danger" onclick="this.parentElement.remove()"
                                        style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            @endforelse
                        </div>
                        <button type="button"
                            onclick="addInputRow('facility-inputs-container', 'facility_points[]', 'Contoh: Bank soal literasi')"
                            style="background: #e0f2fe; color: #0284c7; border: none; padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 500; cursor: pointer; margin-top: 4px;">
                            + Tambah Fasilitas
                        </button>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 16px;">
                    <label class="form-label">Jadwal Belajar</label>
                    <div id="schedule-inputs-container">
                        @forelse($package->schedule_info ?? [] as $point)
                            <div class="dynamic-input-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                                <input type="text" name="schedule_info[]" class="form-input" value="{{ $point }}"
                                    placeholder="Contoh: Senin (15.30–17.30 WIB)" style="flex: 1;">
                                <button type="button" class="btn-icon-danger" onclick="this.parentElement.remove()"
                                    style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        @empty
                            <div class="dynamic-input-row" style="display: flex; gap: 8px; margin-bottom: 8px;">
                                <input type="text" name="schedule_info[]" class="form-input"
                                    placeholder="Contoh: Senin (15.30–17.30 WIB)" style="flex: 1;">
                                <button type="button" class="btn-icon-danger" onclick="this.parentElement.remove()"
                                    style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        @endforelse
                    </div>
                    <button type="button"
                        onclick="addInputRow('schedule-inputs-container', 'schedule_info[]', 'Contoh: Kamis (15.30–17.30 WIB)')"
                        style="background: #e0f2fe; color: #0284c7; border: none; padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 500; cursor: pointer; margin-top: 4px;">
                        + Tambah Jadwal
                    </button>
                </div>

                <div class="admin-card" style="margin-top: 24px; background: #f8fafc; border: 1px solid #e2e8f0;">
                    <h3 style="font-size: 1rem; margin-bottom: 16px;">Pengaturan Tambahan</h3>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Label Harga Kartu</label>
                            <input type="text" name="card_price_label" class="form-input"
                                value="{{ old('card_price_label', $package->card_price_label) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tag (Opsional)</label>
                            <input type="text" name="tag" class="form-input" value="{{ old('tag', $package->tag) }}"
                                placeholder="Contoh: Terpopuler">
                        </div>
                    </div>
                </div>

                <div class="form-actions" style="margin-top: 32px; display: flex; justify-content: flex-end; gap: 12px;">
                    <a href="{{ route('admin.packages.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary"
                        style="background: #0f766e; border-color: #0f766e; color: white;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </form>

    <script>
        function addFeature() {
            const list = document.getElementById('feature-list');
            const item = document.createElement('div');
            item.className = 'feature-item';
            item.innerHTML = `
                <input type="text" name="card_features[]" placeholder="Contoh: 6x kelas live per bulan" />
                <button type="button" class="btn-remove" onclick="removeFeature(this)">Hapus</button>
            `;
            list.appendChild(item);
        }

        function removeFeature(button) {
            const list = document.getElementById('feature-list');
            if (list.children.length > 1) {
                button.parentElement.remove();
            } else {
                // Keep at least one input, just clear it
                button.parentElement.querySelector('input').value = '';
            }
        }
    </script>
@endsection
