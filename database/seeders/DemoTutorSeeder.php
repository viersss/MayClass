<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoTutorSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'tentor@gmail.com'],
            [
                'name' => 'Tentor Demo MayClass',
                'password' => Hash::make('gatau123'),
                'role' => 'tutor',
                'phone' => '0812-0000-1234',
                'gender' => 'other',
                'student_id' => null,
                'address' => 'Jl. Ilmu Pendidikan No. 10, Bandung',
            ]
        );
    }
}
