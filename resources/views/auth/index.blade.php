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
                --bg: #04281c;
                --bg-secondary: #0c3f2d;
                --panel: #ffffff;
                --panel-muted: #eef7f2;
                --accent: #3fa67e;
                --accent-dark: #1b6d4f;
                --accent-soft: #84d986;
                --text: #0f241b;
                --text-muted: #4c6257;
                --outline: rgba(35, 87, 64, 0.25);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                color: var(--text);
                background: radial-gradient(circle at top, rgba(132, 217, 134, 0.15), transparent 50%),
                    linear-gradient(135deg, #021710 0%, var(--bg) 35%, var(--bg-secondary) 100%);
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
                color: #d0dcff;
                font-weight: 500;
                letter-spacing: 0.01em;
            }

            .auth-wrapper {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: clamp(16px, 4vw, 40px);
            }

            .auth-card {
                background: rgba(7, 26, 18, 0.55);
                border-radius: 36px;
                display: grid;
                grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
                width: min(1200px, 100%);
                min-height: clamp(640px, 80vh, 760px);
                overflow: hidden;
                box-shadow: 0 45px 95px rgba(2, 6, 23, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }

            .auth-illustration {
                position: relative;
                background: linear-gradient(130deg, rgba(4, 22, 15, 0.75), rgba(11, 52, 37, 0.78)),
                    url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1200&q=80')
                        center/cover;
                padding: clamp(32px, 5vw, 56px);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                gap: 32px;
                color: #ecfff6;
            }

            .auth-hero-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            }

            .brand-chip {
                padding: 10px 18px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.12);
                font-weight: 600;
                letter-spacing: 0.08em;
                font-size: 0.85rem;
            }

            .hero-season {
                font-size: 0.8rem;
                text-transform: uppercase;
                letter-spacing: 0.2em;
                opacity: 0.75;
            }

            .auth-hero-body {
                margin-top: clamp(24px, 3vw, 40px);
                max-width: 420px;
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .hero-eyebrow {
                font-size: 0.85rem;
                text-transform: uppercase;
                letter-spacing: 0.2em;
                color: rgba(232, 253, 242, 0.75);
            }

            .auth-illustration h1 {
                font-size: clamp(2rem, 3vw, 2.8rem);
                font-weight: 600;
                margin: 0;
                line-height: 1.2;
            }

            .auth-illustration p {
                color: rgba(237, 252, 243, 0.9);
                font-weight: 400;
                margin: 0;
                line-height: 1.5;
            }

            .hero-metric-card {
                margin-top: auto;
                padding: 20px 24px;
                border-radius: 24px;
                background: rgba(5, 25, 17, 0.75);
                border: 1px solid rgba(255, 255, 255, 0.1);
                max-width: 360px;
                backdrop-filter: blur(12px);
                box-shadow: 0 18px 40px rgba(2, 7, 24, 0.45);
            }

            .hero-metric-card strong {
                display: block;
                font-size: 2rem;
                margin-bottom: 4px;
            }

            .hero-metric-card span {
                font-size: 0.95rem;
                color: rgba(255, 255, 255, 0.7);
            }

            [data-copy-mode] {
                display: none;
            }

            html[data-mode="register"] [data-copy-mode="register"],
            html[data-mode="login"] [data-copy-mode="login"] {
                display: block;
            }

            .auth-panel {
                padding: clamp(32px, 5vw, 64px);
                background: var(--panel);
                display: flex;
                flex-direction: column;
                gap: 24px;
                position: relative;
            }

            .panel-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                flex-wrap: wrap;
            }

            .panel-chip {
                font-size: 0.85rem;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--accent-dark);
                font-weight: 600;
            }

            .panel-switch {
                font-size: 0.9rem;
                color: var(--text-muted);
                margin-left: auto;
            }

            .panel-switch a {
                color: var(--accent-dark);
                font-weight: 600;
            }

            .panel-header {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .panel-eyebrow {
                font-size: 0.85rem;
                letter-spacing: 0.2em;
                color: var(--text-muted);
                text-transform: uppercase;
            }

            .panel-header h2 {
                margin: 0;
                font-size: clamp(1.8rem, 3vw, 2.3rem);
                font-weight: 600;
            }

            .panel-desc {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.95rem;
                line-height: 1.5;
                max-width: 520px;
            }

            .step-indicators {
                display: flex;
                justify-content: center;
            }

            .step-indicator {
                display: none;
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .step-dots {
                display: flex;
                gap: 12px;
            }

            .step-dot {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background: #ffffff;
                border: 1px solid rgba(31, 42, 55, 0.2);
                box-shadow: 0 2px 6px rgba(17, 24, 39, 0.15);
            }

            .step-dot--filled {
                background: #1f2a37;
                border-color: #1f2a37;
            }

            .step-label {
                margin: 0;
                font-size: 0.85rem;
                font-weight: 500;
                letter-spacing: 0.02em;
                color: var(--text-muted);
            }

            .register-popup-backdrop {
                position: fixed;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(15, 23, 42, 0.45);
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
                box-shadow: 0 10px 22px rgba(31, 107, 79, 0.3);
                text-decoration: none;
            }

            .register-popup-actions a:hover {
                transform: translateY(-1px);
                box-shadow: 0 12px 28px rgba(66, 183, 173, 0.4);
            }

            .register-popup-actions button {
                background: transparent;
                color: var(--text-muted);
            }

            .register-popup-actions button:hover {
                color: var(--accent-dark);
            }

            html[data-mode="register"] .step-indicator[data-step="register"],
            html[data-mode="login"] .step-indicator[data-step="login"] {
                display: flex;
            }

            .tab-switcher {
                display: inline-flex;
                background: var(--panel-muted);
                border-radius: 16px;
                padding: 6px;
                gap: 6px;
                margin-top: 4px;
                align-self: flex-start;
            }

            .tab-switcher button {
                border: none;
                background: transparent;
                padding: 12px 28px;
                border-radius: 12px;
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
                box-shadow: 0 15px 25px rgba(27, 109, 79, 0.18);
            }

            form {
                display: none;
                flex-direction: column;
                gap: 16px;
                text-align: left;
            }

            .error-alert {
                padding: 14px 18px;
                border-radius: 16px;
                background: rgba(220, 38, 38, 0.08);
                color: #991b1b;
                font-size: 0.85rem;
                line-height: 1.5;
                border: 1px solid rgba(220, 38, 38, 0.15);
            }

            .status-alert {
                padding: 14px 18px;
                border-radius: 16px;
                background: rgba(63, 166, 126, 0.12);
                color: var(--accent-dark);
                font-size: 0.9rem;
                line-height: 1.5;
                border: 1px solid rgba(63, 166, 126, 0.25);
            }

            .google-error {
                margin: 0;
                margin-top: 12px;
                text-align: center;
                color: #dc2626;
                font-size: 0.8rem;
                line-height: 1.4;
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
                border-radius: 16px;
                border: 1.5px solid var(--outline);
                font-family: inherit;
                font-size: 0.95rem;
                transition: border 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
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

            .primary-action {
                margin-top: 8px;
                padding: 16px 18px;
                border-radius: 18px;
                border: none;
                background: var(--accent);
                color: #fff;
                font-weight: 600;
                font-size: 1rem;
                cursor: pointer;
                box-shadow: 0 20px 40px rgba(31, 107, 79, 0.22);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .primary-action:hover {
                transform: translateY(-2px);
                box-shadow: 0 25px 50px rgba(27, 109, 79, 0.3);
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

            .form-support {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-top: 8px;
            }

            .form-helper {
                margin: 0;
                font-size: 0.82rem;
                color: var(--text-muted);
            }

            .terms-link {
                border: none;
                background: rgba(42, 127, 255, 0.12);
                color: var(--accent-dark);
                font-weight: 600;
                font-size: 0.82rem;
                padding: 9px 18px;
                border-radius: 999px;
                cursor: pointer;
                transition: background 0.2s ease, transform 0.2s ease;
            }

            .terms-link:hover {
                background: rgba(42, 127, 255, 0.2);
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
                box-shadow: 0 35px 65px rgba(15, 52, 56, 0.3);
            }

            .terms-dialog header {
                padding: 24px 32px 16px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                background: linear-gradient(135deg, rgba(66, 183, 173, 0.12) 0%, rgba(66, 183, 173, 0.04) 100%);
            }

            .terms-dialog header h3 {
                margin: 0;
                font-size: 1.25rem;
                color: var(--accent-dark);
            }

            .terms-close {
                border: none;
                background: rgba(255, 255, 255, 0.85);
                border-radius: 50%;
                width: 36px;
                height: 36px;
                display: grid;
                place-items: center;
                font-size: 1.1rem;
                cursor: pointer;
                color: var(--accent-dark);
                box-shadow: 0 10px 24px rgba(66, 183, 173, 0.25);
                transition: transform 0.2s ease;
            }

            .terms-close:hover {
                transform: translateY(-1px);
            }

            .terms-body {
                padding: 24px 32px 32px;
                overflow-y: auto;
                color: var(--text);
            }

            .terms-body h4 {
                margin-top: 0;
                margin-bottom: 8px;
                font-size: 1.05rem;
                color: var(--accent-dark);
            }

            .terms-body p {
                margin: 0 0 16px;
                line-height: 1.6;
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            .terms-body ul {
                margin: 0 0 16px 20px;
                color: var(--text-muted);
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .terms-body strong {
                color: var(--accent-dark);
            }

            .terms-actions {
                padding: 16px 32px 28px;
                display: flex;
                justify-content: flex-end;
                background: linear-gradient(180deg, rgba(66, 183, 173, 0.08) 0%, rgba(66, 183, 173, 0) 100%);
            }

            .terms-actions button {
                border: none;
                background: linear-gradient(120deg, var(--accent) 0%, #5ed3c5 100%);
                color: #fff;
                font-weight: 600;
                font-size: 0.9rem;
                padding: 10px 20px;
                border-radius: 12px;
                cursor: pointer;
                box-shadow: 0 12px 24px rgba(66, 183, 173, 0.28);
                transition: transform 0.2s ease;
            }

            .terms-actions button:hover {
                transform: translateY(-1px);
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
        @php($profileData = $profile ?? [])
        @if (session('register_success'))
            <div class="register-popup-backdrop is-visible" id="register-popup" role="dialog" aria-modal="true">
                <div class="register-popup">
                    <p class="register-popup-title">Registrasi berhasil!</p>
                    <p class="register-popup-text">
                        {{ session('status') ?? 'Akun berhasil dibuat. Silakan login untuk mulai belajar.' }}
                    </p>
                    <div class="register-popup-actions">
                        <a href="{{ route('login') }}">Masuk Sekarang</a>
                        <button type="button" data-close-register-popup>Tutup</button>
                    </div>
                </div>
            </div>
        @endif

        <a class="back-link" href="{{ url('/') }}">
            <span aria-hidden="true">&lt;</span>
            Kembali
        </a>
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-illustration" aria-hidden="true">
                    <div class="auth-hero-top">
                        <span class="brand-chip">MayClass</span>
                        <span class="hero-season">Program Premium</span>
                    </div>
                    <div class="auth-hero-body">
                        <p class="hero-eyebrow" data-copy-mode="register">Raih kelas impianmu</p>
                        <p class="hero-eyebrow" data-copy-mode="login">Selamat datang kembali</p>
                        <h1 data-copy-mode="register">Langkah Pasti Menuju Prestasi</h1>
                        <h1 data-copy-mode="login">Lanjutkan langkah pasti menuju prestasi</h1>
                        <p>
                            Ritme belajar intensif, materi terkurasi, dan dukungan mentor MayClass menghadirkan suasana
                            premium seperti landing page utama.
                        </p>
                    </div>
                    <div class="hero-metric-card">
                        <strong>8.200+</strong>
                        <span>Siswa aktif mempercayakan persiapan akademiknya pada MayClass setiap semester.</span>
                    </div>
                </div>
                <div class="auth-panel">
                    <div class="panel-top">
                        <span class="panel-chip">Portal Resmi</span>
                        <p class="panel-switch" data-copy-mode="register">
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Masuk</a>
                        </p>
                        <p class="panel-switch" data-copy-mode="login">
                            Baru di MayClass?
                            <a href="{{ route('register') }}">Daftar</a>
                        </p>
                    </div>
                    <div class="panel-header">
                        <p class="panel-eyebrow" data-copy-mode="register">Registrasi siswa</p>
                        <p class="panel-eyebrow" data-copy-mode="login">Masuk dashboard</p>
                        <h2 data-copy-mode="register">Buat akun MayClass</h2>
                        <h2 data-copy-mode="login">Masuk ke akun MayClass</h2>
                        <p class="panel-desc" data-copy-mode="register">
                            Lengkapi identitas kamu untuk mengaktifkan akses modul belajar premium dan jadwal tentor
                            pilihan.
                        </p>
                        <p class="panel-desc" data-copy-mode="login">
                            Masukkan username dan kata sandi untuk melanjutkan progres belajar tanpa hambatan.
                        </p>
                        <div class="tab-switcher" role="tablist">
                            <button type="button" data-mode="register" role="tab" aria-selected="false">
                                Registrasi
                            </button>
                            <button type="button" data-mode="login" role="tab" aria-selected="false">
                                Masuk
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
                                <option value="" disabled {{ $selectedGender ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                <option value="female" @selected($selectedGender === 'female')>Perempuan</option>
                                <option value="male" @selected($selectedGender === 'male')>Laki-laki</option>
                                <option value="other" @selected($selectedGender === 'other')>Lainnya</option>
                            </select>
                            @error('gender')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-support">
                            <p class="form-helper">Dengan melanjutkan, Anda menyetujui kebijakan layanan MayClass.</p>
                            <button class="terms-link" type="button" data-terms-open>
                                Ketentuan &amp; Privasi
                            </button>
                        </div>
                        <button class="primary-action" type="submit">Selanjutnya</button>
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
                </div>
                <div class="terms-actions">
                    <button type="button" data-terms-close>Tutup</button>
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

            const termsModal = document.querySelector('[data-terms-dialog]');
            const termsOpeners = document.querySelectorAll('[data-terms-open]');
            const termsClosers = document.querySelectorAll('[data-terms-close]');

            function toggleTerms(visible) {
                if (! termsModal) {
                    return;
                }

                termsModal.setAttribute('data-visible', visible ? 'true' : 'false');
                termsModal.setAttribute('aria-hidden', visible ? 'false' : 'true');

                if (visible) {
                    const focusTarget = termsModal.querySelector('button[data-terms-close]');
                    focusTarget?.focus({ preventScroll: true });
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            }

            termsOpeners.forEach((button) => {
                button.addEventListener('click', () => {
                    toggleTerms(true);
                });
            });

            termsClosers.forEach((button) => {
                button.addEventListener('click', () => {
                    toggleTerms(false);
                });
            });

            termsModal?.addEventListener('click', (event) => {
                if (event.target === termsModal) {
                    toggleTerms(false);
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    toggleTerms(false);
                }
            });

            const registerPopup = document.getElementById('register-popup');

            if (registerPopup) {
                const closeButtons = registerPopup.querySelectorAll('[data-close-register-popup]');
                let isClosing = false;

                const closePopup = () => {
                    if (isClosing) {
                        return;
                    }

                    isClosing = true;
                    registerPopup.classList.remove('is-visible');
                    registerPopup.addEventListener(
                        'transitionend',
                        () => registerPopup.remove(),
                        { once: true }
                    );

                    setTimeout(() => {
                        if (registerPopup.parentElement) {
                            registerPopup.remove();
                        }
                    }, 400);

                    document.removeEventListener('keydown', handleKeydown);
                };

                const handleKeydown = (event) => {
                    if (event.key === 'Escape') {
                        closePopup();
                    }
                };

                closeButtons.forEach((button) => {
                    button.addEventListener('click', closePopup);
                });

                registerPopup.addEventListener('click', (event) => {
                    if (event.target === registerPopup) {
                        closePopup();
                    }
                });

                document.addEventListener('keydown', handleKeydown);
            }
        </script>
    </body>
</html>
