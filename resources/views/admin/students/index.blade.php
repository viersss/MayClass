@extends('admin.layout')

@section('title', 'Manajemen Siswa - MayClass')

@push('styles')
    <style>
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .section-header h2 {
            margin: 0;
            font-size: 1.6rem;
        }

        .students-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        }

        .students-table thead {
            background: rgba(61, 183, 173, 0.15);
        }

        .students-table th,
        .students-table td {
            padding: 18px 22px;
            text-align: left;
            font-size: 0.95rem;
        }

        .students-table tbody tr:not(:last-child) {
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-pill[data-state='active'] {
            background: rgba(31, 209, 161, 0.18);
            color: #0f766e;
        }

        .status-pill[data-state='inactive'] {
            background: rgba(244, 140, 6, 0.18);
            color: #b45309;
        }

        .table-action {
            color: var(--primary-dark);
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .students-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
@endpush

@section('content')
    <div class="section-header">
        <div>
            <h2>Manajemen Siswa</h2>
        </div>
    </div>

    <table class="students-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>ID Siswa</th>
                <th>Paket Aktif</th>
                <th>Status</th>
                <th>Berlaku sampai</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['email'] }}</td>
                    <td>{{ $student['student_id'] ?? '—' }}</td>
                    <td>{{ $student['package'] ?? 'Belum ada paket' }}</td>
                    <td>
                        <span class="status-pill" data-state="{{ $student['status_state'] }}">{{ $student['status'] }}</span>
                    </td>
                    <td>{{ $student['ends_at'] ?? '—' }}</td>
                    <td>
                        <a class="table-action" href="{{ route('admin.students.show', $student['id']) }}">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 42px 0;">
                        Belum ada data siswa yang tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
