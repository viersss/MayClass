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
                --bg: #f7f9fc;
                --card: #ffffff;
                --text: #0f172a;
                --muted: #6b7280;
                --accent: #2563eb;
                --accent-2: #0ea5e9;
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
                background: radial-gradient(circle at top, rgba(37, 99, 235, 0.08), transparent 55%), var(--bg);
                color: var(--text);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 32px 16px;
            }

            .forgot-shell {
                width: min(960px, 100%);
                display: grid;
                gap: 20px;
            }

            .back-link {
                color: var(--muted);
                text-decoration: none;
                font-weight: 500;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .forgot-card {
                background: var(--card);
                border-radius: 32px;
                padding: 40px;
                border: 1px solid rgba(15, 23, 42, 0.08);
                box-shadow: 0 30px 60px rgba(15, 23, 42, 0.12);
                display: grid;
                gap: 20px;
            }

            .section-badge {
                width: fit-content;
                padding: 8px 16px;
                border-radius: 999px;
                background: rgba(37, 99, 235, 0.1);
                color: var(--accent);
                font-weight: 600;
                font-size: 0.85rem;
            }

            h1 {
                margin: 0;
                font-size: clamp(1.8rem, 3vw, 2.4rem);
            }

            p {
                margin: 0;
                color: var(--muted);
                line-height: 1.6;
            }

            .steps {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 16px;
            }

            .steps li {
                padding: 16px 18px;
                border-radius: 20px;
                background: rgba(15, 23, 42, 0.03);
                border: 1px solid rgba(15, 23, 42, 0.06);
                font-weight: 500;
            }

            .whatsapp-card {
                margin-top: 12px;
                padding: 20px;
                border-radius: 24px;
                background: linear-gradient(120deg, #22c55e, #16a34a);
                color: #fff;
                display: grid;
                gap: 12px;
            }

            .whatsapp-card strong {
                font-size: 1.1rem;
            }

            .whatsapp-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 14px 20px;
                border-radius: 18px;
                background: #fff;
                color: #047857;
                font-weight: 600;
                text-decoration: none;
                box-shadow: 0 12px 30px rgba(255, 255, 255, 0.25);
            }

            .contact-hint {
                margin: 0;
                font-size: 0.9rem;
                opacity: 0.9;
            }

            @media (max-width: 640px) {
                body {
                    padding: 24px 12px;
                }

                .forgot-card {
                    padding: 28px;
                }
            }
        </style>
    </head>
    <body>
        <div class="forgot-shell">
            <a class="back-link" href="{{ route('login') }}">← Kembali ke login</a>

            <section class="forgot-card">
                <span class="section-badge">Bantuan akun siswa</span>
                <h1>Lupa Password MayClass?</h1>
                <p>
                    Admin akan membantu mereset password siswa tanpa pernah melihat kata sandi lama. Ikuti langkah
                    berikut agar proses berjalan aman dan cepat.
                </p>

                <ul class="steps">
                    <li>1. Klik tombol WhatsApp di bawah untuk terhubung dengan admin dukungan.</li>
                    <li>2. Sampaikan nama lengkap siswa, username/email, dan paket yang aktif untuk verifikasi.</li>
                    <li>3. Admin akan membuat password baru dan mengirimkannya langsung melalui WhatsApp.</li>
                </ul>

                <div class="whatsapp-card">
                    <strong>Siap dibantu via WhatsApp</strong>
                    <a class="whatsapp-button" href="{{ $whatsappLink }}" target="_blank" rel="noopener">
                        Hubungi Admin MayClass
                    </a>
                    <p class="contact-hint">Nomor admin: {{ $whatsappNumber }}</p>
                    <p class="contact-hint">
                        Setelah menerima password baru, minta siswa login dan menggantinya melalui menu profil agar tetap
                        aman.
                    </p>
                </div>
            </section>
        </div>
    </body>
</html>
