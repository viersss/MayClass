<?php

namespace Database\Seeders;

use App\Models\ScheduleSession;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $baseWeek = CarbonImmutable::now()->startOfWeek(CarbonImmutable::MONDAY)->addWeek();
        $tutor = User::firstWhere('email', 'tentor@gmail.com');

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
            $payload = $session;

            if ($tutor) {
                $payload['user_id'] = $tutor->id;
                $payload['mentor_name'] = $tutor->name;
            }

            ScheduleSession::updateOrCreate(
                [
                    'title' => $session['title'],
                    'start_at' => $session['start_at'],
                ],
                $payload
            );
        }

        if ($tutor) {
            $extraSessions = [
                [
                    'title' => 'Pendalaman Matematika Kelas 9',
                    'category' => 'Matematika',
                    'start_at' => $baseWeek->addDays(6)->setTime(10, 0),
                ],
                [
                    'title' => 'Strategi UTBK 2025',
                    'category' => 'UTBK',
                    'start_at' => $baseWeek->addWeek()->addDays(1)->setTime(18, 30),
                ],
                [
                    'title' => 'Bimbingan Essay Bahasa Inggris',
                    'category' => 'Bahasa Inggris',
                    'start_at' => $baseWeek->addWeek()->addDays(3)->setTime(16, 30),
                ],
            ];

            foreach ($extraSessions as $session) {
                ScheduleSession::updateOrCreate(
                    [
                        'title' => $session['title'],
                        'start_at' => $session['start_at'],
                    ],
                    [
                        'category' => $session['category'],
                        'mentor_name' => $tutor->name,
                        'start_at' => $session['start_at'],
                        'user_id' => $tutor->id,
                        'is_highlight' => false,
                    ]
                );
            }
        }
    }
}
