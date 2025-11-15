@extends('tutor.layout')

@section('title', 'Jadwal Mengajar - MayClass')

@push('styles')
    <style>
        .schedule-hero {
            position: relative;
            padding: 32px;
            border-radius: 28px;
            background: linear-gradient(135deg, rgba(61, 183, 173, 0.85), rgba(84, 101, 255, 0.85));
            color: #fff;
            overflow: hidden;
            margin-bottom: 28px;
            box-shadow: 0 28px 65px rgba(15, 23, 42, 0.25);
        }

        .schedule-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.18), transparent 55%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            display: grid;
            gap: 18px;
        }

        .hero-title {
            margin: 0;
            font-size: 2.1rem;
        }

        .hero-subtitle {
            margin: 0;
            font-size: 1rem;
            max-width: 520px;
            color: rgba(255, 255, 255, 0.85);
        }

        .hero-highlight {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
            margin-top: 12px;
        }

        .hero-highlight-card {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 20px;
            backdrop-filter: blur(6px);
        }

        .hero-highlight-card h3 {
            margin: 0 0 8px;
            font-size: 1.2rem;
        }

        .hero-highlight-card p {
            margin: 4px 0;
            font-size: 0.95rem;
        }

        .metric-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .metric-card {
            background: #fff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.1);
            border: 1px solid rgba(15, 23, 42, 0.04);
        }

        .metric-card span {
            display: block;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .metric-card strong {
            display: block;
            font-size: 1.8rem;
            margin-top: 6px;
            color: #111827;
        }

        .template-manager {
            background: #fff;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 20px 48px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(15, 23, 42, 0.04);
            margin-bottom: 30px;
            display: grid;
            gap: 20px;
        }

        .template-manager h2 {
            margin: 0;
            font-size: 1.4rem;
        }

        .template-manager p {
            margin: 4px 0 0;
            color: var(--text-muted);
        }

        .template-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            align-items: end;
        }

        .template-form label {
            display: grid;
            gap: 8px;
            font-weight: 600;
            color: #1f2937;
            font-size: 0.95rem;
        }

        .template-form select,
        .template-form input {
            border: 1px solid #d9e0ea;
            border-radius: 14px;
            padding: 12px 14px;
            font-family: inherit;
            font-size: 0.95rem;
        }

        .template-form button {
            align-self: stretch;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            font-weight: 600;
            padding: 12px 18px;
            cursor: pointer;
            box-shadow: 0 14px 30px rgba(61, 183, 173, 0.25);
        }

        .template-list {
            display: grid;
            gap: 14px;
        }

        .template-card {
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 18px;
            padding: 18px;
            display: grid;
            gap: 14px;
            background: rgba(15, 23, 42, 0.015);
        }

        .template-card form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 14px;
            align-items: end;
        }

        .template-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .template-actions button,
        .session-actions button,
        .cancelled-table button {
            border: none;
            border-radius: 12px;
            padding: 10px 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .template-actions button[type='submit'],
        .session-actions button.cancel-button {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 10px 24px rgba(239, 68, 68, 0.25);
        }

        .template-actions form:last-child button,
        .cancelled-table button.restore-button {
            background: rgba(15, 23, 42, 0.08);
            color: #1f2937;
        }

        .session-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: flex-end;
        }

        .session-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(59, 130, 246, 0.12);
            color: #2563eb;
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.82rem;
        }

        .cancelled-section {
            background: #fff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 20px 48px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(15, 23, 42, 0.04);
        }

        .cancelled-section h3 {
            margin: 0 0 12px;
        }

        .cancelled-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cancelled-table th,
        .cancelled-table td {
            padding: 12px 14px;
            text-align: left;
        }

        .cancelled-table tbody tr {
            border-top: 1px solid rgba(15, 23, 42, 0.08);
        }

        .cancelled-table td:last-child {
            text-align: right;
        }

        .schedule-wrapper {
            display: grid;
            gap: 22px;
        }

        .day-card {
            background: #fff;
            border-radius: 24px;
            padding: 26px;
            box-shadow: 0 20px 48px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(15, 23, 42, 0.04);
        }

        .day-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .day-card h2 {
            margin: 0;
            font-size: 1.35rem;
        }

        .day-card span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .session {
            margin-top: 18px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 18px;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 16px;
            align-items: center;
            background: rgba(15, 23, 42, 0.02);
        }

        .session h3 {
            margin: 0;
            font-size: 1.1rem;
        }

        .session .meta {
            color: #6b7280;
            font-size: 0.95rem;
            margin-top: 6px;
        }

        .session .badge {
            display: inline-flex;
            padding: 6px 14px;
            background: rgba(61, 183, 173, 0.14);
            color: var(--primary-dark);
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .session .time {
            font-weight: 600;
            color: #1f2937;
            text-align: right;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .session .time span {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 48px;
            background: #fff;
            border-radius: 24px;
            color: var(--text-muted);
            box-shadow: 0 20px 48px rgba(15, 23, 42, 0.08);
        }

        .empty-state strong {
            display: block;
            font-size: 1.25rem;
            color: #111827;
            margin-bottom: 12px;
        }

        @media (max-width: 760px) {
            .session {
                grid-template-columns: 1fr;
                text-align: left;
            }

            .session .time {
                text-align: left;
                flex-direction: row;
                align-items: center;
            }
        }
    </style>
@endpush

@section('content')
    @php($metrics = $metrics ?? ['session_count' => 0, 'day_count' => 0, 'subject_count' => 0, 'template_count' => 0, 'cancelled_count' => 0])

    <section class="schedule-hero">
        <div class="hero-content">
            <div>
                <h1 class="hero-title">Jadwal Mengajar</h1>
                <p class="hero-subtitle">Pantau seluruh sesi bimbingan dan pastikan setiap pertemuan berjalan sesuai
                    rencana.</p>
            </div>
            @if ($nextSessionHighlight)
                <div class="hero-highlight">
                    <div class="hero-highlight-card">
                        <h3>Sesi Berikutnya</h3>
                        <p><strong>{{ $nextSessionHighlight['title'] }}</strong></p>
                        <p>{{ $nextSessionHighlight['subject'] }} &middot;
                            {{ $nextSessionHighlight['class_level'] }}</p>
                        <p>{{ $nextSessionHighlight['date_label'] }}</p>
                        <p>{{ $nextSessionHighlight['time_range'] }}</p>
                        <p>Lokasi: {{ $nextSessionHighlight['location'] }}</p>
                        @if ($nextSessionHighlight['student_count'])
                            <p>Peserta: {{ $nextSessionHighlight['student_count'] }} siswa</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>

    <div class="metric-grid">
        <div class="metric-card">
            <span>Total Sesi</span>
            <strong>{{ $metrics['session_count'] }}</strong>
        </div>
        <div class="metric-card">
            <span>Hari Terjadwal</span>
            <strong>{{ $metrics['day_count'] }}</strong>
        </div>
        <div class="metric-card">
            <span>Pola Jadwal Aktif</span>
            <strong>{{ $metrics['template_count'] }}</strong>
        </div>
        <div class="metric-card">
            <span>Sesi Dibatalkan</span>
            <strong>{{ $metrics['cancelled_count'] }}</strong>
        </div>
    </div>

    @if ($packages->isNotEmpty())
        <section class="template-manager">
            <div>
                <h2>Atur pola jadwal</h2>
                <p>Tambahkan pola pertemuan mingguan untuk menghasilkan jadwal otomatis hingga beberapa minggu ke depan.</p>
            </div>
            <form class="template-form" method="POST" action="{{ route('tutor.schedule.templates.store') }}">
                @csrf
                <label>
                    <span>Paket</span>
                    <select name="package_id" required>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}" @selected(old('package_id') == $package->id)>
                                {{ $package->detail_title ?? $package->title }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <span>Judul Sesi</span>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Klinik Matematika" required />
                </label>
                <label>
                    <span>Mata Pelajaran</span>
                    <input type="text" name="category" value="{{ old('category') }}" placeholder="Matematika" />
                </label>
                <label>
                    <span>Tingkat</span>
                    <input type="text" name="class_level" value="{{ old('class_level') }}" placeholder="SMA" />
                </label>
                <label>
                    <span>Lokasi</span>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Zoom / Kelas" />
                </label>
                <label>
                    <span>Hari</span>
                    @php($days = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 0 => 'Minggu'])
                    <select name="day_of_week" required>
                        @foreach ($days as $value => $label)
                            <option value="{{ $value }}" @selected((string) old('day_of_week') === (string) $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <span>Jam Mulai</span>
                    <input type="time" name="start_time" value="{{ old('start_time', '16:00') }}" required />
                </label>
                <label>
                    <span>Durasi (menit)</span>
                    <input type="number" name="duration_minutes" min="30" max="240" step="15" value="{{ old('duration_minutes', 90) }}" required />
                </label>
                <label>
                    <span>Kuota siswa</span>
                    <input type="number" name="student_count" min="1" max="200" value="{{ old('student_count') }}" />
                </label>
                <button type="submit">Tambah Pola</button>
            </form>
            @if ($errors->any())
                <div class="system-alert" style="margin: 0;">
                    <strong>Gagal menyimpan pola jadwal.</strong>
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($templates->isNotEmpty())
                <div class="template-list">
                    @foreach ($templates as $template)
                        <div class="template-card">
                            <form method="POST" action="{{ route('tutor.schedule.templates.update', $template) }}">
                                @csrf
                                @method('PUT')
                                <label>
                                    <span>Paket</span>
                                    <select name="package_id" required>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}" @selected($package->id === $template->package_id)>
                                                {{ $package->detail_title ?? $package->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                                <label>
                                    <span>Judul</span>
                                    <input type="text" name="title" value="{{ $template->title }}" required />
                                </label>
                                <label>
                                    <span>Mata Pelajaran</span>
                                    <input type="text" name="category" value="{{ $template->category }}" />
                                </label>
                                <label>
                                    <span>Tingkat</span>
                                    <input type="text" name="class_level" value="{{ $template->class_level }}" />
                                </label>
                                <label>
                                    <span>Lokasi</span>
                                    <input type="text" name="location" value="{{ $template->location }}" />
                                </label>
                                <label>
                                    <span>Hari</span>
                                    <select name="day_of_week" required>
                                        @foreach ($days as $value => $label)
                                            <option value="{{ $value }}" @selected($template->day_of_week === $value)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label>
                                    <span>Jam Mulai</span>
                                    <input type="time" name="start_time" value="{{ $template->start_time }}" required />
                                </label>
                                <label>
                                    <span>Durasi (menit)</span>
                                    <input type="number" name="duration_minutes" min="30" max="240" step="15" value="{{ $template->duration_minutes }}" required />
                                </label>
                                <label>
                                    <span>Kuota</span>
                                    <input type="number" name="student_count" min="1" max="200" value="{{ $template->student_count }}" />
                                </label>
                                <div class="template-actions">
                                    <button type="submit">Simpan</button>
                                </div>
                            </form>
                            <div class="template-actions">
                                <form method="POST" action="{{ route('tutor.schedule.templates.destroy', $template) }}" onsubmit="return confirm('Hapus pola jadwal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Hapus Pola</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    @if ($days->isEmpty())
        <div class="empty-state">
            <strong>Belum ada jadwal yang ditugaskan</strong>
            Silakan hubungi admin MayClass untuk menambahkan jadwal mengajar Anda.
        </div>
    @else
        <div class="schedule-wrapper">
            @foreach ($days as $day)
                <article class="day-card">
                    <div class="day-card-header">
                        <div>
                            <h2>{{ $day['day_label'] }}</h2>
                            <span>{{ $day['date_label'] }}</span>
                        </div>
                        <span style="font-weight: 600; color: var(--primary-dark);">{{ count($day['items']) }} sesi</span>
                    </div>

                    @foreach ($day['items'] as $item)
                        <div class="session">
                            <div>
                                <span class="badge">{{ $item['subject'] }}</span>
                                <h3>{{ $item['title'] }}</h3>
                                <div class="meta">{{ $item['class_level'] }} &middot; {{ $item['location'] }}</div>
                                @if ($item['student_count'])
                                    <div class="meta">Peserta: {{ $item['student_count'] }} siswa</div>
                                @endif
                                <div class="meta">Durasi: {{ $item['duration'] }} menit</div>
                            </div>
                            <div class="time">
                                {{ $item['time_range'] }}
                                <span>Waktu belajar</span>
                                <div class="session-actions">
                                    <span class="session-status">Terjadwal</span>
                                    @if ($item['is_future'] ?? false)
                                        <form method="POST" action="{{ route('tutor.schedule.sessions.cancel', $item['session_id']) }}" onsubmit="return confirm('Batalkan sesi ini?');">
                                            @csrf
                                            <button type="submit" class="cancel-button">Batalkan</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </article>
            @endforeach
        </div>
    @endif

    @if (($cancelledSessions ?? collect())->isNotEmpty())
        <section class="cancelled-section" style="margin-top: 28px;">
            <h3>Sesi yang dibatalkan</h3>
            <p style="color: var(--text-muted); margin: 0 0 16px;">Aktifkan kembali jadwal apabila pertemuan dijadwalkan ulang.</p>
            <table class="cancelled-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Paket</th>
                        <th>Mata Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cancelledSessions as $session)
                        @php($start = optional($session->start_at)->locale('id'))
                        <tr>
                            <td>{{ $start ? $start->translatedFormat('d M Y, H.i') : '-' }}</td>
                            <td>{{ $session->package?->detail_title ?? $session->package?->title ?? 'Paket MayClass' }}</td>
                            <td>{{ $session->title }}</td>
                            <td>
                                <form method="POST" action="{{ route('tutor.schedule.sessions.restore', $session) }}">
                                    @csrf
                                    <button type="submit" class="restore-button">Pulihkan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif
@endsection
