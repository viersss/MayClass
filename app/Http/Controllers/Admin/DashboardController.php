<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends BaseAdminController
{
    public function index()
    {
        $stats = [
            'totalRevenue' => $this->formatCurrency($this->sumPaidOrders()),
            'yearRevenue' => $this->formatCurrency($this->sumPaidOrders(now()->year)),
            'totalStudents' => Schema::hasTable('users') ? User::where('role', 'student')->count() : 0,
            'pendingPayments' => Schema::hasTable('orders') ? Order::where('status', 'pending')->count() : 0,
            'averageTicket' => $this->formatCurrency($this->averageTicket()),
            'paidOrders' => Schema::hasTable('orders') ? Order::where('status', 'paid')->count() : 0,
        ];

        $monthlyRevenue = $this->monthlyRevenue();

        $recentStudents = Schema::hasTable('users')
            ? User::query()
                ->where('role', 'student')
                ->latest('created_at')
                ->take(6)
                ->get()
                ->map(function (User $user) {
                    
                    return [
                        'name' => $user->name,
                        'email' => $user->email,
                        'joined_at' => $user->created_at ? $user->created_at->locale('id')->translatedFormat('d F Y') : 'N/A',
                        'student_id' => $user->student_id,
                    ];
                })
            : collect();

        return $this->render('admin.dashboard', [
            'stats' => $stats,
            'monthlyRevenue' => $monthlyRevenue,
            'monthComparison' => $this->monthComparison(),
            'paymentPipeline' => $this->paymentPipeline(),
            'recentPayments' => $this->recentPayments(),
            'topPackages' => $this->topPackages(),
            'recentStudents' => $recentStudents,
        ]);
    }

    private function sumPaidOrders(?int $year = null): float
    {
        if (! Schema::hasTable('orders')) {
            return 0.0;
        }

        return Order::query()
            ->where('status', 'paid')
            ->when($year, function ($query) use ($year) {
                $query->whereYear('paid_at', $year);
            })
            ->sum('total');
    }

    private function monthlyRevenue(): Collection
    {
        if (! Schema::hasTable('orders')) {
            return collect();
        }

        $year = now()->year;
        // Using a plain string keeps the raw expression reusable in raw clauses
        $paidReference = 'COALESCE(paid_at, updated_at, created_at)';

        $orders = Order::query()
            ->selectRaw('MONTH(' . $paidReference . ') as month, SUM(total) as total')
            ->where('status', 'paid')
            ->whereRaw('YEAR(' . $paidReference . ') = ?', [$year])
            ->groupByRaw('MONTH(' . $paidReference . ')')
            ->pluck('total', 'month');

        return collect(range(1, 12))->map(function ($month) use ($orders, $year) {
            $date = CarbonImmutable::createFromDate($year, $month, 1);

            return [
                'label' => $date->locale('id')->isoFormat('MMM'),
                'value' => (float) ($orders[$month] ?? 0),
                'formatted' => $this->formatCurrency((float) ($orders[$month] ?? 0)),
            ];
        });
    }

    private function averageTicket(): float
    {
        if (! Schema::hasTable('orders')) {
            return 0.0;
        }

        $count = Order::where('status', 'paid')->count();

        if ($count === 0) {
            return 0.0;
        }

        return $this->sumPaidOrders() / $count;
    }

    private function monthComparison(): array
    {
        if (! Schema::hasTable('orders')) {
            return [
                'formatted' => $this->formatCurrency(0),
                'delta' => 0.0,
                'direction' => 'flat',
            ];
        }

        $currentDate = now();
        $previousDate = now()->subMonth();

        $current = $this->sumPaidOrdersForMonth($currentDate->year, $currentDate->month);
        $previous = $this->sumPaidOrdersForMonth($previousDate->year, $previousDate->month);

        if ($previous === 0.0) {
            $delta = $current > 0 ? 100.0 : 0.0;
        } else {
            $delta = (($current - $previous) / $previous) * 100;
        }

        return [
            'formatted' => $this->formatCurrency($current),
            'delta' => round($delta, 1),
            'direction' => $current <=> $previous,
        ];
    }

    private function paymentPipeline(): array
    {
        if (! Schema::hasTable('orders')) {
            return [
                'total' => 0,
                'rows' => collect([
                    ['status' => 'paid', 'label' => $this->statusLabel('paid'), 'count' => 0, 'percentage' => 0],
                    ['status' => 'pending', 'label' => $this->statusLabel('pending'), 'count' => 0, 'percentage' => 0],
                    ['status' => 'failed', 'label' => $this->statusLabel('failed'), 'count' => 0, 'percentage' => 0],
                ]),
            ];
        }

        $counts = Order::query()
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $total = (int) $counts->sum();

        $rows = collect(['paid', 'pending', 'rejected', 'failed', 'initiated'])->map(function (string $status) use ($counts, $total) {
            $count = (int) ($counts[$status] ?? 0);

            return [
                'status' => $status,
                'label' => $this->statusLabel($status),
                'count' => $count,
                'percentage' => $total > 0 ? round(($count / $total) * 100) : 0,
            ];
        });

        return [
            'total' => $total,
            'rows' => $rows,
        ];
    }

    private function recentPayments(): Collection
    {
        if (! Schema::hasTable('orders')) {
            return collect();
        }

        $query = Order::query();

        $usersReady = Schema::hasTable('users');

        if ($usersReady) {
            $query->with(['user:id,name']);
        }

        $packagesReady = Schema::hasTable('packages');

        if ($packagesReady) {
            $query->with(['package:id,detail_title']);
        }

        return $query
            ->latest('created_at')
            ->take(6)
            ->get()
            ->map(function (Order $order) use ($packagesReady, $usersReady) {
                $packageTitle = $packagesReady
                    ? optional($order->getRelationValue('package'))->detail_title ?? 'Paket tidak tersedia'
                    : 'Tabel paket belum tersedia';

                $studentName = $usersReady
                    ? optional($order->getRelationValue('user'))->name ?? 'Tanpa nama'
                    : 'Data siswa belum tersedia';

                return [
                    'invoice' => 'INV-' . str_pad((string) $order->id, 5, '0', STR_PAD_LEFT),
                    'student' => $studentName,
                    'package' => $packageTitle,
                    'total' => $this->formatCurrency((float) $order->total),
                    'status' => $order->status,
                    'status_label' => $this->statusLabel($order->status),
                    'paid_at' => $order->paid_at ? $order->paid_at->locale('id')->translatedFormat('d M Y') : 'Belum dibayar',
                ];
            });
    }

    private function topPackages(): Collection
    {
        if (! Schema::hasTable('packages') || ! Schema::hasTable('orders')) {
            return collect();
        }

        return Package::query()
            ->select('packages.id', 'packages.detail_title as title')
            ->selectRaw('COUNT(orders.id) as orders_count')
            ->selectRaw('COALESCE(SUM(CASE WHEN orders.status = ? THEN orders.total ELSE 0 END), 0) as revenue', ['paid'])
            ->leftJoin('orders', 'orders.package_id', '=', 'packages.id')
            ->groupBy('packages.id', 'packages.detail_title')
            ->orderByDesc('revenue')
            ->orderByDesc('orders_count')
            ->take(4)
            ->get()
            ->map(function ($package) {
                return [
                    'title' => $package->title,
                    'orders' => (int) $package->orders_count,
                    'revenue' => $this->formatCurrency((float) $package->revenue),
                ];
            });
    }

    private function sumPaidOrdersForMonth(int $year, int $month): float
    {
        if (! Schema::hasTable('orders')) {
            return 0.0;
        }

        return Order::query()
            ->where('status', 'paid')
            ->whereYear('paid_at', $year)
            ->whereMonth('paid_at', $month)
            ->sum('total');
    }

    private function formatCurrency(float $value): string
    {
        if ($value >= 1000000000) {
            return 'Rp ' . number_format($value / 1000000000, 1, ',', '.') . 'M';
        }

        if ($value >= 1000000) {
            return 'Rp ' . number_format($value / 1000000, 1, ',', '.') . 'Jt';
        }

        return 'Rp ' . number_format($value, 0, ',', '.');
    }

    private function statusLabel(?string $status): string
    {
        return match ($status) {
            'paid' => 'Lunas',
            'pending' => 'Menunggu',
            'rejected' => 'Ditolak',
            'failed' => 'Kedaluwarsa',
            'initiated' => 'Draft',
            default => ucfirst((string) $status),
        };
    }
}
