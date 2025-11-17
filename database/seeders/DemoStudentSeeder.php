<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DemoStudentSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        $students = [
            [
                'name' => 'Nadia Pratama',
                'email' => 'nadia@student.mayclass.test',
                'username' => 'nadia_siswa',
                'student_id' => 'MC23001',
                'phone' => '0812-9000-1111',
                'gender' => 'female',
                'address' => 'Bandung',
                'joined_at' => now()->subMonths(5),
            ],
            [
                'name' => 'Farhan Nugroho',
                'email' => 'farhan@student.mayclass.test',
                'username' => 'farhan_may',
                'student_id' => 'MC23002',
                'phone' => '0813-7788-2211',
                'gender' => 'male',
                'address' => 'Jakarta',
                'joined_at' => now()->subMonths(4),
            ],
            [
                'name' => 'Laras Pertiwi',
                'email' => 'laras@student.mayclass.test',
                'username' => 'laras_belajar',
                'student_id' => 'MC23003',
                'phone' => '0819-3322-9988',
                'gender' => 'female',
                'address' => 'Surabaya',
                'joined_at' => now()->subMonths(3),
            ],
            [
                'name' => 'Rafi Maulana',
                'email' => 'rafi@student.mayclass.test',
                'username' => 'rafi_maulana',
                'student_id' => 'MC23004',
                'phone' => '0821-8899-2200',
                'gender' => 'male',
                'address' => 'Yogyakarta',
                'joined_at' => now()->subMonths(2),
            ],
            [
                'name' => 'Salsa Dewi',
                'email' => 'salsa@student.mayclass.test',
                'username' => 'salsa_dewi',
                'student_id' => 'MC23005',
                'phone' => '0812-1111-7788',
                'gender' => 'female',
                'address' => 'Semarang',
                'joined_at' => now()->subMonth(),
            ],
        ];

        foreach ($students as $student) {
            $user = User::updateOrCreate(
                ['email' => $student['email']],
                [
                    'name' => $student['name'],
                    'username' => $student['username'],
                    'email' => $student['email'],
                    'password' => Hash::make('gatau123'),
                    'role' => 'student',
                    'phone' => $student['phone'],
                    'gender' => $student['gender'],
                    'student_id' => $student['student_id'],
                    'address' => $student['address'],
                    'remember_token' => Str::random(10),
                ]
            );

            if ($student['joined_at']) {
                $user->forceFill([
                    'created_at' => $student['joined_at'],
                    'updated_at' => $student['joined_at'],
                ])->save();
            }
        }
    }
}
