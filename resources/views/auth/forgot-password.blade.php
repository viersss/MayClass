<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Bantuan Lupa Password</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                --primary: #1d8f73;
                --primary-dark: #16624f;
                --surface: #ffffff;
                --surface-muted: #f1f5f9;
                --text: #0f172a;
                --text-muted: #475569;
                --border: rgba(15, 23, 42, 0.08);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #e8f7f1, #f8fbff);
                color: var(--text);
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
                display: inline-flex;
                gap: 8px;
                align-items: center;
                padding: 10px 18px;
                border-radius: 999px;
                background: rgba(15, 23, 42, 0.75);
                color: #fff;
                font-size: 0.9rem;
                box-shadow: 0 18px 40px rgba(15, 23, 42, 0.25);
            }

            .page-grid {
                flex: 1;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 24px;
                padding: clamp(32px, 4vw, 56px);
                align-items: stretch;
            }

            .info-card {
                background: var(--surface);
                border-radius: 32px;
                padding: clamp(32px, 4vw, 52px);
                box-shadow: 0 32px 70px rgba(15, 23, 42, 0.08);
                border: 1px solid var(--border);
                display: flex;
                flex-direction: column;
                gap: 28px;
            }

            .info-card header h1 {
                margin: 8px 0 12px;
                font-size: clamp(2rem, 3vw, 2.6rem);
            }

            .info-card header p {
                color: var(--text-muted);
                font-size: 1rem;
                line-height: 1.6;
            }

            .steps {
                display: grid;
                gap: 16px;
            }

            .step-item {
                border-radius: 20px;
                padding: 16px 18px;
                background: var(--surface-muted);
                border: 1px dashed rgba(15, 23, 42, 0.12);
            }

            .step-item strong {
                display: block;
                font-size: 1rem;
                margin-bottom: 6px;
            }

            .contact-card {
                border-radius: 24px;
                background: linear-gradient(135deg, rgba(29, 143, 115, 0.08), rgba(29, 143, 115, 0.18));
                padding: 24px;
                display: grid;
                gap: 10px;
                border: 1px solid rgba(29, 143, 115, 0.2);
            }

            .contact-card h2 {
                margin: 0;
                font-size: 1.6rem;
            }

            .contact-card .phone {
                font-size: 1.1rem;
                font-weight: 600;
            }

            .contact-card small {
                color: var(--text-muted);
            }

            .whatsapp-btn {
                margin-top: 8px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 14px 18px;
                border-radius: 18px;
                background: #25d366;
                color: #0f172a;
                font-weight: 600;
                box-shadow: 0 18px 32px rgba(37, 211, 102, 0.4);
            }

            .illustration {
                border-radius: 32px;
                position: relative;
                overflow: hidden;
                min-height: 420px;
                background: linear-gradient(120deg, rgba(13, 23, 48, 0.65), rgba(13, 23, 48, 0.35)),
                    url('{{ config('mayclass.images.auth.fallback') }}') center/cover no-repeat;
                color: #fff;
                padding: clamp(32px, 4vw, 52px);
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                gap: 12px;
            }

            .illustration strong {
                font-size: clamp(1.6rem, 2.8vw, 2.3rem);
            }

            .illustration span {
                color: rgba(255, 255, 255, 0.82);
                line-height: 1.6;
            }

            @media (max-width: 768px) {
                .back-link {
                    position: static;
                    margin: 16px auto 0;
                }

                .page-grid {
                    padding-top: 12px;
                }
            }
        </style>
    </head>
    <body>
        <a class="back-link" href="{{ route('login') }}">Kembali ke halaman login</a>
        <div class="page-grid">
            <section class="info-card">
                <header>
                    <p style="text-transform: uppercase; letter-spacing: 0.08em; font-size: 0.85rem; color: var(--text-muted);">
                        Keamanan Akun Siswa
                    </p>
                    <h1>Lupa Password MayClass?</h1>
                    <p>
                        Demi keamanan data, reset password dilakukan langsung oleh tim admin. Hubungi admin resmi
                        MayClass menggunakan tombol WhatsApp di bawah agar kami dapat memverifikasi identitas Anda dan
                        membuat kata sandi baru secara manual.
                    </p>
                </header>

                <div class="steps">
                    <div class="step-item">
                        <strong>1. Kirim permintaan</strong>
                        <p>Klik tombol WhatsApp untuk mengirim pesan otomatis ke admin MayClass.</p>
                    </div>
                    <div class="step-item">
                        <strong>2. Verifikasi cepat</strong>
                        <p>Admin akan menanyakan data dasar (nama, kelas, username) untuk memastikan keamanan akun.</p>
                    </div>
                    <div class="step-item">
                        <strong>3. Terima password baru</strong>
                        <p>Setelah verifikasi, admin mengirimkan kata sandi baru yang bisa langsung Anda gunakan.</p>
                    </div>
                </div>

                <div class="contact-card">
                    <span style="font-size: 0.9rem; text-transform: uppercase; color: var(--text-muted);">Kontak Resmi</span>
                    <h2>{{ $contactName }}</h2>
                    <span class="phone">{{ $contactNumber ?? 'Nomor WhatsApp belum tersedia' }}</span>
                    <span style="font-size: 0.9rem;">Jam layanan: {{ $availability }}</span>
                    @if ($whatsappLink)
                        <a class="whatsapp-btn" href="{{ $whatsappLink }}" target="_blank" rel="noopener">
                            Hubungi via WhatsApp
                        </a>
                    @else
                        <small>Silakan hubungi admin melalui kanal resmi MayClass.</small>
                    @endif
                    <small>Pesan otomatis: “{{ $supportMessage }}”</small>
                </div>
            </section>
            <aside class="illustration">
                <strong>Akses bantuan resmi, aman, dan terlindungi.</strong>
                <span>Admin hanya akan memberikan kata sandi baru dan tidak pernah meminta kode OTP atau data rahasia lainnya.</span>
            </aside>
        </div>
    </body>
</html>
