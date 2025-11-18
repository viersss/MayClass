<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Pembayaran Berhasil - MayClass</title>
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
                --primary-dark: #2a938a;
                --accent: #58d2c5;
                --text-dark: #1f2a37;
                --text-muted: #64748b;
                --surface: #ffffff;
                --background: linear-gradient(180deg, #e9f8f7 0%, #f6fffe 100%);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: var(--background);
                color: var(--text-dark);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            header {
                padding: 32px 0 0;
            }

            .container {
                width: 100%;
                max-width: 1100px;
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
                gap: 12px;
                font-weight: 600;
                font-size: 1.2rem;
                color: var(--primary-dark);
            }

            .brand img {
                width: 44px;
                height: 44px;
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
                width: 44px;
                height: 44px;
                border-radius: 50%;
                border: 1px solid rgba(61, 183, 173, 0.35);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: var(--primary-dark);
                background: rgba(61, 183, 173, 0.1);
                overflow: hidden;
            }

            .profile-icon-btn img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            main {
                flex: 1;
                display: grid;
                place-items: center;
                padding: 32px 0 64px;
            }

            .success-card {
                background: var(--surface);
                border-radius: 32px;
                padding: clamp(32px, 4vw, 56px);
                width: min(760px, 100%);
                box-shadow: 0 48px 80px rgba(32, 96, 92, 0.15);
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .success-card::before {
                content: "";
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at top right, rgba(88, 210, 197, 0.25), transparent 55%);
                pointer-events: none;
            }

            .status-icon {
                width: 88px;
                height: 88px;
                border-radius: 50%;
                background: rgba(61, 183, 173, 0.12);
                margin: 0 auto 24px;
                display: grid;
                place-items: center;
                color: var(--primary);
            }

            .status-icon svg {
                width: 42px;
                height: 42px;
            }

            h1 {
                margin: 0 0 16px;
                font-size: clamp(1.9rem, 3vw, 2.6rem);
                line-height: 1.3;
            }

            p {
                margin: 0 0 32px;
                color: var(--text-muted);
                line-height: 1.7;
            }

            .order-summary {
                margin: 0 auto 32px;
                padding: 24px 28px;
                border-radius: 20px;
                background: rgba(61, 183, 173, 0.08);
                display: grid;
                gap: 12px;
                text-align: left;
                color: var(--primary-dark);
            }

            .order-summary strong {
                color: var(--text-dark);
            }

            .cta-group {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                justify-content: center;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 14px 28px;
                border-radius: 999px;
                font-weight: 500;
                border: 1px solid transparent;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                cursor: pointer;
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--primary) 0%, var(--accent) 100%);
                color: #ffffff;
                box-shadow: 0 22px 45px rgba(61, 183, 173, 0.28);
            }

            .btn-outline {
                background: transparent;
                border-color: rgba(61, 183, 173, 0.35);
                color: var(--primary-dark);
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            .activation-modal {
                position: fixed;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(15, 23, 42, 0.55);
                backdrop-filter: blur(4px);
                z-index: 999;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.2s ease;
            }

            .activation-modal.is-visible {
                opacity: 1;
                pointer-events: auto;
            }

            .activation-modal__content {
                background: #ffffff;
                border-radius: 20px;
                padding: clamp(28px, 6vw, 40px);
                max-width: 420px;
                width: 90%;
                text-align: center;
                box-shadow: 0 35px 65px rgba(15, 23, 42, 0.25);
                display: grid;
                gap: 18px;
            }

            .activation-modal__icon {
                width: 64px;
                height: 64px;
                border-radius: 50%;
                background: rgba(47, 152, 140, 0.15);
                color: var(--primary);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto;
            }

            .activation-modal__title {
                margin: 0;
                font-size: 1.3rem;
                font-weight: 600;
            }

            .activation-modal__text {
                margin: 0;
                color: rgba(15, 23, 42, 0.75);
            }

            .activation-modal__cta {
                background: var(--primary);
                color: #ffffff;
                border: none;
                border-radius: 999px;
                padding: 14px 24px;
                font-weight: 600;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .activation-modal__cta:hover,
            .activation-modal__cta:focus-visible {
                transform: translateY(-1px);
                box-shadow: 0 15px 35px rgba(47, 152, 140, 0.35);
            }

            footer {
                padding: 24px 0 40px;
                text-align: center;
                color: var(--text-muted);
                font-size: 0.85rem;
            }

            @media (max-width: 600px) {
                .success-card {
                    padding: 28px;
                }

                .order-summary {
                    padding: 18px 20px;
                }
            }
        </style>
    </head>
    <body>
        @php($profileLink = $profileLink ?? null)
        @php($profileAvatar = $profileAvatar ?? asset('images/avatar-placeholder.svg'))
        <header>
            <div class="container">
                <nav>
                    <a href="/" class="brand">
                        <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass" />
                    </a>
                    <div class="nav-actions">
                        <a class="btn btn-outline" href="{{ route('packages.index') }}">Lihat Paket Lain</a>
                        @auth
                            <a class="profile-icon-btn" href="{{ $profileLink ?? route('student.profile') }}" aria-label="Lihat profil">
                                <img src="{{ $profileAvatar }}" alt="Foto profil MayClass" />
                                <span class="sr-only">Profil</span>
                            </a>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline" style="background: rgba(31, 42, 55, 0.05); border-color: transparent;">Keluar</button>
                            </form>
                        @endauth
                    </div>
                </nav>
            </div>
        </header>
        @php($status = $order->status ?? 'pending')
        @php($isPending = $status === 'pending')
        <main>
            <div class="success-card">
                <div class="status-icon" aria-hidden="true" style="color: {{ $isPending ? '#f59e0b' : 'var(--primary)' }}; background: {{ $isPending ? 'rgba(245, 158, 11, 0.12)' : 'rgba(61, 183, 173, 0.12)' }};">
                    @if ($isPending)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2Zm.75 5v5.09l3.62 2.17-.75 1.23-4.12-2.49V7H12.75Z" fill="currentColor"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M9.00016 16.2001L4.80016 12.0001L3.40016 13.4001L9.00016 19.0001L21.0002 7.00006L19.6002 5.60006L9.00016 16.2001Z"
                                fill="currentColor"
                            />
                        </svg>
                    @endif
                </div>
                <h1>{{ $isPending ? 'Bukti Pembayaran Diterima' : 'Pembayaran Berhasil!' }}</h1>
                <p>
                    Terima kasih telah mempercayakan perjalanan belajar bersama MayClass. Status paket
                    <strong>{{ $package['detail_title'] }}</strong> kini <strong>{{ $isPending ? 'menunggu verifikasi admin' : 'aktif dan siap dipakai' }}</strong>.
                    <br />
                    <span style="display: inline-block; margin-top: 8px; font-size: 0.95rem; color: rgba(100, 116, 139, 0.9);">
                        {{ $package['stage_label'] ?? $package['stage'] ?? 'Program' }}@if (! empty($package['grade_range'])) • {{ $package['grade_range'] }} @endif
                    </span>
                    @if ($isPending)
                        Tim keuangan kami akan mengecek pembayaran Anda maksimal 1x24 jam kerja. Anda akan menerima notifikasi begitu akses aktif.
                    @else
                        Silakan masuk kembali untuk menikmati materi, quiz, dan jadwal terbaru sesuai akunmu.
                    @endif
                </p>
                <div class="order-summary">
                    <div><strong>Paket:</strong> {{ $package['detail_title'] }}</div>
                    <div><strong>Jenjang:</strong> {{ $package['stage_label'] ?? $package['stage'] ?? '—' }}</div>
                    @if (! empty($package['grade_range']))
                        <div><strong>Rentang kelas:</strong> {{ $package['grade_range'] }}</div>
                    @endif
                    <div><strong>ID Pesanan:</strong> MC-{{ str_pad((string) $order->id, 6, '0', STR_PAD_LEFT) }}</div>
                    <div><strong>Total Dibayar:</strong> Rp {{ number_format((int) $order->total, 0, ',', '.') }}</div>
                    <div><strong>Email Konfirmasi:</strong> {{ optional($order->user)->email ?? 'Akun MayClass Anda' }}</div>
                    <div><strong>Status:</strong> {{ $isPending ? 'Menunggu verifikasi' : 'Terverifikasi' }}</div>
                </div>
                <div class="cta-group">
                    <a class="btn btn-primary" href="{{ route('student.dashboard') }}">Kembali ke Dashboard</a>
                    <a class="btn btn-outline" href="{{ route('packages.index') }}">Lihat Paket Lain</a>
                </div>
            </div>
        </main>
        <footer>© {{ now()->year }} MayClass. Tetap semangat belajar!</footer>

        @if (! empty($showActivationModal))
            <div class="activation-modal" data-activation-modal aria-live="assertive">
                <div class="activation-modal__content" role="dialog" aria-modal="true" aria-labelledby="activation-modal-title">
                    <div class="activation-modal__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="32" height="32">
                            <path d="M9 16.2 4.8 12l-1.4 1.4L9 19l12-12-1.4-1.4L9 16.2Z" fill="currentColor" />
                        </svg>
                    </div>
                    <h2 class="activation-modal__title" id="activation-modal-title">Paket Belajar Aktif</h2>
                    <p class="activation-modal__text">Pembayaran Anda telah diverifikasi oleh admin.</p>
                    <button type="button" class="activation-modal__cta" data-start-learning="true">Mulai belajar</button>
                </div>
            </div>
        @endif

        @if ($isPending && ! empty($statusCheckUrl ?? null))
            <script>
                (function () {
                    const statusUrl = @json($statusCheckUrl);
                    const refreshUrl = new URL(@json(route('checkout.success', ['slug' => $package['slug'], 'order' => $order->id])), window.location.origin);
                    refreshUrl.searchParams.set('activated', '1');
                    const retryDelay = 8000;

                    const pollStatus = () => {
                        fetch(statusUrl, {
                            headers: {
                                'Accept': 'application/json',
                            },
                            credentials: 'same-origin',
                        })
                            .then((response) => {
                                if (!response.ok) {
                                    throw new Error('Status request failed');
                                }
                                return response.json();
                            })
                            .then((payload) => {
                                if (payload?.status === 'paid' || payload?.should_redirect) {
                                    window.location.href = refreshUrl.toString();
                                    return;
                                }

                                setTimeout(pollStatus, retryDelay);
                            })
                            .catch(() => {
                                setTimeout(pollStatus, retryDelay * 1.5);
                            });
                    };

                    pollStatus();
                })();
            </script>
        @endif
        @if (! empty($showActivationModal))
            <script>
                (function () {
                    const modal = document.querySelector('[data-activation-modal]');
                    if (!modal) {
                        return;
                    }

                    const startLearning = modal.querySelector('[data-start-learning]');
                    const destination = @json($activationRedirectUrl ?? route('student.dashboard'));

                    requestAnimationFrame(() => {
                        modal.classList.add('is-visible');
                    });

                    if (startLearning) {
                        startLearning.addEventListener('click', () => {
                            window.location.href = destination;
                        });
                    }

                    const currentUrl = new URL(window.location.href);
                    if (currentUrl.searchParams.has('activated')) {
                        currentUrl.searchParams.delete('activated');
                        window.history.replaceState({}, document.title, currentUrl.toString());
                    }
                })();
            </script>
        @endif
    </body>
</html>
