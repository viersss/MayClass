@extends('tutor.layout')

@section('title', 'Jadwal Mengajar - MayClass')

@push('styles')
    <style>
        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .page-heading h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .page-heading p {
            margin: 6px 0 0;
            color: #6b7280;
        }

        .schedule-wrapper {
            display: grid;
            gap: 22px;
        }

        .day-card {
            background: #fff;
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 20px 48px rgba(15, 23, 42, 0.08);
        }

        .day-card h2 {
            margin: 0;
            font-size: 1.3rem;
        }

        .day-card span {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .session {
            margin-top: 18px;
            border: 1px solid #e5e9f2;
            border-radius: 18px;
            padding: 18px 20px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 16px;
            align-items: center;
        }

        .session h3 {
            margin: 0;
            font-size: 1.1rem;
        }

        .session .meta {
            color: #6b7280;
            font-size: 0.95rem;
            margin-top: 4px;
        }

        .session .badge {
            display: inline-flex;
            padding: 6px 12px;
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
        }

        .empty-state {
            text-align: center;
            padding: 48px;
            background: #fff;
            border-radius: 20px;
            color: #6b7280;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.05);
        }

        @media (max-width: 760px) {
            .session {
                grid-template-columns: 1fr;
                text-align: left;
            }

            .session .time {
                text-align: left;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-heading">
        <div>
            <h1>Jadwal Mengajar</h1>
            <p>Lihat dan kelola jadwal mengajar Anda.</p>
        </div>
        <a href="{{ route('tutor.schedule.index') }}" class="button" style="background: var(--primary-dark);">Lihat Kalender</a>
    </div>

    @if ($days->isEmpty())
        <div class="empty-state">Belum ada jadwal yang ditugaskan. Hubungi admin MayClass untuk menambahkan jadwal.</div>
    @else
        <div class="schedule-wrapper">
            @foreach ($days as $day)
                <div class="day-card">
                    <h2>{{ $day['day_label'] }}</h2>
                    <span>{{ $day['date_label'] }}</span>

                    @foreach ($day['items'] as $item)
                        <div class="session">
                            <div>
                                <span class="badge">{{ $item['subject'] }}</span>
                                <h3>{{ $item['title'] }}</h3>
                                <div class="meta">{{ $item['class_level'] }} &middot; {{ $item['location'] }}</div>
                                @if ($item['student_count'])
                                    <div class="meta">Peserta: {{ $item['student_count'] }} siswa</div>
                                @endif
                            </div>
                            <div class="time">{{ $item['time_range'] }} WIB</div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
@endsection
