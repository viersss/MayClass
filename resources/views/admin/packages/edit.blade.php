@extends('admin.layout')

@section('title', 'Edit Paket Belajar')

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="header-content">
                <h1>Edit Paket Belajar</h1>
                <p>Perbarui informasi paket belajar MayClass.</p>
            </div>
            <a href="{{ route('admin.packages.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
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
    </div>

    <script>
        function addInputRow(containerId, inputName, placeholder) {
            const container = document.getElementById(containerId);
            const div = document.createElement('div');
            div.className = 'dynamic-input-row';
            div.style.cssText = 'display: flex; gap: 8px; margin-bottom: 8px;';

            div.innerHTML = `
                    <input type="text" name="${inputName}" class="form-input" placeholder="${placeholder}" style="flex: 1;">
                    <button type="button" class="btn-icon-danger" onclick="this.parentElement.remove()" style="background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; width: 38px; cursor: pointer;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                `;

            container.appendChild(div);
        }
    </script>
@endsection