@extends('tutor.layout')

@section('title', 'Tambah Quiz Baru - MayClass')

@push('styles')
    <style>
        :root {
            --primary: #0f766e;
            --primary-light: #f0fdfa;
            --border-color: #e2e8f0;
            --text-color: #0f172a;
            --text-muted: #64748b;
            --danger: #ef4444;
            --danger-light: #fef2f2;
            --bg-card: #ffffff;
            --bg-body: #f8fafc;
        }

        .form-card {
            background: var(--bg-card);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .form-card h1 {
            margin-top: 0;
            color: var(--text-color);
            font-size: 1.5rem;
            font-weight: 700;
        }

        .form-grid {
            display: grid;
            gap: 24px;
            margin-top: 24px;
        }

        /* --- INPUT STYLES --- */
        label span {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-color);
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="number"],
        input[type="url"],
        select,
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            background-color: #fff;
            transition: all 0.2s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* --- DYNAMIC SECTIONS --- */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .section-title {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-color);
        }

        .btn-add-sm {
            background: var(--primary-light);
            color: var(--primary);
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-add-sm:hover {
            background: #ccfbf1;
        }

        .dynamic-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .dynamic-card {
            background: var(--bg-body);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            position: relative;
            transition: transform 0.1s;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        /* INPUT INSIDE CARD */
        .dynamic-card input[type="text"] {
            background: transparent;
            border: none;
            padding: 0;
            margin: 0;
            font-size: 0.95rem;
            width: 100%;
            font-weight: 500;
        }

        .dynamic-card input[type="text"]:focus {
            box-shadow: none;
        }

        /* --- REMOVE BUTTON --- */
        .btn-remove {
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #94a3b8;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .btn-remove:hover {
            background: var(--danger-light);
            color: var(--danger);
            border-color: #fecaca;
            transform: scale(1.05);
        }

        .btn-remove svg {
            width: 16px;
            height: 16px;
            stroke-width: 2;
        }

        /* --- FOOTER ACTIONS --- */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .btn-cancel {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-decoration: none;
            border: 1px solid transparent;
        }

        .btn-cancel:hover {
            background: #f1f5f9;
            color: var(--text-color);
        }

        .btn-submit {
            padding: 12px 24px;
            border-radius: 12px;
            background: var(--primary);
            color: #fff;
            border: none;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.2);
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: #115e59;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 4px;
        }
    </style>
@endpush

@section('content')
    @php
        // Handle Old Inputs for Dynamic Fields
        $levelValues = collect(old('levels', ['']))->map(fn($v) => is_string($v) ? $v : '');
        if ($levelValues->isEmpty())
            $levelValues = collect(['']);

        $takeawayValues = collect(old('takeaways', ['']))->map(fn($v) => is_string($v) ? $v : '');
        if ($takeawayValues->isEmpty())
            $takeawayValues = collect(['']);
    @endphp

    <div class="form-card">
        <div style="margin-bottom: 32px;">
            <h1>Tambah Quiz Baru</h1>
            <p style="color: var(--text-muted);">Buat evaluasi pembelajaran siswa dengan soal latihan yang terstruktur.</p>
        </div>

        <form method="POST" action="{{ route('tutor.quizzes.store') }}" class="form-grid">
            @csrf

            {{-- 1. INFO UTAMA (Grid 2 Kolom) --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <label>
                    <span>Paket Belajar</span>
                    <select name="package_id" required>
                        <option value="">-- Pilih Paket --</option>
                        @forelse ($packages as $package)
                            <option value="{{ $package->id }}" @selected(old('package_id') == $package->id)>
                                {{ $package->detail_title ?? $package->title }}
                            </option>
                        @empty
                            <option value="" disabled>Tidak ada paket tersedia</option>
                        @endforelse
                    </select>
                    @error('package_id') <div class="error-message">{{ $message }}</div> @enderror
                </label>

            <label>
                <span>Mata Pelajaran</span>
                <select name="subject_id" id="subject-select" required style="width: 100%; padding: 14px 18px; border: 1px solid #d9e0ea; border-radius: 16px; font-family: inherit; font-size: 1rem;">
                    <option value="">Pilih paket terlebih dahulu</option>
                </select>
                @error('subject_id')
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
                <span>Durasi Pengerjaan</span>
                <input type="text" name="duration_label" value="{{ old('duration_label', '45 Menit') }}" placeholder="Contoh: 45 Menit" required />
                @error('duration_label')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </label>

            <label>
                <span>Jumlah Soal</span>
                <input type="number" min="1" max="200" name="question_count" value="{{ old('question_count', 20) }}" placeholder="Contoh: 20" required />
                @error('question_count')
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

            <div class="dynamic-group">
                <div class="dynamic-group__header">
                    <span>Level atau Kompetensi</span>
                    <button class="dynamic-add" data-add-level>Tambah level</button>
                </div>
                <div class="dynamic-group__items" data-levels>
                    @foreach ($levelValues as $value)
                        <div class="dynamic-item" data-level-row>
                            <input type="text" name="levels[]" value="{{ $value }}" placeholder="Contoh: Level Dasar" />
                            <div class="dynamic-item__actions">
                                <button type="button" class="dynamic-item__remove" data-remove-row>Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                @php
                    $levelError = $errors->first('levels') ?: $errors->first('levels.*');
                @endphp
                @if ($levelError)
                    <div class="error-text" style="margin-top: 10px;">{{ $levelError }}</div>
                @endif
            </div>

            {{-- 2. JUDUL & KELAS (Grid 2 Kolom - Judul lebih lebar) --}}
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
                <label>
                    <span>Judul Quiz</span>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Judul materi quiz..."
                        required />
                    @error('title') <div class="error-message">{{ $message }}</div> @enderror
                </label>

                <label>
                    <span>Kelas / Tingkat</span>
                    <input type="text" name="class_level" value="{{ old('class_level') }}" placeholder="Cth: 10 SMA"
                        required />
                    @error('class_level') <div class="error-message">{{ $message }}</div> @enderror
                </label>
            </div>

            {{-- 3. DETAIL TEKNIS (Durasi & Jml Soal) --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">

                <label>
                    <span>Durasi Pengerjaan</span>
                    <input type="text" name="duration_label" value="{{ old('duration_label', '30 menit') }}"
                        placeholder="Cth: 30 menit" required />
                    <div style="margin-top: 6px; font-size: 0.85rem; color: var(--text-muted);">Tuliskan estimasi waktu agar
                        siswa bisa mempersiapkan diri.</div>
                    @error('duration_label') <div class="error-message">{{ $message }}</div> @enderror
                </label>

                <label>
                    <span>Jumlah Soal</span>
                    <input type="number" min="1" max="200" name="question_count" value="{{ old('question_count', 20) }}"
                        placeholder="Cth: 20" required />
                    @error('question_count') <div class="error-message">{{ $message }}</div> @enderror
                </label>
            </div>

            <label>
                <span>Deskripsi Singkat</span>
                <textarea name="summary" placeholder="Jelaskan apa yang akan diujikan dalam quiz ini..."
                    required>{{ old('summary') }}</textarea>
                @error('summary') <div class="error-message">{{ $message }}</div> @enderror
            </label>

            <hr style="border: 0; border-top: 1px solid #f1f5f9; margin: 8px 0;">

            {{-- 4. LEVEL & HIGHLIGHTS (Dynamic Sections) --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px;">

                {{-- Level Kompetensi --}}
                <div>
                    <div class="section-header">
                        <span class="section-title">Level Kompetensi</span>
                        <button type="button" class="btn-add-sm" data-add-level>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah
                        </button>
                    </div>
                    <div class="dynamic-list" data-levels>
                        @foreach ($levelValues as $value)
                            <div class="dynamic-card">
                                <input type="text" name="levels[]" value="{{ $value }}" placeholder="Cth: Level Dasar / Pemula">
                                <button type="button" class="btn-remove" data-remove-row title="Hapus baris">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    @if($errors->has('levels.*'))
                    <div class="error-message">Harap isi semua level.</div> @endif
                </div>

                {{-- Highlights / Takeaways --}}
                <div>
                    <div class="section-header">
                        <span class="section-title">Highlight Pembelajaran</span>
                        <button type="button" class="btn-add-sm" data-add-takeaway>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah
                        </button>
                    </div>
                    <div class="dynamic-list" data-takeaways>
                        @foreach ($takeawayValues as $value)
                            <div class="dynamic-card">
                                <input type="text" name="takeaways[]" value="{{ $value }}"
                                    placeholder="Cth: Memahami konsep dasar...">
                                <button type="button" class="btn-remove" data-remove-row title="Hapus baris">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    @if($errors->has('takeaways.*'))
                    <div class="error-message">Harap isi semua highlight.</div> @endif
                </div>
            </div>

            <hr style="border: 0; border-top: 1px solid #f1f5f9; margin: 8px 0;">

            {{-- 5. LINK QUIZ --}}
            <div>
                <label>
                    <span>Link Quiz / Platform Eksternal</span>
                    <input type="url" name="link_url" value="{{ old('link_url') }}"
                        placeholder="https://docs.google.com/forms/..." required />
                    <div style="margin-top: 6px; font-size: 0.85rem; color: var(--text-muted);">Masukkan link Google Form,
                        Quizizz, atau platform lain yang digunakan.</div>
                    @error('link_url') <div class="error-message">{{ $message }}</div> @enderror
                </label>
            </div>

            {{-- FOOTER --}}
            <div class="form-actions">
                <a href="{{ route('tutor.quizzes.index') }}" class="btn-cancel">Batalkan</a>
                <button type="submit" class="btn-submit">Simpan Quiz</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const trashIcon = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>`;

            // --- Helper Template ---
            const createInputCard = (name, placeholder) => {
                const div = document.createElement('div');
                div.className = 'dynamic-card';
                // Animasi masuk
                div.style.opacity = '0';
                div.style.transform = 'translateY(5px)';

                div.innerHTML = `
                        <input type="text" name="${name}" placeholder="${placeholder}" autofocus>
                        <button type="button" class="btn-remove" data-remove-row title="Hapus baris">${trashIcon}</button>
                    `;

                // Trigger animasi
                setTimeout(() => {
                    div.style.opacity = '1';
                    div.style.transform = 'translateY(0)';
                }, 10);

                return div;
            };

            // --- Logic Levels ---
            const levelContainer = document.querySelector('[data-levels]');
            document.querySelector('[data-add-level]').addEventListener('click', () => {
                levelContainer.appendChild(createInputCard('levels[]', 'Cth: Level Lanjutan'));
            });

            // --- Logic Takeaways ---
            const takeawayContainer = document.querySelector('[data-takeaways]');
            document.querySelector('[data-add-takeaway]').addEventListener('click', () => {
                takeawayContainer.appendChild(createInputCard('takeaways[]', 'Cth: Evaluasi pemahaman...'));
            });

            // --- Global Remove Function ---
            document.addEventListener('click', (e) => {
                const btn = e.target.closest('[data-remove-row]');
                if (btn) {
                    const row = btn.closest('.dynamic-card');
                    if (row && row.parentElement.children.length > 1) {
                        // Animasi keluar
                        row.style.opacity = '0';
                        row.style.transform = 'translateY(10px)';
                        setTimeout(() => {
                            row.remove();
                        }, 200);
                    }
                }
            });

            // AJAX Subject Dropdown
            const packageSelect = document.querySelector('select[name="package_id"]');
            const subjectSelect = document.getElementById('subject-select');

            if (packageSelect && subjectSelect) {
                packageSelect.addEventListener('change', function() {
                    const packageId = this.value;
                    subjectSelect.innerHTML = '<option value="">Memuat...</option>';
                    subjectSelect.disabled = true;

                    if (packageId) {
                        fetch(`/tutor/packages/${packageId}/subjects`)
                            .then(response => response.json())
                            .then(data => {
                                subjectSelect.innerHTML = '<option value="">Pilih Mata Pelajaran</option>';
                                data.forEach(subject => {
                                    const option = document.createElement('option');
                                    option.value = subject.id;
                                    option.textContent = subject.name + ' (' + subject.level + ')';
                                    subjectSelect.appendChild(option);
                                });
                                subjectSelect.disabled = false;
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                subjectSelect.innerHTML = '<option value="">Gagal memuat mata pelajaran</option>';
                            });
                    } else {
                        subjectSelect.innerHTML = '<option value="">Pilih paket terlebih dahulu</option>';
                        subjectSelect.disabled = true;
                    }
                });

                if (packageSelect.value) {
                    packageSelect.dispatchEvent(new Event('change'));
                }
            }
        });
    </script>
@endpush