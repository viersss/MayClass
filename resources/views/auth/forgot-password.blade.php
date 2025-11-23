<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MayClass - Bantuan Lupa Password</title>
    {{-- Pastikan tag ini ada jika Anda menggunakan Laravel Mix/Vite untuk asset management --}}
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    <style>
        :root {
            --primary: #0f766e;
            --primary-hover: #115e59;
            --primary-light: #ccfbf1;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius: 16px;
            --shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
            /* --- Warna Neutral dari halaman referensi --- */
            --neutral-100: #f1f5f9;
            --neutral-200: #e2e8f0;
            --neutral-500: #64748b;
            --neutral-900: #0f172a;
            /* ------------------------------------------- */
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;

            /* Background Style */
            background-color: #0f172a;
            background-image:
                linear-gradient(rgba(15, 23, 42, 0.5), rgba(15, 23, 42, 0.7)),
                url("{{ asset('images/bg_kelas.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        a { text-decoration: none; color: inherit; transition: all 0.2s; }

        .container {
            width: 100%;
            max-width: 520px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Main Card */
        .card {
            background: rgba(255, 255, 255, 0.56);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: var(--radius);
            padding: 40px;
            box-shadow: var(--shadow);
            text-align: center;
            position: relative;
        }

        /* --- Tombol Kembali di Pojok Kiri Atas (Gaya Glassmorphism Tipis) --- */
        .back-button {
            position: absolute;
            top: 24px;
            left: 24px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--neutral-500); /* Warna teks abu-abu */
            padding: 8px 16px;
            border-radius: 99px;
            background: var(--neutral-100); /* Background transparan tipis */
            transition: all 0.2s;
            /* Tidak ada border, sama seperti referensi */
        }
        .back-button:hover {
            background: var(--neutral-200); /* Sedikit lebih gelap saat hover */
            color: var(--neutral-900); /* Teks menjadi gelap saat hover */
        }
        /* ------------------------------------------------------------------- */

        .icon-wrapper {
            width: 64px;
            height: 64px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 28px;
        }

        .card h1 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0 0 12px;
            color: var(--text-main);
            letter-spacing: -0.02em;
        }

        .card p {
            font-size: 0.95rem;
            color: var(--text-main);
            line-height: 1.6;
            margin: 0 0 32px;
            font-weight: 500;
        }

        /* Steps List */
        .steps-list {
            text-align: left;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 32px;
        }

        .step-item {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
            align-items: flex-start;
        }
        .step-item:last-child { margin-bottom: 0; }

        .step-num {
            width: 24px;
            height: 24px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .step-content strong {
            display: block;
            font-size: 0.9rem;
            color: var(--text-main);
            margin-bottom: 2px;
        }
        .step-content span {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.4;
        }

        /* Contact Button */
        .whatsapp-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: #25D366;
            color: white;
            font-weight: 600;
            padding: 14px;
            border-radius: 12px;
            font-size: 1rem;
            transition: background 0.2s, transform 0.1s;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.25);
            border: none; cursor: pointer;
        }

        .whatsapp-btn:hover {
            background: #1ebc57;
            transform: translateY(-2px);
        }
        .whatsapp-btn:active { transform: scale(0.98); }

        /* Footer Info */
        .footer-info {
            margin-top: 24px;
            font-size: 0.85rem;
            color: var(--text-muted);
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(241, 245, 249, 0.8);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        @media (max-width: 480px) {
            .card { padding: 32px 24px; }
            .container { padding: 0; }
        }
    </style>
</head>
<body>

    <div class="container">
        <main class="card">
            {{-- Pastikan route 'login' sudah didefinisikan di Laravel Anda --}}
            <a class="back-button" href="{{ route('login') }}">
                Kembali
            </a>
            
            <div class="icon-wrapper">
                🛡️
            </div>

            <h1>Lupa Password?</h1>
            <p>
                Demi keamanan data siswa, reset password hanya dapat dilakukan melalui verifikasi manual oleh <strong>Admin MayClass</strong>.
            </p>

            <div class="steps-list">
                <div class="step-item">
                    <div class="step-num">1</div>
                    <div class="step-content">
                        <strong>Kirim Pesan</strong>
                        <span>Klik tombol di bawah untuk chat admin.</span>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-num">2</div>
                    <div class="step-content">
                        <strong>Verifikasi Data</strong>
                        <span>Sebutkan Nama & Kelas untuk pengecekan.</span>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-num">3</div>
                    <div class="step-content">
                        <strong>Terima Akses</strong>
                        <span>Admin akan memberikan password baru.</span>
                    </div>
                </div>
            </div>

            {{-- Asumsi variabel ini dikirim dari controller Laravel --}}
            @if ($whatsappLink ?? false)
                <a class="whatsapp-btn" href="{{ $whatsappLink }}" target="_blank" rel="noopener">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.008-.57-.008-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Hubungi Admin MayClass
                </a>
            @else
                <div class="steps-list" style="text-align: center; background: rgba(255,255,255,0.6);">
                    Admin belum tersedia saat ini.
                </div>
            @endif
        </main>
    </div>

</body>
</html>