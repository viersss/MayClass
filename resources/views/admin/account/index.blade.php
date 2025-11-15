@extends('admin.layout')

@section('title', 'Pengaturan Akun - MayClass')

@push('styles')
    <style>
        .account-wrapper {
            display: grid;
            gap: 32px;
        }

        .account-header {
            background: linear-gradient(135deg, rgba(31, 109, 79, 0.12), rgba(63, 166, 126, 0.18));
            border-radius: 24px;
            padding: 28px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .account-header img {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 18px 40px rgba(31, 107, 79, 0.18);
        }

        .account-header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .account-card {
            background: #fff;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 24px 60px rgba(31, 107, 79, 0.1);
            border: 1px solid rgba(31, 107, 79, 0.08);
        }

        .avatar-field {
            display: grid;
            gap: 12px;
            justify-items: center;
            padding: 20px;
            border-radius: 20px;
            border: 1px dashed rgba(63, 166, 126, 0.35);
            background: rgba(63, 166, 126, 0.06);
        }

        .avatar-field__preview {
            width: 112px;
            height: 112px;
            border-radius: 50%;
            overflow: hidden;
            display: grid;
            place-items: center;
            background: rgba(31, 109, 79, 0.08);
        }

        .avatar-field__preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-field__input {
            display: none;
        }

        .avatar-field__button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 999px;
            border: 1px solid rgba(31, 109, 79, 0.4);
            background: #fff;
            color: #1f2a37;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .avatar-field__button:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 26px rgba(31, 109, 79, 0.2);
        }

        .avatar-field__hint {
            margin: 0;
            font-size: 0.85rem;
            color: rgba(17, 37, 54, 0.7);
            text-align: center;
        }

        .avatar-field__error {
            margin: 0;
            font-size: 0.82rem;
            color: #dc2626;
            text-align: center;
        }

        form {
            display: grid;
            gap: 24px;
        }

        .form-grid {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        label span {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input[type='text'],
        input[type='email'] {
            width: 100%;
            padding: 14px 18px;
            border-radius: 16px;
            border: 1px solid rgba(31, 109, 79, 0.2);
            background: rgba(31, 109, 79, 0.04);
            font-family: inherit;
            font-size: 1rem;
        }

        .error-text {
            margin-top: 6px;
            font-size: 0.85rem;
            color: #dc2626;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
        }

        .form-actions button {
            padding: 14px 28px;
            border-radius: 999px;
            border: none;
            background: linear-gradient(135deg, #3fa67e, #1b6d4f);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 20px 40px rgba(31, 107, 79, 0.24);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .form-actions button:hover {
            transform: translateY(-2px);
            box-shadow: 0 28px 55px rgba(31, 107, 79, 0.3);
        }

        @media (max-width: 768px) {
            .account-header {
                flex-direction: column;
                text-align: center;
            }

            .form-actions {
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    @php($currentAdmin = $account ?? $admin)
    @php($avatarSource = $avatarUrl ?? config('mayclass.images.tutor.banner.fallback'))
    <div class="account-wrapper">
        <div class="account-header">
            <img src="{{ $avatarSource }}" alt="Foto Admin" id="admin-account-avatar" />
            <div>
                <h1>Pengaturan Akun</h1>
                <p style="margin: 6px 0 0; color: rgba(17, 37, 54, 0.7);">
                    Kelola informasi profil admin utama untuk memastikan data terbaru tampil di seluruh panel.
                </p>
            </div>
        </div>

        <div class="account-card">
            <form action="{{ route('admin.account.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="avatar-field">
                    <div class="avatar-field__preview">
                        <img src="{{ $avatarSource }}" alt="Preview foto admin" id="admin-avatar-preview" />
                    </div>
                    <label class="avatar-field__button" for="avatar">Unggah Foto Baru</label>
                    <input type="file" class="avatar-field__input" id="avatar" name="avatar" accept="image/*" />
                    <p class="avatar-field__hint">Format JPG/PNG, maksimum 2 MB</p>
                    @error('avatar')
                        <p class="avatar-field__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-grid">
                    <label>
                        <span>Nama Lengkap</span>
                        <input type="text" name="name" value="{{ old('name', $currentAdmin?->name) }}" required />
                        @error('name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </label>

                    <label>
                        <span>Email</span>
                        <input type="email" name="email" value="{{ old('email', $currentAdmin?->email) }}" required />
                        @error('email')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </label>

                    <label>
                        <span>No. Telepon</span>
                        <input type="text" name="phone" value="{{ old('phone', $currentAdmin?->phone) }}" />
                        @error('phone')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </label>
                </div>

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
            const preview = document.getElementById('admin-avatar-preview');

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
                        const headerPreview = document.getElementById('admin-account-avatar');
                        if (headerPreview) {
                            headerPreview.src = result;
                        }
                    }
                });
                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
