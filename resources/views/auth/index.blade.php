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
                --nav-height: 64px;
                --primary-dark: #1b6d4f;
                --primary-main: #3fa67e;
                --primary-light: #84d986;
                --primary-accent: #a8e6a1;
                --neutral-900: #1f2328;
                --neutral-700: #4d5660;
                --neutral-100: #f6f7f8;
                --surface: #ffffff;
                --ink-strong: #14352c;
                --ink-muted: rgba(20, 59, 46, 0.78);
                --ink-soft: rgba(20, 59, 46, 0.62);
                --shadow-lg: 0 24px 60px rgba(31, 107, 79, 0.2);
                --shadow-md: 0 18px 40px rgba(31, 107, 79, 0.12);
                --radius-lg: 20px;
                --radius-xl: 28px;

                /* alias untuk styling halaman auth */
                --panel: var(--surface);
                --panel-muted: var(--neutral-100);
                --accent: var(--primary-main);
                --accent-dark: var(--primary-dark);
                --text: var(--ink-strong);
                --text-muted: var(--ink-muted);
                --outline: rgba(31, 107, 79, 0.25);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                color: var(--text);
                background: #ffffff;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .back-link {
                position: fixed;
                top: 20px;
                left: 32px;
                z-index: 20;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-size: 0.95rem;
                color: #ffffff;
                font-weight: 500;
                letter-spacing: 0.01em;
                padding: 8px 14px;
                border-radius: 999px;
                background: rgba(15, 23, 42, 0.35);
                backdrop-filter: blur(8px);
            }

            .auth-wrapper {
                flex: 1;
                display: flex;
                align-items: stretch;
                justify-content: center;
                min-height: 100vh;
            }

            .auth-card {
                width: 100%;
                display: grid;
                grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
                min-height: 100vh;
            }

            .auth-illustration {
                position: relative;
                background:
                    linear-gradient(130deg, rgba(7, 16, 37, 0.60), rgba(11, 31, 51, 0.45)),
                    url("https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=1600&q=80")
                        center/cover no-repeat;
                padding: clamp(32px, 5vw, 56px);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                gap: 32px;
                color: #f4f8ff;
            }

            .auth-hero-body {
                margin-top: clamp(24px, 3vw, 40px);
                max-width: 520px;
                display: flex;
                flex-direction: column;
                gap: 14px;
            }

            .hero-eyebrow {
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 0.18em;
                color: rgba(255, 255, 255, 0.8);
            }

            .auth-illustration h1 {
                font-size: clamp(2.2rem, 3.2vw, 2.8rem);
                font-weight: 600;
                margin: 0;
                line-height: 1.2;
            }

            .auth-illustration p {
                color: rgba(255, 255, 255, 0.9);
                font-weight: 400;
                margin: 0;
                line-height: 1.7;
                font-size: 1rem;
            }

            [data-copy-mode] {
                display: none;
            }

            html[data-mode="register"] [data-copy-mode="register"],
            html[data-mode="login"] [data-copy-mode="login"] {
                display: block;
            }

            .auth-panel {
                background: var(--panel);
                border-left: 1px solid #e5e7eb;
                padding: clamp(32px, 4vw, 48px);
                display: flex;
                flex-direction: column;
                gap: 24px;
            }

            .panel-header {
                display: flex;
                flex-direction: column;
                gap: 10px;
                padding-top: 8px;
            }

            .panel-header h2 {
                margin: 0;
                font-size: clamp(1.9rem, 2.4vw, 2.3rem);
                font-weight: 600;
            }

            .panel-desc {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.95rem;
                line-height: 1.6;
                max-width: 520px;
            }

            .tab-switcher {
                display: inline-flex;
                background: var(--panel-muted);
                border-radius: 999px;
                padding: 4px;
                gap: 4px;
                margin-top: 8px;
                align-self: flex-start;
                border: 1px solid rgba(20, 59, 46, 0.08);
            }

            .tab-switcher button {
                border: none;
                background: transparent;
                padding: 10px 22px;
                border-radius: 999px;
                font-family: inherit;
                font-weight: 500;
                font-size: 0.92rem;
                cursor: pointer;
                color: var(--text-muted);
                transition: background 0.18s ease, color 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
            }

            html[data-mode="login"] .tab-switcher button[data-mode="login"],
            html[data-mode="register"] .tab-switcher button[data-mode="register"] {
                background: #ffffff;
                color: var(--accent-dark);
                box-shadow: 0 10px 22px rgba(20, 59, 46, 0.18);
            }

            form {
                display: none;
                flex-direction: column;
                gap: 16px;
                text-align: left;
                margin-top: 8px;
            }

            html[data-mode="login"] form[data-mode="login"],
            html[data-mode="register"] form[data-mode="register"] {
                display: flex;
            }

            .error-alert {
                padding: 14px 18px;
                border-radius: 14px;
                background: rgba(220, 38, 38, 0.06);
                color: #991b1b;
                font-size: 0.85rem;
                line-height: 1.5;
                border: 1px solid rgba(220, 38, 38, 0.2);
            }

            .status-alert {
                padding: 14px 18px;
                border-radius: 14px;
                background: rgba(63, 166, 126, 0.08);
                color: var(--accent-dark);
                font-size: 0.9rem;
                line-height: 1.5;
                border: 1px solid rgba(63, 166, 126, 0.2);
            }

            .error-alert ul {
                margin: 0;
                padding-left: 20px;
            }

            .input-error {
                color: #dc2626;
                font-size: 0.75rem;
                margin: -4px 0 0;
            }

            .captcha-card {
                margin-top: 16px;
                border-radius: 20px;
                border: 1.5px dashed rgba(63, 166, 126, 0.4);
                padding: 20px 22px;
                background: rgba(63, 166, 126, 0.06);
                display: grid;
                gap: 10px;
            }

            .captcha-card strong {
                font-size: 1rem;
                color: var(--ink-strong);
            }

            .captcha-card p {
                margin: 0;
                color: var(--ink-soft);
                font-size: 0.9rem;
            }

            .captcha-question {
                font-size: 1.2rem;
                font-weight: 600;
                color: var(--primary-dark);
                letter-spacing: 0.06em;
            }

            label {
                font-weight: 500;
                font-size: 0.9rem;
                color: var(--text);
            }

            input,
            select {
                width: 100%;
                padding: 12px 14px;
                border-radius: 12px;
                border: 1px solid var(--outline);
                font-family: inherit;
                font-size: 0.95rem;
                transition: border 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
                background: #fff;
            }

            input:focus,
            select:focus {
                outline: none;
                border-color: var(--accent);
                box-shadow: 0 0 0 3px rgba(63, 166, 126, 0.2);
                transform: translateY(-1px);
            }

            .two-column {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }

            .input-group {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .primary-action {
                margin-top: 8px;
                padding: 14px 18px;
                border-radius: 999px;
                border: none;
                background: var(--accent);
                color: #fff;
                font-weight: 600;
                font-size: 0.98rem;
                cursor: pointer;
                box-shadow: 0 18px 32px rgba(31, 107, 79, 0.3);
                transition: transform 0.18s ease, box-shadow 0.18s ease;
                align-self: flex-start;
                min-width: 150px;
            }

            .primary-action:hover {
                transform: translateY(-2px);
                box-shadow: 0 24px 48px rgba(31, 107, 79, 0.35);
            }

            .switch-message {
                text-align: left;
                color: var(--text-muted);
                font-size: 0.88rem;
                margin-top: 10px;
            }

            .switch-message a {
                color: var(--accent-dark);
                font-weight: 600;
            }

            .help-link {
                font-size: 0.88rem;
                color: var(--text-muted);
                margin-top: 12px;
            }

            .help-link a {
                color: var(--accent-dark);
                font-weight: 600;
            }

            .form-support {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-top: 4px;
            }

            .form-helper {
                margin: 0;
                font-size: 0.8rem;
                color: var(--text-muted);
            }

            .terms-link {
                border: none;
                background: rgba(63, 166, 126, 0.08);
                color: var(--accent-dark);
                font-weight: 600;
                font-size: 0.8rem;
                padding: 8px 16px;
                border-radius: 999px;
                cursor: pointer;
                transition: background 0.18s ease, transform 0.18s ease;
                white-space: nowrap;
            }

            .terms-link:hover {
                background: rgba(63, 166, 126, 0.18);
                transform: translateY(-1px);
            }

            .terms-modal {
                position: fixed;
                inset: 0;
                display: grid;
                place-items: center;
                background: rgba(17, 24, 39, 0.45);
                padding: 24px;
                z-index: 1000;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.2s ease;
            }

            .terms-modal[data-visible="true"] {
                opacity: 1;
                pointer-events: auto;
            }

            .terms-dialog {
                background: #fdfefe;
                border-radius: 24px;
                max-width: min(720px, 100%);
                max-height: min(90vh, 860px);
                overflow: hidden;
                display: flex;
                flex-direction: column;
                box-shadow: 0 30px 70px rgba(15, 52, 56, 0.4);
            }

            .terms-dialog header {
                padding: 22px 28px 14px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                background: linear-gradient(
                    135deg,
                    rgba(168, 230, 161, 0.2) 0%,
                    rgba(132, 217, 134, 0.05) 100%
                );
            }

            .terms-dialog header h3 {
                margin: 0;
                font-size: 1.2rem;
                color: var(--accent-dark);
            }

            .terms-close {
                border: none;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 50%;
                width: 34px;
                height: 34px;
                display: grid;
                place-items: center;
                font-size: 1.05rem;
                cursor: pointer;
                color: var(--accent-dark);
                box-shadow: 0 10px 24px rgba(66, 183, 173, 0.25);
                transition: transform 0.18s ease;
            }

            .terms-close:hover {
                transform: translateY(-1px);
            }

            .terms-body {
                padding: 20px 28px 24px;
                overflow-y: auto;
                color: var(--text);
            }

            .terms-consent {
                margin: 8px 0 4px;
                padding: 12px 16px;
                border-radius: 14px;
                border: 1px solid rgba(31, 107, 79, 0.2);
                background: rgba(31, 107, 79, 0.05);
                display: flex;
                gap: 12px;
                align-items: flex-start;
            }

            .terms-consent input[type="checkbox"] {
                width: 20px;
                height: 20px;
                margin-top: 2px;
                accent-color: var(--accent);
            }

            .terms-consent label {
                display: flex;
                flex-direction: column;
                gap: 4px;
                font-size: 0.95rem;
                color: var(--text-muted);
            }

            .terms-consent label strong {
                color: var(--text-primary);
            }

            .terms-consent small {
                font-size: 0.85rem;
                color: var(--text-muted);
            }

            .terms-consent.is-approved {
                border-color: var(--accent);
                background: rgba(31, 107, 79, 0.1);
            }

            .terms-body h4 {
                margin-top: 0;
                margin-bottom: 8px;
                font-size: 1.02rem;
                color: var(--accent-dark);
            }

            .terms-body p {
                margin: 0 0 14px;
                line-height: 1.6;
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            .terms-body ul {
                margin: 0 0 14px 20px;
                color: var(--text-muted);
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .terms-body strong {
                color: var(--accent-dark);
            }

            .terms-actions {
                padding: 12px 28px 20px;
                display: flex;
                justify-content: flex-end;
                background: linear-gradient(
                    180deg,
                    rgba(168, 230, 161, 0.12) 0%,
                    rgba(168, 230, 161, 0) 100%
                );
            }

            .terms-actions button {
                border: none;
                background: var(--accent);
                color: #fff;
                font-weight: 600;
                font-size: 0.88rem;
                padding: 9px 18px;
                border-radius: 12px;
                cursor: pointer;
                box-shadow: 0 12px 24px rgba(31, 107, 79, 0.35);
                transition: transform 0.18s ease;
            }

            .terms-actions button:hover {
                transform: translateY(-1px);
            }

            .register-popup-backdrop {
                position: fixed;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(15, 23, 42, 0.55);
                z-index: 1200;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.25s ease;
            }

            .register-popup-backdrop.is-visible {
                opacity: 1;
                pointer-events: auto;
            }

            .register-popup {
                background: var(--panel);
                padding: 20px 24px;
                border-radius: 20px;
                box-shadow: 0 24px 55px rgba(15, 52, 56, 0.35);
                max-width: 340px;
                width: calc(100% - 48px);
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .register-popup-title {
                margin: 0 0 6px;
                font-size: 1rem;
                font-weight: 600;
                color: var(--accent-dark);
            }

            .register-popup-text {
                margin: 0;
                font-size: 0.9rem;
                color: var(--text-muted);
                line-height: 1.4;
            }

            .register-popup-actions {
                margin-top: 8px;
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .register-popup-actions a,
            .register-popup-actions button {
                border-radius: 999px;
                border: none;
                font-weight: 600;
                font-size: 0.95rem;
                padding: 11px 18px;
                font-family: inherit;
                cursor: pointer;
                transition: transform 0.15s ease, box-shadow 0.15s ease;
            }

            .register-popup-actions a {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: var(--accent);
                color: #fff;
                box-shadow: 0 10px 22px rgba(31, 107, 79, 0.35);
                text-decoration: none;
            }

            .register-popup-actions a:hover {
                transform: translateY(-1px);
                box-shadow: 0 12px 28px rgba(31, 107, 79, 0.4);
            }

            .register-popup-actions button {
                background: transparent;
                color: var(--text-muted);
            }

            .register-popup-actions button:hover {
                color: var(--accent-dark);
            }

            @media (max-width: 960px) {
                .auth-card {
                    grid-template-columns: 1fr;
                }

                .auth-illustration {
                    min-height: 260px;
                }

                .auth-panel {
                    border-left: none;
                }

                .back-link {
                    left: 16px;
                }
            }

            @media (max-width: 640px) {
                .auth-panel {
                    padding: 24px 20px 32px;
                }

                .two-column {
                    grid-template-columns: 1fr;
                }

                .form-support {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .tab-switcher {
                    width: 100%;
                    justify-content: space-between;
                }

                .tab-switcher button {
                    flex: 1;
                    text-align: center;
                }
            }
        </style>
    </head>
    <body>
@php($profileData = $profile ?? [])
@if (session('register_success'))
    <div class="register-popup-backdrop is-visible" id="register-popup" role="dialog" aria-modal="true">
        <div class="register-popup">
            <p class="register-popup-title">Registrasi berhasil!</p>
            <p class="register-popup-text">
                {{ session('status') ?? 'Akun berhasil dibuat. Silakan login untuk mulai belajar.' }}
            </p>
        </div>
    </div>

    <script>
        // Auto-close after 1 second
        setTimeout(() => {
            const popup = document.getElementById('register-popup');
            if (popup) {
                popup.classList.remove('is-visible');

                // optionally remove from DOM:
                setTimeout(() => popup.remove(), 300);
            }
        }, 1000);
    </script>
@endif


        <a class="back-link" href="{{ url('/') }}">
            <span aria-hidden="true">&lt;</span>
            Kembali
        </a>

        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-illustration" aria-hidden="true">
                    <div></div>
                    <div class="auth-hero-body">
                        <p class="hero-eyebrow">Mulai perjalanan belajarmu</p>
                        <h1>Langkah Pasti Menuju Prestasi</h1>
                        <p>
                            Rencanakan jadwal, akses materi premium, dan belajar terarah bersama tentor pilihan di satu
                            dashboard yang rapi.
                        </p>
                    </div>
                </div>

                <div class="auth-panel">
                    <div class="panel-header">
                        <h2 data-copy-mode="register">Buat akun MayClass</h2>
                        <h2 data-copy-mode="login">Masuk ke akun MayClass</h2>
                        <p class="panel-desc" data-copy-mode="register">
                            Lengkapi identitas kamu untuk mengaktifkan akses modul belajar premium dan jadwal tentor
                            pilihan.
                        </p>
                        <p class="panel-desc" data-copy-mode="login">
                            Masukkan username dan password untuk melanjutkan progres belajar tanpa hambatan.
                        </p>
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

                    <form data-mode="register" method="post" action="{{ route('register.details') }}" novalidate>
                        @csrf
                        <div class="two-column">
                            <div class="input-group">
                                <label for="register-name">Nama Lengkap</label>
                                <input
                                    id="register-name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $profileData['name'] ?? '') }}"
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
                                    value="{{ old('username', $profileData['username'] ?? '') }}"
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
                                    value="{{ old('email', $profileData['email'] ?? '') }}"
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
                                    value="{{ old('phone', $profileData['phone'] ?? '') }}"
                                    placeholder="Masukkan nomor telepon"
                                />
                                @error('phone')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="register-gender">Jenis Kelamin</label>
                            @php($selectedGender = old('gender', $profileData['gender'] ?? ''))
                            <select id="register-gender" name="gender">
                                <option value="" disabled {{ $selectedGender ? '' : 'selected' }}>
                                    Pilih Jenis Kelamin
                                </option>
                                <option value="female" @selected($selectedGender === 'female')>Perempuan</option>
                                <option value="male" @selected($selectedGender === 'male')>Laki-laki</option>
                            </select>
                            @error('gender')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-support">
                            <p class="form-helper">
                                Dengan melanjutkan, Anda menyetujui kebijakan layanan MayClass.
                            </p>
                            <button class="terms-link" type="button" data-terms-open>
                                Ketentuan &amp; Privasi
                            </button>
                        </div>

                        <button class="primary-action" type="submit">Selanjutnya</button>

                        <p class="switch-message">
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Masuk</a>
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

                        <p class="help-link">
                            Lupa password?
                            <a href="{{ route('password.request') }}">Hubungi admin</a>
                        </p>

                        <p class="switch-message">
                            Baru di MayClass?
                            <a href="{{ route('register') }}">Daftar</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <div class="terms-modal" data-terms-dialog aria-hidden="true">
            <div class="terms-dialog" role="dialog" aria-modal="true" aria-labelledby="terms-title">
                <header>
                    <h3 id="terms-title">Syarat Layanan &amp; Kebijakan Privasi MayClass</h3>
                    <button class="terms-close" type="button" aria-label="Tutup" data-terms-close>&times;</button>
                </header>
                <div class="terms-body">
                    <h4>1. Pendaftaran Akun</h4>
                    <p>
                        MayClass menyediakan platform belajar terpadu yang menghubungkan siswa, tentor, dan admin.
                        Saat mendaftar, Anda perlu memberikan <strong>nama lengkap</strong>, <strong>username</strong>,
                        <strong>email</strong>, <strong>nomor telepon</strong>, dan <strong>jenis kelamin</strong> untuk
                        membangun profil pembelajaran. Informasi ini membantu kami merekomendasikan paket dan
                        menghubungkan Anda dengan tentor yang relevan.
                    </p>

                    <h4>2. Langganan &amp; Pembayaran</h4>
                    <p>
                        Setelah akun dibuat, Anda dapat memilih paket belajar berdasarkan jenjang SD, SMP, atau SMA.
                        Setiap transaksi checkout akan berstatus <strong>menunggu verifikasi admin</strong>. Paket baru
                        aktif ketika tim keuangan MayClass memvalidasi bukti pembayaran. Hingga proses tersebut selesai,
                        akses ke materi, kuis, dan jadwal premium tetap terbatas.
                    </p>

                    <h4>3. Materi, Kuis, dan Jadwal</h4>
                    <p>
                        Konten belajar tersedia secara dinamis sesuai paket yang Anda pilih. Materi dapat dilihat atau
                        diunduh melalui portal siswa, kuis terhubung ke latihan interaktif pihak ketiga, dan jadwal kelas
                        mengikuti sesi yang dirancang tentor. Kami mencatat progres dan aktivitas guna memberikan
                        pengalaman belajar yang konsisten.
                    </p>

                    <h4>4. Kewajiban Pengguna</h4>
                    <ul>
                        <li>Menjaga kerahasiaan kredensial akun dan tidak membagikannya ke pihak lain.</li>
                        <li>Mengunggah dokumen atau foto profil yang sesuai dengan etika komunitas MayClass.</li>
                        <li>Menggunakan fitur materi, kuis, dan jadwal hanya untuk kebutuhan belajar pribadi.</li>
                        <li>Memberikan data pembayaran yang valid saat melakukan checkout paket.</li>
                    </ul>

                    <h4>5. Pengelolaan Data Pribadi</h4>
                    <p>
                        Data pribadi Anda disimpan dengan aman pada sistem MayClass. Kami menggunakan informasi kontak
                        untuk pengingat jadwal, pembaruan paket, serta komunikasi dukungan. Dokumen pembelajaran yang
                        diunggah tentor hanya dibagikan kepada siswa dalam paket terkait. Kami tidak menjual atau
                        mendistribusikan data pribadi ke pihak ketiga di luar kebutuhan layanan inti MayClass.
                    </p>

                    <h4>6. Keamanan &amp; Dukungan</h4>
                    <p>
                        MayClass menerapkan kontrol akses berbasis peran (admin, tentor, siswa) dan pencatatan aktivitas
                        untuk menjaga keamanan. Jika Anda menemukan aktivitas mencurigakan atau memerlukan bantuan,
                        hubungi dukungan kami melalui email <strong>support@mayclass.id</strong> atau WhatsApp resmi yang
                        tercantum di dashboard.
                    </p>
                    <div class="terms-consent" data-terms-consent>
                        <input
                            type="checkbox"
                            id="terms-consent-checkbox"
                            name="terms_consent"
                            data-terms-consent-checkbox
                        />
                        <label for="terms-consent-checkbox">
                            <strong>Saya setuju dengan ketentuan layanan &amp; kebijakan privasi MayClass.</strong>
                            <small>Popup akan tertutup otomatis 1 detik setelah kotak ini dicentang.</small>
                        </label>
                    </div>
                </div>
                <div class="terms-actions">
                    <button type="button" data-terms-close>Tutup</button>
                </div>
            </div>
        </div>

        <script>
            const doc = document.documentElement;
            const switchButtons = document.querySelectorAll(".tab-switcher button");

            function setMode(mode) {
                doc.setAttribute("data-mode", mode);
                switchButtons.forEach((button) => {
                    const isActive = button.dataset.mode === mode;
                    button.setAttribute("aria-selected", isActive ? "true" : "false");
                });
            }

            switchButtons.forEach((button) => {
                button.addEventListener("click", () => {
                    const mode = button.dataset.mode;
                    setMode(mode);
                    history.replaceState(
                        null,
                        "",
                        mode === "register" ? "{{ route('register') }}" : "{{ route('login') }}"
                    );
                });
            });

            setMode(doc.getAttribute("data-mode"));

            const termsModal = document.querySelector("[data-terms-dialog]");
            const termsOpeners = document.querySelectorAll("[data-terms-open]");
            const termsClosers = document.querySelectorAll("[data-terms-close]");
            const termsConsentInput = document.querySelector("[data-terms-consent-checkbox]");
            const termsConsentWrapper = document.querySelector("[data-terms-consent]");
            let termsConsentTimer = null;

            function resetTermsConsent() {
                if (!termsConsentInput) return;

                if (termsConsentTimer) {
                    clearTimeout(termsConsentTimer);
                    termsConsentTimer = null;
                }

                termsConsentInput.checked = false;
                termsConsentWrapper?.classList.remove("is-approved");
            }

            function toggleTerms(visible) {
                if (!termsModal) return;

                if (visible) {
                    resetTermsConsent();
                }

                termsModal.setAttribute("data-visible", visible ? "true" : "false");
                termsModal.setAttribute("aria-hidden", visible ? "false" : "true");

                if (visible) {
                    const focusTarget = termsModal.querySelector("button[data-terms-close]");
                    focusTarget?.focus({ preventScroll: true });
                    document.body.style.overflow = "hidden";
                } else {
                    document.body.style.overflow = "";
                    if (termsConsentTimer) {
                        clearTimeout(termsConsentTimer);
                        termsConsentTimer = null;
                    }
                }
            }

            termsOpeners.forEach((button) => {
                button.addEventListener("click", () => {
                    toggleTerms(true);
                });
            });

            termsClosers.forEach((button) => {
                button.addEventListener("click", () => {
                    toggleTerms(false);
                });
            });

            termsModal?.addEventListener("click", (event) => {
                if (event.target === termsModal) {
                    toggleTerms(false);
                }
            });

            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape") {
                    toggleTerms(false);
                }
            });

            termsConsentInput?.addEventListener("change", (event) => {
                const isChecked = event.target.checked;

                if (isChecked) {
                    termsConsentWrapper?.classList.add("is-approved");
                    termsConsentTimer = window.setTimeout(() => {
                        toggleTerms(false);
                    }, 1000);
                } else {
                    termsConsentWrapper?.classList.remove("is-approved");
                    if (termsConsentTimer) {
                        clearTimeout(termsConsentTimer);
                        termsConsentTimer = null;
                    }
                }
            });

            const registerPopup = document.getElementById("register-popup");

            if (registerPopup) {
                const closeButtons = registerPopup.querySelectorAll("[data-close-register-popup]");
                let isClosing = false;

                const closePopup = () => {
                    if (isClosing) return;

                    isClosing = true;
                    registerPopup.classList.remove("is-visible");
                    registerPopup.addEventListener(
                        "transitionend",
                        () => registerPopup.remove(),
                        { once: true }
                    );

                    setTimeout(() => {
                        if (registerPopup.parentElement) {
                            registerPopup.remove();
                        }
                    }, 400);

                    document.removeEventListener("keydown", handleKeydown);
                };

                const handleKeydown = (event) => {
                    if (event.key === "Escape") {
                        closePopup();
                    }
                };

                closeButtons.forEach((button) => {
                    button.addEventListener("click", closePopup);
                });

                registerPopup.addEventListener("click", (event) => {
                    if (event.target === registerPopup) {
                        closePopup();
                    }
                });

                document.addEventListener("keydown", handleKeydown);
            }
        </script>
    </body>
</html>
