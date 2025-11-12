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

        $featureTableAvailable = Schema::hasTable('package_features');

        if ($featureTableAvailable) {
            PackageFeature::query()->delete();
        }

        Package::query()->delete();

        $packages = [
            [
                'slug' => 'mayclass-spark',
                'level' => 'SD 1-3',
                'tag' => 'Terpopuler',
                'card_price_label' => 'Mulai Rp249K/bulan',
                'detail_title' => 'MayClass Spark - SD Kelas 1-3',
                'detail_price_label' => 'Rp 249.000 / bulan',
                'image_url' => 'package_sd_1_3',
                'price' => 249_000,
                'summary' => 'Fondasi numerasi dan literasi dengan pendampingan intensif tutor MayClass.',
                'card_features' => [
                    '4x kelas live interaktif',
                    'Modul latihan tematik mingguan',
                    'Evaluasi perkembangan bulanan',
                ],
                'inclusions' => [
                    'Pendampingan belajar daring 60 menit/sesi',
                    'Akses bank soal SD level dasar',
                    'Laporan belajar ke orang tua setiap bulan',
                ],
            ],
            [
                'slug' => 'mayclass-advance',
                'level' => 'SD 4-6',
                'tag' => 'Best Seller',
                'card_price_label' => 'Mulai Rp329K/bulan',
                'detail_title' => 'MayClass Advance - SD Kelas 4-6',
                'detail_price_label' => 'Rp 329.000 / bulan',
                'image_url' => 'package_sd_4_6',
                'price' => 329_000,
                'summary' => 'Program persiapan kelulusan dengan kurikulum berdiferensiasi dan sesi klinik PR.',
                'card_features' => [
                    '6x kelas live per bulan',
                    'Bank latihan adaptif per mata pelajaran',
                    'Klinik PR dan konsultasi tutor',
                ],
                'inclusions' => [
                    'Simulasi ujian tengah dan akhir semester',
                    'Akses materi video on-demand',
                    'Rencana belajar personal bersama mentor',
                ],
            ],
            [
                'slug' => 'mayclass-explore',
                'level' => 'SMP 7-9',
                'tag' => 'Favorit SMP',
                'card_price_label' => 'Mulai Rp399K/bulan',
                'detail_title' => 'MayClass Explore - SMP Kelas 7-9',
                'detail_price_label' => 'Rp 399.000 / bulan',
                'image_url' => 'package_smp_7_9',
                'price' => 399_000,
                'summary' => 'Pendalaman materi ujian sekolah dan asesmen kompetensi minimum (AKM).',
                'card_features' => [
                    '8x kelas live tematik',
                    'Bank kuis adaptif AKM',
                    'Tryout bulanan terintegrasi',
                ],
                'inclusions' => [
                    'Pendampingan tugas proyek lintas mata pelajaran',
                    'Analisis hasil belajar per kompetensi',
                    'Akses komunitas diskusi siswa MayClass',
                ],
            ],
            [
                'slug' => 'mayclass-focus',
                'level' => 'SMA IPA',
                'tag' => 'Siap UTBK',
                'card_price_label' => 'Mulai Rp479K/bulan',
                'detail_title' => 'MayClass Focus - SMA IPA & UTBK',
                'detail_price_label' => 'Rp 479.000 / bulan',
                'image_url' => 'package_utbk',
                'price' => 479_000,
                'summary' => 'Strategi intensif UTBK dengan kelas premium dan bimbingan mentor lulusan PTN.',
                'card_features' => [
                    '10x kelas premium/minggu',
                    'Bank soal UTBK & pembahasan',
                    'Coaching session karier',
                ],
                'inclusions' => [
                    '3x tryout UTBK full online',
                    'Bedah rapor nilai dan target kampus',
                    'Pendampingan konsultasi jurusan',
                ],
            ],
        ];

        foreach ($packages as $packageData) {
            $package = Package::create([
                'slug' => $packageData['slug'],
                'level' => $packageData['level'],
                'tag' => $packageData['tag'],
                'card_price_label' => $packageData['card_price_label'],
                'detail_title' => $packageData['detail_title'],
                'detail_price_label' => $packageData['detail_price_label'],
                'image_url' => $packageData['image_url'],
                'price' => $packageData['price'],
                'summary' => $packageData['summary'],
            ]);

            if ($featureTableAvailable) {
                $this->seedFeatures($package, 'card', $packageData['card_features']);
                $this->seedFeatures($package, 'included', $packageData['inclusions']);
            }
        }
    }

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
