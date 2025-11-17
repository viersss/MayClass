<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
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

            /* LOGO DIPERBESAR */
            .brand img {
                height: clamp(70px, 6vw, 72px); /* kecil 56px, naik responsif, maksimum 72px */
                width: auto;                    /* jaga proporsi gambar */
                object-fit: contain;
            }

            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }

            .profile-icon-btn {
                width: 46px;
                height: 46px;
                border-radius: 50%;
                border: 1px solid rgba(61, 183, 173, 0.35);
                background: rgba(61, 183, 173, 0.12);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: var(--primary-dark);
            }

            .profile-icon-btn svg {
                width: 22px;
                height: 22px;
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
                cursor: pointer;
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

            .info-alert {
                padding: 12px 16px;
                border-radius: 16px;
                background: rgba(252, 211, 77, 0.18);
                color: #92400e;
                font-size: 0.9rem;
            }

            .order-chip {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 16px;
                border-radius: 999px;
                background: rgba(61, 183, 173, 0.12);
                color: var(--primary-dark);
                font-weight: 600;
                font-size: 0.9rem;
            }

            .two-column {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            @media (max-width: 640px) {
                .two-column {
                    grid-template-columns: 1fr;
                }
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

            .payment-box {
                border-radius: 18px;
                padding: 20px 22px;
                background: rgba(61, 183, 173, 0.06);
                border: 1.5px solid rgba(61, 183, 173, 0.25);
                display: grid;
                gap: 6px;
            }

            .payment-box-title {
                font-weight: 600;
                color: var(--primary-dark);
            }

            .payment-box-row {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 8px;
                font-size: 0.95rem;
                color: var(--text-muted);
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
                font-size: 0.95rem;
            }

            .upload-preview {
                border-radius: 18px;
                border: 1.5px solid rgba(61, 183, 173, 0.25);
                padding: 16px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                background: rgba(61, 183, 173, 0.05);
            }

            .upload-preview[data-empty="true"] {
                color: var(--text-muted);
                font-style: italic;
            }

            .preview-clear {
                border: none;
                background: transparent;
                color: var(--primary-dark);
                font-weight: 600;
                cursor: pointer;
            }

            .countdown-banner {
                border-radius: 20px;
                padding: 18px 22px;
                background: rgba(249, 181, 59, 0.15);
                border: 1px solid rgba(249, 181, 59, 0.4);
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 12px;
            }

            .countdown-banner strong {
                font-size: 1.4rem;
                letter-spacing: 0.08em;
            }

            .countdown-note {
                margin: 0;
                color: rgba(49, 46, 31, 0.8);
                font-size: 0.9rem;
            }

            .countdown-banner[data-status='expired'] {
                background: rgba(248, 113, 113, 0.14);
                border-color: rgba(248, 113, 113, 0.4);
                color: #b91c1c;
            }

            .is-disabled {
                opacity: 0.6;
                cursor: not-allowed;
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

            /* ===== Copy button styles ===== */
            .copy-inline {
                display: inline-flex;
                align-items: center;
                gap: 10px;
            }

            .icon-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 36px;
                height: 36px;
                border-radius: 10px;
                border: 1px solid rgba(61, 183, 173, 0.3);
                background: rgba(255, 255, 255, 0.85);
                color: var(--primary-dark);
                cursor: pointer;
                transition: transform 0.15s ease, box-shadow 0.2s ease, background 0.2s ease;
            }
            .icon-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 10px 20px rgba(35, 109, 105, 0.15);
            }
            .icon-btn svg {
                width: 18px;
                height: 18px;
            }
            .icon-btn .icon-check {
                display: none;
            }
            .icon-btn.copied {
                background: rgba(61, 183, 173, 0.15);
                border-color: rgba(61, 183, 173, 0.5);
            }
            .icon-btn.copied .icon-copy {
                display: none;
            }
            .icon-btn.copied .icon-check {
                display: block;
            }

            /* ===== WhatsApp button ===== */
            .help-actions {
                margin-top: 10px;
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
            }
            .whatsapp-btn {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 12px 18px;
                border-radius: 999px;
                border: none;
                background: #25d366;
                color: #ffffff;
                font-weight: 600;
                cursor: pointer;
                box-shadow: 0 12px 24px rgba(37, 211, 102, 0.25);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .whatsapp-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 16px 32px rgba(37, 211, 102, 0.35);
            }
            .whatsapp-btn svg {
                width: 18px;
                height: 18px;
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
                        <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass" />
                    </a>
                    <div class="nav-actions">
                        <a
                            class="nav-btn"
                            href="{{ route('packages.index') }}"
                        >
                            Kembali ke Paket
                        </a>
                        @auth
                            <a class="profile-icon-btn" href="{{ route('student.profile') }}" aria-label="Lihat profil">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 3c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4Z" />
                                </svg>
                                <span class="sr-only">Profil</span>
                            </a>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="nav-btn"
                                    style="background: rgba(31, 42, 55, 0.05); border-color: transparent;"
                                >
                                    Keluar
                                </button>
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
                    <input type="hidden" name="order_id" value="{{ $order->id }}" />
                    <input type="hidden" name="payment_method" value="transfer_bank" />
                    @error('order_id')
                        <div class="error-alert" role="alert">{{ $message }}</div>
                    @enderror
                    @if (session('checkout_expired'))
                        <div class="info-alert" role="status">Sesi checkout sebelumnya telah berakhir. Kami menyiapkan sesi baru agar kamu bisa melanjutkan pembayaran.</div>
                    @endif
                    @php($orderCode = 'MC-' . str_pad((string) $order->id, 6, '0', STR_PAD_LEFT))
                    @php($countdownLabel = sprintf('%02d:%02d', floor($countdownSeconds / 60), $countdownSeconds % 60))

                    <div>
                        <h1>Checkout</h1>
                        <p style="color: var(--text-muted); margin: 12px 0 0;">
                            Lengkapi data yang dibutuhkan untuk mengamankan akses ke {{ $package['detail_title'] }}.
                        </p>
                        <div class="order-chip">ID Pesanan: {{ $orderCode }}</div>
                        <div
                            style="
                                margin-top: 16px;
                                display: inline-flex;
                                flex-wrap: wrap;
                                gap: 10px 14px;
                                padding: 12px 18px;
                                border-radius: 18px;
                                background: rgba(61, 183, 173, 0.08);
                                color: var(--text-muted);
                                font-size: 0.95rem;
                            "
                        >
                            <span>{{ $package['stage_label'] ?? $package['stage'] ?? 'Program' }}</span>
                            @if (! empty($package['grade_range']))
                                <span>• {{ $package['grade_range'] }}</span>
                            @endif
                        </div>
                    </div>

                    <div
                        class="countdown-banner"
                        data-countdown
                        data-remaining="{{ $countdownSeconds }}"
                        data-expire-endpoint="{{ route('checkout.expire', [$package['slug'], $order->id]) }}"
                    >
                        <div>
                            <small>Batas Pembayaran</small>
                            <strong data-countdown-display>{{ $countdownLabel }}</strong>
                        </div>
                        <p class="countdown-note" data-countdown-note>Segera unggah bukti pembayaran sebelum waktu berakhir.</p>
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
                        <label>Detail Rekening Pembayaran</label>
                        <div class="payment-box">
                            <div class="payment-box-title">Transfer Bank ke Rekening Berikut</div>
                            <div class="payment-box-row">
                                <span>Bank</span>
                                <span><strong>BANK BCA</strong></span>
                            </div>
                            <div class="payment-box-row">
                                <span>Nomor Rekening</span>
                                <span class="copy-inline">
                                    <strong id="account-number">1234 5678 90</strong>
                                    <button
                                        type="button"
                                        class="icon-btn copy-btn"
                                        data-target="#account-number"
                                        aria-label="Salin nomor rekening"
                                        title="Salin nomor rekening"
                                    >
                                        <!-- Copy icon (siluet) -->
                                        <svg class="icon-copy" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                            <path d="M9 9h7a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8"/>
                                            <path d="M7 15H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v1" stroke="currentColor" stroke-width="1.8"/>
                                        </svg>
                                        <!-- Check icon (saat berhasil) -->
                                        <svg class="icon-check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                            <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                            <div class="payment-box-row">
                                <span>Atas Nama</span>
                                <span><strong>Maylina</strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="two-column">
                        <div class="input-group">
                            <label for="cardholder_name">Nama Pemilik Rekening</label>
                            <input
                                id="cardholder_name"
                                type="text"
                                name="cardholder_name"
                                value="{{ old('cardholder_name', auth()->user()->name ?? '') }}"
                                placeholder="Masukkan nama pada rekening"
                                required
                            />
                            @error('cardholder_name')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="card_number">Nomor Rekening / VA Pengirim</label>
                            <input
                                id="card_number"
                                type="text"
                                name="card_number"
                                value="{{ old('card_number') }}"
                                placeholder="Contoh: 1234 5678 9999"
                                required
                            />
                            @error('card_number')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="payment-proof">Unggah Bukti Pembayaran</label>
                        <label class="upload-box" for="payment-proof">
                            Tarik &amp; letakkan bukti transaksi atau klik untuk mengunggah
                        </label>
                        <input
                            id="payment-proof"
                            type="file"
                            name="payment_proof"
                            accept=".jpg,.jpeg,.png,.pdf"
                            style="display: none;"
                            required
                        />
                        <div class="upload-preview" data-upload-preview data-empty="true">
                            <span data-upload-filename>Belum ada file yang dipilih.</span>
                            <button type="button" class="preview-clear" data-clear-upload>Hapus</button>
                        </div>
                        @error('payment_proof')
                            <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="confirm-btn" type="submit">Konfirmasi Pembayaran</button>
                </form>

                <aside class="summary-card">
                    <div>
                        <h2>Ringkasan Pembayaran</h2>
                        <p style="margin: 8px 0 0; color: var(--text-muted);">
                            {{ $package['detail_title'] }}
                        </p>
                        <p style="margin: 6px 0 0; color: var(--text-muted); font-size: 0.85rem;">
                            {{ $package['stage_label'] ?? $package['stage'] ?? 'Program' }}@if (! empty($package['grade_range'])) • {{ $package['grade_range'] }} @endif
                        </p>
                    </div>
                    <ul>
                        <li>
                            <span>Jenjang</span>
                            <span>{{ $package['stage_label'] ?? $package['stage'] ?? '—' }}</span>
                        </li>
                        @if (! empty($package['grade_range']))
                            <li>
                                <span>Rentang kelas</span>
                                <span>{{ $package['grade_range'] }}</span>
                            </li>
                        @endif
                        @php
                            $subtotal = $order->subtotal ?? ($package['price_numeric'] ?? 0);
                            $total = $order->total ?? $subtotal;
                        @endphp
                        <li>
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </li>
                        <li>
                            <span>Coupon Discount</span>
                            <span>Rp 0</span>
                        </li>
                        <!-- Baris Pajak (PPN 11%) DIHAPUS sesuai permintaan -->
                        <li class="total">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                    <div>
                        <h3 style="margin: 0 0 12px;">Butuh bantuan?</h3>
                        <p style="margin: 0 0 12px; color: var(--text-muted);">
                            Jika ada kendala pembayaran, silakan hubungi Admin MayClass melalui WhatsApp.
                        </p>

                        @php
                            // Ganti nomor default di bawah dengan nomor WhatsApp admin Anda (format internasional, tanpa +)
                            $whatsapp_number = config('services.whatsapp.finance_admin', '6281234567890');
                            $wa_message = rawurlencode('Halo Admin Keuangan MayClass, saya butuh bantuan pembayaran untuk paket ' . ($package['detail_title'] ?? ''));
                            $wa_link = "https://wa.me/{$whatsapp_number}?text={$wa_message}";
                        @endphp
                        <div class="help-actions">
                            <a class="whatsapp-btn" href="{{ $wa_link }}" target="_blank" rel="noopener">
                                <!-- WhatsApp icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" focusable="false">
                                    <path fill="currentColor" d="M19.7 17.5c-.3-.1-1.7-.8-2-.9s-.5-.1-.7.1-.8.9-1 1.1-.4.2-.7.1a6.7 6.7 0 0 1-2-1.2 7.5 7.5 0 0 1-1.4-1.7c-.2-.3 0-.5.1-.7l.5-.5c.2-.2.3-.4.4-.6s0-.4 0-.6c0-.1-.7-1.7-1-2.3s-.6-.5-.8-.5h-.7a1.3 1.3 0 0 0-1 .5 4.1 4.1 0 0 0-1.3 3.1 7.2 7.2 0 0 0 1.5 3.8 15.8 15.8 0 0 0 3.8 3.6 8.7 8.7 0 0 0 3.7 1.6 3.9 3.9 0 0 0 2.6-.4 3.3 3.3 0 0 0 1.1-2.1c.1-1.1.1-1 .1-1.1s-.2-.1-.5-.2Z"/>
                                    <path fill="currentColor" d="M27.5 4.5A14 14 0 0 0 4.3 24.4L3 29l4.7-1.2A14 14 0 1 0 27.4 4.5ZM16 26.1a10 10 0 0 1-5.1-1.4l-.4-.2-3 .8.8-2.9-.3-.4a10.1 10.1 0 1 1 8-18 10.1 10.1 0 0 1 0 22.1Z"/>
                                </svg>
                                Chat WhatsApp
                            </a>
                        </div>
                    </div>
                </aside>
            </main>
        </div>

        <script>
            (function () {
                'use strict';

                function copyTextToClipboard(text) {
                    if (navigator.clipboard && window.isSecureContext) {
                        return navigator.clipboard.writeText(text);
                    } else {
                        // Fallback untuk HTTP/non-secure context
                        const textArea = document.createElement('textarea');
                        textArea.value = text;
                        textArea.style.position = 'fixed';
                        textArea.style.top = '-9999px';
                        document.body.appendChild(textArea);
                        textArea.focus();
                        textArea.select();
                        try {
                            document.execCommand('copy');
                            document.body.removeChild(textArea);
                            return Promise.resolve();
                        } catch (err) {
                            document.body.removeChild(textArea);
                            return Promise.reject(err);
                        }
                    }
                }

                document.addEventListener('DOMContentLoaded', function () {
                    const buttons = document.querySelectorAll('.copy-btn');
                    buttons.forEach(function (btn) {
                        btn.addEventListener('click', function () {
                            const targetSel = btn.getAttribute('data-target');
                            const target = document.querySelector(targetSel);
                            if (!target) return;

                            const raw = target.textContent || '';
                            const value = raw.replace(/\D+/g, '') || raw.trim();

                            copyTextToClipboard(value)
                                .then(function () {
                                    btn.classList.add('copied');
                                    btn.setAttribute('aria-label', 'Disalin!');
                                    btn.title = 'Disalin!';
                                    setTimeout(function () {
                                        btn.classList.remove('copied');
                                        btn.setAttribute('aria-label', 'Salin nomor rekening');
                                        btn.title = 'Salin nomor rekening';
                                    }, 1800);
                                })
                                .catch(function () {
                                    btn.classList.add('copied');
                                    setTimeout(function () {
                                        btn.classList.remove('copied');
                                    }, 1200);
                                });
                        });
                    });

                    setupProofPreview();
                    setupCountdown();
                });

                function setupProofPreview() {
                    const input = document.getElementById('payment-proof');
                    const preview = document.querySelector('[data-upload-preview]');
                    const label = document.querySelector('[data-upload-filename]');
                    const clearBtn = document.querySelector('[data-clear-upload]');

                    if (!input || !preview || !label) {
                        return;
                    }

                    const render = function (file) {
                        if (!file) {
                            preview.dataset.empty = 'true';
                            label.textContent = 'Belum ada file yang dipilih.';

                            return;
                        }

                        preview.dataset.empty = 'false';
                        const size = Math.max(1, Math.round(file.size / 1024));
                        label.textContent = file.name + ' (' + size + ' KB)';
                    };

                    input.addEventListener('change', function () {
                        render(this.files && this.files[0]);
                    });

                    clearBtn?.addEventListener('click', function () {
                        input.value = '';
                        render(null);
                    });

                    render(input.files && input.files[0]);
                }

                function setupCountdown() {
                    const banner = document.querySelector('[data-countdown]');
                    if (!banner) {
                        return;
                    }

                    let remaining = parseInt(banner.getAttribute('data-remaining') || '0', 10);
                    const display = banner.querySelector('[data-countdown-display]');
                    const note = banner.querySelector('[data-countdown-note]');
                    const expireEndpoint = banner.getAttribute('data-expire-endpoint');
                    const form = document.querySelector('form.checkout-card');
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    let expired = false;

                    const updateDisplay = function () {
                        const minutes = Math.max(0, Math.floor(remaining / 60));
                        const seconds = Math.max(0, remaining % 60);
                        if (display) {
                            display.textContent = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
                        }
                    };

                    const lockForm = function () {
                        if (!form) {
                            return;
                        }

                        form.querySelectorAll('input, button, textarea, select').forEach(function (el) {
                            if (el.type === 'hidden') {
                                return;
                            }

                            el.disabled = true;
                            el.classList.add('is-disabled');
                        });
                    };

                    const markExpired = function () {
                        if (expired) {
                            return;
                        }

                        expired = true;
                        remaining = 0;
                        updateDisplay();
                        banner.dataset.status = 'expired';
                        if (note) {
                            note.textContent = 'Waktu pembayaran telah habis. Muat ulang halaman untuk sesi baru.';
                        }
                        lockForm();

                        if (expireEndpoint && token) {
                            fetch(expireEndpoint, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json',
                                },
                                credentials: 'same-origin',
                            }).catch(function () {
                                /* no-op */
                            });
                        }
                    };

                    updateDisplay();

                    if (remaining <= 0) {
                        markExpired();

                        return;
                    }

                    setInterval(function () {
                        if (expired) {
                            return;
                        }

                        remaining = Math.max(0, remaining - 1);
                        updateDisplay();

                        if (remaining === 0) {
                            markExpired();
                        }
                    }, 1000);
                }
            })();
        </script>
    </body>
</html>
