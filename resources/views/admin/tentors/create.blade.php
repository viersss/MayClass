@extends('admin.layout')

@section('title', 'Tambah Tentor Baru - MayClass')

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
            --radius: 16px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .page-title p {
            color: var(--text-muted);
            margin: 4px 0 0;
            font-size: 0.95rem;
        }

        .form-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 24px;
            align-items: start;
        }

        .card {
            background: var(--bg-surface);
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            padding: 24px;
            margin-bottom: 24px;
        }

        .card-header {
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-main);
            margin: 0;
        }

        .avatar-upload-zone {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 24px;
            border: 2px dashed var(--border-color);
            border-radius: var(--radius);
            background: #f8fafc;
            transition: all 0.2s;
            cursor: pointer;
        }

        .avatar-upload-zone:hover {
            border-color: var(--primary);
            background: #f0fdfa;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 16px;
            border: 4px solid #fff;
            box-shadow: var(--shadow-md);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .helper-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .package-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 16px;
        }

        .package-card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            background: #fff;
        }

        .package-card:hover {
            border-color: var(--primary);
            background: #f0fdfa;
        }

        .package-card.selected {
            border-color: var(--primary);
            background: #f0fdfa;
            box-shadow: 0 0 0 2px var(--primary);
        }

        .package-card input[type="checkbox"] {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-cancel {
            background: white;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
            display: block;
            margin-top: 12px;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background: #f8fafc;
        }

        @media (max-width: 1024px) {
            .form-container {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h1>Tambah Tentor Baru</h1>
            <p>Lengkapi informasi profil dan penugasan untuk mendaftarkan pengajar baru.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.tentors.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-container">
            <!-- Left Column: Avatar & Account -->
            <div class="left-col">
                <div class="card">
                    <div class="card-header">
                        <h3>Foto Profil</h3>
                    </div>
                    <label class="avatar-upload-zone" for="avatar-input">
                        <img src="{{ asset('images/avatar-placeholder.svg') }}" id="avatar-preview" class="avatar-preview"
                            alt="Preview">
                        <span style="font-weight: 600; color: var(--primary); font-size: 0.9rem;">Klik untuk Unggah</span>
                        <span class="helper-text">JPG/PNG, Max 5MB</span>
                        <input type="file" id="avatar-input" name="avatar" accept="image/*" hidden
                            onchange="previewImage(this)">
                    </label>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Akun Login</h3>
                    </div>
                    <div class="form-group">
                        <label>Username <span style="color:red">*</span></label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" required
                            placeholder="cth: budi_math">
                        @error('username') <p class="helper-text" style="color: #ef4444;">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>Password <span style="color:red">*</span></label>
                        <input type="password" name="password" class="form-control" required
                            placeholder="Minimal 8 karakter">
                        @error('password') <p class="helper-text" style="color: #ef4444;">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="checkbox-label"
                            style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="is_active" value="1" checked
                                style="width: 18px; height: 18px; accent-color: var(--primary);">
                            <span>Akun Aktif</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Simpan Tentor</button>
                <a href="{{ route('admin.tentors.index') }}" class="btn-cancel">Batalkan</a>
            </div>

            <!-- Right Column: Personal & Professional Info -->
            <div class="right-col">
                <div class="card">
                    <div class="card-header">
                        <h3>Informasi Pribadi</h3>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap <span style="color:red">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required
                                placeholder="Nama lengkap beserta gelar">
                            @error('name') <p class="helper-text" style="color: #ef4444;">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email <span style="color:red">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                                placeholder="email@contoh.com">
                            @error('email') <p class="helper-text" style="color: #ef4444;">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                            placeholder="0812...">
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Profil Profesional</h3>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Spesialisasi <span style="color:red">*</span></label>
                            <input type="text" name="specializations" class="form-control"
                                value="{{ old('specializations') }}" required
                                placeholder="Cth: Matematika SMA, Fisika Dasar">
                        </div>
                        <div class="form-group">
                            <label>Pengalaman (Tahun)</label>
                            <input type="number" name="experience_years" class="form-control"
                                value="{{ old('experience_years', 0) }}" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Headline Profil</label>
                        <input type="text" name="headline" class="form-control" value="{{ old('headline') }}"
                            placeholder="Cth: Guru Matematika Berpengalaman 5 Tahun">
                    </div>
                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <input type="text" name="education" class="form-control" value="{{ old('education') }}"
                            placeholder="Cth: S1 Pendidikan Matematika UPI">
                    </div>
                    <div class="form-group">
                        <label>Bio Singkat</label>
                        <textarea name="bio" class="form-control" rows="4"
                            placeholder="Ceritakan sedikit tentang metode mengajar atau prestasi...">{{ old('bio') }}</textarea>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Mata Pelajaran yang Diampu</h3>
                    </div>
                    <div class="form-group">
                        <p class="helper-text" style="margin-bottom: 12px;">Pilih mata pelajaran yang dikuasai tentor ini.
                        </p>
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 12px;">
                            @foreach($subjectsByLevel as $level => $subjects)
                                @if($subjects->isNotEmpty())
                                    <div style="grid-column: 1 / -1; font-weight: 700; color: var(--primary); margin-top: 8px;">
                                        {{ $level }}</div>
                                    @foreach($subjects as $subject)
                                        <label
                                            style="display: flex; align-items: center; gap: 8px; padding: 8px; border: 1px solid var(--border-color); border-radius: 8px; cursor: pointer; background: #fff;">
                                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" {{ in_array($subject->id, old('subjects', [])) ? 'checked' : '' }}>
                                            <span style="font-size: 0.9rem;">{{ $subject->name }}</span>
                                        </label>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                        @error('subjects') <p class="helper-text" style="color: #ef4444;">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Penugasan Paket Belajar (Opsional)</h3>
                    </div>
                    @if($packages->isEmpty())
                        <div style="text-align: center; padding: 20px; color: var(--text-muted);">
                            Belum ada paket belajar yang tersedia.
                        </div>
                    @else
                        <div class="package-grid">
                            @foreach($packages as $package)
                                <label class="package-card {{ in_array($package->id, old('packages', [])) ? 'selected' : '' }}"
                                    onclick="togglePackage(this)">
                                    <input type="checkbox" name="packages[]" value="{{ $package->id }}" {{ in_array($package->id, old('packages', [])) ? 'checked' : '' }}>
                                    <div
                                        style="font-weight: 700; color: var(--text-main); margin-bottom: 4px; padding-right: 24px;">
                                        {{ $package->detail_title }}</div>
                                    <div style="font-size: 0.85rem; color: var(--text-muted);">
                                        {{ \App\Support\PackagePresenter::stageLabel($package->level) }}</div>
                                    @if($package->tutor)
                                        <div style="font-size: 0.8rem; color: #eab308; margin-top: 8px;">
                                            ⚠️ Sudah ada: {{ $package->tutor->name }}
                                        </div>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function togglePackage(card) {
            const checkbox = card.querySelector('input[type="checkbox"]');
            if (checkbox.checked) {
                card.classList.add('selected');
            } else {
                card.classList.remove('selected');
            }
        }
    </script>
@endsection