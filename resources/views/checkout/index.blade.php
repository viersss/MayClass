<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Checkout - {{ $package['detail_title'] }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                color-scheme: light;
                --primary: #3db7ad;
                --primary-dark: #2f8f87;
                --accent: #f9b233;
                --text-dark: #1f2a37;
                --text-muted: #6b7280;
                --bg: #f3fbfb;
                --card: #ffffff;
                --shadow: 0 32px 55px rgba(28, 87, 86, 0.18);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: linear-gradient(180deg, #f4ffff 0%, #e6f4f3 100%);
                color: var(--text-dark);
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            header {
                padding: 32px 0 16px;
            }

            .container {
                width: min(1180px, 92vw);
                margin: 0 auto;
            }

            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 14px;
                font-weight: 600;
                font-size: 1.3rem;
                color: var(--primary-dark);
            }

            .brand-icon {
                width: 44px;
                height: 44px;
                border-radius: 12px;
                background: var(--primary);
                display: grid;
                place-items: center;
                color: #fff;
                font-weight: 700;
                box-shadow: 0 18px 35px rgba(61, 183, 173, 0.28);
            }

            .nav-btn {
                padding: 10px 24px;
                border-radius: 999px;
                border: 1px solid rgba(61, 183, 173, 0.35);
                background: rgba(255, 255, 255, 0.85);
                color: var(--primary-dark);
                font-weight: 500;
                font-size: 0.95rem;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .nav-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 18px 36px rgba(35, 109, 105, 0.2);
            }

            main {
                display: grid;
                grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
                gap: 48px;
                align-items: start;
                padding: 32px 0 72px;
            }

            .checkout-card,
            .summary-card {
                background: var(--card);
                border-radius: 32px;
                box-shadow: var(--shadow);
                padding: 36px;
                display: grid;
                gap: 24px;
            }

            h1 {
                margin: 0;
                font-size: clamp(2rem, 2.8vw, 2.5rem);
            }

            .checkout-card label {
                display: block;
                font-weight: 500;
                color: var(--text-muted);
                margin-bottom: 8px;
            }

            .payment-options {
                display: flex;
                gap: 16px;
                flex-wrap: wrap;
            }

            .payment-option {
                flex: 1;
                min-width: 120px;
                border-radius: 16px;
                padding: 16px 18px;
                background: rgba(61, 183, 173, 0.12);
                border: 1px solid rgba(61, 183, 173, 0.2);
                font-weight: 600;
                color: var(--primary-dark);
                text-align: center;
            }

            .input {
                width: 100%;
                border-radius: 16px;
                border: 1.5px solid rgba(61, 183, 173, 0.25);
                padding: 16px 18px;
                font-size: 1rem;
                font-family: inherit;
                transition: border 0.2s ease, box-shadow 0.2s ease;
                background: rgba(255, 255, 255, 0.9);
            }

            .input:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 4px rgba(61, 183, 173, 0.18);
            }

            .upload-box {
                border: 2px dashed rgba(61, 183, 173, 0.35);
                border-radius: 18px;
                padding: 24px;
                text-align: center;
                color: var(--text-muted);
            }

            .confirm-btn {
                padding: 16px 28px;
                border-radius: 999px;
                border: none;
                background: var(--primary);
                color: #fff;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .confirm-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 20px 40px rgba(32, 105, 101, 0.25);
            }

            .summary-card h2 {
                margin: 0;
                font-size: 1.3rem;
            }

            .summary-card ul {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 12px;
            }

            .summary-card li {
                display: flex;
                justify-content: space-between;
                align-items: center;
                color: var(--text-muted);
            }

            .summary-card li.total {
                color: var(--text-dark);
                font-weight: 600;
                font-size: 1.1rem;
            }

            footer {
                background: #102a43;
                color: rgba(255, 255, 255, 0.7);
                padding: 48px 0;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 24px;
            }

            .footer-grid h4 {
                margin: 0 0 16px;
                font-size: 1rem;
                color: #fff;
            }

            .footer-grid ul {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 10px;
                font-size: 0.9rem;
            }

            .copyright {
                margin-top: 36px;
                text-align: center;
                font-size: 0.85rem;
                opacity: 0.7;
            }

            @media (max-width: 960px) {
                main {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <a href="/" class="brand">
                        <span class="brand-icon">MC</span>
                        MayClass
                    </a>
                    <a class="nav-btn" style="padding: 10px 24px; border-radius: 999px; border: 1px solid rgba(61, 183, 173, 0.35);" href="{{ route('packages.index') }}">
                        ← Kembali ke Paket
                    </a>
                </nav>
            </div>
        </header>

        <div class="container">
            <main>
                <section class="checkout-card">
                    <div>
                        <h1>Checkout</h1>
                        <p style="color: var(--text-muted); margin: 12px 0 0;">
                            Lengkapi detail pembayaranmu untuk mengamankan akses ke {{ $package['detail_title'] }}.
                        </p>
                    </div>

                    <div>
                        <label>Metode Pembayaran</label>
                        <div class="payment-options">
                            <div class="payment-option">American Express</div>
                            <div class="payment-option">Visa</div>
                            <div class="payment-option">Transfer Bank</div>
                        </div>
                    </div>

                    <div>
                        <label>Nama pada Kartu</label>
                        <input class="input" type="text" placeholder="Masukkan nama sesuai kartu" />
                    </div>

                    <div>
                        <label>Nomor Kartu</label>
                        <input class="input" type="text" placeholder="0000 0000 0000 0000" />
                    </div>

                    <div>
                        <label>Unggah Bukti Pembayaran</label>
                        <div class="upload-box">
                            Tarik & letakkan bukti transaksi atau klik untuk mengunggah
                        </div>
                    </div>

                    <button class="confirm-btn" type="button">Confirm Payment</button>
                </section>

                <aside class="summary-card">
                    <div>
                        <h2>Ringkasan Pembayaran</h2>
                        <p style="margin: 8px 0 0; color: var(--text-muted);">{{ $package['detail_title'] }}</p>
                    </div>
                    <ul>
                        <li><span>Subtotal</span><span>Rp {{ number_format($package['price_numeric'], 0, ',', '.') }}</span></li>
                        <li><span>Coupon Discount</span><span>Rp 0</span></li>
                        <li><span>Pajak (PPN 11%)</span><span>Rp {{ number_format(round($package['price_numeric'] * 0.11), 0, ',', '.') }}</span></li>
                        @php
                            $total = $package['price_numeric'] + round($package['price_numeric'] * 0.11);
                        @endphp
                        <li class="total"><span>Total</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span></li>
                    </ul>
                    <div>
                        <h3 style="margin: 0 0 12px;">Dapatkan bantuan?</h3>
                        <p style="margin: 0; color: var(--text-muted);">Hubungi Admin Keuangan MayClass melalui live chat atau WhatsApp.</p>
                    </div>
                </aside>
            </main>
        </div>

        <footer>
            <div class="container">
                <div class="footer-grid">
                    <div>
                        <h4>Company</h4>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Help center</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Stay up to date</h4>
                        <ul>
                            <li>Promo bimbingan terbaru</li>
                            <li>Agenda kelas spesial</li>
                            <li>Tips belajar mingguan</li>
                        </ul>
                    </div>
                </div>
                <p class="copyright">© 2024 MayClass. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
