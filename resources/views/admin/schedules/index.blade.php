@extends('admin.layout')

@section('title', 'Manajemen Jadwal - Admin MayClass')

@push('styles')
<style>
    /* =========================
       TOKENS & UTILITIES
    ========================== */
    :root{
        --danger: #ef4444;
        --surface-soft: color-mix(in srgb, var(--surface) 96%, #000 4%);
    }
    .stack{ display:grid; gap:8px; }
    .stack-8{ display:grid; gap:8px; }
    .stack-12{ display:grid; gap:12px; }
    .stack-16{ display:grid; gap:16px; }
    .stack-20{ display:grid; gap:20px; }
    .stack-24{ display:grid; gap:24px; }
    .stack-28{ display:grid; gap:28px; }
    .row{ display:flex; gap:12px; align-items:center; flex-wrap:wrap; }
    .muted{ color:var(--text-muted); }
    .w-100{ width:100%; }

    /* =========================
       PAGE STRUCTURE
    ========================== */
    .schedule-admin{ margin-top:8px; display:grid; gap:28px; }

    .hero-chip{
        display:inline-flex; align-items:center; gap:8px;
        padding:6px 14px; border-radius:999px;
        background:var(--surface-muted); border:1px solid var(--border);
        color:var(--text-muted); font-weight:600; font-size:.85rem; width:fit-content;
    }

    .schedule-header{
        padding:24px 28px; border-radius:16px;
        background:var(--surface); border:1px solid var(--border);
        box-shadow:0 10px 22px rgba(15,23,42,.06);
        display:flex; align-items:center; justify-content:space-between; gap:24px;
    }
    .schedule-header h3{ margin:10px 0 6px; font-size:1.7rem; }
    .schedule-header p{ margin:0; max-width:540px; color:var(--text-muted); line-height:1.6; }

    .tutor-filter{ min-width:220px; display:grid; gap:6px; }
    .tutor-filter label{ display:grid; gap:6px; font-weight:600; color:var(--text-muted); }
    .tutor-filter select{
        border-radius:10px; border:1px solid var(--border);
        padding:10px 12px; font:inherit; background:var(--surface);
    }

    /* =========================
       METRICS
    ========================== */
    .schedule-metrics{
        display:grid; grid-template-columns:repeat(4, minmax(0,1fr)); gap:12px;
    }
    .schedule-metric{
        padding:16px; border-radius:14px; background:var(--surface);
        border:1px solid var(--border); display:grid; gap:6px;
    }
    .schedule-metric span{ font-weight:600; color:var(--text-muted); font-size:.9rem; }
    .schedule-metric strong{ font-size:1.6rem; line-height:1.1; }

    /* =========================
       CARD
    ========================== */
    .card{
        background:var(--surface); border-radius:16px; border:1px solid var(--border);
        box-shadow:0 10px 24px rgba(15,23,42,.08); padding:24px;
    }
    .card-header{
        display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:18px;
    }
    .card-header h3{ margin:0; font-size:1.2rem; }
    .card-subtitle{ color:var(--text-muted); font-size:.9rem; }

    .empty-state{
        padding:18px; background:var(--surface-muted);
        border-radius:14px; border:1px dashed var(--border); text-align:center; color:var(--text-muted);
    }

    /* =========================
       CALENDAR / AGENDA
    ========================== */
    .calendar-stack{ display:grid; gap:16px; }
    .calendar-day{
        border:1px solid var(--border); border-radius:14px; padding:16px;
        display:grid; gap:14px; background:var(--surface-soft);
    }
    .calendar-day header{ display:flex; justify-content:space-between; align-items:center; gap:12px; }
    .calendar-day header strong{ font-size:1.1rem; }
    .calendar-sessions{ display:grid; gap:12px; }

    .session-card{
        display:flex; justify-content:space-between; gap:14px; padding:12px;
        border-radius:12px; border:1px solid var(--border); background:var(--surface);
    }
    .subject-badge{
        padding:4px 8px; border-radius:999px; background:rgba(37,99,235,.12);
        color:var(--primary); font-size:.8rem; font-weight:600;
    }
    .session-meta{ display:flex; flex-wrap:wrap; gap:6px; color:var(--text-muted); font-size:.9rem; }
    .session-time{ min-width:160px; display:grid; gap:4px; text-align:right; }

    /* =========================
       FORMS & BUTTONS
    ========================== */
    .field, .field input, .field select, .field textarea{ width:100%; }
    .field input, .field select, .field textarea,
    .input, .select, .textarea{
        padding:10px 12px; border-radius:10px; border:1px solid var(--border);
        font:inherit; background:var(--surface);
    }
    .input-sm, .select-sm{ padding:8px 10px; border-radius:8px; font-size:.9rem; }

    .btn{
        display:inline-flex; align-items:center; justify-content:center;
        height:40px; min-width:104px; padding:0 16px;
        border:none; border-radius:999px; font:inherit;
        font-weight:700; cursor:pointer; background:var(--primary); color:#fff;
    }
    .btn-ghost{ background:transparent; color:var(--primary); border:1px solid var(--primary); }
    .btn-danger{ background:var(--danger); }
    .btn-warning{ background:#ea580c; }

    /* =========================
       TEMPLATE LIST (Pola aktif)
       -> LIST rapi, longgar, profesional
    ========================== */
    .template-list{
        border:1px solid var(--border); border-radius:14px; overflow:hidden; background:var(--surface);
    }
    .template-list-head,
    .template-row{
        display:grid;
        /* PAKET | JUDUL&MAPEL | MULAI | DURASI&LOKASI | KUOTA | AKSI */
        grid-template-columns:
            minmax(220px, 1.2fr)
            minmax(320px, 1.6fr)
            minmax(200px, 1.0fr)
            minmax(320px, 1.35fr)
            minmax(120px, 0.6fr)
            minmax(220px, 0.9fr);
        column-gap:24px;   /* jarak antar-kolom lega */
        row-gap:12px;      /* jarak vertikal di baris */
        align-items:center;
        padding:16px 20px; /* padding baris */
    }
    .template-list-head{
        background:var(--surface-muted); font-weight:700; color:var(--text-muted);
        text-transform:uppercase; font-size:.78rem; letter-spacing:.04em;
        border-bottom:1px solid var(--border);
    }
    .template-row{ border-top:1px solid var(--border); }
    .template-row .cell{ display:grid; gap:8px; }

    /* Durasi & Lokasi: grid 2 kolom agar tidak “nempel” dengan Kuota */
    .cell--dl{
        display:grid; grid-template-columns:120px 1fr; column-gap:14px; align-items:center;
    }
    .cell--dl .minw-duration{ min-width:110px; }

    /* Kuota: lebar stabil agar tidak menekan kolom lain */
    .cell--quota .input-sm{ max-width:120px; width:100%; }

    /* Kolom Aksi: tombol rapi, tidak mepet dan tetap sejajar kanan */
    .template-row-actions{
        display:flex; gap:12px; justify-content:flex-end; align-items:center; white-space:nowrap; min-width:230px;
    }
    .template-row-actions .btn{ min-width:100px; }

    /* Mobile */
    .template-row .cell::before{ content:attr(data-label); display:none; font-size:.75rem; color:var(--text-muted); }
    @media (max-width:980px){
        .template-list-head{ display:none; }
        .template-row{ grid-template-columns:1fr; row-gap:14px; }
        .template-row .cell::before{ display:block; margin-bottom:4px; }
        .cell--dl{ grid-template-columns:1fr; row-gap:10px; }
        .template-row-actions{ justify-content:flex-start; }
    }

    /* =========================
       HISTORY TABLE
    ========================== */
    .history-table{ width:100%; border-collapse:collapse; }
    .history-table th, .history-table td{ padding:10px 8px; text-align:left; border-bottom:1px solid var(--border); }
    .history-table th{ font-size:.78rem; text-transform:uppercase; letter-spacing:.05em; color:var(--text-muted); }
</style>
@endpush

@section('content')
<section class="schedule-admin">

    {{-- HEADER --}}
    <div class="schedule-header">
        <div>
            <h3>Jadwal Pengajaran MayClass</h3>
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

    {{-- METRICS --}}
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

    {{-- =========================================
         1) ATUR POLA JADWAL (FULL-WIDTH)
    ========================================== --}}
    <article class="card">
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
            <form class="stack-16" method="POST" action="{{ route('admin.schedule.templates.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $schedule['selectedTutorId'] }}">

                <div class="template-form-grid">
                    <label class="field">
                        <span class="muted">Paket belajar</span>
                        <select name="package_id" class="select" required>
                            @foreach ($schedule['packages'] as $package)
                                <option value="{{ $package->id }}">{{ $package->detail_title }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="field">
                        <span class="muted">Judul sesi</span>
                        <input type="text" class="input" name="title" value="{{ old('title') }}" required>
                    </label>

                    <label class="field">
                        <span class="muted">Pelajaran</span>
                        <input type="text" class="input" name="category" value="{{ old('category') }}">
                    </label>

                    <label class="field">
                        <span class="muted">Tingkat kelas</span>
                        <input type="text" class="input" name="class_level" value="{{ old('class_level') }}">
                    </label>

                    <label class="field">
                        <span class="muted">Lokasi</span>
                        <input type="text" class="input" name="location" value="{{ old('location') }}">
                    </label>

                    <label class="field">
                        <span class="muted">Tanggal pertama</span>
                        <input type="date" class="input" name="reference_date" value="{{ old('reference_date', $schedule['referenceDate']) }}" required>
                    </label>

                    <label class="field">
                        <span class="muted">Jam mulai</span>
                        <input type="time" class="input" name="start_time" value="{{ old('start_time') }}" required>
                    </label>

                    <label class="field">
                        <span class="muted">Durasi (menit)</span>
                        <input type="number" class="input" name="duration_minutes" min="30" max="240" step="15" value="{{ old('duration_minutes', 90) }}" required>
                    </label>

                    <label class="field">
                        <span class="muted">Jumlah siswa</span>
                        <input type="number" class="input" name="student_count" min="1" max="200" value="{{ old('student_count') }}">
                    </label>
                </div>

                <div class="row" style="justify-content:flex-end;">
                    <button type="submit" class="btn">Tambah jadwal</button>
                </div>
            </form>
        @endif
    </article>

    {{-- =========================================
         2) POLA AKTIF (FULL-WIDTH LIST)
    ========================================== --}}
    <article class="card">
        <div class="card-header">
            <div>
                <h3>Pola aktif</h3>
                <span class="card-subtitle">Perbarui atau hapus jadwal berulang</span>
            </div>
        </div>

        @if ($schedule['templates']->isNotEmpty())
            <div class="template-list">
                <div class="template-list-head">
                    <span>Paket</span>
                    <span>Judul &amp; Mapel</span>
                    <span>Mulai</span>
                    <span>Durasi &amp; Lokasi</span>
                    <span>Kuota</span>
                    <span>Aksi</span>
                </div>

                @foreach ($schedule['templates'] as $template)
                    @php $formId = 'tpl-update-'.$template['id']; @endphp

                    <div class="template-row">
                        {{-- Paket --}}
                        <div class="cell" data-label="Paket">
                            <select name="package_id" class="select-sm w-100" form="{{ $formId }}" required>
                                @foreach ($schedule['packages'] as $package)
                                    <option value="{{ $package->id }}" @selected($package->id === $template['package_id'])>
                                        {{ $package->detail_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Judul & Mapel --}}
                        <div class="cell" data-label="Judul & Mapel">
                            <input type="text" name="title" class="input-sm w-100" value="{{ $template['title'] }}" form="{{ $formId }}" required>
                            <div class="row" style="gap:10px;">
                                <input type="text" name="category" class="input-sm" placeholder="Pelajaran" value="{{ $template['category'] }}" form="{{ $formId }}">
                                <input type="text" name="class_level" class="input-sm" placeholder="Tingkat" value="{{ $template['class_level'] }}" form="{{ $formId }}">
                            </div>
                        </div>

                        {{-- Mulai --}}
                        <div class="cell" data-label="Mulai">
                            <div class="stack">
                                <input type="date" name="reference_date" class="input-sm"
                                       value="{{ $template['reference_date_value'] ?? $schedule['referenceDate'] }}"
                                       form="{{ $formId }}" required>
                                <input type="time" name="start_time" class="input-sm"
                                       value="{{ $template['start_time'] }}" form="{{ $formId }}" required>
                            </div>
                        </div>

                        {{-- Durasi & Lokasi --}}
                        <div class="cell cell--dl" data-label="Durasi & Lokasi">
                            <input type="number" name="duration_minutes" class="input-sm minw-duration" min="30" max="240" step="15"
                                   value="{{ $template['duration_minutes'] }}" form="{{ $formId }}" required>
                            <input type="text" name="location" class="input-sm" placeholder="Lokasi"
                                   value="{{ $template['location'] }}" form="{{ $formId }}">
                        </div>

                        {{-- Kuota --}}
                        <div class="cell cell--quota" data-label="Kuota">
                            <input type="number" name="student_count" class="input-sm" min="1" max="200"
                                   value="{{ $template['student_count'] }}" form="{{ $formId }}">
                        </div>

                        {{-- Aksi --}}
                        <div class="cell template-row-actions" data-label="Aksi">
                            <form id="{{ $formId }}" method="POST" action="{{ route('admin.schedule.templates.update', $template['id']) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $template['user_id'] }}">
                                <button type="submit" class="btn">Simpan</button>
                            </form>
                            <form method="POST" action="{{ route('admin.schedule.templates.destroy', $template['id']) }}" onsubmit="return confirm('Hapus pola jadwal ini?');">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="redirect_tutor_id" value="{{ $schedule['activeFilter'] }}">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">Belum ada pola yang tersimpan.</div>
        @endif
    </article>

    {{-- =========================================
         3) AGENDA MENDATANG (FULL-WIDTH)
    ========================================== --}}
    <article class="card">
        <div class="card-header">
            <div>
                <h3>Agenda mendatang</h3>
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
                                <span class="muted"> — {{ $day['full_date'] }}</span>
                            </div>
                            <span class="card-subtitle">{{ count($day['items']) }} sesi</span>
                        </header>

                        <div class="calendar-sessions">
                            @foreach ($day['items'] as $session)
                                <div class="session-card">
                                    <div class="stack-8">
                                        <span class="subject-badge">{{ $session['subject'] }}</span>
                                        <h4 style="margin:0;">{{ $session['title'] }}</h4>

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
                                        <small class="muted">Waktu belajar</small>
                                        <div class="row" style="justify-content:flex-end;">
                                            <form method="POST" action="{{ route('admin.schedule.sessions.cancel', $session['id']) }}" onsubmit="return confirm('Batalkan sesi ini?');">
                                                @csrf
                                                <input type="hidden" name="redirect_tutor_id" value="{{ $schedule['activeFilter'] }}">
                                                <button type="submit" class="btn btn-warning">Batalkan</button>
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

    {{-- =========================================
         4) HISTORI SELESAI (FULL-WIDTH)
    ========================================== --}}
    <article class="card">
        <div class="card-header">
            <h3>Histori sesi selesai</h3>
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

    {{-- =========================================
         5) SESI DIBATALKAN (FULL-WIDTH)
    ========================================== --}}
    <article class="card">
        <div class="card-header">
            <h3>Sesi dibatalkan</h3>
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
                                    <button type="submit" class="btn">Pulihkan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </article>

</section>
@endsection
