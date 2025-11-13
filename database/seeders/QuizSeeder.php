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
        $quizzesAvailable = Schema::hasTable('quizzes');

        if (! $quizzesAvailable) {
            return;
        }

        $levelsAvailable = Schema::hasTable('quiz_levels');
        $takeawaysAvailable = Schema::hasTable('quiz_takeaways');

        if ($levelsAvailable) {
            QuizLevel::query()->delete();
        }

        if ($takeawaysAvailable) {
            QuizTakeaway::query()->delete();
        }

        Quiz::query()->delete();

        $quizzes = [
            [
                'slug' => 'kuis-matematika-smp-barisan-dan-deret',
                'subject' => 'Matematika',
                'class_level' => 'SMP',
                'title' => 'Barisan dan Deret',
                'summary' => 'Uji pemahaman konsep barisan aritmetika dan geometri dengan soal bertingkat.',
                'link_url' => 'https://mayclass.id/kuis/matematika/barisan-deret',
                'thumbnail_url' => 'quiz_math_sequence',
                'duration_label' => '30 menit',
                'question_count' => 20,
                'levels' => [
                    'Pemanasan konsep dasar',
                    'Latihan tingkat lanjut',
                ],
                'takeaways' => [
                    'Memahami pola kenaikan dan penurunan pada barisan.',
                    'Menentukan suku ke-n dan jumlah n suku pertama.',
                    'Menganalisis soal cerita yang berkaitan dengan barisan.',
                ],
            ],
            [
                'slug' => 'kuis-ipa-sd-energi-dan-perubahannya',
                'subject' => 'IPA',
                'class_level' => 'SD',
                'title' => 'Energi dan Perubahannya',
                'summary' => 'Latihan pilihan ganda tentang sumber energi dan cara perubahannya dalam kehidupan sehari-hari.',
                'link_url' => 'https://mayclass.id/kuis/ipa/energi-perubahan',
                'thumbnail_url' => 'quiz_science_energy',
                'duration_label' => '20 menit',
                'question_count' => 15,
                'levels' => [
                    'Pengenalan konsep energi',
                    'Penerapan energi dalam kehidupan',
                ],
                'takeaways' => [
                    'Mengklasifikasikan bentuk-bentuk energi.',
                    'Menjelaskan perubahan energi sederhana.',
                    'Menerapkan konsep energi dalam contoh nyata.',
                ],
            ],
            [
                'slug' => 'kuis-bahasa-inggris-sma-recount-text',
                'subject' => 'Bahasa Inggris',
                'class_level' => 'SMA',
                'title' => 'Recount Text Mastery',
                'summary' => 'Evaluasi pemahaman struktur recount text dan penggunaan simple past tense.',
                'link_url' => 'https://mayclass.id/kuis/bahasa-inggris/recount-text',
                'thumbnail_url' => 'quiz_english_recount',
                'duration_label' => '25 menit',
                'question_count' => 18,
                'levels' => [
                    'Memahami struktur teks',
                    'Latihan grammar dan kosa kata',
                ],
                'takeaways' => [
                    'Mengidentifikasi orientation, events, dan re-orientation.',
                    'Menggunakan simple past tense secara tepat.',
                    'Menyusun recount text singkat dengan runtut.',
                ],
            ],
        ];

        foreach ($quizzes as $quizData) {
            $quiz = Quiz::create([
                'slug' => $quizData['slug'],
                'subject' => $quizData['subject'],
                'class_level' => $quizData['class_level'],
                'title' => $quizData['title'],
                'summary' => $quizData['summary'],
                'link_url' => $quizData['link_url'],
                'thumbnail_url' => $quizData['thumbnail_url'],
                'duration_label' => $quizData['duration_label'],
                'question_count' => $quizData['question_count'],
            ]);

            if ($levelsAvailable) {
                foreach (array_values($quizData['levels']) as $index => $label) {
                    QuizLevel::create([
                        'quiz_id' => $quiz->id,
                        'label' => $label,
                        'position' => $index + 1,
                    ]);
                }
            }

            if ($takeawaysAvailable) {
                foreach (array_values($quizData['takeaways']) as $index => $description) {
                    QuizTakeaway::create([
                        'quiz_id' => $quiz->id,
                        'description' => $description,
                        'position' => $index + 1,
                    ]);
                }
            }
        }
    }
}
