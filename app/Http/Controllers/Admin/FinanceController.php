<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
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
            'totalStudents' => $this->countStudents(),
            'pendingPayments' => Schema::hasTable('orders') ? Order::where('status', 'pending')->count() : 0,
        ];

        return $this->render('admin.finance.index', [
            'stats' => $stats,
            'monthlyRevenue' => $this->monthlyRevenue(),
            'statusSummary' => $this->paymentStatusSummary(),
            'orders' => $this->ordersForReview(),
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

    public function reject(Order $order): RedirectResponse
    {
        if ($order->status === 'rejected') {
            return redirect()->back()->with('status', __('Pembayaran sudah ditandai sebagai ditolak.'));
        }

        $order->forceFill([
            'status' => 'rejected',
            'paid_at' => null,
        ])->save();

        return redirect()->back()->with('status', __('Pembayaran ditolak dan menunggu klarifikasi siswa.'));
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

    private function countStudents(): int
    {
        if (! Schema::hasTable('users')) {
            return 0;
        }

        return (int) User::where('role', 'student')->count();
    }

    private function paymentStatusSummary(): array
    {
        $default = [
            'pending' => ['label' => __('Menunggu Verifikasi'), 'count' => 0, 'description' => __('Transaksi menunggu pengecekan admin.')],
            'paid' => ['label' => __('Terverifikasi'), 'count' => 0, 'description' => __('Pembayaran berhasil disetujui.')],
            'rejected' => ['label' => __('Ditolak'), 'count' => 0, 'description' => __('Perlu klarifikasi atau unggah ulang bukti.')],
        ];

        if (! Schema::hasTable('orders')) {
            return $default;
        }

        $counts = Order::query()
            ->selectRaw('status, COUNT(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status')
            ->map(fn ($value) => (int) $value)
            ->all();

        foreach ($default as $status => &$entry) {
            $entry['count'] = $counts[$status] ?? 0;
        }

        return $default;
    }

    private function ordersForReview()
    {
        if (! Schema::hasTable('orders')) {
            return collect();
        }

        return Order::with(['user', 'package'])
            ->latest('created_at')
            ->get()
            ->map(function (Order $order) {
                $status = $order->status ?? 'pending';
                $badge = $this->statusBadge($status);

                return [
                    'id' => $order->id,
                    'package' => $order->package?->detail_title ?? __('Tidak diketahui'),
                    'student' => $order->user?->name ?? __('Pengguna'),
                    'total' => 'Rp ' . number_format($order->total ?? 0, 0, ',', '.'),
                    'due_at' => optional($order->created_at)->locale('id')->translatedFormat('d M Y'),
                    'status' => $status,
                    'status_label' => $badge['label'],
                    'status_class' => $badge['class'],
                    'proof' => $order->payment_proof_path ? asset('storage/' . $order->payment_proof_path) : null,
                    'proof_name' => $order->payment_proof_path ? basename($order->payment_proof_path) : null,
                    'canApprove' => $status === 'pending',
                    'canReject' => $status === 'pending',
                ];
            });
    }

    private function statusBadge(string $status): array
    {
        return match ($status) {
            'paid' => ['label' => __('Verified'), 'class' => 'status-pill status-pill--paid'],
            'rejected' => ['label' => __('Rejected'), 'class' => 'status-pill status-pill--rejected'],
            default => ['label' => __('Pending'), 'class' => 'status-pill status-pill--pending'],
        };
    }
}
