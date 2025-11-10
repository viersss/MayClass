<!DOCTYPE html>
<html lang="id" data-mode="{{ $mode === 'register' ? 'register' : 'login' }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Masuk &amp; Registrasi</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                color-scheme: light;
                --bg: #b9e3e0;
                --panel: #f9ffff;
                --accent: #42b7ad;
                --accent-dark: #2f8f87;
                --text: #1f2a37;
                --text-muted: #6b7280;
                --outline: rgba(47, 143, 135, 0.25);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                color: var(--text);
                background: linear-gradient(135deg, #dff5f2 0%, #9ed6d1 100%);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .back-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin: 24px;
                font-size: 0.95rem;
                color: var(--accent-dark);
                font-weight: 500;
            }

            .auth-wrapper {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 24px;
            }

            .auth-card {
                background: var(--panel);
                border-radius: 32px;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                width: min(1080px, 100%);
                overflow: hidden;
                box-shadow: 0 35px 65px rgba(27, 71, 74, 0.18);
            }

            .auth-illustration {
                background: linear-gradient(160deg, rgba(255, 255, 255, 0.3) 0%, rgba(59, 166, 158, 0.65) 100%);
                padding: 48px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                gap: 32px;
            }

            .auth-illustration .image-frame {
                background: #f1faf9;
                border-radius: 24px;
                overflow: hidden;
                position: relative;
                box-shadow: 0 20px 45px rgba(45, 133, 126, 0.2);
            }

            .auth-illustration .image-frame::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(160deg, rgba(66, 183, 173, 0.2) 0%, rgba(66, 183, 173, 0.05) 100%);
            }

            .auth-illustration img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .auth-illustration h1 {
                font-size: clamp(1.9rem, 2.5vw, 2.6rem);
                margin: 0;
                line-height: 1.3;
            }

            .auth-illustration p {
                color: #f6fffe;
                font-weight: 400;
                margin: 0;
            }

            .auth-illustration strong {
                color: #003a36;
            }

            .auth-panel {
                padding: 48px;
                background: #fdfefe;
                display: flex;
                flex-direction: column;
                gap: 32px;
            }

            .auth-header {
                text-align: center;
            }

            .auth-header h2 {
                margin: 0;
                font-size: 1.6rem;
                font-weight: 600;
            }

            .tab-switcher {
                display: inline-flex;
                background: rgba(66, 183, 173, 0.1);
                border-radius: 999px;
                padding: 6px;
                gap: 8px;
                margin-top: 16px;
            }

            .tab-switcher button {
                border: none;
                background: transparent;
                padding: 10px 24px;
                border-radius: 999px;
                font-family: inherit;
                font-weight: 500;
                font-size: 0.95rem;
                cursor: pointer;
                color: var(--text-muted);
                transition: all 0.2s ease;
            }

            html[data-mode="login"] .tab-switcher button[data-mode="login"],
            html[data-mode="register"] .tab-switcher button[data-mode="register"] {
                background: #fff;
                color: var(--accent-dark);
                box-shadow: 0 12px 25px rgba(66, 183, 173, 0.25);
            }

            form {
                display: none;
                flex-direction: column;
                gap: 16px;
                text-align: left;
            }

            .error-alert {
                padding: 12px 16px;
                border-radius: 12px;
                background: rgba(220, 38, 38, 0.1);
                color: #991b1b;
                font-size: 0.85rem;
                line-height: 1.5;
            }

            .status-alert {
                padding: 12px 16px;
                border-radius: 12px;
                background: rgba(66, 183, 173, 0.12);
                color: var(--accent-dark);
                font-size: 0.9rem;
                line-height: 1.5;
                text-align: center;
            }

            .error-alert ul {
                margin: 0;
                padding-left: 20px;
            }

            .input-error {
                color: #dc2626;
                font-size: 0.75rem;
                margin: -6px 0 0;
            }

            html[data-mode="login"] form[data-mode="login"],
            html[data-mode="register"] form[data-mode="register"] {
                display: flex;
            }

            label {
                font-weight: 500;
                font-size: 0.92rem;
                color: var(--text);
            }

            input,
            select {
                width: 100%;
                padding: 14px 16px;
                border-radius: 14px;
                border: 1.5px solid var(--outline);
                font-family: inherit;
                font-size: 0.95rem;
                transition: border 0.2s ease, box-shadow 0.2s ease;
                background: #fff;
            }

            input:focus,
            select:focus {
                outline: none;
                border-color: var(--accent);
                box-shadow: 0 0 0 3px rgba(66, 183, 173, 0.22);
            }

            .two-column {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }

            .primary-action {
                margin-top: 8px;
                padding: 14px 16px;
                border-radius: 14px;
                border: none;
                background: linear-gradient(120deg, var(--accent) 0%, #5ed3c5 100%);
                color: #fff;
                font-weight: 600;
                font-size: 1rem;
                cursor: pointer;
                box-shadow: 0 16px 30px rgba(66, 183, 173, 0.35);
                transition: transform 0.15s ease, box-shadow 0.15s ease;
            }

            .primary-action:hover {
                transform: translateY(-1px);
                box-shadow: 0 18px 35px rgba(66, 183, 173, 0.42);
            }

            .switch-message {
                text-align: center;
                color: var(--text-muted);
                font-size: 0.9rem;
            }

            .switch-message a {
                color: var(--accent-dark);
                font-weight: 500;
            }

            .input-group {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            @media (max-width: 960px) {
                .auth-card {
                    grid-template-columns: 1fr;
                    max-width: 640px;
                }

                .auth-illustration {
                    display: none;
                }

                .auth-panel {
                    padding: 32px 24px 40px;
                }

                .back-link {
                    margin: 16px 20px;
                }
            }

            @media (max-width: 520px) {
                .two-column {
                    grid-template-columns: 1fr;
                }

                .tab-switcher {
                    width: 100%;
                    justify-content: space-between;
                }

                .tab-switcher button {
                    flex: 1;
                }
            }
        </style>
    </head>
    <body>
        <a class="back-link" href="{{ url('/') }}">
            <span aria-hidden="true">&lt;</span>
            Kembali
        </a>
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-illustration">
                    <div class="image-frame" aria-hidden="true">
                        <img src="{{ \App\Support\ImageRepository::url('auth') }}" alt="Ilustrasi siswa MayClass" />
                    </div>
                    <div>
                        <h1>
                            Langkah Pasti Menuju Prestasi
                            <strong>bersama MayClass</strong>
                        </h1>
                        <p>
                            Kami menjembatani siswa, tentor, dan orang tua melalui pengalaman belajar yang
                            personal, interaktif, dan terukur.
                        </p>
                    </div>
                </div>
                <div class="auth-panel">
                    <div class="auth-header">
                        <h2>Selamat datang di MayClass</h2>
                        <div class="tab-switcher" role="tablist">
                            <button type="button" data-mode="login" role="tab" aria-selected="false">
                                Masuk
                            </button>
                            <button type="button" data-mode="register" role="tab" aria-selected="false">
                                Registrasi
                            </button>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="status-alert" role="status">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="error-alert" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form data-mode="register" method="post" action="{{ route('register.perform') }}" novalidate>
                        @csrf
                        <div class="two-column">
                            <div class="input-group">
                                <label for="register-name">Nama Lengkap</label>
                                <input
                                    id="register-name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                />
                                @error('name')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="register-username">Username</label>
                                <input
                                    id="register-username"
                                    type="text"
                                    name="username"
                                    value="{{ old('username') }}"
                                    placeholder="Pilih username unik"
                                    required
                                />
                                @error('username')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="two-column">
                            <div class="input-group">
                                <label for="register-email">Email</label>
                                <input
                                    id="register-email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Masukkan email aktif"
                                    required
                                />
                                @error('email')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="register-phone">No. Tlp / WA</label>
                                <input
                                    id="register-phone"
                                    type="tel"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="Masukkan nomor telepon"
                                />
                                @error('phone')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="register-gender">Jenis Kelamin</label>
                            <select id="register-gender" name="gender">
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                <option value="female" @selected(old('gender') === 'female')>Perempuan</option>
                                <option value="male" @selected(old('gender') === 'male')>Laki-laki</option>
                                <option value="other" @selected(old('gender') === 'other')>Lainnya</option>
                            </select>
                            @error('gender')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="register-password">Password</label>
                            <input
                                id="register-password"
                                type="password"
                                name="password"
                                autocomplete="new-password"
                                placeholder="Masukkan kata sandi"
                                required
                            />
                            @error('password')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="primary-action" type="submit">Daftar</button>
                        <p class="switch-message">
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Masuk Sekarang</a>
                        </p>
                    </form>

                    <form data-mode="login" method="post" action="{{ route('login.perform') }}" novalidate>
                        @csrf
                        <div class="input-group">
                            <label for="login-username">Username</label>
                            <input
                                id="login-username"
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                required
                            />
                            @error('username')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="login-password">Password</label>
                            <input
                                id="login-password"
                                type="password"
                                name="password"
                                placeholder="Masukkan kata sandi"
                                autocomplete="current-password"
                                required
                            />
                            @error('password')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="primary-action" type="submit">Masuk</button>
                        <p class="switch-message">
                            Belum punya akun?
                            <a href="{{ route('register') }}">Daftar Sekarang</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const doc = document.documentElement;
            const switchButtons = document.querySelectorAll('.tab-switcher button');

            function setMode(mode) {
                doc.setAttribute('data-mode', mode);
                switchButtons.forEach((button) => {
                    const isActive = button.dataset.mode === mode;
                    button.setAttribute('aria-selected', isActive ? 'true' : 'false');
                });
            }

            switchButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const mode = button.dataset.mode;
                    setMode(mode);
                    history.replaceState(null, '', mode === 'register' ? '{{ route('register') }}' : '{{ route('login') }}');
                });
            });

            setMode(doc.getAttribute('data-mode'));
        </script>
    </body>
</html>
