<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Package;
use App\Models\PackageFeature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('packages')) {
            return;
        }

        if (Schema::hasTable('enrollments')) {
            Enrollment::query()->delete();
        }

        if (Schema::hasTable('orders')) {
            Order::query()->delete();
        }

        if (Schema::hasTable('package_features')) {
            PackageFeature::query()->delete();
        }

        Package::query()->delete();
    }
}
