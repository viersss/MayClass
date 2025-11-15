@extends('tutor.layout')

@section('title', 'Pengaturan Akun - MayClass')

@push('styles')
    <style>
        .account-shell {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 32px;
            align-items: flex-start;
        }

        .profile-pane {
            position: relative;
            background: linear-gradient(160deg, rgba(15, 23, 42, 0.92), rgba(45, 212, 191, 0.85));
            border-radius: 28px;
            padding: 36px 28px;
            color: #fff;
            box-shadow: 0 28px 65px rgba(15, 23, 42, 0.28);
            overflow: hidden;
        }

        .profile-pane::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.16), transparent 60%);
            pointer-events: none;
        }

        .profile-pane-content {
            position: relative;
            display: grid;
            gap: 18px;
            justify-items: center;
            text-align: center;
        }

        .profile-avatar {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.35);
        }

        .avatar-upload {
            display: grid;
            gap: 10px;
            justify-items: center;
            padding: 20px;
            border-radius: 24px;
            background: rgba(93, 230, 201, 0.08);
            border: 1px solid rgba(45, 212, 191, 0.18);
        }

        .avatar-preview {
            width: 112px;
            height: 112px;
            border-radius: 50%;
            overflow: hidden;
            display: grid;
            place-items: center;
            background: rgba(15, 23, 42, 0.08);
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
            padding: 10px 18px;
            border-radius: 999px;
            border: 1px solid rgba(45, 212, 191, 0.35);
            background: #fff;
            color: var(--primary-dark);
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .avatar-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(45, 212, 191, 0.25);
        }

        .avatar-hint {
            margin: 0;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .avatar-error {
            margin: 0;
            font-size: 0.82rem;
            color: #b91c1c;
            text-align: center;
        }

        .profile-name {
            margin: 0;
            font-size: 1.6rem;
        }

        .profile-role {
            margin: 0;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.85);
        }

        .profile-stats {
            display: grid;
            gap: 12px;
            width: 100%;
        }

        .profile-stats div {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            padding: 14px 18px;
            display: grid;
            gap: 4px;
        }

        .profile-stats span {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.75);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .profile-stats strong {
            font-size: 1.2rem;
        }

        .profile-contact {
            display: grid;
            gap: 10px;
            text-align: left;
            width: 100%;
        }

        .profile-contact span {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .profile-contact a {
            color: #fdfdfd;
            font-weight: 600;
        }

        .form-card {
            background: #fff;
            border-radius: 28px;
            padding: 36px;
            box-shadow: 0 28px 65px rgba(15, 23, 42, 0.12);
            border: 1px solid rgba(15, 23, 42, 0.05);
        }

        .form-card h1 {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 1.85rem;
        }

        .form-card p.description {
            margin: 0 0 24px;
            color: var(--text-muted);
            font-size: 0.98rem;
        }

        .last-updated {
            margin-bottom: 18px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .form-grid {
            display: grid;
            gap: 22px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        label span {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input[type='text'],
        input[type='email'],
        input[type='number'],
        textarea {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #d9e0ea;
            border-radius: 16px;
            font-family: inherit;
            font-size: 1rem;
            background: #fff;
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.04);
        }

        .help-text {
            display: block;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .error-text {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 6px;
        }

        .form-actions {
            grid-column: 1 / -1;
            display: flex;
            justify-content: flex-end;
            gap: 16px;
        }

        .form-actions button {
            padding: 14px 26px;
            border-radius: 18px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            box-shadow: 0 18px 45px rgba(61, 183, 173, 0.28);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .form-actions button:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 55px rgba(61, 183, 173, 0.35);
        }

        @media (max-width: 1024px) {
            .account-shell {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="account-shell">
        <aside class="profile-pane">
            <div class="profile-pane-content">
                @php($profileAvatar = $avatarUrl ?? config('mayclass.images.tutor.banner.fallback'))
                <img src="{{ $profileAvatar }}" alt="Foto Tutor" class="profile-avatar" />
                <div>
                    <h2 class="profile-name">{{ $tutor?->name ?? 'Tutor MayClass' }}</h2>
                    <p class="profile-role">{{ $tutorProfile?->specializations ?? 'Pengajar MayClass' }}</p>
                </div>
                <div class="profile-stats">
                    <div>
                        <span>Pengalaman Mengajar</span>
                        <strong>{{ $tutorProfile?->experience_years ?? 0 }} tahun</strong>
                    </div>
                    @if ($tutorProfile?->education)
                        <div>
                            <span>Pendidikan Terakhir</span>
                            <strong>{{ $tutorProfile->education }}</strong>
                        </div>
                    @endif
                </div>
                <div class="profile-contact">
                    <div>
                        <span>Email</span>
                        <a href="mailto:{{ $tutor?->email }}">{{ $tutor?->email }}</a>
                    </div>
                    @if ($tutor?->phone)
                        <div>
                            <span>Telepon</span>
                            <a href="tel:{{ $tutor->phone }}">{{ $tutor->phone }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </aside>

        <div class="form-card">
            <h1>Informasi Pribadi</h1>
            <p class="description">Perbarui profil profesional Anda agar siswa mengenal kompetensi tutor MayClass lebih baik.</p>
            @if ($tutor?->updated_at)
                <div class="last-updated">Terakhir diperbarui {{ $tutor->updated_at->locale('id')->diffForHumans() }}</div>
            @endif

            <form method="POST" action="{{ route('tutor.account.update') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="avatar-upload">
                    <div class="avatar-preview">
                        <img
                            src="{{ $avatarUrl ?? config('mayclass.images.tutor.banner.fallback') }}"
                            alt="Preview foto tutor"
                            id="tutor-avatar-preview"
                        />
                    </div>
                    <label for="avatar" class="avatar-button">Ganti Foto Profil</label>
                    <input type="file" id="avatar" name="avatar" class="avatar-input" accept="image/*" />
                    <p class="avatar-hint">Format JPG/PNG, maksimal 2 MB</p>
                    @error('avatar')
                        <p class="avatar-error">{{ $message }}</p>
                    @enderror
                </div>
                <label>
                    <span>Nama Lengkap</span>
                    <input type="text" name="name" value="{{ old('name', $tutor?->name) }}" required />
                    @error('name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </label>

                <label>
                    <span>Email</span>
                    <input type="email" name="email" value="{{ old('email', $tutor?->email) }}" required />
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </label>

                <label>
                    <span>No. Telepon</span>
                    <input type="text" name="phone" value="{{ old('phone', $tutor?->phone) }}" />
                    <span class="help-text">Cantumkan nomor yang aktif untuk koordinasi jadwal.</span>
                    @error('phone')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </label>

                <label>
                    <span>Mata Pelajaran</span>
                    <input type="text" name="specializations" value="{{ old('specializations', $tutorProfile?->specializations) }}" required />
                    <span class="help-text">Pisahkan dengan koma jika mengajar lebih dari satu bidang.</span>
                    @error('specializations')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </label>

                <label>
                    <span>Pengalaman Mengajar (Tahun)</span>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $tutorProfile?->experience_years) }}" min="0" max="60" required />
                    @error('experience_years')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </label>

                <label>
                    <span>Pendidikan Terakhir</span>
                    <input type="text" name="education" value="{{ old('education', $tutorProfile?->education) }}" />
                    @error('education')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </label>

                <div class="form-actions">
                    <button type="submit">Simpan Perubahan</button>
                </div>
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
                    const result = event.target?.result;
                    if (typeof result === 'string') {
                        preview.src = result;
                    }
                });
                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
