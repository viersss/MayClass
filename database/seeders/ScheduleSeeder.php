<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\ScheduleSession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('schedule_sessions')) {
            return;
        }

        $packages = Schema::hasTable('packages')
            ? Package::query()->get()->keyBy('slug')
            : collect();

        ScheduleSession::query()->delete();

        $sessions = [
            [
                'package_slug' => 'mayclass-sd-fundamental',
                'title' => 'Kelas Numerasi Dasar',
                'category' => 'Matematika',
                'class_level' => 'SD',
                'location' => 'Zoom Meeting',
                'student_count' => 18,
                'mentor_name' => 'Kak Dina',
                'start_at' => now()->addDays(2)->setTime(16, 0, 0),
                'is_highlight' => true,
            ],
            [
                'package_slug' => 'mayclass-smp-eksplor',
                'title' => 'Klinik IPA: Sistem Tata Surya',
                'category' => 'IPA',
                'class_level' => 'SMP',
                'location' => 'Google Meet',
                'student_count' => 22,
                'mentor_name' => 'Kak Rafi',
                'start_at' => now()->addDays(4)->setTime(18, 30, 0),
                'is_highlight' => false,
            ],
            [
                'package_slug' => 'mayclass-sma-premium',
                'title' => 'Bedah Soal UTBK Saintek',
                'category' => 'UTBK',
                'class_level' => 'SMA',
                'location' => 'MayClass Learning Hub',
                'student_count' => 15,
                'mentor_name' => 'Kak Naya',
                'start_at' => now()->addDays(6)->setTime(19, 0, 0),
                'is_highlight' => false,
            ],
        ];

        foreach ($sessions as $session) {
            $package = $packages->get($session['package_slug']);

            ScheduleSession::create([
                'package_id' => $package?->id,
                'user_id' => null,
                'title' => $session['title'],
                'category' => $session['category'],
                'class_level' => $session['class_level'],
                'location' => $session['location'],
                'student_count' => $session['student_count'],
                'mentor_name' => $session['mentor_name'],
                'start_at' => $session['start_at'],
                'is_highlight' => $session['is_highlight'],
            ]);
        }
    }
}
