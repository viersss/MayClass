<!DOCTYPE html>
<html lang="id" data-mode="{{ $mode === 'register' ? 'register' : 'login' }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Masuk &amp; Registrasi</title>
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

            .divider {
                display: flex;
                align-items: center;
                gap: 16px;
                color: var(--text-muted);
                font-size: 0.85rem;
                margin: 8px 0;
            }

            .divider::before,
            .divider::after {
                content: "";
                flex: 1;
                height: 1px;
                background: rgba(107, 114, 128, 0.2);
            }

            .social-buttons {
                display: grid;
                gap: 12px;
            }

            .social-button {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 12px;
                border-radius: 12px;
                border: 1.5px solid rgba(66, 183, 173, 0.25);
                background: #fff;
                font-weight: 500;
                color: var(--text);
                font-size: 0.95rem;
                cursor: pointer;
                transition: border 0.2s ease, transform 0.15s ease;
            }

            .social-button:hover {
                border-color: var(--accent);
                transform: translateY(-1px);
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
                                <label for="register-email">Email</label>
                                <input
                                    id="register-email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Masukkan email"
                                    required
                                />
                                @error('email')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="two-column">
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
                        <div class="divider">atau</div>
                        <div class="social-buttons">
                            <button
                                class="social-button"
                                type="button"
                                data-google-login
                                data-google-url="{{ route('auth.google.redirect', ['popup' => 1, 'from' => 'register']) }}"
                                data-google-fallback-url="{{ route('auth.google.redirect', ['from' => 'register']) }}"
                                aria-label="Daftar menggunakan Google"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21.35 11.1H12.2V13.7H18.6C18.3 15.3 16.9 17.4 14.2 17.4C11.2 17.4 8.9 15 8.9 12C8.9 9 11.2 6.6 14.2 6.6C15.9 6.6 17.1 7.3 17.8 7.9L19.8 5.9C18.3 4.6 16.4 3.8 14.2 3.8C9.7 3.8 6 7.5 6 12C6 16.5 9.7 20.2 14.2 20.2C19 20.2 22 16.8 22 12.2C22 11.6 21.9 11.3 21.9 11L21.35 11.1Z"
                                        fill="#4285F4"
                                    />
                                </svg>
                                Google
                            </button>
                        </div>
                        <p class="switch-message">
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Masuk Sekarang</a>
                        </p>
                    </form>

                    <form data-mode="login" method="post" action="{{ route('login.perform') }}" novalidate>
                        @csrf
                        <div class="input-group">
                            <label for="login-email">Email</label>
                            <input
                                id="login-email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email"
                                required
                            />
                            @error('email')
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
                        <div class="divider">atau</div>
                        <div class="social-buttons">
                            <button
                                class="social-button"
                                type="button"
                                data-google-login
                                data-google-url="{{ route('auth.google.redirect', ['popup' => 1, 'from' => 'login']) }}"
                                data-google-fallback-url="{{ route('auth.google.redirect', ['from' => 'login']) }}"
                                aria-label="Masuk menggunakan Google"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21.35 11.1H12.2V13.7H18.6C18.3 15.3 16.9 17.4 14.2 17.4C11.2 17.4 8.9 15 8.9 12C8.9 9 11.2 6.6 14.2 6.6C15.9 6.6 17.1 7.3 17.8 7.9L19.8 5.9C18.3 4.6 16.4 3.8 14.2 3.8C9.7 3.8 6 7.5 6 12C6 16.5 9.7 20.2 14.2 20.2C19 20.2 22 16.8 22 12.2C22 11.6 21.9 11.3 21.9 11L21.35 11.1Z"
                                        fill="#4285F4"
                                    />
                                </svg>
                                Google
                            </button>
                        </div>
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

            const googleButtons = document.querySelectorAll('[data-google-login]');

            googleButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const popupUrl = button.dataset.googleUrl;
                    const fallbackUrl = button.dataset.googleFallbackUrl || popupUrl;

                    if (!popupUrl) {
                        return;
                    }

                    const width = 520;
                    const height = 640;
                    const left = window.screenX + (window.outerWidth - width) / 2;
                    const top = window.screenY + (window.outerHeight - height) / 2;
                    const features = [
                        `width=${Math.round(width)}`,
                        `height=${Math.round(height)}`,
                        `left=${Math.max(Math.round(left), 0)}`,
                        `top=${Math.max(Math.round(top), 0)}`,
                        'resizable=yes',
                        'scrollbars=yes',
                    ].join(',');

                    const popup = window.open(popupUrl, 'mayclass-google-signin', features);

                    if (!popup || popup.closed || typeof popup.closed === 'undefined') {
                        window.location.href = fallbackUrl || popupUrl;
                    } else {
                        popup.focus();
                    }
                });
            });

        </script>
    </body>
</html>
