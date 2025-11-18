<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Lupa Password Siswa - MayClass</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
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
                --neutral-100: #f6f7f8;
                --surface: #ffffff;
                --border: #e5e7eb;
                --text: #111827;
                --muted: #6b7280;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                font-family: 'Poppins', sans-serif;
                background: var(--neutral-100);
                color: var(--text);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 32px 16px;
            }

            .forgot-shell {
                width: min(880px, 100%);
                display: grid;
                gap: 18px;
            }

            .back-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-size: 0.9rem;
                color: var(--muted);
                text-decoration: none;
                font-weight: 500;
            }

            .back-link::before {
                content: '←';
                display: inline-block;
                font-size: 1rem;
            }

            .back-link:hover {
                color: var(--primary-main);
            }

            .forgot-card {
                background: var(--surface);
                border-radius: 24px;
                padding: 28px 24px 24px;
                border: 1px solid var(--border);
                box-shadow:
                    0 16px 40px rgba(15, 23, 42, 0.06),
                    0 0 0 1px rgba(15, 23, 42, 0.01);
                display: grid;
                gap: 22px;
            }

            .forgot-header {
                display: grid;
                gap: 10px;
            }

            .section-badge {
                width: fit-content;
                padding: 6px 14px;
                border-radius: 999px;
                background: rgba(63, 166, 126, 0.08);
                color: var(--primary-dark);
                border: 1px solid rgba(63, 166, 126, 0.25);
                font-weight: 600;
                font-size: 0.8rem;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            h1 {
                margin: 0;
                font-size: clamp(1.8rem, 2.8vw, 2.2rem);
                line-height: 1.3;
            }

            .forgot-header p {
                margin: 0;
                color: var(--muted);
                font-size: 0.95rem;
                line-height: 1.7;
                max-width: 620px;
            }

            .forgot-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.3fr) minmax(0, 1fr);
                gap: 20px;
                align-items: flex-start;
            }

            /* STEP LIST (kiri) */
            .steps-shell {
                padding: 16px 16px 14px;
                border-radius: 18px;
                background: #ffffff;
                border: 1px solid var(--border);
            }

            .steps-title {
                margin: 0 0 10px;
                font-size: 0.95rem;
                font-weight: 600;
                color: var(--muted);
            }

            .steps {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 14px;
            }

            .step {
                display: grid;
                grid-template-columns: auto minmax(0, 1fr);
                gap: 12px;
                align-items: flex-start;
            }

            .step-indicator {
                position: relative;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 26px;
                height: 26px;
                border-radius: 999px;
                background: rgba(63, 166, 126, 0.12);
                color: var(--primary-dark);
                font-size: 0.8rem;
                font-weight: 600;
                flex-shrink: 0;
            }

            .step-indicator::after {
                content: '';
                position: absolute;
                left: 50%;
                top: 26px;
                transform: translateX(-50%);
                width: 1px;
                height: calc(100% - 26px);
                background: linear-gradient(to bottom, rgba(148, 163, 184, 0.5), transparent);
                opacity: 0.7;
            }

            .step:last-child .step-indicator::after {
                display: none;
            }

            .step-body {
                display: grid;
                gap: 4px;
            }

            .step-body strong {
                font-size: 0.9rem;
            }

            .step-body span {
                font-size: 0.9rem;
                color: var(--muted);
                line-height: 1.6;
            }

            /* WHATSAPP PANEL (kanan) */
            .whatsapp-card {
                padding: 18px 18px 16px;
                border-radius: 18px;
                background: linear-gradient(
                    135deg,
                    rgba(63, 166, 126, 0.08),
                    rgba(80, 200, 140, 0.18)
                );
                border: 1px solid rgba(63, 166, 126, 0.3);
                display: grid;
                gap: 10px;
            }

            .whatsapp-card strong {
                font-size: 1rem;
                color: var(--primary-dark);
            }

            .whatsapp-text {
                font-size: 0.9rem;
                color: var(--muted);
                line-height: 1.5;
            }

            .whatsapp-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                margin-top: 4px;
                padding: 10px 18px;
                border-radius: 999px;
                background: var(--primary-main);
                color: #ffffff;
                font-weight: 600;
                text-decoration: none;
                font-size: 0.92rem;
                box-shadow: 0 10px 22px rgba(15, 23, 42, 0.12);
                border: none;
                min-width: 210px;
            }

            .whatsapp-button:hover {
                filter: brightness(0.97);
            }

            .contact-hint {
                margin: 0;
                font-size: 0.86rem;
                color: var(--muted);
            }

            .contact-hint span {
                font-weight: 600;
                color: var(--primary-dark);
            }

            /* RESPONSIVE */
            @media (max-width: 768px) {
                body {
                    padding: 24px 12px;
                }

                .forgot-card {
                    padding: 22px 18px 18px;
                    border-radius: 20px;
                }

                .forgot-grid {
                    grid-template-columns: minmax(0, 1fr);
                    gap: 16px;
                }

                .steps-shell {
                    padding: 14px 12px 12px;
                }

                .step-body span {
                    font-size: 0.88rem;
                }

                .whatsapp-card {
                    padding: 16px 14px 14px;
                }
            }
        </style>
    </head>
    <body>
        <div class="forgot-shell">
            <a class="back-link" href="{{ route('login') }}">Kembali ke login</a>

            <section class="forgot-card">
                <header class="forgot-header">
                    <span class="section-badge">Bantuan akun siswa</span>
                    <h1>Lupa Password MayClass?</h1>
                    <p>
                        Admin akan membantu mereset password siswa. Ikuti langkah
                        berikut agar proses berjalan aman, terverifikasi, dan tetap rahasia.
                    </p>
                </header>

                <div class="forgot-grid">
                    <!-- Langkah-langkah (kiri) -->
                    <div class="steps-shell">
                        <p class="steps-title">Langkah reset password</p>
                        <ul class="steps">
                            <li class="step">
                                <div class="step-indicator">1</div>
                                <div class="step-body">
                                    <strong>Hubungi admin melalui WhatsApp</strong>
                                    <span>
                                        Klik tombol WhatsApp di samping untuk langsung membuka percakapan dengan admin
                                        dukungan.
                                    </span>
                                </div>
                            </li>
                            <li class="step">
                                <div class="step-indicator">2</div>
                                <div class="step-body">
                                    <strong>Kirim data verifikasi siswa</strong>
                                    <span>
                                        Sampaikan nama lengkap siswa, username/email, dan paket yang sedang aktif agar
                                        identitas dapat diverifikasi.
                                    </span>
                                </div>
                            </li>
                            <li class="step">
                                <div class="step-indicator">3</div>
                                <div class="step-body">
                                    <strong>Terima password baru yang aman</strong>
                                    <span>
                                        Admin akan membuat password baru dan mengirimkannya langsung ke WhatsApp
                                        sebagai informasi rahasia.
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- WhatsApp card (kanan) -->
                    <div class="whatsapp-card">
                        <strong>Reset password bersama Admin MayClass</strong>
                        <p class="whatsapp-text">
                            Kami siap membantu mengatur ulang password akun siswa. Pastikan nomor WhatsApp yang digunakan
                            aktif dan dapat dihubungi.
                        </p>
                        <a class="whatsapp-button" href="{{ $whatsappLink }}" target="_blank" rel="noopener">
                            Hubungi Admin MayClass
                        </a>
                        <p class="contact-hint">
                            Nomor admin: <span>{{ $whatsappNumber }}</span>
                        </p>
                        <p class="contact-hint">
                            Setelah menerima password baru, minta siswa login dan segera menggantinya melalui menu
                            profil untuk keamanan yang maksimal.
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
