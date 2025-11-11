<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('quizzes')) {
            return;
        }

        Quiz::query()->delete();
    }
}
