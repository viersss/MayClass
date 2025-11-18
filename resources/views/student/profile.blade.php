<!DOCTYPE html>
<html lang="id" data-page="profile">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Edit Profil - MayClass</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                --primary: #3db7ad;
                --primary-dark: #2c938b;
                --accent: #5f6af8;
                --text-dark: #1f2a37;
                --text-muted: #6b7280;
                --card: #ffffff;
                --page-padding: clamp(16px, 3vw, 40px);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: linear-gradient(180deg, #eff9f8 0%, #ffffff 40%);
                color: var(--text-dark);
                min-height: 100vh;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            header {
                padding: 28px 0 0;
            }


.container {
    width: 100%;
    margin: 0;
    padding: 0;
}

            nav {
                background: var(--card);
                border-radius: 20px;
                padding: 18px var(--page-padding);
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: 0 24px 60px rgba(45, 133, 126, 0.12);
                gap: 24px;
            }


.brand {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
    font-size: 1.1rem;
    color: var(--primary-dark);
}

.brand img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

            .nav-links {
                display: flex;
                gap: 28px;
                align-items: center;
                font-size: 0.95rem;
                color: var(--text-muted);
            }

            .nav-links a[data-active="true"] {
                color: var(--primary-dark);
                font-weight: 600;
            }

            .nav-links a[data-active="true"]::after {
                content: "";
                display: block;
                height: 4px;
                border-radius: 999px;
                margin-top: 8px;
                background: linear-gradient(120deg, var(--primary), var(--accent));
            }

            .nav-actions {
                display: inline-flex;
                align-items: center;
                gap: 16px;
            }

            .nav-actions form {
                margin: 0;
            }

            .profile-chip {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                padding: 10px 16px;
                border-radius: 999px;
                background: rgba(61, 183, 173, 0.12);
                font-size: 0.9rem;
                color: var(--primary-dark);
            }

            .logout-button {
                padding: 10px 18px;
                border-radius: 999px;
                border: 1px solid rgba(61, 183, 173, 0.25);
                background: rgba(61, 183, 173, 0.12);
                color: var(--primary-dark);
                font-weight: 600;
            }

            .logout-button:hover {
                background: rgba(44, 147, 139, 0.2);
                border-color: rgba(44, 147, 139, 0.3);
            }

            main {
                padding: 48px var(--page-padding) 80px;
                display: grid;
                gap: 32px;
            }

            .profile-card {
                background: var(--card);
                border-radius: 32px;
                padding: clamp(32px, 5vw, 56px);
                box-shadow: 0 32px 68px rgba(32, 96, 92, 0.12);
                display: grid;
                gap: 24px;
            }

            .profile-card h1 {
                margin: 0;
                font-size: clamp(2rem, 3vw, 2.4rem);
                text-align: center;
            }

            .avatar-upload {
                display: grid;
                gap: 12px;
                justify-items: center;
            }

            .avatar-preview {
                width: 112px;
                height: 112px;
                border-radius: 50%;
                background: rgba(61, 183, 173, 0.12);
                display: grid;
                place-items: center;
                overflow: hidden;
                box-shadow: 0 18px 36px rgba(61, 183, 173, 0.18);
                color: var(--primary-dark);
                font-size: 2.4rem;
            }

            .avatar-preview img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .avatar-upload__button {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 18px;
                border-radius: 999px;
                border: 1px solid rgba(61, 183, 173, 0.3);
                background: rgba(61, 183, 173, 0.1);
                color: var(--primary-dark);
                font-weight: 500;
                cursor: pointer;
                transition: background 0.2s ease, transform 0.2s ease;
            }

            .avatar-upload__button:hover {
                background: rgba(61, 183, 173, 0.18);
                transform: translateY(-1px);
            }

            .avatar-upload__hint {
                margin: 0;
                font-size: 0.85rem;
                color: var(--text-muted);
                text-align: center;
            }

            .avatar-upload__filename {
                margin: 4px 0 0;
                font-size: 0.85rem;
                color: var(--primary-dark);
            }

            .avatar-input {
                display: none;
            }

            .avatar-upload__error {
                margin: 4px 0 0;
                font-size: 0.82rem;
                color: #b91c1c;
                text-align: center;
            }

            form {
                display: grid;
                gap: 24px;
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 24px;
            }

            label {
                display: block;
                font-weight: 500;
                margin-bottom: 6px;
            }

            input,
            select,
            textarea {
                width: 100%;
                border-radius: 16px;
                border: 1px solid rgba(61, 183, 173, 0.25);
                padding: 14px 18px;
                font-family: inherit;
                font-size: 0.95rem;
                color: var(--text-dark);
                background: rgba(61, 183, 173, 0.06);
            }

            textarea {
                resize: vertical;
                min-height: 120px;
            }

            .btn-group {
                display: flex;
                gap: 16px;
                justify-content: flex-end;
                flex-wrap: wrap;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 14px 28px;
                border-radius: 999px;
                font-weight: 500;
                border: 1px solid transparent;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                cursor: pointer;
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--primary) 0%, #58d2c5 100%);
                color: #ffffff;
                box-shadow: 0 20px 40px rgba(61, 183, 173, 0.28);
            }

            .btn-outline {
                background: rgba(61, 183, 173, 0.08);
                border-color: rgba(61, 183, 173, 0.22);
                color: var(--primary-dark);
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            footer {
                padding: 32px var(--page-padding) 48px;
                text-align: center;
                color: var(--text-muted);
                font-size: 0.85rem;
            }

            @media (max-width: 768px) {
                .grid {
                    grid-template-columns: 1fr;
                }

                .btn-group {
                    justify-content: center;
                }
            }
        </style>
    </head>
    <body>
        @php($hasActivePackage = $hasActivePackage ?? false)
        <header>
            <div class="container">
                <nav>
                    <a href="{{ route('student.dashboard') }}" class="brand">
                        <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="Logo MayClass" />
                    </a>
                    @php($routeName = request()->route()?->getName())
                    <div class="nav-links">
                        <a href="{{ route('student.dashboard') }}" data-active="{{ $routeName === 'student.dashboard' ? 'true' : 'false' }}">Beranda</a>
                        @if ($hasActivePackage)
                            <a href="{{ route('student.materials') }}" data-active="{{ str_starts_with($routeName, 'student.materials') ? 'true' : 'false' }}">Materi</a>
                            <a href="{{ route('student.quiz') }}" data-active="{{ str_starts_with($routeName, 'student.quiz') ? 'true' : 'false' }}">Quiz</a>
                            <a href="{{ route('student.schedule') }}" data-active="{{ $routeName === 'student.schedule' ? 'true' : 'false' }}">Jadwal</a>
                        @endif
                    </div>
                    <div class="nav-actions">
                        <a class="profile-chip" href="{{ route('student.profile') }}" data-active="true">
                            <span>Siswa</span>
                        </a>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-button">Keluar</button>
                        </form>
                    </div>
                </nav>
            </div>
        </header>
        <main class="container">
            <section class="profile-card">
                <h1>Edit Profil</h1>
                @php($avatarUrl = $avatarUrl ?? null)
                <div class="avatar-upload">
                    <div class="avatar-preview" data-avatar-preview>
                        <img
                            src="{{ $avatarUrl ?? '' }}"
                            alt="Foto profil {{ $profile['name'] }}"
                            data-avatar-image
                            data-original="{{ $avatarUrl ?? '' }}"
                            @if (! $avatarUrl) style="display: none;" @endif
                        />
                        <span data-avatar-placeholder @if($avatarUrl) style="display: none;" @endif>🧑</span>
                    </div>
                    <label class="avatar-upload__button" for="avatar">Pilih foto</label>
                    <p class="avatar-upload__hint">Format JPG/PNG, maksimal 5 MB</p>
                    <p class="avatar-upload__filename" data-avatar-filename></p>
                    @error('avatar')
                        <p class="avatar-upload__error">{{ $message }}</p>
                    @enderror
                </div>
                @if ($errors->any())
                    <div
                        style="padding: 14px 18px; border-radius: 16px; background: rgba(220, 38, 38, 0.12); color: #b91c1c; text-align: center;"
                    >
                        {{ $errors->first() }}
                    </div>
                @endif
                @if (session('status'))
                    <div
                        style="padding: 14px 18px; border-radius: 16px; background: rgba(61, 183, 173, 0.12); color: var(--primary-dark); text-align: center;"
                    >
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('student.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input id="avatar" name="avatar" type="file" accept="image/*" class="avatar-input" />
                    <div class="grid">
                        <div>
                            <label for="name">Nama Lengkap</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $profile['name']) }}"
                                required
                            />
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $profile['email']) }}"
                                required
                            />
                        </div>
                    </div>
                    <div class="grid">
                        <div>
                            <label for="student-id">No. Tlp/WA</label>
                            <input
                                id="student-id"
                                name="phone"
                                type="text"
                                value="{{ old('phone', $profile['phone']) }}"
                            />
                        </div>
                        <div>
                            <label for="gender">Jenis Kelamin</label>
                            <select id="gender" name="gender">
                                <option value="">Pilih jenis kelamin</option>
                                @foreach ($genderOptions as $value => $label)
                                    <option value="{{ $value }}" @selected(old('gender', $profile['gender']) === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid">
                        <div>
                            <label for="parent">Nama Orang Tua</label>
                            <input
                                id="parent"
                                name="parent_name"
                                type="text"
                                value="{{ old('parent_name', $profile['parentName']) }}"
                            />
                        </div>
                        <div>
                            <label for="student-code">ID Siswa</label>
                            <input
                                id="student-code"
                                type="text"
                                value="{{ $profile['studentId'] }}"
                                readonly
                                style="background: rgba(61, 183, 173, 0.06);"
                            />
                        </div>
                    </div>
                    <div>
                        <label for="address">Alamat</label>
                        <textarea id="address" name="address">{{ old('address', $profile['address']) }}</textarea>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-outline" type="reset">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </section>
        </main>
        <footer>© {{ now()->year }} MayClass. Data pribadi dijaga sesuai kebijakan privasi.</footer>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('avatar');
                const imagePreview = document.querySelector('[data-avatar-image]');
                const placeholder = document.querySelector('[data-avatar-placeholder]');
                const filename = document.querySelector('[data-avatar-filename]');

                if (!input || (!imagePreview && !placeholder)) {
                    return;
                }

                input.addEventListener('change', function () {
                    const file = input.files && input.files[0];

                    if (!file) {
                        if (imagePreview) {
                            const original = imagePreview.getAttribute('data-original');
                            const hasOriginal = Boolean(original);
                            imagePreview.style.display = hasOriginal ? 'block' : 'none';

                            if (hasOriginal) {
                                imagePreview.src = original;
                            } else {
                                imagePreview.removeAttribute('src');
                            }
                        }

                        if (placeholder) {
                            const shouldShowPlaceholder = !imagePreview || imagePreview.style.display === 'none';
                            placeholder.style.display = shouldShowPlaceholder ? 'grid' : 'none';
                        }

                        if (filename) {
                            filename.textContent = '';
                        }

                        return;
                    }

                    if (imagePreview) {
                        imagePreview.style.display = 'block';
                        imagePreview.src = URL.createObjectURL(file);
                    }

                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }

                    if (filename) {
                        filename.textContent = file.name;
                    }
                });
            });
        </script>
    </body>
</html>
