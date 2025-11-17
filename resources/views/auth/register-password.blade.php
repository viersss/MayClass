<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Buat Password</title>
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
                --primary-dark: #1b6d4f;
                --primary-main: #3fa67e;
                --primary-light: #84d986;
                --neutral-900: #1f2328;
                --neutral-600: #4d5660;
                --neutral-200: #f1f5f4;
                --surface: #ffffff;
                --panel-muted: #f6f7f8;
                --outline: rgba(20, 59, 46, 0.18);
                --shadow-lg: 0 32px 60px rgba(20, 59, 46, 0.15);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                color: var(--neutral-900);
                background: linear-gradient(180deg, #f4fbf9 0%, #ffffff 65%);
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
                top: 24px;
                left: 32px;
                z-index: 10;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 14px;
                border-radius: 999px;
                font-size: 0.95rem;
                color: #ffffff;
                font-weight: 500;
                background: rgba(20, 59, 46, 0.55);
                backdrop-filter: blur(8px);
            }

            .auth-wrapper {
                flex: 1;
                display: flex;
                align-items: stretch;
                justify-content: center;
                padding: clamp(16px, 4vw, 32px);
            }

            .auth-card {
                width: 100%;
                max-width: 1100px;
                display: grid;
                grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
                border-radius: 32px;
                overflow: hidden;
                background: var(--surface);
                box-shadow: var(--shadow-lg);
            }

            .auth-illustration {
                position: relative;
                background:
                    linear-gradient(135deg, rgba(7, 16, 37, 0.7), rgba(20, 59, 46, 0.55)),
                    url("https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=1600&q=80")
                        center/cover no-repeat;
                padding: clamp(32px, 4vw, 56px);
                display: flex;
                flex-direction: column;
                gap: 32px;
                color: #f0fff7;
            }

            .auth-illustration .image-frame {
                border-radius: 24px;
                overflow: hidden;
                position: relative;
                box-shadow: 0 24px 50px rgba(0, 0, 0, 0.35);
            }

            .auth-illustration .image-frame::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(63, 166, 126, 0.3), transparent 65%);
            }

            .auth-illustration img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .auth-illustration h1 {
                margin: 0;
                font-size: clamp(2rem, 2.4vw, 2.8rem);
                line-height: 1.3;
                font-weight: 600;
            }

            .auth-illustration p {
                margin: 0;
                color: rgba(255, 255, 255, 0.82);
                line-height: 1.6;
            }

            .auth-panel {
                padding: clamp(32px, 5vw, 56px);
                background: var(--surface);
                display: flex;
                flex-direction: column;
                gap: 28px;
            }

            .auth-header h2 {
                margin: 0;
                font-size: clamp(1.8rem, 2.4vw, 2.2rem);
            }

            .auth-header p {
                margin: 6px 0 0;
                color: var(--neutral-600);
                font-size: 0.95rem;
            }

            .summary-card {
                background: var(--panel-muted);
                border-radius: 22px;
                padding: 22px 26px;
                border: 1px solid rgba(20, 59, 46, 0.08);
                display: grid;
                gap: 12px;
            }

            .summary-card h3 {
                margin: 0;
                font-size: 1rem;
                color: var(--primary-dark);
            }

            .summary-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 14px 20px;
            }

            .summary-grid dt {
                font-size: 0.78rem;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: var(--neutral-600);
                margin: 0 0 4px;
            }

            .summary-grid dd {
                margin: 0;
                font-weight: 600;
                color: var(--neutral-900);
            }

            form {
                display: flex;
                flex-direction: column;
                gap: 18px;
            }

            label {
                font-weight: 500;
                font-size: 0.92rem;
                color: var(--neutral-900);
            }

            input {
                width: 100%;
                padding: 14px 16px;
                border-radius: 14px;
                border: 1.5px solid var(--outline);
                font-family: inherit;
                font-size: 0.95rem;
                transition: border 0.2s ease, box-shadow 0.2s ease;
                background: #fff;
            }

            input:focus {
                outline: none;
                border-color: var(--primary-main);
                box-shadow: 0 0 0 3px rgba(63, 166, 126, 0.2);
            }

            .primary-action {
                margin-top: 8px;
                padding: 14px 20px;
                border-radius: 16px;
                border: none;
                background: linear-gradient(120deg, var(--primary-main), var(--primary-light));
                color: #fff;
                font-weight: 600;
                font-size: 1rem;
                cursor: pointer;
                box-shadow: 0 18px 32px rgba(63, 166, 126, 0.28);
                transition: transform 0.15s ease, box-shadow 0.15s ease;
            }

            .primary-action:hover {
                transform: translateY(-1px);
                box-shadow: 0 22px 38px rgba(63, 166, 126, 0.35);
            }

            .form-helper {
                margin: 0;
                font-size: 0.82rem;
                color: var(--neutral-600);
            }

            .error-alert {
                padding: 12px 16px;
                border-radius: 12px;
                background: rgba(220, 38, 38, 0.1);
                color: #991b1b;
                font-size: 0.85rem;
                line-height: 1.5;
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

            .actions-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
                flex-wrap: wrap;
            }

            .link-button {
                border: none;
                background: transparent;
                padding: 0;
                font-size: 0.9rem;
                color: var(--primary-dark);
                font-weight: 500;
                cursor: pointer;
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
                    position: static;
                    margin: 16px 24px;
                }

                .summary-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 520px) {
                .actions-row {
                    flex-direction: column;
                    align-items: stretch;
                }

                .link-button {
                    align-self: center;
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
                <div class="auth-illustration">
                    <div class="image-frame" aria-hidden="true">
                        <img src="{{ \App\Support\ImageRepository::url('auth') }}" alt="Ilustrasi keamanan akun MayClass" />
                    </div>
                    <div>
                     <h1 data-copy-mode="register">
                        Daftar untuk akses penuh ke fitur belajar MayClass, mulai dari kelas interaktif hingga pendampingan tentor profesional.
                    </h1>
                    </div>
                </div>
                <div class="auth-panel">
                    <div class="auth-header">
                        <h2>Konfirmasi Password</h2>
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
                        <p class="form-helper">Dengan menyelesaikan langkah ini, akun MayClass Anda akan dibuat.</p>
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
