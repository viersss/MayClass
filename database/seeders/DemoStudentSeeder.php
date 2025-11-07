<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoStudentSeeder extends Seeder
{
    public function run(): void
    {
        $package = Package::where('slug', 'sma-ipa')->first();

        if (! $package) {
            return;
        }

        $user = User::updateOrCreate(
            ['email' => 'demo@student.mayclass.test'],
            [
                'name' => 'Ahmad Rizki',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'student_id' => 'MC-102938',
                'phone' => '081234567890',
                'gender' => 'male',
                'parent_name' => 'Budi Santoso',
                'address' => 'Jl. Melati No. 12, Bandung',
            ]
        );

        $subtotal = $package->price;
        $tax = round($subtotal * 0.11, 2);
        $total = $subtotal + $tax;

        $order = Order::updateOrCreate(
            [
                'user_id' => $user->id,
                'package_id' => $package->id,
            ],
            [
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => 'paid',
                'payment_method' => 'transfer_bank',
                'cardholder_name' => $user->name,
                'card_number_last_four' => '1234',
                'paid_at' => CarbonImmutable::now()->subDay(),
            ]
        );

        Enrollment::updateOrCreate(
            [
                'user_id' => $user->id,
                'package_id' => $package->id,
            ],
            [
                'order_id' => $order->id,
                'starts_at' => CarbonImmutable::now()->startOfMonth(),
                'ends_at' => CarbonImmutable::now()->endOfMonth(),
                'is_active' => true,
            ]
        );
    }
}
