<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DemoStudentSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        User::where('email', 'demo@student.mayclass.test')->delete();
    }
}
