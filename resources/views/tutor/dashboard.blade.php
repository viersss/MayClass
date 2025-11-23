@extends('tutor.layout')

@section('title', 'Dashboard Tentor - MayClass')

@push('styles')
<style>
    :root {
        /* Color Palette */
        --primary: #0f766e;
        --primary-dark: #115e59;
        --primary-light: #ccfbf1;
        
        --text-main: #0f172a;
        --text-muted: #64748b;
        --text-light: #94a3b8;
        
        --bg-body: #f8fafc;
        --bg-card: #ffffff;
        
        --border: #e2e8f0;
        
        /* Effects */
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        
        --radius-xl: 24px;
        --radius-lg: 16px;
        --radius-md: 12px;
    }

    .dashboard-container {
        display: flex;
        flex-direction: column;
        gap: 40px;
        max-width: 1280px;
        margin: 0 auto;
        padding-bottom: 40px;
    }

    /* --- 1. HERO SECTION (CLEAN) --- */
    .hero-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-xl);
        padding: 48px;
        color: white;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    /* Subtle Pattern Overlay */
    .hero-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 25%), 
                          radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 20%);
        pointer-events: none;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 700px;
    }

    .hero-content h1 {
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 12px;
        letter-spacing: -0.02em;
    }

    .hero-content p {
        font-size: 1.1rem;
        line-height: 1.6;
        opacity: 0.9;
        margin: 0;
        font-weight: 400;
    }

    /* --- 2. STATS GRID --- */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 24px;
    }

    .stat-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: #cbd5e1;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    /* Icon Colors Variants */
    .bg-blue-soft { background: #eff6ff; color: #2563eb; }
    .bg-green-soft { background: #f0fdf4; color: #16a34a; }
    .bg-orange-soft { background: #fff7ed; color: #ea580c; }
    .bg-purple-soft { background: #f5f3ff; color: #7c3aed; }

    .stat-info {
        display: flex;
        flex-direction: column;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: capitalize;
    }

    /* --- 3. AGENDA SECTION --- */
    .agenda-section {
        background: var(--bg-card);
        border-radius: var(--radius-xl);
        border: 1px solid var(--border);
        padding: 32px;
        box-shadow: var(--shadow-sm);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--bg-body);
    }

    .section-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0;
    }

    .date-badge {
        background: var(--bg-body);
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-muted);
        border: 1px solid var(--border);
    }

    /* Session List Layout */
    .session-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .session-card {
        display: grid;
        grid-template-columns: 140px 1fr;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: border-color 0.2s;
    }

    .session-card:hover {
        border-color: var(--text-light);
    }

    .session-card.active {
        border-color: var(--primary);
        box-shadow: 0 0 0 1px var(--primary);
        background-color: #fafffe;
    }

    /* Time Column */
    .session-time {
        background: var(--bg-body);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        text-align: center;
        border-right: 1px solid var(--border);
    }

    .time-start {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-main);
    }

    .time-end {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-top: 4px;
    }

    /* Details Column */
    .session-details {
        padding: 20px 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 12px;
    }

    .session-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .session-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0;
    }

    .badges-row {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge {
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 600;
        letter-spacing: 0.02em;
    }

    .badge-subject { background: #e0f2fe; color: #0369a1; }
    .badge-level { background: #f3e8ff; color: #7e22ce; }

    .meta-info {
        display: flex;
        gap: 24px;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .meta-item svg {
        width: 16px;
        height: 16px;
        color: var(--text-light);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--bg-body);
        border-radius: var(--radius-lg);
        border: 2px dashed var(--border);
    }
    
    .empty-state svg {
        width: 48px;
        height: 48px;
        color: var(--text-light);
        margin-bottom: 16px;
    }

    .empty-state p {
        color: var(--text-muted);
        margin: 0;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .hero-card { padding: 32px; }
        .session-card { grid-template-columns: 1fr; }
        .session-time { 
            flex-direction: row; 
            gap: 12px; 
            border-right: none; 
            border-bottom: 1px solid var(--border); 
            padding: 12px;
            justify-content: flex-start;
        }
        .time-end::before { content: "- "; }
    }
</style>
@endpush

@section('content')
@php
    use Illuminate\Support\Str;
    $firstName = $tutor?->name ? Str::of($tutor->name)->before(' ') : 'Tutor';
@endphp

<div class="dashboard-container">
    
    {{-- 1. HERO SECTION (Clean Version) --}}
    <div class="hero-card">
        <div class="hero-content">
            <h1>Selamat Datang, {{ $firstName }}! 👋</h1>
            <p>
                Pantau jadwal mengajar, kelola materi, dan lihat perkembangan siswa Anda dalam satu tempat. 
                Siap memberikan yang terbaik hari ini?
            </p>
        </div>
    </div>

    {{-- 2. STATISTICS GRID --}}
    <div class="stats-grid">
        @foreach ($highlightStats as $stat)
            @php
                $label = trim($stat['label'] ?? '');
                $displayVal = $stat['display'] ?? '0';
                $normalized = Str::lower($label);
                
                if (Str::contains($normalized, 'materi')) {
                    $icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>';
                    $class = 'bg-blue-soft';
                } elseif (Str::contains($normalized, ['quiz', 'kuis'])) {
                    $icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                    $class = 'bg-purple-soft';
                } elseif (Str::contains($normalized, 'siswa')) {
                    $icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>';
                    $class = 'bg-orange-soft';
                } else {
                    $icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>';
                    $class = 'bg-green-soft';
                }
            @endphp

            <div class="stat-card">
                <div class="stat-icon {{ $class }}">
                    {!! $icon !!}
                </div>
                <div class="stat-info">
                    <span class="stat-value">{{ $displayVal }}</span>
                    <span class="stat-label">{{ $label }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 3. AGENDA / SCHEDULE SECTION --}}
    <div class="agenda-section">
        <div class="section-header">
            <h2>Agenda Mengajar</h2>
            <span class="date-badge">
                <svg width="14" height="14" style="vertical-align: -2px; margin-right: 4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ $todayLabel }}
            </span>
        </div>

        @if ($todaySessions->isEmpty())
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p>Tidak ada jadwal mengajar hari ini.</p>
                <p style="font-size: 0.85rem; margin-top: 4px;">Gunakan waktu ini untuk mempersiapkan materi mendatang.</p>
            </div>
        @else
            <div class="session-list">
                @foreach ($todaySessions as $session)
                    @php
                        $times = explode('-', $session['time_range']);
                        $start = trim($times[0] ?? '');
                        $end = trim($times[1] ?? '');
                        $isActive = !empty($session['highlight']);
                    @endphp

                    <div class="session-card {{ $isActive ? 'active' : '' }}">
                        <div class="session-time">
                            <span class="time-start">{{ $start }}</span>
                            @if($end) <span class="time-end">{{ $end }} WIB</span> @endif
                        </div>

                        <div class="session-details">
                            <div class="session-header">
                                <div style="display:flex; flex-direction:column; gap:6px;">
                                    <div class="badges-row">
                                        <span class="badge badge-subject">{{ $session['subject'] }}</span>
                                        <span class="badge badge-level">{{ $session['class_level'] }}</span>
                                    </div>
                                    <h3 class="session-title">{{ $session['title'] }}</h3>
                                </div>
                            </div>

                            <div class="meta-info">
                                <div class="meta-item">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span>{{ $session['location'] }}</span>
                                </div>
                                <div class="meta-item">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    <span>{{ $session['student_count'] ? $session['student_count'] . ' Siswa' : 'Private' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection