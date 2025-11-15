<!DOCTYPE html>
<html lang="id" data-mode="{{ $mode === 'register' ? 'register' : 'login' }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Masuk &amp; Registrasi</title>
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
                gap: 32px;
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
                font-size: clamp(0.9rem, 1.7vw, 1.9rem);
                font-weight: 400; /* atau 300 kalau mau lebih ringan */
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

            [data-copy-mode] {
                display: none;
            }

            html[data-mode="register"] [data-copy-mode="register"],
            html[data-mode="login"] [data-copy-mode="login"] {
                display: block;
            }

            .auth-panel {
                padding: 48px;
                background: #fdfefe;
                display: flex;
                flex-direction: column;
                gap: 32px;
            }

            .auth-header {
                text-align: center;
            }

            .auth-header h2 {
                margin: 0;
                font-size: 1.6rem;
                font-weight: 600;
            }

            .step-indicators {
                display: flex;
                justify-content: center;
            }

            .step-indicator {
                display: none;
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .step-dots {
                display: flex;
                gap: 12px;
            }

            .step-dot {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background: #ffffff;
                border: 1px solid rgba(31, 42, 55, 0.2);
                box-shadow: 0 2px 6px rgba(17, 24, 39, 0.15);
            }

            .step-dot--filled {
                background: #1f2a37;
                border-color: #1f2a37;
            }

            .step-label {
                margin: 0;
                font-size: 0.85rem;
                font-weight: 500;
                letter-spacing: 0.02em;
                color: var(--text-muted);
            }

            html[data-mode="register"] .step-indicator[data-step="register"],
            html[data-mode="login"] .step-indicator[data-step="login"] {
                display: flex;
            }

            .tab-switcher {
                display: inline-flex;
                background: rgba(66, 183, 173, 0.1);
                border-radius: 999px;
                padding: 6px;
                gap: 8px;
                margin-top: 16px;
            }

            .tab-switcher button {
                border: none;
                background: transparent;
                padding: 10px 24px;
                border-radius: 999px;
                font-family: inherit;
                font-weight: 500;
                font-size: 0.95rem;
                cursor: pointer;
                color: var(--text-muted);
                transition: all 0.2s ease;
            }

            html[data-mode="login"] .tab-switcher button[data-mode="login"],
            html[data-mode="register"] .tab-switcher button[data-mode="register"] {
                background: #fff;
                color: var(--accent-dark);
                box-shadow: 0 12px 25px rgba(66, 183, 173, 0.25);
            }

            form {
                display: none;
                flex-direction: column;
                gap: 16px;
                text-align: left;
            }

            .error-alert {
                padding: 12px 16px;
                border-radius: 12px;
                background: rgba(220, 38, 38, 0.1);
                color: #991b1b;
                font-size: 0.85rem;
                line-height: 1.5;
            }

            .status-alert {
                padding: 12px 16px;
                border-radius: 12px;
                background: rgba(66, 183, 173, 0.12);
                color: var(--accent-dark);
                font-size: 0.9rem;
                line-height: 1.5;
                text-align: center;
            }

            .google-error {
                margin: 0;
                margin-top: 12px;
                text-align: center;
                color: #dc2626;
                font-size: 0.8rem;
                line-height: 1.4;
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

            html[data-mode="login"] form[data-mode="login"],
            html[data-mode="register"] form[data-mode="register"] {
                display: flex;
            }

            label {
                font-weight: 500;
                font-size: 0.92rem;
                color: var(--text);
            }

            input,
            select {
                width: 100%;
                padding: 14px 16px;
                border-radius: 14px;
                border: 1.5px solid var(--outline);
                font-family: inherit;
                font-size: 0.95rem;
                transition: border 0.2s ease, box-shadow 0.2s ease;
                background: #fff;
            }

            input:focus,
            select:focus {
                outline: none;
                border-color: var(--accent);
                box-shadow: 0 0 0 3px rgba(66, 183, 173, 0.22);
            }

            .two-column {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
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

            .switch-message {
                text-align: center;
                color: var(--text-muted);
                font-size: 0.9rem;
            }

            .switch-message a {
                color: var(--accent-dark);
                font-weight: 500;
            }

            .form-support {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-top: 8px;
            }

            .form-helper {
                margin: 0;
                font-size: 0.78rem;
                color: var(--text-muted);
            }

            .terms-link {
                border: none;
                background: rgba(66, 183, 173, 0.12);
                color: var(--accent-dark);
                font-weight: 500;
                font-size: 0.78rem;
                padding: 8px 14px;
                border-radius: 999px;
                cursor: pointer;
                transition: background 0.2s ease, transform 0.2s ease;
            }

            .terms-link:hover {
                background: rgba(66, 183, 173, 0.22);
                transform: translateY(-1px);
            }

            .terms-modal {
                position: fixed;
                inset: 0;
                display: grid;
                place-items: center;
                background: rgba(17, 24, 39, 0.45);
                padding: 24px;
                z-index: 1000;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.2s ease;
            }

            .terms-modal[data-visible="true"] {
                opacity: 1;
                pointer-events: auto;
            }

            .terms-dialog {
                background: #fdfefe;
                border-radius: 24px;
                max-width: min(720px, 100%);
                max-height: min(90vh, 860px);
                overflow: hidden;
                display: flex;
                flex-direction: column;
                box-shadow: 0 35px 65px rgba(15, 52, 56, 0.3);
            }

            .terms-dialog header {
                padding: 24px 32px 16px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                background: linear-gradient(135deg, rgba(66, 183, 173, 0.12) 0%, rgba(66, 183, 173, 0.04) 100%);
            }

            .terms-dialog header h3 {
                margin: 0;
                font-size: 1.25rem;
                color: var(--accent-dark);
            }

            .terms-close {
                border: none;
                background: rgba(255, 255, 255, 0.85);
                border-radius: 50%;
                width: 36px;
                height: 36px;
                display: grid;
                place-items: center;
                font-size: 1.1rem;
                cursor: pointer;
                color: var(--accent-dark);
                box-shadow: 0 10px 24px rgba(66, 183, 173, 0.25);
                transition: transform 0.2s ease;
            }

            .terms-close:hover {
                transform: translateY(-1px);
            }

            .terms-body {
                padding: 24px 32px 32px;
                overflow-y: auto;
                color: var(--text);
            }

            .terms-body h4 {
                margin-top: 0;
                margin-bottom: 8px;
                font-size: 1.05rem;
                color: var(--accent-dark);
            }

            .terms-body p {
                margin: 0 0 16px;
                line-height: 1.6;
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            .terms-body ul {
                margin: 0 0 16px 20px;
                color: var(--text-muted);
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .terms-body strong {
                color: var(--accent-dark);
            }

            .terms-actions {
                padding: 16px 32px 28px;
                display: flex;
                justify-content: flex-end;
                background: linear-gradient(180deg, rgba(66, 183, 173, 0.08) 0%, rgba(66, 183, 173, 0) 100%);
            }

            .terms-actions button {
                border: none;
                background: linear-gradient(120deg, var(--accent) 0%, #5ed3c5 100%);
                color: #fff;
                font-weight: 600;
                font-size: 0.9rem;
                padding: 10px 20px;
                border-radius: 12px;
                cursor: pointer;
                box-shadow: 0 12px 24px rgba(66, 183, 173, 0.28);
                transition: transform 0.2s ease;
            }

            .terms-actions button:hover {
                transform: translateY(-1px);
            }

            .input-group {
                display: flex;
                flex-direction: column;
                gap: 6px;
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
            }

            @media (max-width: 520px) {
                .two-column {
                    grid-template-columns: 1fr;
                }

                .tab-switcher {
                    width: 100%;
                    justify-content: space-between;
                }

                .tab-switcher button {
                    flex: 1;
                }
            }
        </style>
    </head>
    <body>
        @php($profileData = $profile ?? [])
        <a class="back-link" href="{{ url('/') }}">
            <span aria-hidden="true">&lt;</span>
            Kembali
        </a>
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-illustration">
                    <div class="image-frame" aria-hidden="true">
                        <img src="{{ \App\Support\ImageRepository::url('auth') }}" alt="Ilustrasi siswa MayClass" />
                    </div>
                    <div>
                        <h1 data-copy-mode="register">
                            Daftar untuk akses penuh ke fitur belajar MayClass, mulai dari kelas interaktif hingga
                            pendampingan tentor profesional.
                        </h1>
                        <h1 data-copy-mode="login">                            
                            Masuk untuk akses penuh ke fitur belajar MayClass, mulai dari kelas interaktif hingga
                            pendampingan tentor profesional.
                        </h1>
                    </div>
                </div>
                <div class="auth-panel">
                    <div class="auth-header">
                        <h2>Selamat datang di MayClass</h2>
                        <div class="tab-switcher" role="tablist">
                            <button type="button" data-mode="register" role="tab" aria-selected="false">
                                Registrasi
                            </button>
                            <button type="button" data-mode="login" role="tab" aria-selected="false">
                                Masuk
                            </button>
                        </div>
                    </div>

                    <div class="step-indicators">
                        <div class="step-indicator" data-step="register" aria-live="polite">
                            <div class="step-dots" aria-hidden="true">
                                <span class="step-dot step-dot--filled"></span>
                                <span class="step-dot"></span>
                            </div>
                            <p class="step-label">Step 1 dari 2</p>
                        </div>
                        <div class="step-indicator" data-step="login" aria-live="polite">
                            <div class="step-dots" aria-hidden="true">
                                <span class="step-dot"></span>
                                <span class="step-dot step-dot--filled"></span>
                            </div>
                            <p class="step-label">Step 2 dari 2</p>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="status-alert" role="status">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="error-alert" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form data-mode="register" method="post" action="{{ route('register.details') }}" novalidate>
                        @csrf
                        <div class="two-column">
                            <div class="input-group">
                                <label for="register-name">Nama Lengkap</label>
                                <input
                                    id="register-name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $profileData['name'] ?? '') }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                />
                                @error('name')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="register-username">Username</label>
                                <input
                                    id="register-username"
                                    type="text"
                                    name="username"
                                    value="{{ old('username', $profileData['username'] ?? '') }}"
                                    placeholder="Pilih username unik"
                                    required
                                />
                                @error('username')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="two-column">
                            <div class="input-group">
                                <label for="register-email">Email</label>
                                <input
                                    id="register-email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $profileData['email'] ?? '') }}"
                                    placeholder="Masukkan email aktif"
                                    required
                                />
                                @error('email')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="register-phone">No. Tlp / WA</label>
                                <input
                                    id="register-phone"
                                    type="tel"
                                    name="phone"
                                    value="{{ old('phone', $profileData['phone'] ?? '') }}"
                                    placeholder="Masukkan nomor telepon"
                                />
                                @error('phone')
                                    <p class="input-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="register-gender">Jenis Kelamin</label>
                            @php($selectedGender = old('gender', $profileData['gender'] ?? ''))
                            <select id="register-gender" name="gender">
                                <option value="" disabled {{ $selectedGender ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                <option value="female" @selected($selectedGender === 'female')>Perempuan</option>
                                <option value="male" @selected($selectedGender === 'male')>Laki-laki</option>
                                <option value="other" @selected($selectedGender === 'other')>Lainnya</option>
                            </select>
                            @error('gender')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-support">
                            <p class="form-helper">Dengan melanjutkan, Anda menyetujui kebijakan layanan MayClass.</p>
                            <button class="terms-link" type="button" data-terms-open>
                                Ketentuan &amp; Privasi
                            </button>
                        </div>
                        <button class="primary-action" type="submit">Selanjutnya</button>
                        <p class="switch-message">
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Masuk Sekarang</a>
                        </p>
                    </form>

                    <form data-mode="login" method="post" action="{{ route('login.perform') }}" novalidate>
                        @csrf
                        <div class="input-group">
                            <label for="login-username">Username</label>
                            <input
                                id="login-username"
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                required
                            />
                            @error('username')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="login-password">Password</label>
                            <input
                                id="login-password"
                                type="password"
                                name="password"
                                placeholder="Masukkan kata sandi"
                                autocomplete="current-password"
                                required
                            />
                            @error('password')
                                <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="primary-action" type="submit">Masuk</button>
                        <p class="switch-message">
                            Belum punya akun?
                            <a href="{{ route('register') }}">Daftar Sekarang</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <div class="terms-modal" data-terms-dialog aria-hidden="true">
            <div class="terms-dialog" role="dialog" aria-modal="true" aria-labelledby="terms-title">
                <header>
                    <h3 id="terms-title">Syarat Layanan &amp; Kebijakan Privasi MayClass</h3>
                    <button class="terms-close" type="button" aria-label="Tutup" data-terms-close>&times;</button>
                </header>
                <div class="terms-body">
                    <h4>1. Pendaftaran Akun</h4>
                    <p>
                        MayClass menyediakan platform belajar terpadu yang menghubungkan siswa, tentor, dan admin.
                        Saat mendaftar, Anda perlu memberikan <strong>nama lengkap</strong>, <strong>username</strong>,
                        <strong>email</strong>, <strong>nomor telepon</strong>, dan <strong>jenis kelamin</strong> untuk
                        membangun profil pembelajaran. Informasi ini membantu kami merekomendasikan paket dan
                        menghubungkan Anda dengan tentor yang relevan.
                    </p>

                    <h4>2. Langganan &amp; Pembayaran</h4>
                    <p>
                        Setelah akun dibuat, Anda dapat memilih paket belajar berdasarkan jenjang SD, SMP, atau SMA.
                        Setiap transaksi checkout akan berstatus <strong>menunggu verifikasi admin</strong>. Paket baru
                        aktif ketika tim keuangan MayClass memvalidasi bukti pembayaran. Hingga proses tersebut selesai,
                        akses ke materi, kuis, dan jadwal premium tetap terbatas.
                    </p>

                    <h4>3. Materi, Kuis, dan Jadwal</h4>
                    <p>
                        Konten belajar tersedia secara dinamis sesuai paket yang Anda pilih. Materi dapat dilihat atau
                        diunduh melalui portal siswa, kuis terhubung ke latihan interaktif pihak ketiga, dan jadwal kelas
                        mengikuti sesi yang dirancang tentor. Kami mencatat progres dan aktivitas guna memberikan
                        pengalaman belajar yang konsisten.
                    </p>

                    <h4>4. Kewajiban Pengguna</h4>
                    <ul>
                        <li>Menjaga kerahasiaan kredensial akun dan tidak membagikannya ke pihak lain.</li>
                        <li>Mengunggah dokumen atau foto profil yang sesuai dengan etika komunitas MayClass.</li>
                        <li>Menggunakan fitur materi, kuis, dan jadwal hanya untuk kebutuhan belajar pribadi.</li>
                        <li>Memberikan data pembayaran yang valid saat melakukan checkout paket.</li>
                    </ul>

                    <h4>5. Pengelolaan Data Pribadi</h4>
                    <p>
                        Data pribadi Anda disimpan dengan aman pada sistem MayClass. Kami menggunakan informasi kontak
                        untuk pengingat jadwal, pembaruan paket, serta komunikasi dukungan. Dokumen pembelajaran yang
                        diunggah tentor hanya dibagikan kepada siswa dalam paket terkait. Kami tidak menjual atau
                        mendistribusikan data pribadi ke pihak ketiga di luar kebutuhan layanan inti MayClass.
                    </p>

                    <h4>6. Keamanan &amp; Dukungan</h4>
                    <p>
                        MayClass menerapkan kontrol akses berbasis peran (admin, tentor, siswa) dan pencatatan aktivitas
                        untuk menjaga keamanan. Jika Anda menemukan aktivitas mencurigakan atau memerlukan bantuan,
                        hubungi dukungan kami melalui email <strong>support@mayclass.id</strong> atau WhatsApp resmi yang
                        tercantum di dashboard.
                    </p>
                </div>
                <div class="terms-actions">
                    <button type="button" data-terms-close>Tutup</button>
                </div>
            </div>
        </div>

        <script>
            const doc = document.documentElement;
            const switchButtons = document.querySelectorAll('.tab-switcher button');

            function setMode(mode) {
                doc.setAttribute('data-mode', mode);
                switchButtons.forEach((button) => {
                    const isActive = button.dataset.mode === mode;
                    button.setAttribute('aria-selected', isActive ? 'true' : 'false');
                });
            }

            switchButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const mode = button.dataset.mode;
                    setMode(mode);
                    history.replaceState(null, '', mode === 'register' ? '{{ route('register') }}' : '{{ route('login') }}');
                });
            });

            setMode(doc.getAttribute('data-mode'));

            const termsModal = document.querySelector('[data-terms-dialog]');
            const termsOpeners = document.querySelectorAll('[data-terms-open]');
            const termsClosers = document.querySelectorAll('[data-terms-close]');

            function toggleTerms(visible) {
                if (! termsModal) {
                    return;
                }

                termsModal.setAttribute('data-visible', visible ? 'true' : 'false');
                termsModal.setAttribute('aria-hidden', visible ? 'false' : 'true');

                if (visible) {
                    const focusTarget = termsModal.querySelector('button[data-terms-close]');
                    focusTarget?.focus({ preventScroll: true });
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            }

            termsOpeners.forEach((button) => {
                button.addEventListener('click', () => {
                    toggleTerms(true);
                });
            });

            termsClosers.forEach((button) => {
                button.addEventListener('click', () => {
                    toggleTerms(false);
                });
            });

            termsModal?.addEventListener('click', (event) => {
                if (event.target === termsModal) {
                    toggleTerms(false);
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    toggleTerms(false);
                }
            });
        </script>
    </body>
</html>
