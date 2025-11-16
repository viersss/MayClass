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

        .profile-pane {
            background: #111c32;
            border-radius: 20px;
            padding: 28px;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .profile-pane-content {
            display: grid;
            gap: 16px;
            justify-items: center;
            text-align: center;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.35);
        }

        .profile-name {
            margin: 0;
            font-size: 1.5rem;
        }

        .profile-role {
            margin: 0;
            color: rgba(255, 255, 255, 0.75);
        }

        .profile-stats {
            display: grid;
            gap: 10px;
            width: 100%;
        }

        .profile-stats div {
            padding: 12px 14px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.08);
            text-align: left;
        }

        .profile-stats span {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .profile-contact {
            display: grid;
            gap: 8px;
            width: 100%;
            text-align: left;
        }

        .profile-contact span {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.65);
        }

        .profile-contact a {
            color: #fff;
            font-weight: 600;
        }

        .avatar-upload {
            background: var(--surface-muted);
            border-radius: 16px;
            padding: 18px;
            border: 1px solid var(--border-subtle);
            display: grid;
            gap: 12px;
            justify-items: center;
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
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
            padding: 10px 16px;
            border-radius: 12px;
            border: 1px solid var(--border-subtle);
            background: var(--surface);
            cursor: pointer;
            font-weight: 600;
            color: var(--text-main);
        }

        .avatar-hint {
            margin: 0;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .avatar-error {
            margin: 0;
            font-size: 0.85rem;
            color: #b91c1c;
        }

        .form-card {
            background: var(--surface);
            border-radius: 20px;
            padding: 28px;
            border: 1px solid var(--border-subtle);
        }

        .form-card h1 {
            margin: 0 0 6px;
            font-size: 1.7rem;
        }

        .form-card p.description {
            margin: 0 0 18px;
            color: var(--text-muted);
        }

        .last-updated {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .form-grid {
            display: grid;
            gap: 18px;
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
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid var(--border-subtle);
            font-family: inherit;
            font-size: 1rem;
            background: #fff;
        }

        .help-text {
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
        }

        .form-actions button {
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
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
                @php($placeholderAvatar = asset('images/avatar-placeholder.svg'))
                @php($profileAvatar = $avatarUrl ?? $placeholderAvatar)
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
                            src="{{ $avatarUrl ?? $placeholderAvatar }}"
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
