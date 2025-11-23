<?php

namespace Database\Seeders;

use App\Models\CheckoutSession; // Tambahkan Import ini
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
        // Cek apakah tabel packages ada
        if (! Schema::hasTable('packages')) {
            return;
        }

        // ==========================================
        // 1. LOGIKA PEMBERSIHAN (RESET DATA)
        // ==========================================
        
        // Hapus data Enrollment (Pendaftaran) terlebih dahulu (Child Table)
        if (Schema::hasTable('enrollments')) {
            Enrollment::query()->delete();
        }

        // Hapus data Checkout Sessions (Child Table) - PERBAIKAN UTAMA DISINI
        // Ini mencegah error Integrity constraint violation: 1451
        if (Schema::hasTable('checkout_sessions')) {
            CheckoutSession::query()->delete();
        }

        // Hapus data Order (Pesanan) (Child Table)
        if (Schema::hasTable('orders')) {
            Order::query()->delete();
        }

        // Hapus fitur paket
        if (Schema::hasTable('package_features')) {
            PackageFeature::query()->delete();
        }

        // Terakhir, hapus semua Paket
        Package::query()->delete();


        // ==========================================
        // 2. DATA PAKET (DIKOSONGKAN)
        // ==========================================
        
        // Bagian ini dikomentari agar tidak ada "Data Demo" yang masuk ke database.
        // Database akan bersih (kosong) setelah seeder ini dijalankan.
        
        /*
        $packages = [
            [
                'slug' => 'mayclass-sd-fundamental',
                'level' => 'SD',
                'grade_range' => 'Kelas 1 - 3',
                'detail_title' => 'MayClass SD Fundamental',
                'price' => 249000,
                // ... data lainnya ...
            ],
        ];

        foreach ($packages as $packageData) {
            Package::create($packageData);
        }
        */
    }

    // Helper method dibiarkan ada (walaupun tidak dipanggil) untuk referensi masa depan
    private function seedFeatures(Package $package, string $type, array $labels): void
    {
        foreach (array_values($labels) as $index => $label) {
            PackageFeature::create([
                'package_id' => $package->id,
                'type' => $type,
                'label' => $label,
                'position' => $index + 1,
            ]);
        }
    }
}