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
                'class_level' => 'Kelas 10A',
                'location' => 'Lab Komputer 1',
                'student_count' => 25,
                'mentor_name' => 'Ahmad Rizki',
                'start_at' => $baseWeek->addDays(1)->setTime(16, 0),
                'is_highlight' => true,
            ],
            [
                'title' => 'Grammar Intensive',
                'category' => 'Bahasa Inggris',
                'class_level' => 'Kelas 11B',
                'location' => 'Ruang 203',
                'student_count' => 20,
                'mentor_name' => 'Ayu Pratiwi',
                'start_at' => $baseWeek->addDays(2)->setTime(19, 0),
            ],
            [
                'title' => 'Kimia: Termokimia',
                'category' => 'Kimia',
                'class_level' => 'Kelas 12 IPA',
                'location' => 'Ruang 305',
                'student_count' => 18,
                'mentor_name' => 'Dr. Budi Santoso',
                'start_at' => $baseWeek->addDays(3)->setTime(17, 0),
            ],
            [
                'title' => 'Literasi Tematik',
                'category' => 'SD Terpadu',
                'class_level' => 'Kelas 4',
                'location' => 'Studio Virtual',
                'student_count' => 30,
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
                    'class_level' => 'Kelas 9',
                    'location' => 'Ruang 210',
                    'student_count' => 28,
                    'start_at' => $baseWeek->addDays(6)->setTime(10, 0),
                ],
                [
                    'title' => 'Strategi UTBK 2025',
                    'category' => 'UTBK',
                    'class_level' => 'Intensive Class',
                    'location' => 'Aula MayClass',
                    'student_count' => 40,
                    'start_at' => $baseWeek->addWeek()->addDays(1)->setTime(18, 30),
                ],
                [
                    'title' => 'Bimbingan Essay Bahasa Inggris',
                    'category' => 'Bahasa Inggris',
                    'class_level' => 'Kelas 12 IPS',
                    'location' => 'Studio Virtual',
                    'student_count' => 22,
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
                        'class_level' => $session['class_level'] ?? null,
                        'location' => $session['location'] ?? null,
                        'student_count' => $session['student_count'] ?? null,
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
