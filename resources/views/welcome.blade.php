<!DOCTYPE html>
<html lang="id" data-page="landing">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MayClass - Bimbingan Belajar Premium untuk Raih Prestasi</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
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
                --neutral-900: #1f2328;
                --neutral-700: #4d5660;
                --neutral-100: #f6f7f8;
                --surface: #ffffff;
                --ink-strong: #14352c;
                --ink-muted: rgba(20, 59, 46, 0.78);
                --ink-soft: rgba(20, 59, 46, 0.62);
                --nav-surface: linear-gradient(135deg, rgba(80, 190, 150, 0.98), rgba(63, 166, 126, 0.98));
                --footer-surface: #e8f3ef;
                --shadow-lg: 0 24px 60px rgba(31, 107, 79, 0.2);
                --shadow-md: 0 18px 40px rgba(31, 107, 79, 0.12);
                --radius-lg: 20px;
                --radius-xl: 28px;
            }
            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                color: var(--ink-strong);
                background: #ffffff;
                line-height: 1.7;
            }

            img {
                display: block;
                max-width: 100%;
                height: auto;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            /* Full-width layout with proper container centering */
            .container {
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 32px;
            }

            /* Ensure all sections have consistent full-width layout */
            .section {
                width: 100%;
                padding: 96px 0;
            }

            .section .container {
                width: 100%;
            }

            [data-reveal] {
                opacity: 0;
                transform: translateY(48px);
                transition: opacity 700ms cubic-bezier(0.16, 1, 0.3, 1),
                    transform 700ms cubic-bezier(0.16, 1, 0.3, 1);
                transition-delay: var(--reveal-delay, 0ms);
                will-change: opacity, transform;
            }

            [data-reveal].is-visible {
                opacity: 1;
                transform: translateY(0);
            }

            /* ==== NAVBAR TRANSLUCENT + BLUR ==== */
header {
  overflow: visible;           /* biar elemen nav tidak ter-clipping */
  padding-top: 0;
}

nav {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  width: 100%;
  padding: 12px clamp(12px, 3vw, 24px);
  
  /* 🔸 Glassmorphism putih */
  background: rgba(255, 255, 255, 0.4); /* putih transparan */
  backdrop-filter: blur(16px) saturate(180%);
  -webkit-backdrop-filter: blur(16px) saturate(180%);
  border-bottom: 1px solid rgba(255, 255, 255, 0.25);
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);

  transition: background 0.3s ease, box-shadow 0.3s ease;
}



.nav-inner {
  display: grid;
  grid-template-columns: auto 1fr auto; /* kiri - tengah - kanan */
  align-items: center;
  width: 100%;
  padding: 0 32px; /* tidak terlalu besar */
  gap: 20px;
}

            @media (max-width: 1024px) {
                nav {
                    padding: 24px clamp(8px, 4vw, 20px);
                }

                .nav-inner {
                    gap: clamp(18px, 4vw, 32px);
                }
            }

            @media (max-width: 768px) {
                nav {
                    padding: 20px clamp(8px, 6vw, 16px);
                    margin-bottom: 24px;
                }

                .nav-inner {
                    grid-template-columns: 1fr;
                    justify-items: center;
                    gap: 18px;
                }

                .nav-inner > * {
                    width: 100%;
                    justify-self: center;
                }
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 14px;
                font-weight: 600;
                font-size: 1.25rem;
                flex-shrink: 0;
                justify-self: start;
            }

.brand img {
    width: 130px;    /* 🔸 dari 48px → 72px (lebih besar tapi masih proporsional) */
    height: auto;   /* biar tinggi menyesuaikan proporsi */
    object-fit: contain;
}


.nav-links {
  display: flex;
  align-items: center;
  justify-content: center; /* 🔸 dorong ke kanan */
  gap: 28px;
  font-size: 0.95rem;
  margin-left: 57px;
}


            .nav-links a {
                color: #000;
                transition: color 0.2s ease;
            }

            .nav-links a:hover {
                color: #ffffff;
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 16px;
                justify-content: flex-end;
                justify-self: end;
                color: #000
            }

            @media (max-width: 768px) {
                .nav-actions {
                    width: 100%;
                    justify-content: center;
                }
            }

            @media (max-width: 768px) {
                .nav-actions {
                    width: 100%;
                    justify-content: center;
                }
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 28px;
                border-radius: 999px;
                font-size: 0.95rem;
                font-weight: 500;
                border: 1px solid transparent;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                cursor: pointer;
            }

            .btn-outline {
                border-color: rgba(255, 255, 255, 0.38);
                color: #ffffff;
                background: transparent;
            }

            .btn-outline:hover {
                transform: translateY(-1px);
                box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
            }

            .btn-primary {
                background: linear-gradient(120deg, var(--primary-light) 0%, var(--primary-accent) 100%);
                color: var(--primary-dark);
                box-shadow: 0 16px 40px rgba(132, 217, 134, 0.36);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
            }

            .btn-ghost {
                border-color: rgba(63, 166, 126, 0.35);
                background: rgba(63, 166, 126, 0.08);
                color: var(--primary-dark);
            }

            .btn-ghost:hover {
                transform: translateY(-1px);
                box-shadow: 0 14px 32px rgba(63, 166, 126, 0.2);
            }

            .hero {
                position: relative;
                z-index: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center; 
                text-align: center;
                width: 100%;
                min-height: calc(100vh + 120px);
                padding-top: calc(var(--nav-height) + 40px);
                padding-bottom: 100px;

                background: 
                    linear-gradient(
                        to bottom,
                        rgba(0, 0, 0, 0.35),
                        rgba(0, 0, 0, 0.65)
                    ),
                    url('/images/stis_contoh.jpeg') center/cover no-repeat;
            }



            .hero-content {
                max-width: 800px;
                margin: 0 auto;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .hero h1 {
                font-size: clamp(2.7rem, 4vw, 3.9rem);
                line-height: 1.15;
                margin: 18px 0;
                color: #ffffff;
                text-align: center;
                max-width: 720px;
            }

            .hero p {
                color: rgba(255, 255, 255, 0.94);
                margin: 0 0 32px;
                max-width: 640px;
                text-align: center;
                font-size: 1.1rem;
            }

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 18px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.16);
                font-weight: 600;
                letter-spacing: 0.02em;
                color: #ffffff;
            }

            .badge-soft {
                background: rgba(20, 59, 46, 0.08);
                color: var(--primary-dark);
                border: 1px solid rgba(20, 59, 46, 0.08);
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                margin-bottom: 40px;
            }

            .hero-stats {
                display: grid;
                gap: 18px;
                background: rgba(255, 255, 255, 0.12);
                border-radius: var(--radius-xl);
                padding: 28px 32px;
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.16);
                max-width: 440px;
                color: rgba(255, 255, 255, 0.9);
            }

            .hero-stats-row {
                display: flex;
                flex-wrap: wrap;
                gap: 18px;
            }

            .hero-stat {
                flex: 1 1 160px;
                display: grid;
                gap: 2px;
            }

            .hero-stat strong {
                font-size: 1.6rem;
                color: #ffffff;
            }

            .hero-stat span {
                color: rgba(255, 255, 255, 0.8);
            }

            .hero-art {
                position: relative;
            }

            .hero-art::after {
                content: "";
                position: absolute;
                inset: 10% 0 -6% 12%;
                background: radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.22), transparent 65%);
                border-radius: var(--radius-xl);
                z-index: 0;
            }

            .hero-art img {
                position: relative;
                z-index: 1;
                border-radius: var(--radius-xl);
                box-shadow: var(--shadow-lg);
            }

            .section-header {
                max-width: 760px;
                margin: 0 auto 64px;
                text-align: center;
                display: grid;
                gap: 16px;
            }

            .section-header h2 {
                margin: 0;
                font-size: clamp(2rem, 3vw, 2.7rem);
                color: var(--ink-strong);
            }

            .section-header p {
                margin: 0;
                color: var(--ink-muted);
            }

            /* Articles grid in full-width container */
            .articles-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 28px;
                width: 100%;
            }

            .article-card {
                background: var(--surface);
                border-radius: var(--radius-xl);
                box-shadow: var(--shadow-md);
                overflow: hidden;
                display: grid;
                grid-template-rows: 220px 1fr;
            }

            .article-card img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .article-content {
                padding: 24px 26px 32px;
                display: grid;
                gap: 10px;
            }

            .article-content h3 {
                margin: 0;
                font-size: 1.15rem;
                color: var(--ink-strong);
            }

            .article-content p {
                margin: 0;
                color: var(--ink-soft);
                font-size: 0.95rem;
            }

            .link-muted {
                color: var(--primary-main);
                font-weight: 600;
            }

            /* Full-width pricing section */
            .pricing-section {
                width: 100%;
                background: linear-gradient(135deg, #f0fdf4 0%, #f7fef5 100%);
                padding: 96px 0;
            }

            .pricing-group {
                display: grid;
                gap: 24px;
                margin-top: 48px;
            }

            .pricing-group h3 {
                margin: 0;
                font-size: 1.6rem;
            }

            .pricing-group p {
                margin: 6px 0 0;
                color: var(--ink-soft);
            }

            .pricing-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 28px;
                width: 100%;
            }

            .pricing-card {
                background: var(--surface);
                border-radius: var(--radius-xl);
                padding: 36px 32px;
                box-shadow: var(--shadow-md);
                display: grid;
                gap: 18px;
                position: relative;
            }

            .pricing-card::after {
                content: "";
                position: absolute;
                inset: 18px;
                border-radius: 24px;
                border: 1px dashed rgba(63, 166, 126, 0.18);
                pointer-events: none;
            }

            .pricing-card strong {
                font-size: 1.4rem;
            }

            .pricing-price {
                font-size: 2rem;
                color: var(--primary-main);
                font-weight: 700;
            }

            .pricing-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                font-size: 0.9rem;
                color: var(--ink-soft);
            }

            .pricing-features {
                list-style: none;
                margin: 0;
                padding: 0;
                display: grid;
                gap: 12px;
                color: var(--ink-soft);
            }

            .pricing-features li::before {
                content: "•";
                margin-right: 8px;
                color: var(--primary-light);
            }

            .pricing-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 8px;
            }

            .pricing-actions a {
                flex: 1;
                min-width: 120px;
                text-align: center;
            }

            /* Highlight section as full-width block */
            .highlight-section {
                position: relative;
                width: 100%;
                background: linear-gradient(110deg, rgba(31, 109, 79, 0.96), rgba(17, 54, 37, 0.92)),
                    url("https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1600&q=80")
                        center/cover;
                color: #ffffff;
                overflow: hidden;
                margin: 0;
                padding: 80px 32px;
            }

            .highlight-content {
                display: grid;
                gap: 48px;
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0;
            }

            .highlight-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 24px;
                width: 100%;
            }

            .highlight-card {
                background: rgba(255, 255, 255, 0.12);
                border-radius: var(--radius-lg);
                padding: 28px;
                backdrop-filter: blur(12px);
                display: grid;
                gap: 12px;
                border: 1px solid rgba(255, 255, 255, 0.16);
            }

            .highlight-card strong {
                color: #ffffff;
            }

            .highlight-card p {
                margin: 0;
            }

            /* Journey roadmap */
            .journey-section {
                background: #f5fbf8;
                border-top: 1px solid rgba(20, 59, 46, 0.04);
                border-bottom: 1px solid rgba(20, 59, 46, 0.04);
            }

            .journey-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 20px;
                margin-top: 36px;
            }

            .journey-card {
                background: #ffffff;
                border-radius: 22px;
                padding: 28px;
                display: grid;
                gap: 12px;
                box-shadow: 0 22px 45px rgba(20, 59, 46, 0.12);
                border: 1px solid rgba(20, 59, 46, 0.06);
                position: relative;
            }

            .journey-step {
                width: 44px;
                height: 44px;
                border-radius: 12px;
                background: rgba(63, 166, 126, 0.12);
                color: var(--primary-dark);
                font-weight: 600;
                font-size: 1rem;
                display: grid;
                place-items: center;
            }

            .journey-card strong {
                font-size: 1.1rem;
                color: var(--ink-strong);
            }

            .journey-card p {
                margin: 0;
                color: var(--ink-soft);
            }

            .journey-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                font-size: 0.85rem;
                color: var(--primary-dark);
            }

            .journey-meta span {
                background: rgba(20, 59, 46, 0.05);
                border-radius: 999px;
                padding: 4px 10px;
            }

            /* FAQ grid in full-width container */
            .faq-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
                width: 100%;
            }

            details {
                border-radius: var(--radius-lg);
                background: var(--surface);
                padding: 20px 24px;
                box-shadow: var(--shadow-md);
            }

footer {
    margin-top: 80px;
    background: radial-gradient(circle at top, rgba(22, 63, 48, 0.92), rgba(8, 26, 24, 0.96));
    color: rgba(255, 255, 255, 0.8);
}

.footer-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: clamp(24px, 4vw, 80px);
    align-items: flex-start;
    padding: 80px 32px 40px;
}

.footer-brand {
    flex: 1 1 280px;
    display: grid;
    gap: 16px;
}

.footer-brand img {
    width: 140px;
    height: auto;
}

.footer-brand p {
    margin: 0;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.7;
}

.footer-nav {
    flex: 1 1 420px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 24px;
}

.footer-links {
    display: grid;
    gap: 10px;
    font-size: 0.95rem;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.75);
    transition: color 0.2s ease;
}

.footer-links a:hover {
    color: var(--primary-light);
}

.footer-contact {
    display: grid;
    gap: 12px;
}

.contact-item {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    border-radius: 14px;
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    font-size: 0.95rem;
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    padding: 20px 32px 40px;
    flex-wrap: wrap;
}

.footer-bottom p {
    margin: 0;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.65);
}

.footer-socials {
    display: inline-flex;
    gap: 12px;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.25);
    display: grid;
    place-items: center;
    color: rgba(255, 255, 255, 0.85);
    transition: background 0.2s ease, color 0.2s ease;
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.12);
    color: var(--primary-light);
}

@media (max-width: 768px) {
    .footer-wrapper {
        padding: 60px 20px 32px;
    }

    .footer-bottom {
        padding: 20px;
    }
}

            @media (max-width: 1080px) {
                .hero {
                    padding: 60px 24px;
                }

                .hero h1 {
                    font-size: clamp(2.2rem, 3.5vw, 2.9rem);
                }

                .hero p {
                    font-size: 1rem;
                }

                .articles-grid,
                .pricing-grid,
                .highlight-grid,
                .faq-grid,
                .journey-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 768px) {
                nav {
                    padding: 18px 18px;
                    gap: 16px;
                    width: calc(100% - 32px);
                    margin: 0 auto 24px;
                }

                .nav-links {
                    flex-wrap: wrap;
                    justify-content: center;
                    gap: 16px;
                }

                .section {
                    padding: 60px 0;
                }

                .pricing-section {
                    padding: 60px 0;
                }

.hero {
  height: 900px;
  padding-top: calc(var(--nav-height) + 60px);
}



                .highlight-section {
                    padding: 60px 16px;
                }

                .section .container {
                    padding: 0 16px;
                }

                .articles-grid,
                .pricing-grid,
                .highlight-grid,
                .faq-grid,
                .journey-grid {
                    grid-template-columns: 1fr;
                }

                .hero-stats {
                    max-width: none;
                    width: 100%;
                }

                footer {
                    padding: 60px 0 40px;
                }

                .footer-grid {
                    grid-template-columns: 1fr;
                    padding: 0 16px;
                    margin: 0 auto 40px;
                }

                .copyright {
                    padding: 0 16px;
                }

                .journey-card {
                    padding: 24px;
                }
            }
        </style>
    </head>
    <body>
        @php
            $joinLink = route('join');
        @endphp

        <header>
            <nav>
                <div class="nav-inner">
                    <a class="brand" href="/">
                        <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass" width="200" height="auto" />
                    </a>
                    <div class="nav-links">
                        <a href="#beranda">Beranda</a>
                        <a href="#artikel">Artikel</a>
                        <a href="#paket">Paket Belajar</a>
                        <a href="#keunggulan">Keunggulan</a>
                        <a href="#alur">Cara Bergabung</a>
                        <a href="#faq">FAQ</a>
                    </div>
                    <div class="nav-actions">
                        <a class="btn btn-primary" href="{{ $joinLink }}">
                            Gabung Sekarang
                        </a>
                    </div>
                </div>
            </nav>
            <div class="hero" id="beranda">
                <div class="hero-content" data-reveal data-reveal-delay="40">
                    <span class="badge">Bimbel MayClass</span>
                    <h1>Langkah Pasti Menuju Prestasi</h1>
                    <p>
                        Bertemu dengan tentor terbaik MayClass dan rasakan perjalanan belajar yang terarah, fleksibel, dan
                        penuh dukungan menuju Perguruan Tinggi impianmu.
                    </p>
                    </div>
                </div>
            </div>
        </header>

        <section class="section" id="artikel">
            <div class="container">
                <div class="section-header" data-reveal>

                    <h2 class="section-title">Wawasan Terbaru untuk Dukung Persiapanmu</h2>
                    <p class="section-subtitle">
                        Nikmati rangkuman materi, strategi ujian, dan cerita motivasi dari tim akademik MayClass agar kamu
                        selalu selangkah di depan.
                    </p>
                </div>
                <div class="articles-grid">
                    <article class="article-card" data-reveal>
                        <img
                            src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=800&q=80"
                            alt="Artikel UTBK"
                        />
                        <div class="article-content">
                            <h3>Kenali 7 Subtes UTBK yang Harus Kamu Taklukkan</h3>
                            <p>
                                Panduan lengkap memahami struktur TPS dan Literasi dengan latihan intensif dari mentor MayClass.
                            </p>
                            <a class="link-muted" href="{{ route('packages.index') }}">Selengkapnya</a>
                        </div>
                    </article>
                    <article class="article-card" data-reveal data-reveal-delay="120">
                        <img
                            src="https://images.unsplash.com/photo-1460518451285-97b6aa326961?auto=format&fit=crop&w=800&q=80"
                            alt="Artikel SKD"
                        />
                        <div class="article-content">
                            <h3>Strategi Lulus SKD ASN &amp; PPPK Bersama Mentor Ahli</h3>
                            <p>
                                Kisi-kisi terbaru, tips manajemen waktu, dan latihan soal real untuk skor maksimal di seleksi CPNS.
                            </p>
                            <a class="link-muted" href="{{ route('packages.index') }}">Selengkapnya</a>
                        </div>
                    </article>
                    <article class="article-card" data-reveal data-reveal-delay="200">
                        <img
                            src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=800&q=80"
                            alt="Artikel motivasi"
                        />
                        <div class="article-content">
                            <h3>Raih Kampus Impian dari Nol</h3>
                            <p>
                                Belajar dari pengalaman siswa MayClass yang berhasil masuk kampus favorit berkat program intensif.
                            </p>
                            <a class="link-muted" href="{{ route('packages.index') }}">Selengkapnya</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="pricing-section" id="paket">
            <div class="container">
                <div class="section-header" data-reveal>

                    <h2 class="section-title">Pilih Paket Favoritmu &amp; Belajar Bareng Mentor Andal</h2>
                    <p class="section-subtitle">
                        Mulai dari kelas reguler, persiapan UTBK, hingga bimbingan CPNS—MayClass siap menemanimu dengan sesi
                        interaktif dan laporan perkembangan rutin.
                    </p>
                </div>
                @php($packageCatalog = collect($landingPackages ?? []))

                @if ($packageCatalog->isNotEmpty())
                    @foreach ($packageCatalog as $group)
                        <div class="pricing-group">
                            <div>
                                <h3>{{ $group['stage_label'] ?? $group['stage'] }}</h3>
                                @php($stageDescription = $group['stage_description'] ?? '')
                                @if (! empty($stageDescription))
                                    <p>{{ $stageDescription }}</p>
                                @endif
                            </div>
                            <div class="pricing-grid">
                                @foreach ($group['packages'] as $package)
                                    @php($features = collect($package['card_features'] ?? $package['features'] ?? [])->take(3))
                                    <article class="pricing-card" data-reveal data-reveal-delay="{{ $loop->index * 120 }}">
                                        <span class="badge" style="background: rgba(63, 166, 126, 0.12); color: var(--primary-main);">
                                            {{ $package['tag'] ?? ($group['stage_label'] ?? $group['stage']) }}
                                        </span>
                                        <strong>{{ $package['detail_title'] }}</strong>
                                        <div class="pricing-price">{{ $package['card_price'] }}</div>
                                        <div class="pricing-meta">
                                            <span>{{ $group['stage_label'] ?? $group['stage'] }}</span>
                                            @if (! empty($package['grade_range']))
                                                <span>• {{ $package['grade_range'] }}</span>
                                            @endif
                                        </div>
                                        @if ($package['summary'] ?? false)
                                            <p style="margin: 0; color: var(--ink-soft); font-size: 0.95rem;">
                                                {{ $package['summary'] }}
                                            </p>
                                        @endif
                                        @if ($features->isNotEmpty())
                                            <ul class="pricing-features">
                                                @foreach ($features as $feature)
                                                    <li>{{ $feature }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <div class="pricing-actions">
                                            <a class="btn btn-primary" href="{{ route('packages.show', $package['slug']) }}">Detail Paket</a>
                                            @auth
                                                <a class="btn btn-primary" href="{{ route('checkout.show', $package['slug']) }}">Langsung Checkout</a>
                                            @endauth
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="pricing-grid">
                        <article class="pricing-card">
                            <strong>Paket sedang disiapkan</strong>
                            <div class="pricing-price">Segera hadir</div>
                            <p style="color: var(--ink-soft);">Tim MayClass dapat menambahkan paket melalui dashboard admin untuk menampilkan katalog otomatis di halaman ini.</p>
                            <div class="pricing-actions">
                                <a class="btn btn-primary" href="{{ route('login') }}">Masuk Dashboard</a>
                            </div>
                        </article>
                    </div>
                @endif
            </div>
        </section>

        <div class="highlight-section" id="keunggulan">
            <div class="highlight-content">
                <div data-reveal>
                    <span class="badge" style="background: rgba(255, 255, 255, 0.16); color: #ffffff;">Mengapa MayClass?</span>
                    <h2 style="margin: 18px 0 12px; font-size: clamp(2.1rem, 3vw, 3rem); color: #ffffff;">Bersama MayClass Belajarmu Lebih Seru</h2>
                    <p style="margin: 0; max-width: 620px; color: rgba(255, 255, 255, 0.84);">
                        Rasakan pengalaman belajar intensif, hangat, dan profesional. Tim MayClass memastikan setiap sesi
                        berjalan menyenangkan dengan target capaian yang jelas.
                    </p>
                </div>
                <div class="highlight-grid">
                    <div class="highlight-card" data-reveal>
                        <strong>Super Teacher</strong>
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.82);">
                            Mentor pilihan dengan pengalaman mengajar panjang dan capaian prestisius.
                        </p>
                    </div>
                    <div class="highlight-card" data-reveal data-reveal-delay="120">
                        <strong>Materi Lengkap</strong>
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.82);">
                            Silabus terbaru, bank soal adaptif, dan rekaman kelas siap diputar kapan pun.
                        </p>
                    </div>
                    <div class="highlight-card" data-reveal data-reveal-delay="200">
                        <strong>Analisis Mendalam</strong>
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.82);">
                            Pantau progres lewat laporan mingguan dan rekomendasi belajar personal.
                        </p>
                    </div>
                    <div class="highlight-card" data-reveal data-reveal-delay="280">
                        <strong>Komunitas Aktif</strong>
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.82);">
                            Saling dukung bersama teman sefrekuensi dan dapatkan motivasi harian.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <section class="section journey-section" id="alur">
            <div class="container">
                <div class="section-header" data-reveal>
                    <span class="badge badge-soft">Cara Bergabung</span>
                    <h2 class="section-title">3 Langkah Praktis untuk Mulai Belajar di MayClass</h2>
                    <p class="section-subtitle">
                        Mulai dari memilih paket, mengatur jadwal, sampai memantau progres—semuanya bisa kamu lakukan dalam satu dashboard.
                    </p>
                </div>
                <div class="journey-grid">
                    <article class="journey-card" data-reveal>
                        <div class="journey-step">1</div>
                        <strong>Eksplor Paket Belajar</strong>
                        <p>Pilih jenjang, fokus materi, dan jumlah sesi yang cocok dengan targetmu langsung dari katalog online.</p>
                        <div class="journey-meta">
                            <span>Simulasi kebutuhan</span>
                            <span>Lihat silabus</span>
                        </div>
                    </article>
                    <article class="journey-card" data-reveal data-reveal-delay="120">
                        <div class="journey-step">2</div>
                        <strong>Atur Jadwal Fleksibel</strong>
                        <p>Admin MayClass bantu sinkronisasi jadwal kamu dan mentor, lengkap dengan pengingat otomatis sebelum sesi dimulai.</p>
                        <div class="journey-meta">
                            <span>Pengingat WhatsApp</span>
                            <span>Reschedule mudah</span>
                        </div>
                    </article>
                    <article class="journey-card" data-reveal data-reveal-delay="220">
                        <div class="journey-step">3</div>
                        <strong>Ikuti Kelas &amp; Pantau Progres</strong>
                        <p>Masuk ruang belajar interaktif, cek rekaman kelas, dan lihat laporan perkembangan yang dikirim tiap pekan.</p>
                        <div class="journey-meta">
                            <span>Dashboard progres</span>
                            <span>Evaluasi mentor</span>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" id="faq">
            <div class="container">
                <div class="section-header" data-reveal>

                    <h2 class="section-title">FAQ</h2>

                </div>
                <div class="faq-grid" data-reveal>
                    <details>
                        <summary>Apakah MayClass menyediakan kelas online dan tatap muka?</summary>
                        <p>
                            Ya. Kamu bisa memilih mode belajar sesuai kebutuhan. Tim kami bantu atur jadwal dan mentor terbaik
                            untukmu.
                        </p>
                    </details>
                    <details>
                        <summary>Bagaimana cara mengakses materi dan rekaman kelas?</summary>
                        <p>
                            Siswa dapat login ke dashboard MayClass untuk melihat materi, rekaman kelas, dan rangkuman progres
                            belajar.
                        </p>
                    </details>
                    <details>
                        <summary>Apakah bisa reschedule jika ada jadwal mendadak?</summary>
                        <p>
                            Bisa. Hubungi admin maksimal 24 jam sebelum sesi dimulai dan kami akan bantu atur ulang jadwalmu.
                        </p>
                    </details>
                    <details>
                        <summary>Bagaimana sistem evaluasi progres siswa?</summary>
                        <p>
                            Kami menyediakan laporan mingguan, evaluasi tryout, dan coaching pribadi agar target belajar tercapai.
                        </p>
                    </details>
                    <details>
                        <summary>Apakah ada grup diskusi komunitas?</summary>
                        <p>
                            Ada. Semua siswa akan bergabung di komunitas eksklusif untuk diskusi, motivasi, dan info terbaru.
                        </p>
                    </details>
                    <details>
                        <summary>Metode pembayaran apa yang tersedia?</summary>
                        <p>
                            Pembayaran dapat melalui transfer bank, e-wallet, dan virtual account dengan konfirmasi otomatis.
                        </p>
                    </details>
                </div>
            </div>
        </section>

        <footer>
                <div class="footer-wrapper container" data-reveal>
                    <div class="footer-brand">
                        <img src="{{ asset('images/Logo_MayClass.png') }}" alt="Logo MayClass" />
                        <p>
                            MayClass mengintegrasikan materi interaktif, pendampingan mentor, dan layanan admin responsif
                            untuk memastikan perjalanan belajarmu selalu terarah.
                        </p>
                        <div class="footer-contact">
                            <a class="contact-item" href="tel:+6281234567890">📞 +62 812-3456-7890</a>
                            <a class="contact-item" href="mailto:hello@mayclass.id">✉️ hello@mayclass.id</a>
                        </div>
                    </div>
                    <div class="footer-nav">
                        <div>
                            <h4>Produk</h4>
                            <div class="footer-links">
                                <a href="#paket">Paket Belajar</a>
                                <a href="#keunggulan">Keunggulan</a>
                                <a href="#alur">Cara Bergabung</a>
                            </div>
                        </div>
                        <div>
                            <h4>Bantuan</h4>
                            <div class="footer-links">
                                <a href="#faq">FAQ</a>
                                <a href="{{ route('login') }}">Masuk Dashboard</a>
                                <a href="https://wa.me/{{ config('services.whatsapp.finance_admin', '6281234567890') }}" target="_blank" rel="noopener">Chat Admin</a>
                            </div>
                        </div>
                        <div>
                            <h4>Perusahaan</h4>
                            <div class="footer-links">
                                <a href="#beranda">Tentang MayClass</a>
                                <a href="#artikel">Blog &amp; Artikel</a>
                                <a href="{{ route('packages.index') }}">Semua Paket</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>© {{ now()->year }} MayClass. All rights reserved.</p>
                    <div class="footer-socials">
                        <a class="social-link" href="https://www.instagram.com" target="_blank" rel="noreferrer" aria-label="Instagram MayClass">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="18" height="18">
                                <rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.4" />
                                <circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.4" />
                                <circle cx="17.5" cy="6.5" r="1" fill="currentColor" />
                            </svg>
                        </a>
                        <a class="social-link" href="https://www.tiktok.com" target="_blank" rel="noreferrer" aria-label="TikTok MayClass">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="18" height="18">
                                <path d="M15 3c.3 2.6 1.9 4 4 4v3.1c-1.6.1-3-.5-4-1.4v6.2c0 3.6-2.6 6-6 6s-6-2.4-6-5.6c0-3 2-5.1 5.2-5.4V12c-1.1.2-2 1-2 2.1 0 1.4 1.2 2.3 2.8 2.3s2.7-1 2.7-2.5V3h3.3Z" fill="currentColor" />
                            </svg>
                        </a>
                        <a class="social-link" href="https://www.youtube.com" target="_blank" rel="noreferrer" aria-label="YouTube MayClass">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="18" height="18">
                                <path d="M21.5 7.5s-.2-1.4-.8-2c-.8-.8-1.8-.8-2.3-.9C15.2 4.4 12 4.4 12 4.4h0s-3.2 0-6.4.2c-.5.1-1.5.1-2.3.9-.6.6-.8 2-.8 2S2 9.1 2 10.6v1.9c0 1.5.2 3.1.2 3.1s.2 1.4.8 2c.8.8 1.8.8 2.3.9 1.7.2 6.7.2 6.7.2s3.2 0 6.4-.2c.5-.1 1.5-.1 2.3-.9.6-.6.8-2 .8-2s.2-1.6.2-3.1v-1.9c0-1.5-.2-3.1-.2-3.1Zm-12 6.4V8.1l5.2 3.9-5.2 1.9Z" fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const root = document.documentElement;

                if (!root || root.dataset.page !== 'landing') {
                    return;
                }

                const revealElements = Array.from(document.querySelectorAll('[data-reveal]'));
                const motionQuery = window.matchMedia
                    ? window.matchMedia('(prefers-reduced-motion: reduce)')
                    : null;
                let revealObserver = null;

                const disconnectObserver = () => {
                    if (revealObserver) {
                        revealObserver.disconnect();
                        revealObserver = null;
                    }
                };

                const revealImmediately = () => {
                    if (!revealElements.length) {
                        return;
                    }

                    revealElements.forEach((element) => {
                        element.classList.add('is-visible');
                        element.style.removeProperty('--reveal-delay');
                    });

                    disconnectObserver();
                };

                const setupRevealObserver = () => {
                    if (!revealElements.length) {
                        return;
                    }

                    disconnectObserver();

                    if (motionQuery && motionQuery.matches) {
                        revealImmediately();
                        return;
                    }

                    revealObserver = new IntersectionObserver(
                        (entries) => {
                            entries.forEach((entry) => {
                                if (!entry.isIntersecting) {
                                    return;
                                }

                                const element = entry.target;
                                const delay = Number(element.dataset.revealDelay || 0);

                                if (Number.isFinite(delay) && !element.style.getPropertyValue('--reveal-delay')) {
                                    element.style.setProperty('--reveal-delay', `${delay}ms`);
                                }

                                requestAnimationFrame(() => {
                                    element.classList.add('is-visible');
                                });

                                if (revealObserver) {
                                    revealObserver.unobserve(element);
                                }
                            });
                        },
                        {
                            threshold: 0.25,
                            rootMargin: '0px 0px -10% 0px',
                        }
                    );

                    revealElements.forEach((element) => {
                        if (element.classList.contains('is-visible')) {
                            return;
                        }

                        revealObserver.observe(element);
                    });
                };

                setupRevealObserver();

                if (motionQuery) {
                    motionQuery.addEventListener('change', (event) => {
                        if (event.matches) {
                            revealImmediately();
                        } else {
                            setupRevealObserver();
                        }
                    });
                }

                if (motionQuery && motionQuery.matches) {
                    return;
                }

                const scrollElement = document.scrollingElement || root;

                if (!scrollElement) {
                    return;
                }

                document.querySelectorAll('a[href^="#"]').forEach((link) => {
                    link.addEventListener('click', (event) => {
                        const href = link.getAttribute('href');

                        if (!href || href.length <= 1) {
                            return;
                        }

                        const anchorTarget = document.querySelector(href);

                        if (!anchorTarget) {
                            return;
                        }

                        event.preventDefault();

                        const offset = 80;
                        const desired =
                            anchorTarget.getBoundingClientRect().top + window.pageYOffset - offset;
                        const maxScroll = scrollElement.scrollHeight - window.innerHeight;
                        const target = Math.min(Math.max(desired, 0), maxScroll);

                        window.scrollTo({ top: target, behavior: 'smooth' });
                    });
                });
            });
        </script>

    </body>
</html>

