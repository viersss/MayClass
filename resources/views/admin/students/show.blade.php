@extends('admin.layout')

@section('title', 'Detail Siswa - MayClass')

@push('styles')
    <style>
        .detail-layout {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 28px;
        }

        .side-stack {
            display: grid;
            gap: 24px;
        }

        .profile-card,
        .timeline-card,
        .password-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 26px;
            padding: 28px;
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: 0 22px 46px rgba(15, 23, 42, 0.08);
        }

        .page-alert {
            margin-bottom: 18px;
            padding: 16px 20px;
            border-radius: 18px;
            background: rgba(37, 99, 235, 0.1);
            color: #1d4ed8;
            font-weight: 500;
        }

        .profile-card header {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-bottom: 22px;
        }

        .profile-card header div {
            display: grid;
            gap: 4px;
        }

        .profile-card header strong {
            font-size: 1.4rem;
        }

        .avatar {
            width: 72px;
            height: 72px;
            border-radius: 24px;
            object-fit: cover;
            background: rgba(61, 183, 173, 0.18);
        }

        .summary-banner {
            margin-top: 12px;
            padding: 18px 22px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(31, 209, 161, 0.18), rgba(84, 101, 255, 0.18));
            display: grid;
            gap: 6px;
        }

        .summary-banner span {
            font-size: 0.9rem;
            color: rgba(15, 23, 42, 0.68);
        }

        .summary-banner strong {
            font-size: 1.1rem;
        }

        .summary-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 6px;
            width: fit-content;
        }

        .summary-status[data-state='active'] {
            background: rgba(31, 209, 161, 0.18);
            color: #0f766e;
        }

        .summary-status[data-state='inactive'] {
            background: rgba(244, 140, 6, 0.18);
            color: #b45309;
        }

        .info-grid {
            margin-top: 24px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .info-tile {
            background: rgba(61, 183, 173, 0.08);
            border-radius: 18px;
            padding: 16px 18px;
            display: grid;
            gap: 6px;
        }

        .info-tile span {
            color: rgba(15, 23, 42, 0.55);
            font-size: 0.85rem;
        }

        .info-tile strong {
            font-size: 1.05rem;
        }

        .timeline-card h3 {
            margin-top: 0;
            font-size: 1.25rem;
            margin-bottom: 18px;
        }

        .password-card h3 {
            margin: 0 0 8px;
            font-size: 1.3rem;
        }

        .password-card p {
            margin: 0 0 18px;
            color: var(--text-muted);
        }

        .password-card form {
            margin: 0;
        }

        .password-card button[type='submit'] {
            padding: 12px 22px;
            border-radius: 16px;
            border: none;
            background: linear-gradient(120deg, #2563eb, #3db7ad);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 18px 32px rgba(37, 99, 235, 0.2);
            width: 100%;
        }

        .password-card__meta {
            margin-top: 18px;
            padding: 16px;
            border-radius: 18px;
            background: rgba(37, 99, 235, 0.08);
            color: #1e3a8a;
        }

        .password-chip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 16px;
            background: #fff;
            margin-top: 10px;
            border: 1px dashed rgba(15, 23, 42, 0.12);
            font-family: 'Courier New', Consolas, monospace;
            font-size: 1.1rem;
        }

        .password-chip button {
            border: none;
            background: #0f172a;
            color: #fff;
            border-radius: 12px;
            padding: 8px 14px;
            cursor: pointer;
            font-weight: 600;
        }

        .password-chip button[data-state='copied'] {
            background: #22c55e;
        }

        .timeline {
            display: grid;
            gap: 18px;
        }

        .timeline-entry {
            padding: 18px 20px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(15, 23, 42, 0.05);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
        }

        .timeline-entry strong {
            font-size: 1.05rem;
        }

        .timeline-entry span {
            display: inline-flex;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            margin: 8px 0;
        }

        .timeline-entry span[data-state='active'] {
            background: rgba(31, 209, 161, 0.18);
            color: #0f766e;
        }

        .timeline-entry span[data-state='inactive'] {
            background: rgba(244, 140, 6, 0.18);
            color: #b45309;
        }

        .timeline-entry footer {
            margin-top: 10px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        @media (max-width: 1024px) {
            .detail-layout {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .password-card button[type='submit'] {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <a href="{{ route('admin.students.index') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--text-muted); margin-bottom: 22px;">
        ← Kembali ke daftar siswa
    </a>

    @if (session('status'))
        <div class="page-alert" role="status">{{ session('status') }}</div>
    @endif

    <div class="detail-layout">
        <section class="profile-card">
            <header>
                <img class="avatar" src="{{ $student->avatar_path ? asset('storage/' . $student->avatar_path) : config('mayclass.images.tutor.banner.fallback') }}" alt="Avatar" />
                <div>
                    <strong>{{ $student->name }}</strong>
                    <span>{{ $student->email }}</span>
                    <span style="color: var(--text-muted);">ID Siswa: {{ $student->student_id ?? 'Belum ditetapkan' }}</span>
                </div>
            </header>

            <div class="summary-banner">
                <span>Paket terbaru</span>
                <strong>{{ $summary['package'] }}</strong>
                <span>Aktif hingga {{ $summary['expires'] }}</span>
                <span class="summary-status" data-state="{{ $summary['status_state'] }}">{{ $summary['status'] }}</span>
            </div>

            <div class="info-grid">
                <div class="info-tile">
                    <span>Nomor Telepon</span>
                    <strong>{{ $student->phone ?? 'Tidak tersedia' }}</strong>
                </div>
                <div class="info-tile">
                    <span>Alamat</span>
                    <strong>{{ $student->address ?? 'Tidak tersedia' }}</strong>
                </div>
                <div class="info-tile">
                    <span>Orang Tua/Wali</span>
                    <strong>{{ $student->parent_name ?? 'Tidak tersedia' }}</strong>
                </div>
                <div class="info-tile">
                    <span>Jenis Kelamin</span>
                    <strong>{{ $student->gender ? \Illuminate\Support\Str::title($student->gender) : 'Tidak tersedia' }}</strong>
                </div>
            </div>
        </section>

        <div class="side-stack">
            <section class="password-card">
                <h3>Reset Password Siswa</h3>
                <p>
                    Sistem akan membuat kata sandi acak baru. Sampaikan langsung kepada siswa dan sarankan untuk
                    menggantinya setelah berhasil login.
                </p>
                <form method="POST" action="{{ route('admin.students.reset-password', $student) }}">
                    @csrf
                    <button type="submit">Buat Password Baru</button>
                </form>

                @if (session('generated_password'))
                    <div class="password-card__meta">
                        <strong>Password terbaru siap dibagikan:</strong>
                        <div class="password-chip">
                            <span id="generated-password-value">{{ session('generated_password') }}</span>
                            <button type="button" data-copy-target="generated-password-value">Salin</button>
                        </div>
                        <small>Beritahu siswa untuk memperbarui password di menu profil setelah login.</small>
                    </div>
                @endif
            </section>

            <section class="timeline-card">
                <h3>Riwayat Paket & Pembayaran</h3>
                <div class="timeline">
                    @forelse ($timeline as $entry)
                        <article class="timeline-entry">
                            <strong>{{ $entry['package'] }}</strong>
                            <span data-state="{{ $entry['status_state'] }}">{{ $entry['status'] }}</span>
                            <div style="color: var(--text-muted); font-size: 0.9rem;">Periode: {{ $entry['period'] }}</div>
                            <footer>
                                Invoice #{{ $entry['invoice'] ?? '-' }} · Total {{ $entry['total'] }}
                            </footer>
                        </article>
                    @empty
                        <p style="color: var(--text-muted);">Belum ada riwayat paket untuk siswa ini.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('[data-copy-target]').forEach((button) => {
            button.addEventListener('click', async () => {
                const target = document.getElementById(button.dataset.copyTarget);
                if (!target) return;

                const text = target.textContent.trim();
                try {
                    await navigator.clipboard.writeText(text);
                    button.dataset.state = 'copied';
                    const original = button.textContent;
                    button.textContent = 'Tersalin';
                    setTimeout(() => {
                        button.dataset.state = '';
                        button.textContent = original;
                    }, 2000);
                } catch (error) {
                    alert('Gagal menyalin password. Salin secara manual.');
                }
            });
        });
    </script>
@endpush
