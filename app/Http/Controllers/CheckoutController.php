<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Support\PackagePresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function show(string $slug)
    {
        $package = Package::with(['cardFeatures', 'inclusions'])->where('slug', $slug)->firstOrFail();

        return view('checkout.index', [
            'package' => $this->formatPackage($package),
        ]);
    }

    public function store(Request $request, string $slug): RedirectResponse
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'payment_method' => ['required', Rule::in(['american_express', 'visa', 'transfer_bank'])],
            'cardholder_name' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'max:25'],
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf'],
        ]);

        $user = Auth::user();

        $subtotal = $package->price;
        $tax = round($subtotal * 0.11, 2);
        $total = $subtotal + $tax;

        $proofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        $order = Order::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'status' => 'pending',
            'payment_method' => $data['payment_method'],
            'cardholder_name' => $data['cardholder_name'],
            'card_number_last_four' => substr(preg_replace('/\D/', '', $data['card_number']), -4),
            'payment_proof_path' => $proofPath,
            'paid_at' => null,
        ]);

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

    private function formatPackage(Package $package): array
    {
        return PackagePresenter::detail($package);
    }
}
