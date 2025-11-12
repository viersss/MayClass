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
                width: 100%;
                max-width: 1180px;
                margin: 0 auto;
                padding: 0 24px;
            }

            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 16px;
                flex-wrap: wrap;
            }

            .nav-actions form {
                margin: 0;
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 14px;
                font-weight: 600;
                font-size: 1.25rem;
                color: var(--primary-dark);
            }

            .brand img {
                width: 44px;
                height: 44px;
                object-fit: contain;
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

            .error-alert {
                margin: 8px 0 0;
                padding: 16px 18px;
                border-radius: 18px;
                background: rgba(220, 38, 38, 0.1);
                color: #991b1b;
                font-size: 0.85rem;
            }

            .error-alert ul {
                margin: 0;
                padding-left: 20px;
            }

            .input-error {
                color: #dc2626;
                font-size: 0.75rem;
                margin: 6px 0 0;
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
                        <img src="{{ \App\Support\ImageRepository::url('logo') }}" alt="Logo MayClass" />
                    </a>
                    <div class="nav-actions">
                        <a class="nav-btn" style="padding: 10px 24px; border-radius: 999px; border: 1px solid rgba(61, 183, 173, 0.35);" href="{{ route('packages.index') }}">
                            ← Kembali ke Paket
                        </a>
                        @auth
                            <a class="nav-btn" style="border-color: transparent; background: rgba(61, 183, 173, 0.15);" href="{{ route('student.profile') }}">
                                Profil
                            </a>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-btn" style="background: rgba(31, 42, 55, 0.05); border-color: transparent;">Keluar</button>
                            </form>
                        @endauth
                    </div>
                </nav>
            </div>
        </header>

        <div class="container">
            <main>
                <form
                    class="checkout-card"
                    method="post"
                    action="{{ route('checkout.process', $package['slug']) }}"
                    enctype="multipart/form-data"
                    novalidate
                >
                    @csrf
                    <div>
                        <h1>Checkout</h1>
                        <p style="color: var(--text-muted); margin: 12px 0 0;">
                            Lengkapi detail pembayaranmu untuk mengamankan akses ke {{ $package['detail_title'] }}.
                        </p>
                        <div
                            style="margin-top: 16px; display: inline-flex; flex-wrap: wrap; gap: 10px 14px; padding: 12px 18px; border-radius: 18px; background: rgba(61, 183, 173, 0.08); color: var(--text-muted); font-size: 0.95rem;"
                        >
                            <span>{{ $package['stage_label'] ?? $package['stage'] ?? 'Program' }}</span>
                            @if (! empty($package['grade_range']))
                                <span>• {{ $package['grade_range'] }}</span>
                            @endif
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="error-alert" role="alert" style="margin-top: 4px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label>Metode Pembayaran</label>
                        <div class="payment-options">
                            <label class="payment-option">
                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="american_express"
                                    @checked(old('payment_method', 'transfer_bank') === 'american_express')
                                />
                                American Express
                            </label>
                            <label class="payment-option">
                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="visa"
                                    @checked(old('payment_method', 'transfer_bank') === 'visa')
                                />
                                Visa
                            </label>
                            <label class="payment-option">
                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="transfer_bank"
                                    @checked(old('payment_method', 'transfer_bank') === 'transfer_bank')
                                />
                                Transfer Bank
                            </label>
                        </div>
                        @error('payment_method')
                            <p class="input-error" style="margin-top: 8px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cardholder-name">Nama pada Kartu</label>
                        <input
                            id="cardholder-name"
                            class="input"
                            type="text"
                            name="cardholder_name"
                            value="{{ old('cardholder_name') }}"
                            placeholder="Masukkan nama sesuai kartu"
                            required
                        />
                        @error('cardholder_name')
                            <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="card-number">Nomor Kartu</label>
                        <input
                            id="card-number"
                            class="input"
                            type="text"
                            name="card_number"
                            value="{{ old('card_number') }}"
                            placeholder="0000 0000 0000 0000"
                            required
                        />
                        @error('card_number')
                            <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="payment-proof">Unggah Bukti Pembayaran</label>
                        <label class="upload-box" for="payment-proof">
                            Tarik & letakkan bukti transaksi atau klik untuk mengunggah
                        </label>
                        <input
                            id="payment-proof"
                            type="file"
                            name="payment_proof"
                            accept=".jpg,.jpeg,.png,.pdf"
                            style="display: none;"
                            required
                        />
                        @error('payment_proof')
                            <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="confirm-btn" type="submit">Konfirmasi Pembayaran</button>
                </form>

                <aside class="summary-card">
                    <div>
                        <h2>Ringkasan Pembayaran</h2>
                        <p style="margin: 8px 0 0; color: var(--text-muted);">{{ $package['detail_title'] }}</p>
                        <p style="margin: 6px 0 0; color: var(--text-muted); font-size: 0.85rem;">
                            {{ $package['stage_label'] ?? $package['stage'] ?? 'Program' }}@if (! empty($package['grade_range'])) • {{ $package['grade_range'] }} @endif
                        </p>
                    </div>
                    <ul>
                        <li><span>Jenjang</span><span>{{ $package['stage_label'] ?? $package['stage'] ?? '—' }}</span></li>
                        @if (! empty($package['grade_range']))
                            <li><span>Rentang kelas</span><span>{{ $package['grade_range'] }}</span></li>
                        @endif
                        @php
                            $subtotal = $package['price_numeric'];
                            $tax = round($subtotal * 0.11);
                            $total = $subtotal + $tax;
                        @endphp
                        <li><span>Subtotal</span><span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span></li>
                        <li><span>Coupon Discount</span><span>Rp 0</span></li>
                        <li><span>Pajak (PPN 11%)</span><span>Rp {{ number_format($tax, 0, ',', '.') }}</span></li>
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
                <p class="copyright">© {{ now()->year }} MayClass. All rights reserved.</p>
            </div>
        </footer>

    </body>
</html>
