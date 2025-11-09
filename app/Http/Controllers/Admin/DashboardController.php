<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
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
                        'joined_at' => optional($user->created_at)->locale('id')->translatedFormat('d F Y'),
                        'student_id' => $user->student_id,
                    ];
                })
            : collect();

        return $this->render('admin.dashboard', [
            'stats' => $stats,
            'monthlyRevenue' => $monthlyRevenue,
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
        $orders = Order::query()
            ->selectRaw('MONTH(paid_at) as month, SUM(total) as total')
            ->where('status', 'paid')
            ->whereYear('paid_at', $year)
            ->groupByRaw('MONTH(paid_at)')
            ->pluck('total', 'month');

        return collect(range(1, 12))->map(function ($month) use ($orders, $year) {
            $date = CarbonImmutable::createFromDate($year, $month, 1);

            return [
                'label' => $date->locale('id')->isoFormat('MMM'),
                'value' => (float) ($orders[$month] ?? 0),
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
}
