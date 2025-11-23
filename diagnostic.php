<?php

use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

echo "--- DIAGNOSTIC START ---\n";

// 1. Check Tables
echo "Checking Tables:\n";
echo " - users: " . (Schema::hasTable('users') ? 'YES' : 'NO') . "\n";
echo " - packages: " . (Schema::hasTable('packages') ? 'YES' : 'NO') . "\n";
echo " - enrollments: " . (Schema::hasTable('enrollments') ? 'YES' : 'NO') . "\n";
echo " - checkout_sessions: " . (Schema::hasTable('checkout_sessions') ? 'YES' : 'NO') . "\n";

// 2. Check Counts
echo "\nChecking Counts:\n";
if (Schema::hasTable('users')) {
    echo " - Tutors: " . User::where('role', 'tutor')->count() . "\n";
}
if (Schema::hasTable('packages')) {
    echo " - Packages: " . Package::count() . "\n";
}

// 3. Test Package Query
echo "\nTesting Package Query (withQuotaUsage):\n";
try {
    if (Schema::hasTable('packages')) {
        $packages = Package::withQuotaUsage()->get();
        echo " - Query Success. Result Count: " . $packages->count() . "\n";
        if ($packages->count() > 0) {
            echo " - First Package: " . $packages->first()->detail_title . "\n";
        }
    } else {
        echo " - Skipped (Table missing)\n";
    }
} catch (\Exception $e) {
    echo " - Query FAILED: " . $e->getMessage() . "\n";
}

echo "--- DIAGNOSTIC END ---\n";
