<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizLevel;
use App\Models\QuizTakeaway;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Hapus Level Kuis (Child)
        if (Schema::hasTable('quiz_levels')) {
            QuizLevel::query()->delete();
        }

        // 2. Hapus Poin Belajar Kuis (Child)
        if (Schema::hasTable('quiz_takeaways')) {
            QuizTakeaway::query()->delete();
        }

        // 3. Hapus Kuis Utama (Parent)
        if (Schema::hasTable('quizzes')) {
            Quiz::query()->delete();
        }

        $this->command->info('Data Kuis berhasil dikosongkan.');
    }
}