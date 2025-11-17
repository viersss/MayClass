<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Support\PackagePresenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $package = Package::with(['cardFeatures', 'inclusions'])->where('slug', $slug)->firstOrFail();
        $user = $request->user();

        $existingOrder = $this->latestSubmittedOrder($user->id, $package->id);

        if ($existingOrder) {
            return redirect()->route('checkout.success', ['slug' => $package->slug, 'order' => $existingOrder->id]);
        }

        $order = $this->resolveDraftOrder($user->id, $package);
        $packageDetail = $this->formatPackage($package);

        if (! $order->expires_at) {
            $order->forceFill(['expires_at' => now()->addMinutes(30)])->save();
            $order->refresh();
        }

        $expiresAt = $order->expires_at ?? now()->addMinutes(30);
        $remainingSeconds = max(0, now()->diffInSeconds($expiresAt, false));

        return view('checkout.index', [
            'package' => $packageDetail,
            'order' => $order,
            'countdownSeconds' => $remainingSeconds,
            'financeWhatsappLink' => $this->buildFinanceWhatsappLink($packageDetail),
        ]);
    }

    public function store(Request $request, string $slug): RedirectResponse
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'payment_method' => ['required', Rule::in(['american_express', 'visa', 'transfer_bank'])],
            'cardholder_name' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'max:25'],
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'order_id' => ['required', Rule::exists('orders', 'id')->where(fn ($query) => $query->where('user_id', $request->user()->id)->where('status', 'initiated'))],
        ]);

        $user = Auth::user();

        $order = Order::where('id', $data['order_id'])
            ->where('user_id', $user->id)
            ->where('package_id', $package->id)
            ->where('status', 'initiated')
            ->firstOrFail();

        if ($order->expires_at && $order->expires_at->isPast()) {
            $order->forceFill([
                'status' => 'failed',
                'cancelled_at' => now(),
            ])->save();

            return redirect()
                ->route('checkout.show', $package->slug)
                ->with('checkout_expired', true);
        }

        $proofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        if ($order->payment_proof_path) {
            Storage::disk('public')->delete($order->payment_proof_path);
        }

        $order->forceFill([
            'status' => 'pending',
            'payment_method' => $data['payment_method'],
            'cardholder_name' => $data['cardholder_name'],
            'card_number_last_four' => substr(preg_replace('/\D/', '', $data['card_number']), -4),
            'payment_proof_path' => $proofPath,
            'expires_at' => null,
            'cancelled_at' => null,
        ])->save();

        return redirect()->route('checkout.success', ['slug' => $package->slug, 'order' => $order->id]);
    }

    public function success(Request $request, string $slug)
    {
        $package = Package::with(['cardFeatures', 'inclusions'])->where('slug', $slug)->firstOrFail();
        $orderId = $request->query('order');

        $order = Order::with('user')
            ->where('id', $orderId)
            ->where('package_id', $package->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.success', [
            'package' => $this->formatPackage($package),
            'order' => $order,
        ]);
    }

    public function expire(Request $request, string $slug, Order $order): JsonResponse
    {
        abort_unless($order->user_id === $request->user()->id, 403);
        abort_unless($order->package?->slug === $slug, 404);

        if ($order->status === 'initiated') {
            $order->forceFill([
                'status' => 'failed',
                'cancelled_at' => now(),
            ])->save();
        }

        return response()->json(['status' => 'expired']);
    }

    private function formatPackage(Package $package): array
    {
        return PackagePresenter::detail($package);
    }

    private function buildFinanceWhatsappLink(array $packageDetail): string
    {
        $whatsappNumber = config('services.whatsapp.finance_admin', '6281234567890');
        $packageName = $packageDetail['detail_title'] ?? $packageDetail['title'] ?? 'MayClass';
        $message = rawurlencode('Halo Admin Keuangan MayClass, saya butuh bantuan pembayaran untuk paket ' . $packageName);

        return "https://wa.me/{$whatsappNumber}?text={$message}";
    }

    private function resolveDraftOrder(int $userId, Package $package): Order
    {
        $subtotal = $package->price;
        $tax = round($subtotal * 0.11, 2);
        $total = $subtotal + $tax;
        $expiresAt = now()->addMinutes(30);

        $draft = Order::where('user_id', $userId)
            ->where('package_id', $package->id)
            ->where('status', 'initiated')
            ->latest('id')
            ->first();

        if ($draft && $draft->expires_at && $draft->expires_at->isPast()) {
            $draft->forceFill([
                'status' => 'failed',
                'cancelled_at' => now(),
            ])->save();
            $draft = null;
        }

        if ($draft) {
            $draft->forceFill([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'expires_at' => $expiresAt,
            ])->save();

            return $draft->fresh();
        }

        return Order::create([
            'user_id' => $userId,
            'package_id' => $package->id,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'status' => 'initiated',
            'payment_method' => 'transfer_bank',
            'expires_at' => $expiresAt,
        ]);
    }

    private function latestSubmittedOrder(int $userId, int $packageId): ?Order
    {
        return Order::where('user_id', $userId)
            ->where('package_id', $packageId)
            ->whereIn('status', ['pending', 'paid'])
            ->whereNotNull('payment_proof_path')
            ->latest('updated_at')
            ->first();
    }
}
