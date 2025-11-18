@extends('admin.layout')

@section('title', 'Manajemen Jadwal - Admin MayClass')

@push('styles')
    <style>
        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            background: var(--surface-muted);
            border: 1px solid var(--border);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.85rem;
            width: fit-content;
        }

        .schedule-admin {
            margin-top: 8px;
            display: grid;
            gap: 28px;
        }

        .schedule-header {
            padding: 32px;
            border-radius: 20px;
            background: var(--surface);
            border: 1px solid var(--border);
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .schedule-header h3 {
            margin: 12px 0 10px;
            font-size: 1.9rem;
        }

        .schedule-header p {
            margin: 0;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .schedule-header-content {
            flex: 1;
        }

        .tutor-filter {
            min-width: 220px;
            display: grid;
            gap: 8px;
            flex-shrink: 0;
        }

        .tutor-filter label {
            display: grid;
            gap: 6px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .tutor-filter select {
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 10px 12px;
            font: inherit;
        }

        .schedule-metrics {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .schedule-metric {
            padding: 20px;
            border-radius: 16px;
            background: var(--surface);
            border: 1px solid var(--border);
            display: grid;
            gap: 8px;
        }

        .schedule-metric span {
            font-weight: 600;
            color: var(--text-muted);
        }

        .schedule-metric strong {
            font-size: 1.8rem;
        }

        /* New Two Column Layout */
        .schedule-main-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        /* Card Styling */
        .schedule-card {
            background: var(--surface);
            border-radius: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            padding: 28px;
            display: grid;
            gap: 20px;
            height: fit-content;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.4rem;
        }

        .card-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .empty-state {
            padding: 32px 24px;
            background: var(--surface-muted);
            border-radius: 16px;
            border: 1px dashed var(--border);
            text-align: center;
            color: var(--text-muted);
        }

        /* Template Form Styling */
        .template-form {
            display: grid;
            gap: 20px;
        }

        .template-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .template-form-grid label {
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-weight: 600;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .template-form-grid input,
        .template-form-grid select {
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid var(--border);
            font: inherit;
            transition: border-color 0.2s;
        }

        .template-form-grid input:focus,
        .template-form-grid select:focus {
            outline: none;
            border-color: var(--primary);
        }

        .template-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .template-actions button {
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
            background: var(--primary);
            color: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .template-actions button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .template-actions button[type='submit']:last-child {
            background: #ea580c;
        }

        /* Active Templates Table */
        .template-table {
            width: 100%;
            border-collapse: collapse;
        }

        .template-table th,
        .template-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .template-table th {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            font-weight: 700;
            background: var(--surface-muted);
        }

        .template-table tbody tr {
            transition: background-color 0.2s;
        }

        .template-table tbody tr:hover {
            background: var(--surface-muted);
        }

        .template-table input,
        .template-table select {
            padding: 6px 8px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font: inherit;
            font-size: 0.85rem;
            width: 100%;
            background: var(--surface);
        }

        .template-table input[type="time"],
        .template-table input[type="date"] {
            min-width: 110px;
        }

        .template-table input[type="number"] {
            min-width: 70px;
        }

        .template-table-actions {
            display: flex;
            gap: 6px;
            justify-content: flex-end;
        }

        .template-table-actions button {
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.85rem;
            transition: transform 0.2s;
            white-space: nowrap;
        }

        .template-table-actions button[type='submit']:first-child {
            background: var(--primary);
            color: #fff;
        }

        .template-table-actions form:last-child button {
            background: #ea580c;
            color: #fff;
        }

        .template-table-actions button:hover {
            transform: translateY(-1px);
        }

        /* History Tables */
        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th,
        .history-table td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .history-table th {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            font-weight: 700;
            background: var(--surface-muted);
        }

        .history-table tbody tr {
            transition: background-color 0.2s;
        }

        .history-table tbody tr:hover {
            background: var(--surface-muted);
        }

        .history-table button {
            border: none;
            background: var(--primary);
            color: #fff;
            padding: 6px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            transition: transform 0.2s;
        }

        .history-table button:hover {
            transform: translateY(-1px);
        }

        /* Agenda Section - Full Width */
        .agenda-section {
            grid-column: 1 / -1;
        }

        .calendar-stack {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .calendar-day {
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 20px;
            display: grid;
            gap: 16px;
            background: var(--surface-muted);
        }

        .calendar-day header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .calendar-day header strong {
            font-size: 1.2rem;
        }

        .calendar-sessions {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .session-card {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 18px;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: var(--surface);
        }

        .session-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 6px;
        }

        .subject-badge {
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: var(--primary);
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 8px;
            display: inline-block;
        }

        .session-card h4 {
            margin: 4px 0;
            font-size: 1.1rem;
        }

        .session-time {
            min-width: 160px;
            display: grid;
            gap: 4px;
            text-align: right;
        }

        .session-actions {
            margin-top: 8px;
            display: inline-flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .session-actions button {
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
            background: #ea580c;
            color: #fff;
            font-size: 0.9rem;
            transition: transform 0.2s;
        }

        .session-actions button:hover {
            transform: translateY(-1px);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .schedule-main-grid {
                grid-template-columns: 1fr;
            }
            
            .template-form-grid,
            .template-card-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .schedule-metrics {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .schedule-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@section('content')
    <section class="schedule-admin">
        <!-- Header Section -->
        <div class="schedule-header">
            <div class="schedule-header-content">
                <h3>Kalender pengajaran MayClass</h3>
                <p>
                    Admin dapat meninjau jadwal setiap tutor, mengatur pola pertemuan, dan memastikan sesi yang telah
                    berlalu otomatis berpindah ke histori.
                </p>
            </div>
            @if ($schedule['tutors']->isNotEmpty())
                <form method="GET" action="{{ route('admin.schedules.index') }}" class="tutor-filter">
                    <label>
                        <span>Pilih tutor</span>
                        <select name="tutor_id" onchange="this.form.submit()">
                            <option value="all" @selected($schedule['activeFilter'] === 'all')>Semua tutor</option>
                            @foreach ($schedule['tutors'] as $tutor)
                                <option value="{{ $tutor->id }}" @selected($schedule['activeFilter'] === (string) $tutor->id)>
                                    {{ $tutor->name }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                </form>
            @endif
        </div>

        <!-- Metrics Section -->
        <div class="schedule-metrics">
            <article class="schedule-metric">
                <span>Sesi akan datang</span>
                <strong>{{ number_format($schedule['metrics']['upcoming']) }}</strong>
            </article>
            <article class="schedule-metric">
                <span>Histori selesai</span>
                <strong>{{ number_format($schedule['metrics']['history']) }}</strong>
            </article>
            <article class="schedule-metric">
                <span>Dibatalkan</span>
                <strong>{{ number_format($schedule['metrics']['cancelled']) }}</strong>
            </article>
            <article class="schedule-metric">
                <span>Pola aktif</span>
                <strong>{{ number_format($schedule['metrics']['templates']) }}</strong>
            </article>
        </div>

        <!-- Main Grid: Template Management -->
        <div class="schedule-main-grid">
            <!-- Left Column: Create Template -->
            <article class="schedule-card">
                <div class="card-header">
                    <div>
                        <h3>Atur pola jadwal</h3>
                        <span class="card-subtitle">Buat template sesi untuk tutor terpilih</span>
                    </div>
                </div>
                @if (! $schedule['selectedTutorId'])
                    <div class="empty-state">Pilih tutor terlebih dahulu untuk menambahkan jadwal.</div>
                @elseif ($schedule['packages']->isEmpty())
                    <div class="empty-state">Belum ada paket belajar yang bisa dihubungkan. Tambahkan paket terlebih dahulu.</div>
                @else
                    <form class="template-form" method="POST" action="{{ route('admin.schedule.templates.store') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $schedule['selectedTutorId'] }}">
                        <div class="template-form-grid">
                            <label>
                                <span>Paket belajar</span>
                                <select name="package_id" required>
                                    @foreach ($schedule['packages'] as $package)
                                        <option value="{{ $package->id }}">{{ $package->detail_title }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label>
                                <span>Judul sesi</span>
                                <input type="text" name="title" value="{{ old('title') }}" required>
                            </label>
                            <label>
                                <span>Pelajaran</span>
                                <input type="text" name="category" value="{{ old('category') }}">
                            </label>
                            <label>
                                <span>Tingkat kelas</span>
                                <input type="text" name="class_level" value="{{ old('class_level') }}">
                            </label>
                            <label>
                                <span>Lokasi</span>
                                <input type="text" name="location" value="{{ old('location') }}">
                            </label>
                            <label>
                                <span>Tanggal pertama</span>
                                <input type="date" name="reference_date" value="{{ old('reference_date', $schedule['referenceDate']) }}" required>
                            </label>
                            <label>
                                <span>Jam mulai</span>
                                <input type="time" name="start_time" value="{{ old('start_time') }}" required>
                            </label>
                            <label>
                                <span>Durasi (menit)</span>
                                <input type="number" name="duration_minutes" min="30" max="240" step="15" value="{{ old('duration_minutes', 90) }}" required>
                            </label>
                            <label>
                                <span>Jumlah siswa</span>
                                <input type="number" name="student_count" min="1" max="200" value="{{ old('student_count') }}">
                            </label>
                        </div>
                        <div class="template-actions">
                            <button type="submit">Tambah jadwal</button>
                        </div>
                    </form>
                @endif
            </article>

            <!-- Right Column: Active Templates -->
            <article class="schedule-card">
                <div class="card-header">
                    <div>
                        <h3>Pola aktif</h3>
                        <span class="card-subtitle">Perbarui atau hapus jadwal berulang</span>
                    </div>
                </div>
                @if ($schedule['templates']->isNotEmpty())
                    <table class="template-table">
                        <thead>
                            <tr>
                                <th>Paket</th>
                                <th>Judul</th>
                                <th>Pelajaran</th>
                                <th>Tingkat</th>
                                <th>Lokasi</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Durasi</th>
                                <th>Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule['templates'] as $template)
                                <tr>
                                    <form method="POST" action="{{ route('admin.schedule.templates.update', $template['id']) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="user_id" value="{{ $template['user_id'] }}">
                                        <td>
                                            <select name="package_id" required>
                                                @foreach ($schedule['packages'] as $package)
                                                    <option value="{{ $package->id }}" @selected($package->id === $template['package_id'])>
                                                        {{ $package->detail_title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="title" value="{{ $template['title'] }}" required>
                                        </td>
                                        <td>
                                            <input type="text" name="category" value="{{ $template['category'] }}">
                                        </td>
                                        <td>
                                            <input type="text" name="class_level" value="{{ $template['class_level'] }}">
                                        </td>
                                        <td>
                                            <input type="text" name="location" value="{{ $template['location'] }}">
                                        </td>
                                        <td>
                                            <input type="date" name="reference_date" value="{{ $template['reference_date_value'] ?? $schedule['referenceDate'] }}" required>
                                        </td>
                                        <td>
                                            <input type="time" name="start_time" value="{{ $template['start_time'] }}" required>
                                        </td>
                                        <td>
                                            <input type="number" name="duration_minutes" min="30" max="240" step="15" value="{{ $template['duration_minutes'] }}" required>
                                        </td>
                                        <td>
                                            <input type="number" name="student_count" min="1" max="200" value="{{ $template['student_count'] }}">
                                        </td>
                                        <td>
                                            <div class="template-table-actions">
                                                <button type="submit">Simpan</button>
                                    </form>
                                                <form method="POST" action="{{ route('admin.schedule.templates.destroy', $template['id']) }}" onsubmit="return confirm('Hapus pola jadwal ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="redirect_tutor_id" value="{{ $schedule['activeFilter'] }}">
                                                    <button type="submit">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">Belum ada pola yang tersimpan.</div>
                @endif
            </article>
       <!-- Full Width: Agenda Section -->
        <article class="schedule-card agenda-section">
            <div class="card-header">
                <div>
                    <h3>Agenda mendatang</h3>
                    <span class="card-subtitle">Kelompokkan jadwal berdasarkan tanggal kalender</span>
                </div>
            </div>
            @if (! $schedule['ready'])
                <div class="empty-state">Sistem jadwal belum siap. Pastikan migrasi jadwal telah dijalankan.</div>
            @elseif ($schedule['upcomingDays']->isEmpty())
                <div class="empty-state">Belum ada sesi mengajar yang tercatat.</div>
            @else
                <div class="calendar-stack">
                    @foreach ($schedule['upcomingDays'] as $day)
                        <article class="calendar-day">
                            <header>
                                <div>
                                    <strong>{{ $day['weekday'] }}</strong>
                                    <span>{{ $day['full_date'] }}</span>
                                </div>
                                <span class="card-subtitle">{{ count($day['items']) }} sesi</span>
                            </header>
                            <div class="calendar-sessions">
                                @foreach ($day['items'] as $session)
                                    <div class="session-card">
                                        <div>
                                            <span class="subject-badge">{{ $session['subject'] }}</span>
                                            <h4>{{ $session['title'] }}</h4>
                                            <div class="session-meta">
                                                <span>{{ $session['package'] }}</span>
                                                <span>&middot;</span>
                                                <span>{{ $session['class_level'] }}</span>
                                            </div>
                                            <div class="session-meta">
                                                <span>Pengajar: {{ $session['tutor'] }}</span>
                                            </div>
                                            <div class="session-meta">
                                                <span>Lokasi: {{ $session['location'] }}</span>
                                                @if ($session['student_count'])
                                                    <span>&middot;</span>
                                                    <span>{{ $session['student_count'] }} siswa</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="session-time">
                                            <strong>{{ $session['time_range'] }}</strong>
                                            <small>Waktu belajar</small>
                                            <div class="session-actions">
                                                <form method="POST" action="{{ route('admin.schedule.sessions.cancel', $session['id']) }}" onsubmit="return confirm('Batalkan sesi ini?');">
                                                    @csrf
                                                    <input type="hidden" name="redirect_tutor_id" value="{{ $schedule['activeFilter'] }}">
                                                    <button type="submit">Batalkan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </article>
            <!-- Left Column: History Sessions -->
            <article class="schedule-card">
                <div class="card-header">
                    <div>
                        <h3>Histori sesi selesai</h3>
                        <span class="card-subtitle">Pertemuan yang selesai otomatis tersimpan di daftar ini</span>
                    </div>
                </div>
                @if ($schedule['historySessions']->isEmpty())
                    <div class="empty-state">Belum ada sesi yang selesai.</div>
                @else
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Pengajar</th>
                                <th>Paket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule['historySessions'] as $history)
                                <tr>
                                    <td>{{ $history['label'] }}</td>
                                    <td>{{ $history['time_range'] }}</td>
                                    <td>{{ $history['tutor'] }}</td>
                                    <td>{{ $history['package'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </article>

            <!-- Right Column: Cancelled Sessions -->
            <article class="schedule-card">
                <div class="card-header">
                    <div>
                        <h3>Sesi dibatalkan</h3>
                        <span class="card-subtitle">Pulihkan jadwal jika pertemuan dijadwalkan ulang</span>
                    </div>
                </div>
                @if ($schedule['cancelledSessions']->isEmpty())
                    <div class="empty-state">Tidak ada sesi yang dibatalkan.</div>
                @else
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Pengajar</th>
                                <th>Paket</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule['cancelledSessions'] as $cancelled)
                                <tr>
                                    <td>{{ $cancelled['label'] }}</td>
                                    <td>{{ $cancelled['time_range'] }}</td>
                                    <td>{{ $cancelled['tutor'] }}</td>
                                    <td>{{ $cancelled['package'] }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.schedule.sessions.restore', $cancelled['id']) }}">
                                            @csrf
                                            <input type="hidden" name="redirect_tutor_id" value="{{ $schedule['activeFilter'] }}">
                                            <button type="submit">Pulihkan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </article>
        </div>

    </section>
@endsection