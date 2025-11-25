<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Package;
use Illuminate\Support\Facades\Schema;

echo "--- TEST QUERY START ---\n";

try {
    $packages = Package::withQuotaUsage()->with(['subjects', 'tutors'])->orderBy('level')->get();
    echo "Query Success. Count: " . $packages->count() . "\n";
    foreach ($packages as $p) {
        echo " - " . $p->detail_title . " (Level: " . $p->level . ")\n";
    }
} catch (\Exception $e) {
    echo "Query FAILED: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}

echo "--- TEST QUERY END ---\n";
