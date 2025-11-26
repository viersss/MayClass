<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\MaterialChapter;
use App\Models\MaterialObjective;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Hapus Bab Materi (Child)
        if (Schema::hasTable('material_chapters')) {
            MaterialChapter::query()->delete();
        }

        // 2. Hapus Tujuan Materi (Child)
        if (Schema::hasTable('material_objectives')) {
            MaterialObjective::query()->delete();
        }

        // 3. Hapus Materi Utama (Parent)
        if (Schema::hasTable('materials')) {
            Material::query()->delete();
        }

        $this->command->info('Data Materi berhasil dikosongkan.');
    }
}