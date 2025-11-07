<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $materials = [
            [
                'slug' => 'persamaan-linear',
                'subject' => 'Matematika',
                'title' => 'Persamaan Linear',
                'level' => 'SMA IPA',
                'summary' => 'Pendalaman konsep persamaan linear dua variabel lengkap dengan contoh kontekstual dan latihan terstruktur.',
                'thumbnail_url' => 'persamaan_linear',
                'objectives' => [
                    'Menjabarkan bentuk umum persamaan linear satu dan dua variabel.',
                    'Menggunakan metode subtitusi dan eliminasi pada soal cerita.',
                    'Menganalisis kesalahan umum dan strategi mempercepat pengerjaan.',
                    'Menghubungkan konsep linear dengan model masalah kehidupan nyata.',
                ],
                'chapters' => [
                    ['title' => 'Konsep Dasar', 'description' => 'Memahami definisi, notasi, dan representasi grafis persamaan linear.'],
                    ['title' => 'Metode Penyelesaian', 'description' => 'Berlatih eliminasi, subtitusi, dan grafik lengkap dengan simulasi digital.'],
                    ['title' => 'Aplikasi Kontekstual', 'description' => 'Studi kasus finansial, sosial, dan ilmiah yang memanfaatkan model linear.'],
                    ['title' => 'Bank Soal Premium', 'description' => 'Kumpulan 120 soal bertingkat lengkap dengan pembahasan video.'],
                ],
            ],
            [
                'slug' => 'kimia-termokimia',
                'subject' => 'Kimia',
                'title' => 'Kimia: Termokimia',
                'level' => 'SMA IPA',
                'summary' => 'Pelajari konsep perubahan entalpi, hukum Hess, dan penerapan termokimia pada reaksi sehari-hari.',
                'thumbnail_url' => 'kimia_termokimia',
                'objectives' => [
                    'Menjelaskan konsep energi dan entalpi reaksi secara kualitatif.',
                    'Menggunakan hukum Hess dan data entalpi standar.',
                    'Menganalisis grafik profil energi untuk reaksi endoterm dan eksoterm.',
                    'Mensimulasikan eksperimen sederhana termokimia di rumah.',
                ],
                'chapters' => [
                    ['title' => 'Dasar Termodinamika', 'description' => 'Konsep energi, kerja, dan panas dalam sistem kimia.'],
                    ['title' => 'Hukum Hess', 'description' => 'Latihan menyusun reaksi bertingkat untuk menghitung entalpi.'],
                    ['title' => 'Profil Energi', 'description' => 'Membaca kurva energi dan menentukan sifat reaksi.'],
                    ['title' => 'Praktikum Rumah', 'description' => 'Eksperimen sederhana dengan bahan aman untuk memahami kalorimeter.'],
                ],
            ],
            [
                'slug' => 'bahasa-grammar',
                'subject' => 'Bahasa Inggris',
                'title' => 'Grammar Intensif',
                'level' => 'SMP',
                'summary' => 'Kuasai struktur kalimat bahasa Inggris melalui praktik interaktif dan evaluasi otomatis.',
                'thumbnail_url' => 'bahasa_grammar',
                'objectives' => [
                    'Memahami tenses dasar hingga kompleks secara runtut.',
                    'Mengidentifikasi kesalahan umum dalam writing dan speaking.',
                    'Latihan grammar adaptif dengan feedback instan.',
                    'Menyusun paragraf akademik dengan struktur tepat.',
                ],
                'chapters' => [
                    ['title' => 'Tenses Fondasi', 'description' => 'Simple, continuous, perfect, dan kombinasi tens yang sering muncul.'],
                    ['title' => 'Sentence Building', 'description' => 'Membangun kalimat majemuk, kompleks, dan voice variations.'],
                    ['title' => 'Error Correction', 'description' => 'Latihan identifikasi dan perbaikan kalimat dalam konteks ujian.'],
                    ['title' => 'Writing Clinic', 'description' => 'Workshop menulis esai pendek dengan rubrik penilaian.'],
                ],
            ],
            [
                'slug' => 'sd-literasi',
                'subject' => 'SD Terpadu',
                'title' => 'Literasi Tematik SD',
                'level' => 'SD (Kelas 3-4)',
                'summary' => 'Pendekatan tematik untuk meningkatkan kemampuan literasi dan numerasi dasar siswa SD.',
                'thumbnail_url' => 'sd_literasi',
                'objectives' => [
                    'Membangun kebiasaan membaca aktif melalui cerita tematik.',
                    'Melatih pemahaman bacaan dengan pertanyaan inferensi.',
                    'Mengintegrasikan numerasi sederhana ke dalam aktivitas literasi.',
                    'Kolaborasi orang tua-siswa melalui lembar aktivitas mingguan.',
                ],
                'chapters' => [
                    ['title' => 'Cerita Tematik', 'description' => 'Cerita interaktif dengan audio dan lembar aktivitas.'],
                    ['title' => 'Literasi Visual', 'description' => 'Melatih interpretasi infografis sederhana untuk anak.'],
                    ['title' => 'Numerasi Kontekstual', 'description' => 'Menghubungkan cerita dengan perhitungan sehari-hari.'],
                    ['title' => 'Proyek Mini', 'description' => 'Panduan membuat jurnal keluarga dan presentasi singkat.'],
                ],
            ],
        ];

        foreach ($materials as $data) {
            $objectives = $data['objectives'];
            $chapters = $data['chapters'];

            unset($data['objectives'], $data['chapters']);

            $material = Material::updateOrCreate(['slug' => $data['slug']], $data);
            $material->objectives()->delete();
            $material->chapters()->delete();

            foreach ($objectives as $index => $objective) {
                $material->objectives()->create([
                    'description' => $objective,
                    'position' => $index,
                ]);
            }

            foreach ($chapters as $index => $chapter) {
                $material->chapters()->create([
                    'title' => $chapter['title'],
                    'description' => $chapter['description'],
                    'position' => $index,
                ]);
            }
        }
    }
}
