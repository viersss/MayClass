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
            max-width: 540px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .tutor-filter {
            min-width: 220px;
            display: grid;
            gap: 8px;
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

        .schedule-grid {
            display: grid;
            gap: 28px;
            align-items: start;
        }

        .schedule-grid.calendar-only,
        .schedule-grid.history-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        .calendar-card,
        .history-stack > div,
        .template-section {
            background: var(--surface);
            border-radius: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            padding: 28px;
            display: grid;
            gap: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .card-header h3 {
            margin: 0;
        }

        .card-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .empty-state {
            padding: 24px;
            background: var(--surface-muted);
            border-radius: 18px;
            border: 1px dashed var(--border);
            text-align: center;
            color: var(--text-muted);
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
        }

        .calendar-day header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
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
            padding: 16px;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: var(--surface-muted);
        }

        .session-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .subject-badge {
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: var(--primary);
            font-size: 0.8rem;
            font-weight: 600;
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

        .session-actions button,
        .template-actions button,
        .template-section button {
            border: none;
            border-radius: 999px;
            padding: 10px 18px;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
            background: var(--primary);
            color: #fff;
        }

        .session-actions button:last-child,
        .template-actions button[type='submit'] {
            background: #ea580c;
        }

        .template-form,
        .template-card form {
            display: grid;
            gap: 20px;
        }

        .template-pair {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 24px;
            margin-top: 8px;
        }

        .template-form-grid,
        .template-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .template-card-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .template-form-grid label,
        .template-card-grid label {
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .template-form-grid input,
        .template-form-grid select,
        .template-card-grid input,
        .template-card-grid select,
        .template-card-grid textarea {
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid var(--border);
            font: inherit;
        }

        .template-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .template-actions form {
            display: inline;
        }

        .template-card {
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px;
            display: grid;
            gap: 16px;
        }

        .template-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 18px;
        }

        .template-card-footer {
            justify-content: space-between;
        }

        .history-stack {
            display: grid;
            gap: 20px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th,
        .history-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .history-table th {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
        }

        .history-table button {
            border: none;
            background: var(--primary);
            color: #fff;
            padding: 6px 12px;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 600;
        }

        .template-section small {
            color: var(--text-muted);
        }
    </style>
@endpush

@section('content')
    <section class="schedule-admin">
        <div class="schedule-header">
            <div>
                <span class="hero-chip">Penjadwalan tutor</span>
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
        <div class="schedule-grid calendar-only">
            <article class="calendar-card">
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
        </div>
        <div class="template-pair">
            <div class="template-section">
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
            </div>
            <div class="template-section">
                <div class="card-header">
                    <div>
                        <h3>Pola aktif</h3>
                        <span class="card-subtitle">Perbarui atau hapus jadwal berulang</span>
                    </div>
                </div>
                @if ($schedule['templates']->isNotEmpty())
                    <div class="template-grid">
                        @foreach ($schedule['templates'] as $template)
                            <div class="template-card">
                                <form method="POST" action="{{ route('admin.schedule.templates.update', $template['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="user_id" value="{{ $template['user_id'] }}">
                                    <div class="template-card-grid">
                                        <label>
                                            <span>Paket</span>
                                            <select name="package_id" required>
                                                @foreach ($schedule['packages'] as $package)
                                                    <option value="{{ $package->id }}" @selected($package->id === $template['package_id'])>
                                                        {{ $package->detail_title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <label>
                                            <span>Judul</span>
                                            <input type="text" name="title" value="{{ $template['title'] }}" required>
                                        </label>
                                        <label>
                                            <span>Pelajaran</span>
                                            <input type="text" name="category" value="{{ $template['category'] }}">
                                        </label>
                                        <label>
                                            <span>Tingkat</span>
                                            <input type="text" name="class_level" value="{{ $template['class_level'] }}">
                                        </label>
                                        <label>
                                            <span>Lokasi</span>
                                            <input type="text" name="location" value="{{ $template['location'] }}">
                                        </label>
                                        <label>
                                            <span>Tanggal pertama</span>
                                            <input type="date" name="reference_date" value="{{ $template['reference_date_value'] ?? $schedule['referenceDate'] }}" required>
                                        </label>
                                        <label>
                                            <span>Jam mulai</span>
                                            <input type="time" name="start_time" value="{{ $template['start_time'] }}" required>
                                        </label>
                                        <label>
                                            <span>Durasi</span>
                                            <input type="number" name="duration_minutes" min="30" max="240" step="15" value="{{ $template['duration_minutes'] }}" required>
                                        </label>
                                        <label>
                                            <span>Kuota siswa</span>
                                            <input type="number" name="student_count" min="1" max="200" value="{{ $template['student_count'] }}">
                                        </label>
                                    </div>
                                    <div class="template-actions">
                                        <button type="submit">Simpan</button>
                                    </div>
                                </form>
                                <div class="template-actions template-card-footer">
                                    <form method="POST" action="{{ route('admin.schedule.templates.destroy', $template['id']) }}" onsubmit="return confirm('Hapus pola jadwal ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="redirect_tutor_id" value="{{ $schedule['activeFilter'] }}">
                                        <button type="submit">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">Belum ada pola yang tersimpan.</div>
                @endif
            </div>
        </div>
        <div class="schedule-grid history-grid">
            <div class="history-stack">
                <div>
                    <div class="card-header">
                        <h3>Histori sesi selesai</h3>
                        <span class="card-subtitle">Pertemuan yang selesai otomatis tersimpan di daftar ini.</span>
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
                </div>
                <div>
                    <div class="card-header">
                        <h3>Sesi dibatalkan</h3>
                        <span class="card-subtitle">Pulihkan jadwal jika pertemuan dijadwalkan ulang.</span>
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
                </div>
            </div>
        </div>
    </section>
@endsection
