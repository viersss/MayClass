@extends('tutor.layout')

@section('title', 'Pengaturan Akun - MayClass')

@push('styles')
    <style>
        .account-shell {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 28px;
            align-items: flex-start;
        }

        /* SIDEBAR PROFIL */
        .profile-pane {
            background: #111c32;
            border-radius: 20px;
            padding: 24px 22px;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.45);
        }

        .profile-pane-header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .profile-pill {
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(148, 163, 184, 0.16);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(226, 232, 240, 0.92);
        }

        .profile-pane-content {
            display: grid;
            gap: 18px;
            justify-items: center;
            text-align: center;
        }

        .profile-avatar-wrapper {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.6);
        }

        .profile-status-dot {
            position: absolute;
            right: 6px;
            bottom: 8px;
            width: 16px;
            height: 16px;
            border-radius: 999px;
            background: #22c55e;
            border: 2px solid #0f172a;
        }

        .profile-name {
            margin: 8px 0 2px;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .profile-role {
            margin: 0;
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.95rem;
        }

        .profile-subtext {
            margin: 4px 0 0;
            font-size: 0.8rem;
            color: rgba(148, 163, 184, 0.9);
        }

        .profile-stats {
            display: grid;
            gap: 10px;
            width: 100%;
        }

        .profile-stat-item {
            padding: 10px 12px;
            border-radius: 14px;
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(148, 163, 184, 0.35);
            text-align: left;
        }

        .profile-stats span {
            font-size: 0.8rem;
            color: rgba(148, 163, 184, 0.9);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            display: block;
            margin-bottom: 3px;
        }

        .profile-stats strong {
            font-size: 0.95rem;
        }

        .profile-contact {
            display: grid;
            gap: 8px;
            width: 100%;
            text-align: left;
            margin-top: 4px;
            padding-top: 10px;
            border-top: 1px dashed rgba(148, 163, 184, 0.5);
        }

        .profile-contact span {
            font-size: 0.8rem;
            color: rgba(148, 163, 184, 0.95);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .profile-contact a {
            display: inline-block;
            color: #e5e7eb;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
        }

        .profile-contact a:hover {
            text-decoration: underline;
        }

        /* FORM KANAN */
        .form-card {
            background: var(--surface, #ffffff);
            border-radius: 20px;
            padding: 24px 24px 28px;
            border: 1px solid var(--border-subtle, #e5e7eb);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
        }

        .password-panel {
            margin-top: 24px;
            display: grid;
            gap: 16px;
        }

        .password-panel h2 {
            margin: 0;
            font-size: 1.3rem;
        }

        .password-panel p {
            margin: 0;
            color: var(--text-muted);
        }

        .password-form {
            display: grid;
            gap: 20px;
        }

        .password-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .password-input {
            width: 100%;
            border-radius: 14px;
            border: 1px solid var(--border-subtle, #e5e7eb);
            padding: 14px 16px;
            font-family: inherit;
            font-size: 0.95rem;
            background: var(--surface-muted, #f8fafc);
        }

        .password-error {
            margin-top: 6px;
            font-size: 0.85rem;
            color: #dc2626;
        }

        .password-submit {
            width: fit-content;
            border: none;
            border-radius: 999px;
            padding: 12px 26px;
            background: #125e66;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(18, 94, 102, 0.2);
        }

        .password-alert {
            padding: 12px 16px;
            border-radius: 16px;
            background: rgba(18, 94, 102, 0.08);
            color: #125e66;
            font-weight: 500;
        }

        .form-header {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 12px;
        }

        .form-title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .form-card h1 {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 600;
        }

        .form-tag {
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(34, 197, 94, 0.08);
            color: #16a34a;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .form-card p.description {
            margin: 0;
            color: var(--text-muted, #6b7280);
            font-size: 0.9rem;
        }

        .last-updated {
            font-size: 0.8rem;
            color: var(--text-muted, #6b7280);
            margin: 6px 0 12px;
        }

        .form-sections {
            display: grid;
            gap: 22px;
        }

        .form-section-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted, #6b7280);
            margin: 4px 0 6px;
        }

        .form-grid {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        label span {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 0.92rem;
        }

        input[type='text'],
        input[type='email'],
        input[type='number'],
        textarea {
            width: 100%;
            padding: 11px 14px;
            border-radius: 12px;
            border: 1px solid var(--border-subtle, #e5e7eb);
            font-family: inherit;
            font-size: 0.95rem;
            background: #fff;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, transform 0.12s ease;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: var(--accent, #3fa67e);
            box-shadow: 0 0 0 2px rgba(63, 166, 126, 0.25);
            transform: translateY(-1px);
        }

        .help-text {
            font-size: 0.8rem;
            color: var(--text-muted, #6b7280);
            margin-top: 4px;
        }

        .error-text {
            color: #dc2626;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        /* UPLOAD AVATAR */
        .avatar-upload {
            background: var(--surface-muted, #f9fafb);
            border-radius: 16px;
            padding: 16px 16px 14px;
            border: 1px dashed var(--border-subtle, #e5e7eb);
            display: grid;
            gap: 10px;
            justify-items: center;
            text-align: center;
        }

        .avatar-upload-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .avatar-upload-subtitle {
            font-size: 0.8rem;
            color: var(--text-muted, #6b7280);
            margin: 0;
        }

        .avatar-preview {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid var(--border-subtle, #e5e7eb);
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-input {
            display: none;
        }

        .avatar-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid var(--border-subtle, #e5e7eb);
            background: #ffffff;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.86rem;
            color: var(--text-main, #111827);
            margin-top: 4px;
        }

        .avatar-button:hover {
            border-color: var(--accent, #3fa67e);
        }

        .avatar-hint {
            margin: 0;
            font-size: 0.78rem;
            color: var(--text-muted, #6b7280);
        }

        .avatar-error {
            margin: 0;
            font-size: 0.78rem;
            color: #b91c1c;
        }

        /* ACTIONS */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .form-actions button {
            padding: 11px 22px;
            border-radius: 999px;
            border: none;
            background: var(--accent, #3fa67e);
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 14px 30px rgba(63, 166, 126, 0.35);
            transition: transform 0.12s ease, box-shadow 0.12s ease;
        }

        .form-actions button:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 40px rgba(63, 166, 126, 0.45);
        }

        .form-actions button:disabled {
            opacity: 0.7;
            cursor: default;
            box-shadow: none;
            transform: none;
        }

        @media (max-width: 1024px) {
            .account-shell {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .form-card {
                padding: 20px 16px 24px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="account-shell">
        {{-- PANEL KIRI: PROFIL SINGKAT TUTOR --}}
        <aside class="profile-pane">
            <div class="profile-pane-header">
                <span class="profile-pill">Profil Tutor</span>
            </div>

            <div class="profile-pane-content">
                @php($placeholderAvatar = asset('images/avatar-placeholder.svg'))
                @php($profileAvatar = $avatarUrl ?: $placeholderAvatar)

                <div class="profile-avatar-wrapper">
                    <img src="{{ $profileAvatar }}" alt="Foto Tutor" class="profile-avatar" />
                    <span class="profile-status-dot" title="Status aktif"></span>
                </div>

                <div>
                    <h2 class="profile-name">{{ $tutor?->name ?? 'Tutor MayClass' }}</h2>
                    <p class="profile-role">
                        {{ $tutorProfile?->specializations ?: 'Pengajar MayClass' }}
                    </p>
                    <p class="profile-subtext">
                        Sesuaikan profil agar siswa lebih mudah mengenal kredibilitas dan gaya mengajar Anda.
                    </p>
                </div>

                <div class="profile-stats">
                    <div class="profile-stat-item">
                        <span>Pengalaman Mengajar</span>
                        <strong>{{ $tutorProfile?->experience_years ?? 0 }} tahun</strong>
                    </div>
                    @if ($tutorProfile?->education)
                        <div class="profile-stat-item">
                            <span>Pendidikan Terakhir</span>
                            <strong>{{ $tutorProfile->education }}</strong>
                        </div>
                    @endif
                </div>

                <div class="profile-contact">
                    <div>
                        <span>Email utama</span>
                        <a href="mailto:{{ $tutor?->email }}">{{ $tutor?->email }}</a>
                    </div>
                    @if ($tutor?->phone)
                        <div>
                            <span>No. WhatsApp / Telepon</span>
                            <a href="tel:{{ $tutor->phone }}">{{ $tutor->phone }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </aside>

        {{-- PANEL KANAN: FORM PENGATURAN --}}
        <div class="form-card">
            <header class="form-header">
                <div class="form-title-row">
                    <h1>Informasi Akun & Profil Mengajar</h1>
                    <span class="form-tag">Hanya terlihat oleh siswa MayClass</span>
                </div>
                <p class="description">
                    Lengkapi data di bawah ini agar profil Anda tampil profesional di halaman kelas dan mudah dipahami oleh siswa.
                </p>
                @if ($tutor?->updated_at)
                    <div class="last-updated">
                        Terakhir diperbarui {{ $tutor->updated_at->locale('id')->diffForHumans() }}
                    </div>
                @endif
            </header>

            <form method="POST" action="{{ route('tutor.account.update') }}" class="form-sections" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- SECTION: FOTO PROFIL --}}
                <section>
                    <div class="form-section-title">Foto Profil</div>
                    <div class="form-grid">
                        <div class="avatar-upload">
                            <div class="avatar-preview">
                                <img
                                    src="{{ $profileAvatar }}"
                                    alt="Preview foto tutor"
                                    id="tutor-avatar-preview"
                                />
                            </div>
                            <div>
                                <p class="avatar-upload-title">Foto profil tutor</p>
                                <p class="avatar-upload-subtitle">
                                    Gunakan foto yang jelas dan rapi untuk meningkatkan kepercayaan siswa.
                                </p>
                            </div>
                            <label for="avatar" class="avatar-button">
                                Ganti Foto Profil
                            </label>
                            <input type="file" id="avatar" name="avatar" class="avatar-input" accept="image/*" />
                            <p class="avatar-hint">Format JPG/PNG, maksimal 5 MB.</p>
                            @error('avatar')
                                <p class="avatar-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- SECTION: DATA AKUN UTAMA --}}
                <section>
                    <div class="form-section-title">Data Akun</div>
                    <div class="form-grid">
                        <label>
                            <span>Nama Lengkap</span>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $tutor?->name) }}"
                                required
                            />
                            @error('name')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </label>

                        <label>
                            <span>Email</span>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $tutor?->email) }}"
                                required
                            />
                            <p class="help-text">Email ini digunakan untuk login dan komunikasi resmi dari MayClass.</p>
                            @error('email')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </label>

                        <label>
                            <span>No. Telepon / WhatsApp</span>
                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone', $tutor?->phone) }}"
                            />
                            <p class="help-text">Cantumkan nomor aktif yang digunakan untuk koordinasi jadwal dan kelas.</p>
                            @error('phone')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>
                </section>

                {{-- SECTION: PROFIL MENGAJAR --}}
                <section>
                    <div class="form-section-title">Profil Mengajar</div>
                    <div class="form-grid">
                        <label>
                            <span>Mata Pelajaran</span>
                            <input
                                type="text"
                                name="specializations"
                                value="{{ old('specializations', $tutorProfile?->specializations) }}"
                                required
                            />
                            <p class="help-text">
                                Contoh: Matematika SMA, Fisika, UTBK. Pisahkan dengan koma jika lebih dari satu.
                            </p>
                            @error('specializations')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </label>

                        <label>
                            <span>Pengalaman Mengajar (Tahun)</span>
                            <input
                                type="number"
                                name="experience_years"
                                value="{{ old('experience_years', $tutorProfile?->experience_years) }}"
                                min="0"
                                max="60"
                                required
                            />
                            <p class="help-text">
                                Isi dengan pengalaman total mengajar, baik di MayClass maupun di tempat lain.
                            </p>
                            @error('experience_years')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </label>

                        <label>
                            <span>Pendidikan Terakhir</span>
                            <input
                                type="text"
                                name="education"
                                value="{{ old('education', $tutorProfile?->education) }}"
                            />
                            <p class="help-text">
                                Contoh: S1 Pendidikan Matematika - Universitas X, S2 Teknik Informatika - Institut Y.
                            </p>
                            @error('education')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>
                </section>

                <div class="form-actions">
                    <button type="submit">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
        <div class="form-card password-panel">
            <h2>Ubah Password</h2>
            <p>Gunakan kombinasi huruf, angka, dan simbol untuk menjaga kerahasiaan akun.</p>
            @if (session('password_status'))
                <div class="password-alert">{{ session('password_status') }}</div>
            @endif
            <form class="password-form" method="post" action="{{ route('tutor.account.password') }}">
                @csrf
                @method('PUT')
                <div class="password-grid">
                    <label>
                        <span>Password Lama</span>
                        <input class="password-input" type="password" name="current_password" autocomplete="current-password" required />
                        @error('current_password', 'passwordUpdate')
                            <div class="password-error">{{ $message }}</div>
                        @enderror
                    </label>
                    <label>
                        <span>Password Baru</span>
                        <input class="password-input" type="password" name="password" autocomplete="new-password" required />
                        @error('password', 'passwordUpdate')
                            <div class="password-error">{{ $message }}</div>
                        @enderror
                    </label>
                    <label>
                        <span>Konfirmasi Password Baru</span>
                        <input class="password-input" type="password" name="password_confirmation" autocomplete="new-password" required />
                    </label>
                </div>
                <button class="password-submit" type="submit">Perbarui Password</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('avatar');
            const preview = document.getElementById('tutor-avatar-preview');

            if (!input || !preview) {
                return;
            }

            input.addEventListener('change', function () {
                const file = input.files && input.files[0];

                if (!file) {
                    return;
                }

                const reader = new FileReader();
                reader.addEventListener('load', function (event) {
                    const result = event.target && event.target.result;
                    if (typeof result === 'string') {
                        preview.src = result;
                    }
                });

                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
