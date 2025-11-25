<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Package;
use Illuminate\Support\Facades\Hash;

echo "--- TEST CREATE START ---\n";

// 1. Create Tutor
try {
    $tutor = User::create([
        'name' => 'Tutor Test Script',
        'username' => 'tutorscript',
        'email' => 'tutorscript@test.com',
        'password' => Hash::make('password'),
        'role' => 'tutor',
        'is_active' => true,
    ]);
    echo "Tutor Created: ID " . $tutor->id . "\n";
} catch (\Exception $e) {
    echo "Tutor Creation FAILED: " . $e->getMessage() . "\n";
}

// 2. Create Package
try {
    $package = Package::create([
        'slug' => 'paket-test-script',
        'level' => 'SD',
        'grade_range' => '1-6',
        'tag' => 'Best Seller',
        'card_price_label' => 'Per Bulan',
        'detail_title' => 'Paket SD Juara',
        'detail_price_label' => 'Bulan',
        'image_url' => 'abc',
        'price' => 500000,
        'max_students' => 20,
        'summary' => 'Test summary',
        'tutor_id' => $tutor->id ?? null,
    ]);
    echo "Package Created: ID " . $package->id . "\n";
} catch (\Exception $e) {
    echo "Package Creation FAILED: " . $e->getMessage() . "\n";
}

echo "--- TEST CREATE END ---\n";
