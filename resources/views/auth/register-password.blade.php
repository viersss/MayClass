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
                justify-content: flex-start;
                gap: 24px;
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

            .auth-header h2 {
                margin: 0 0 8px;
                font-size: 1.6rem;
                font-weight: 600;
            }

            .auth-header p {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.95rem;
            }

            .summary-card {
                background: rgba(66, 183, 173, 0.08);
                border-radius: 20px;
                padding: 20px 24px;
                display: grid;
                gap: 12px;
            }

            .summary-card h3 {
                margin: 0;
                font-size: 1rem;
                color: var(--accent-dark);
            }

            .summary-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px 16px;
            }

            .summary-grid dt {
                font-size: 0.78rem;
                text-transform: uppercase;
                letter-spacing: 0.04em;
                color: var(--text-muted);
                margin: 0 0 4px;
            }

            .summary-grid dd {
                margin: 0;
                font-weight: 600;
                color: var(--text);
                word-break: break-word;
            }

            form {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            label {
                font-weight: 500;
                font-size: 0.92rem;
                color: var(--text);
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
                border-color: var(--accent);
                box-shadow: 0 0 0 3px rgba(66, 183, 173, 0.22);
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

            .form-helper {
                margin: 0;
                font-size: 0.78rem;
                color: var(--text-muted);
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
                margin-top: 12px;
            }

            .link-button {
                border: none;
                background: transparent;
                padding: 0;
                font-size: 0.9rem;
                color: var(--accent-dark);
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
                    margin: 16px 20px;
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

            .auth-illustration h1 {
                font-size: clamp(0.9rem, 1.7vw, 1.9rem);
                font-weight: 400; 
                margin: 0;
                line-height: 1.3;
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
