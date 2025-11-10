<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('materials')) {
            return;
        }

        Material::query()->delete();
    }
}
