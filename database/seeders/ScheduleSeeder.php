<?php

namespace Database\Seeders;

use App\Models\ScheduleSession;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $baseWeek = CarbonImmutable::now()->startOfWeek(CarbonImmutable::MONDAY)->addWeek();

        $sessions = [
            [
                'title' => 'Persamaan Linear',
                'category' => 'Matematika',
                'mentor_name' => 'Ahmad Rizki',
                'start_at' => $baseWeek->addDays(1)->setTime(16, 0),
                'is_highlight' => true,
            ],
            [
                'title' => 'Grammar Intensive',
                'category' => 'Bahasa Inggris',
                'mentor_name' => 'Ayu Pratiwi',
                'start_at' => $baseWeek->addDays(2)->setTime(19, 0),
            ],
            [
                'title' => 'Kimia: Termokimia',
                'category' => 'Kimia',
                'mentor_name' => 'Dr. Budi Santoso',
                'start_at' => $baseWeek->addDays(3)->setTime(17, 0),
            ],
            [
                'title' => 'Literasi Tematik',
                'category' => 'SD Terpadu',
                'mentor_name' => 'Mentor Laila',
                'start_at' => $baseWeek->addDays(5)->setTime(9, 0),
            ],
        ];

        foreach ($sessions as $session) {
            ScheduleSession::updateOrCreate(
                [
                    'title' => $session['title'],
                    'start_at' => $session['start_at'],
                ],
                $session
            );
        }
    }
}
