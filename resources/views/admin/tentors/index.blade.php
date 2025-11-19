@extends('admin.layout')

@section('title', 'Manajemen Tentor - MayClass')

@push('styles')
    <style>
        .tentor-page {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .tentor-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border-radius: 20px;
            padding: 28px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .tentor-header h1 {
            margin: 0;
            font-size: 1.7rem;
            color: #0f172a;
        }

        .tentor-header p {
            margin: 6px 0 0;
            color: #64748b;
        }

        .tentor-header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .tentor-search {
            position: relative;
        }

        .tentor-search input {
            border-radius: 999px;
            border: 1px solid #e2e8f0;
            padding: 10px 18px;
            padding-left: 42px;
            min-width: 260px;
            font-size: 0.95rem;
            background: #f8fafc;
        }

        .tentor-search svg {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .btn-primary {
            background: #0f766e;
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 12px 22px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .tentor-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .tentor-stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #e2e8f0;
        }

        .tentor-stat-card span {
            font-size: 0.85rem;
            color: #64748b;
        }

        .tentor-stat-card strong {
            font-size: 1.8rem;
            color: #0f172a;
        }

        .tentor-filter-form {
            display: flex;
            gap: 16px;
            align-items: center;
            background: #fff;
            border-radius: 16px;
            padding: 16px;
            border: 1px solid #e2e8f0;
        }

        .tentor-filter-form select {
            border-radius: 10px;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .tentor-table-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #94a3b8;
            background: #f8fafc;
            padding: 16px 20px;
        }

        td {
            padding: 18px 20px;
            border-top: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .tentor-profile {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .tentor-profile img {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        .tentor-profile strong {
            display: block;
            color: #0f172a;
        }

        .tentor-profile small {
            color: #64748b;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-active {
            background: #ecfdf5;
            color: #047857;
        }

        .status-inactive {
            background: #fef2f2;
            color: #b91c1c;
        }

        .tentor-actions {
            display: flex;
            gap: 8px;
        }

        .tentor-actions a,
        .tentor-actions button {
            border: 1px solid #cbd5e1;
            border-radius: 999px;
            padding: 8px 16px;
            font-size: 0.85rem;
            background: #fff;
            cursor: pointer;
            text-decoration: none;
        }

        .tentor-actions button {
            color: #b91c1c;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #64748b;
        }
    </style>
@endpush

@section('content')
    <div class="tentor-page">
        <div class="tentor-header">
            <div>
                <h1>Manajemen Tentor</h1>
                <p>Kelola seluruh profil tentor, atur status aktif/nonaktif, dan ubah data profil kapan pun.</p>
            </div>
            <div class="tentor-header-actions">
                <form method="GET" class="tentor-search" action="{{ route('admin.tentors.index') }}">
                    <input type="text" name="q" value="{{ $filters['query'] }}" placeholder="Cari tentor berdasarkan nama atau email...">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m1.85-5.4A7.5 7.5 0 1 1 5 5a7.5 7.5 0 0 1 13.5 6.25Z"/></svg>
                    <input type="hidden" name="status" value="{{ $filters['status'] }}">
                </form>
                <a href="{{ route('admin.tentors.create') }}" class="btn-primary">Tambah Tentor</a>
            </div>
        </div>

        <div class="tentor-stats">
            <div class="tentor-stat-card">
                <span>Total Tentor</span>
                <strong>{{ number_format($stats['total']) }}</strong>
            </div>
            <div class="tentor-stat-card">
                <span>Aktif</span>
                <strong style="color:#0f766e;">{{ number_format($stats['active']) }}</strong>
            </div>
            <div class="tentor-stat-card">
                <span>Nonaktif</span>
                <strong style="color:#b91c1c;">{{ number_format($stats['inactive']) }}</strong>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.tentors.index') }}" class="tentor-filter-form">
            <label for="status">Filter status:</label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="all" @selected($filters['status'] === 'all')>Semua Tentor</option>
                <option value="active" @selected($filters['status'] === 'active')>Aktif</option>
                <option value="inactive" @selected($filters['status'] === 'inactive')>Nonaktif</option>
            </select>
            <input type="hidden" name="q" value="{{ $filters['query'] }}">
        </form>

        <div class="tentor-table-card">
            <table>
                <thead>
                    <tr>
                        <th>Tentor</th>
                        <th>Kontak</th>
                        <th>Spesialisasi</th>
                        <th>Pengalaman</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tentors as $tentor)
                        <tr>
                            <td>
                                <div class="tentor-profile">
                                    <img src="{{ $tentor['avatar'] }}" alt="Foto tentor">
                                    <div>
                                        <strong>{{ $tentor['name'] }}</strong>
                                        <small>{{ $tentor['username'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="display:flex; flex-direction:column; gap:4px;">
                                    <span>{{ $tentor['email'] }}</span>
                                    <small style="color:#64748b;">{{ $tentor['phone'] ?: 'Belum diatur' }}</small>
                                </div>
                            </td>
                            <td>
                                <div style="display:flex; flex-direction:column; gap:4px;">
                                    <span>{{ $tentor['specializations'] ?? '-' }}</span>
                                    <small style="color:#64748b;">{{ $tentor['education'] ?? 'Pendidikan belum diisi' }}</small>
                                </div>
                            </td>
                            <td>{{ $tentor['experience_years'] }} Tahun</td>
                            <td>
                                <span class="status-pill {{ $tentor['is_active'] ? 'status-active' : 'status-inactive' }}">
                                    {{ $tentor['is_active'] ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <div class="tentor-actions">
                                    <a href="{{ route('admin.tentors.edit', $tentor['id']) }}">Detail &amp; Edit</a>
                                    <form method="POST" action="{{ route('admin.tentors.destroy', $tentor['id']) }}" onsubmit="return confirm('Hapus tentor ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    Belum ada data tentor. Gunakan tombol "Tambah Tentor" untuk membuat data baru.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
