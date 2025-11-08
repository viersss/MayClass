@extends('tutor.layout')

@section('title', 'Pengaturan Akun - MayClass')

@push('styles')
    <style>
        .account-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 28px;
            align-items: flex-start;
        }

        .profile-pane {
            background: #fff;
            border-radius: 24px;
            padding: 32px;
            text-align: center;
            box-shadow: 0 22px 55px rgba(15, 23, 42, 0.08);
        }

        .profile-pane img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 16px;
            border: 3px solid rgba(61, 183, 173, 0.35);
        }

        .profile-pane h2 {
            margin: 0;
            font-size: 1.4rem;
        }

        .profile-pane p {
            margin: 8px 0 0;
            color: #6b7280;
        }

        .form-card {
            background: #fff;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 22px 55px rgba(15, 23, 42, 0.08);
        }

        .form-card h1 {
            margin-top: 0;
        }

        .form-grid {
            display: grid;
            gap: 18px;
            margin-top: 24px;
        }

        label span {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #d9e0ea;
            border-radius: 16px;
            font-family: inherit;
            font-size: 1rem;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 24px;
        }

        .form-actions button {
            padding: 14px 24px;
            border-radius: 16px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: none;
            background: var(--primary);
            color: #fff;
        }

        .error-text {
            color: #dc2626;
            font-size: 0.9rem;
            margin-top: 6px;
        }

        @media (max-width: 980px) {
            .account-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="account-grid">
        <div class="profile-pane">
            <img
                src="{{ $tutorProfile?->avatar_path ? asset('storage/' . $tutorProfile->avatar_path) : config('mayclass.images.tutor.banner.fallback') }}"
                alt="Foto Tutor"
            />
            <h2>{{ $tutor?->name ?? 'Tutor MayClass' }}</h2>
            <p>{{ $tutorProfile?->specializations ?? 'Pengajar MayClass' }}</p>
            <p style="margin-top: 12px; font-weight: 600;">Pengalaman: {{ $tutorProfile?->experience_years ?? 0 }} tahun</p>
            @if ($tutorProfile?->education)
                <p style="margin-top: 4px; color: #374151;">Pendidikan: {{ $tutorProfile->education }}</p>
            @endif
        </div>

        <div class="form-card">
            <h1>Informasi Pribadi</h1>
            <p>Perbarui data akun dan profil profesional Anda.</p>

            <form method="POST" action="{{ route('tutor.account.update') }}" class="form-grid">
                @csrf
                @method('PUT')
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
                    @error('phone')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </label>

                <label>
                    <span>Mata Pelajaran</span>
                    <input type="text" name="specializations" value="{{ old('specializations', $tutorProfile?->specializations) }}" required />
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
