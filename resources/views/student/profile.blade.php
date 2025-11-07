<!DOCTYPE html>
<html lang="id" data-page="profile">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Edit Profil - MayClass</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <style>
            :root {
                --primary: #3db7ad;
                --primary-dark: #2c938b;
                --accent: #5f6af8;
                --text-dark: #1f2a37;
                --text-muted: #6b7280;
                --card: #ffffff;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "Poppins", sans-serif;
                background: linear-gradient(180deg, #eff9f8 0%, #ffffff 40%);
                color: var(--text-dark);
                min-height: 100vh;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            header {
                padding: 28px 0 0;
            }

            .container {
                width: min(960px, 92vw);
                margin: 0 auto;
            }

            nav {
                background: var(--card);
                border-radius: 20px;
                padding: 18px 26px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: 0 24px 60px rgba(45, 133, 126, 0.12);
                gap: 24px;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 12px;
                font-weight: 600;
                font-size: 1.1rem;
                color: var(--primary-dark);
            }

            .brand-badge {
                width: 40px;
                height: 40px;
                border-radius: 12px;
                background: var(--primary);
                display: grid;
                place-items: center;
                color: #ffffff;
                font-weight: 700;
                box-shadow: 0 18px 32px rgba(61, 183, 173, 0.25);
            }

            .nav-links {
                display: flex;
                gap: 28px;
                align-items: center;
                font-size: 0.95rem;
                color: var(--text-muted);
            }

            .nav-links a[data-active="true"] {
                color: var(--primary-dark);
                font-weight: 600;
            }

            .nav-links a[data-active="true"]::after {
                content: "";
                display: block;
                height: 4px;
                border-radius: 999px;
                margin-top: 8px;
                background: linear-gradient(120deg, var(--primary), var(--accent));
            }

            .profile-chip {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                padding: 10px 16px;
                border-radius: 999px;
                background: rgba(61, 183, 173, 0.12);
                font-size: 0.9rem;
                color: var(--primary-dark);
            }

            main {
                padding: 48px 0 80px;
                display: grid;
                gap: 32px;
            }

            .profile-card {
                background: var(--card);
                border-radius: 32px;
                padding: clamp(32px, 5vw, 56px);
                box-shadow: 0 32px 68px rgba(32, 96, 92, 0.12);
                display: grid;
                gap: 24px;
            }

            .profile-card h1 {
                margin: 0;
                font-size: clamp(2rem, 3vw, 2.4rem);
                text-align: center;
            }

            .avatar {
                width: 96px;
                height: 96px;
                border-radius: 50%;
                background: rgba(61, 183, 173, 0.12);
                display: grid;
                place-items: center;
                margin: 0 auto;
                font-size: 2.4rem;
                color: var(--primary-dark);
                box-shadow: 0 18px 36px rgba(61, 183, 173, 0.18);
            }

            form {
                display: grid;
                gap: 24px;
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 24px;
            }

            label {
                display: block;
                font-weight: 500;
                margin-bottom: 6px;
            }

            input,
            select,
            textarea {
                width: 100%;
                border-radius: 16px;
                border: 1px solid rgba(61, 183, 173, 0.25);
                padding: 14px 18px;
                font-family: inherit;
                font-size: 0.95rem;
                color: var(--text-dark);
                background: rgba(61, 183, 173, 0.06);
            }

            textarea {
                resize: vertical;
                min-height: 120px;
            }

            .btn-group {
                display: flex;
                gap: 16px;
                justify-content: flex-end;
                flex-wrap: wrap;
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
                background: linear-gradient(120deg, var(--primary) 0%, #58d2c5 100%);
                color: #ffffff;
                box-shadow: 0 20px 40px rgba(61, 183, 173, 0.28);
            }

            .btn-outline {
                background: rgba(61, 183, 173, 0.08);
                border-color: rgba(61, 183, 173, 0.22);
                color: var(--primary-dark);
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            footer {
                padding: 32px 0 48px;
                text-align: center;
                color: var(--text-muted);
                font-size: 0.85rem;
            }

            @media (max-width: 768px) {
                .grid {
                    grid-template-columns: 1fr;
                }

                .btn-group {
                    justify-content: center;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <a href="{{ route('student.dashboard') }}" class="brand">
                        <span class="brand-badge">MC</span>
                        MayClass
                    </a>
                    <div class="nav-links">
                        <a href="{{ route('student.dashboard') }}">Beranda</a>
                        <a href="{{ route('student.materials') }}">Materi</a>
                        <a href="{{ route('student.quiz') }}">Quiz</a>
                        <a href="{{ route('student.schedule') }}">Jadwal</a>
                    </div>
                    <a class="profile-chip" href="{{ route('student.profile') }}" data-active="true">
                        <span>👋</span>
                        <span>Siswa</span>
                    </a>
                </nav>
            </div>
        </header>
        <main class="container">
            <section class="profile-card">
                <h1>Edit Profil</h1>
                <div class="avatar">🧑</div>
                <form action="#" method="post">
                    <div class="grid">
                        <div>
                            <label for="name">Nama Lengkap</label>
                            <input id="name" type="text" value="{{ $profile['name'] }}" />
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input id="email" type="email" value="{{ $profile['email'] }}" />
                        </div>
                    </div>
                    <div class="grid">
                        <div>
                            <label for="student-id">No. Tlp/WA</label>
                            <input id="student-id" type="text" value="{{ $profile['phone'] }}" />
                        </div>
                        <div>
                            <label for="gender">Jenis Kelamin</label>
                            <select id="gender">
                                <option>{{ $profile['gender'] }}</option>
                                <option>Perempuan</option>
                                <option>Laki-laki</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid">
                        <div>
                            <label for="parent">Nama Orang Tua</label>
                            <input id="parent" type="text" value="{{ $profile['parentName'] }}" />
                        </div>
                        <div>
                            <label for="student-code">ID Siswa</label>
                            <input id="student-code" type="text" value="{{ $profile['studentId'] }}" />
                        </div>
                    </div>
                    <div>
                        <label for="address">Alamat</label>
                        <textarea id="address">{{ $profile['address'] }}</textarea>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-outline" type="reset">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </section>
        </main>
        <footer>© 2024 MayClass. Data pribadi dijaga sesuai kebijakan privasi.</footer>
    </body>
</html>
