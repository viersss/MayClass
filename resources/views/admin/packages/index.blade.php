@extends('admin.layout')

@section('title', 'Manajemen Paket - MayClass')

@push('styles')
    <style>
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .header-actions h2 {
            margin: 0;
            font-size: 1.6rem;
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(61, 183, 173, 0.85), rgba(84, 101, 255, 0.85));
            color: #fff;
            font-weight: 600;
        }

        .package-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 44px rgba(15, 23, 42, 0.08);
        }

        .package-table thead {
            background: rgba(84, 101, 255, 0.12);
        }

        .package-table th,
        .package-table td {
            padding: 18px 22px;
            font-size: 0.95rem;
            text-align: left;
        }

        .package-table tbody tr:not(:last-child) {
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        }

        .table-actions {
            display: inline-flex;
            gap: 14px;
        }

        .table-actions a {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .table-actions button {
            border: none;
            background: none;
            color: #dc2626;
            font-weight: 600;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .package-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
@endpush

@section('content')
    <div class="header-actions">
        <div>
            <span style="color: var(--primary-dark); font-weight: 500;">Kelola produk paket belajar</span>
            <h2>Manajemen Paket</h2>
        </div>
        <a href="{{ route('admin.packages.create') }}" class="primary-btn">+ Paket Baru</a>
    </div>

    <table class="package-table">
        <thead>
            <tr>
                <th>Nama Paket</th>
                <th>Level</th>
                <th>Label Harga</th>
                <th>Harga</th>
                <th>Tag</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($packages as $package)
                <tr>
                    <td>{{ $package->detail_title }}</td>
                    <td>{{ $package->level }}</td>
                    <td>{{ $package->detail_price_label }}</td>
                    <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                    <td>{{ $package->tag ?? '—' }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.packages.edit', $package) }}">Edit</a>
                            <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" onsubmit="return confirm('Hapus paket ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 42px 0;">
                        Belum ada paket yang tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
