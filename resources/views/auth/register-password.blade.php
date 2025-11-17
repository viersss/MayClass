<!DOCTYPE html>
<html lang="id" data-mode="password">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Konfirmasi Password</title>
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
                    linear-gradient(130deg, rgba(7, 16, 37, 0.6), rgba(11, 31, 51, 0.45)),
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

            .summary-card {
                margin-top: 8px;
                border-radius: 22px;
                border: 1px solid rgba(20, 59, 46, 0.08);
                background: var(--panel-muted);
                padding: 22px 24px;
                display: flex;
                flex-direction: column;
                gap: 14px;
            }

            .summary-card h3 {
                margin: 0;
                font-size: 1rem;
                color: var(--accent-dark);
                letter-spacing: 0.04em;
            }

            .summary-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 12px 24px;
            }

            .summary-grid dt {
                font-size: 0.72rem;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                color: var(--text-muted);
                margin: 0 0 4px;
            }

            .summary-grid dd {
                margin: 0;
                font-weight: 600;
                color: var(--text);
                font-size: 0.98rem;
            }

            form {
                display: flex;
                flex-direction: column;
                gap: 16px;
                text-align: left;
                margin-top: 8px;
            }

            .input-group {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            label {
                font-weight: 500;
                font-size: 0.9rem;
                color: var(--text);
            }

            input {
                width: 100%;
                padding: 12px 14px;
                border-radius: 12px;
                border: 1px solid var(--outline);
                font-family: inherit;
                font-size: 0.95rem;
                transition: border 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
                background: #fff;
            }

            input:focus {
                outline: none;
                border-color: var(--accent);
                box-shadow: 0 0 0 3px rgba(63, 166, 126, 0.2);
                transform: translateY(-1px);
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
                min-width: 220px;
            }

            .primary-action:hover {
                transform: translateY(-2px);
                box-shadow: 0 24px 48px rgba(31, 107, 79, 0.35);
            }

            .actions-row {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                align-items: center;
                justify-content: space-between;
            }

            .link-button {
                border: none;
                background: transparent;
                padding: 0;
                color: var(--accent-dark);
                font-weight: 600;
                font-size: 0.9rem;
                cursor: pointer;
            }

            .form-helper {
                margin: 0;
                font-size: 0.82rem;
                color: var(--text-muted);
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

            .error-alert ul {
                margin: 0;
                padding-left: 20px;
            }

            .input-error {
                color: #dc2626;
                font-size: 0.75rem;
                margin: -4px 0 0;
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

                .summary-grid {
                    grid-template-columns: 1fr;
                }

                .actions-row {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .primary-action {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        @php($genderLabel = match ($profile['gender'] ?? null) {
            'female' => 'Perempuan',
            'male' => 'Laki-laki',
            default => 'Tidak disebutkan',
        })
        <a class="back-link" href="{{ route('register') }}">
            <span aria-hidden="true">&lt;</span>
            Kembali ke data diri
        </a>
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-illustration" aria-hidden="true">
                    <div></div>
                    <div class="auth-hero-body">
                        <p class="hero-eyebrow">Langkah terakhir</p>
                        <h1>Kunci akses MayClass dengan password aman</h1>
                        <p>
                            Pastikan password kuat agar perjalanan belajar digitalmu tetap aman dan fokus. Setelah ini,
                            akunmu siap digunakan untuk mengeksplor seluruh materi MayClass.
                        </p>
                    </div>
                </div>

                <div class="auth-panel">
                    <div class="panel-header">
                        <h2>Konfirmasi Password</h2>
                        <p class="panel-desc">
                            Tinjau kembali data diri kamu dan buat password baru untuk menyelesaikan proses registrasi.
                        </p>
                    </div>

                    <div class="summary-card">
                        <h3>Ringkasan Data Diri</h3>
                        <dl class="summary-grid">
                            <div>
                                <dt>Nama Lengkap</dt>
                                <dd>{{ $profile['name'] }}</dd>
                            </div>
                            <div>
                                <dt>Username</dt>
                                <dd>{{ $profile['username'] }}</dd>
                            </div>
                            <div>
                                <dt>Email</dt>
                                <dd>{{ $profile['email'] }}</dd>
                            </div>
                            <div>
                                <dt>No. Tlp / WA</dt>
                                <dd>{{ $profile['phone'] ?? 'Belum diisi' }}</dd>
                            </div>
                            <div>
                                <dt>Jenis Kelamin</dt>
                                <dd>{{ $genderLabel }}</dd>
                            </div>
                        </dl>
                    </div>

                    @if ($errors->any())
                        <div class="error-alert" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('register.perform') }}" novalidate>
                        @csrf
                        <div class="input-group">
                            <label for="register-password">Password</label>
                            <input
                                id="register-password"
                                type="password"
                                name="password"
                                autocomplete="new-password"
                                placeholder="Buat password minimal 8 karakter"
                                required
                            />
                            @error('password')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="register-password-confirmation">Konfirmasi Password</label>
                            <input
                                id="register-password-confirmation"
                                type="password"
                                name="password_confirmation"
                                autocomplete="new-password"
                                placeholder="Ulangi password Anda"
                                required
                            />
                            @error('password_confirmation')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <p class="form-helper">
                            Setelah password disimpan, akun MayClass Anda langsung aktif dan siap digunakan.
                        </p>
                        <div class="actions-row">
                            <a class="link-button" href="{{ route('register') }}">Perbarui data diri</a>
                            <button class="primary-action" type="submit">Simpan Password &amp; Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
