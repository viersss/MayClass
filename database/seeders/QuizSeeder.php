<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = [
            [
                'slug' => 'persamaan-linear',
                'subject' => 'Matematika',
                'class_level' => 'Kelas 10A',
                'title' => 'Quiz Persamaan Linear',
                'summary' => 'Uji kemampuanmu menyelesaikan soal persamaan linear satu dan dua variabel.',
                'link_url' => 'https://mayclass.id/quiz/persamaan-linear',
                'thumbnail_url' => 'persamaan_linear',
                'duration_label' => '45 Menit',
                'question_count' => 30,
                'levels' => ['Dasar', 'Menengah', 'Lanjutan'],
                'takeaways' => [
                    'Analisis pola pengerjaan paling efisien.',
                    'Evaluasi otomatis dengan rekomendasi remedi.',
                    'Pembahasan video untuk soal HOTS.',
                ],
            ],
            [
                'slug' => 'kimia-termokimia',
                'subject' => 'Kimia',
                'class_level' => 'Kelas 12 IPA',
                'title' => 'Quiz Termokimia',
                'summary' => 'Tantang pemahaman energi reaksi, perubahan entalpi, dan hukum Hess.',
                'link_url' => 'https://mayclass.id/quiz/kimia-termokimia',
                'thumbnail_url' => 'kimia_termokimia',
                'duration_label' => '35 Menit',
                'question_count' => 25,
                'levels' => ['Dasar', 'Menengah'],
                'takeaways' => [
                    'Latihan menghitung entalpi dengan data tabel.',
                    'Skor langsung dengan grafik kemampuan.',
                    'Saran penguatan materi setelah quiz.',
                ],
            ],
            [
                'slug' => 'bahasa-grammar',
                'subject' => 'Bahasa Inggris',
                'class_level' => 'Kelas 11',
                'title' => 'Quiz Grammar Adaptive',
                'summary' => 'Cek penguasaan grammar dengan soal adaptif dan feedback instan.',
                'link_url' => 'https://mayclass.id/quiz/bahasa-grammar',
                'thumbnail_url' => 'bahasa_grammar',
                'duration_label' => '30 Menit',
                'question_count' => 28,
                'levels' => ['Dasar', 'Menengah'],
                'takeaways' => [
                    'Deteksi kesalahan umum dan koreksi otomatis.',
                    'Simulasi soal TOEFL junior dan AKM.',
                    'Rencana belajar personal untuk grammar.',
                ],
            ],
            [
                'slug' => 'sd-literasi',
                'subject' => 'SD Terpadu',
                'class_level' => 'Kelas 4',
                'title' => 'Quiz Literasi Tematik',
                'summary' => 'Pertanyaan literasi-numerasi yang menyenangkan untuk siswa SD kelas menengah.',
                'link_url' => 'https://mayclass.id/quiz/sd-literasi',
                'thumbnail_url' => 'sd_literasi',
                'duration_label' => '25 Menit',
                'question_count' => 20,
                'levels' => ['Dasar'],
                'takeaways' => [
                    'Cerita interaktif dengan pertanyaan pemahaman.',
                    'Skor langsung untuk siswa dan orang tua.',
                    'Saran aktivitas lanjutan di rumah.',
                ],
            ],
        ];

        foreach ($quizzes as $data) {
            $levels = $data['levels'];
            $takeaways = $data['takeaways'];

            unset($data['levels'], $data['takeaways']);

            $quiz = Quiz::updateOrCreate(['slug' => $data['slug']], $data);
            $quiz->levels()->delete();
            $quiz->takeaways()->delete();

            foreach ($levels as $index => $label) {
                $quiz->levels()->create([
                    'label' => $label,
                    'position' => $index,
                ]);
            }

            foreach ($takeaways as $index => $description) {
                $quiz->takeaways()->create([
                    'description' => $description,
                    'position' => $index,
                ]);
            }
        }
    }
}
