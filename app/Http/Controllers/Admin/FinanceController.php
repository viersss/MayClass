<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class FinanceController extends BaseAdminController
{
    public function index(): View
    {
        $stats = [
            'totalRevenue' => $this->formatCurrency($this->sumPaidOrders()),
            'yearRevenue' => $this->formatCurrency($this->sumPaidOrders(now()->year)),
            'pendingPayments' => Schema::hasTable('orders') ? Order::where('status', 'pending')->count() : 0,
            'averageTicket' => $this->formatCurrency($this->averageTicket()),
        ];

        $monthlyRevenue = $this->monthlyRevenue();

        $pendingOrders = Schema::hasTable('orders')
            ? Order::with(['user', 'package'])
                ->where('status', 'pending')
                ->orderBy('created_at')
                ->get()
                ->map(function (Order $order) {
                    return [
                        'id' => $order->id,
                        'package' => $order->package?->detail_title ?? '-',
                        'student' => $order->user?->name ?? '-',
                        'total' => 'Rp ' . number_format($order->total, 0, ',', '.'),
                        'due_at' => optional($order->created_at)->locale('id')->translatedFormat('d F Y'),
                        'proof' => $order->payment_proof_path ? asset('storage/' . $order->payment_proof_path) : null,
                    ];
                })
            : collect();

        return $this->render('admin.finance.index', [
            'stats' => $stats,
            'monthlyRevenue' => $monthlyRevenue,
            'pendingOrders' => $pendingOrders,
        ]);
    }

    public function approve(Order $order): RedirectResponse
    {
        if ($order->status === 'paid') {
            return redirect()->back()->with('status', __('Pembayaran sudah diverifikasi.'));
        }

        $order->forceFill([
            'status' => 'paid',
            'paid_at' => CarbonImmutable::now(),
        ])->save();

        return redirect()->back()->with('status', __('Pembayaran berhasil diverifikasi.'));
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

    private function averageTicket(): float
    {
        if (! Schema::hasTable('orders')) {
            return 0.0;
        }

        $paidOrders = Order::where('status', 'paid')->count();

        if ($paidOrders === 0) {
            return 0.0;
        }

        return $this->sumPaidOrders() / $paidOrders;
    }

    private function monthlyRevenue()
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
