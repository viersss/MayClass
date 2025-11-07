<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'slug' => 'sd-kelas-1-3',
                'level' => 'SD (Kelas 1-3)',
                'tag' => 'Popular',
                'card_price_label' => 'Rp 2jt',
                'detail_title' => 'Paket SD Kelas 1-3',
                'detail_price_label' => 'Rp 2 jt',
                'image_url' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
                'price' => 2000000,
                'summary' => 'Bangun pondasi akademik yang kuat untuk siswa SD kelas awal melalui pembelajaran tematik dan aktivitas interaktif.',
                'card_features' => [
                    'Pendampingan tematik sesuai kurikulum',
                    'Latihan literasi dan numerasi',
                    'Kelas interaktif 3x per minggu',
                    'Mentor ramah dan bersertifikasi',
                ],
                'included' => [
                    'Jadwal belajar fleksibel',
                    'Akses perangkat apa pun',
                    'Kelas tematik kreatif',
                    'Evaluasi perkembangan bulanan',
                ],
            ],
            [
                'slug' => 'sd-kelas-4-6',
                'level' => 'SD (Kelas 4-6)',
                'tag' => 'Best',
                'card_price_label' => 'Rp 3jt',
                'detail_title' => 'Paket SD Kelas 4-6',
                'detail_price_label' => 'Rp 3 jt',
                'image_url' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=900&q=80',
                'price' => 3000000,
                'summary' => 'Siapkan siswa untuk ujian akhir SD dengan modul latihan terarah, pemantauan progres, dan sesi klinik soal mingguan.',
                'card_features' => [
                    'Materi lengkap Matematika & IPA',
                    'Tryout bulanan terukur',
                    'Bank soal adaptif',
                    'Parent report otomatis',
                ],
                'included' => [
                    'Money back guarantee',
                    'Akses materi 24/7',
                    '120+ video pembelajaran',
                    'Sertifikat kelulusan program',
                ],
            ],
            [
                'slug' => 'smp-kelas-7-9',
                'level' => 'SMP (Kelas 7-9)',
                'tag' => 'Favorite',
                'card_price_label' => 'Rp 3,2jt',
                'detail_title' => 'Paket SMP Kelas 7-9',
                'detail_price_label' => 'Rp 3,2 jt',
                'image_url' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
                'price' => 3200000,
                'summary' => 'Dukung persiapan AKM dan ujian sekolah dengan kombinasi konsep inti, eksperimen virtual, dan klinik mentoring.',
                'card_features' => [
                    'Pendalaman konsep Matematika & IPA',
                    'Bahasa Inggris komunikatif',
                    'Penjurusan dan konsultasi karier',
                    'Komunitas diskusi siswa',
                ],
                'included' => [
                    'Bank soal adaptif',
                    'Live class interaktif',
                    'Rekaman kelas tersimpan',
                    'Laporan perkembangan personal',
                ],
            ],
            [
                'slug' => 'sma-ipa',
                'level' => 'SMA (Jurusan IPA)',
                'tag' => 'Best',
                'card_price_label' => 'Rp 3,5jt',
                'detail_title' => 'Paket SMA IPA',
                'detail_price_label' => 'Rp 3,5 jt',
                'image_url' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=900&q=80',
                'price' => 3500000,
                'summary' => 'Dalami materi STEM dengan eksperimen virtual, sesi pemantapan UTBK, serta klinik soal intensif setiap pekan.',
                'card_features' => [
                    'Kelas premium STEM',
                    'UTBK dan ujian sekolah',
                    'Mentor dari PTN unggulan',
                    'Grup belajar eksklusif',
                ],
                'included' => [
                    'Simulasi UTBK rutin',
                    'Modul digital interaktif',
                    'Akses perangkat apapun',
                    'Sertifikat kelulusan program',
                ],
            ],
            [
                'slug' => 'sma-ips',
                'level' => 'SMA (Jurusan IPS)',
                'tag' => 'Popular',
                'card_price_label' => 'Rp 3,3jt',
                'detail_title' => 'Paket SMA IPS',
                'detail_price_label' => 'Rp 3,3 jt',
                'image_url' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
                'price' => 3300000,
                'summary' => 'Fokus pada pemahaman konsep sosial, ekonomi, dan sejarah melalui studi kasus dan presentasi kolaboratif.',
                'card_features' => [
                    'Kelas live interaktif',
                    'Klinik esai dan debat',
                    'Mentor profesional',
                    'Pendampingan tugas sekolah',
                ],
                'included' => [
                    'Rencana belajar personal',
                    'Akses materi kapan saja',
                    'Bimbingan konseling lanjutan',
                    'Tryout dan analisis nilai',
                ],
            ],
            [
                'slug' => 'persiapan-utbk',
                'level' => 'Persiapan UTBK',
                'tag' => 'Intensif',
                'card_price_label' => 'Rp 4jt',
                'detail_title' => 'Bootcamp Persiapan UTBK',
                'detail_price_label' => 'Rp 4 jt',
                'image_url' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=900&q=80',
                'price' => 4000000,
                'summary' => 'Program percepatan UTBK dengan tryout mingguan, klinik pembahasan, dan mentoring strategi penalaran.',
                'card_features' => [
                    'Tryout mingguan intensif',
                    'Analisis nilai realtime',
                    'Strategi pengerjaan soal',
                    'Sesi motivasi dan coaching',
                ],
                'included' => [
                    'Simulasi CBT premium',
                    'Bank soal 1500+',
                    'Live review soal',
                    'Kelas strategi kampus tujuan',
                ],
            ],
            [
                'slug' => 'olimpiade-sains',
                'level' => 'Olimpiade Sains',
                'tag' => 'Elite',
                'card_price_label' => 'Rp 4,5jt',
                'detail_title' => 'Program Olimpiade Sains',
                'detail_price_label' => 'Rp 4,5 jt',
                'image_url' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
                'price' => 4500000,
                'summary' => 'Pendampingan khusus siswa berprestasi dengan modul penelitian, bimbingan eksperimen, dan coaching nasional.',
                'card_features' => [
                    'Mentor pemenang olimpiade',
                    'Lab virtual eksperimental',
                    'Bimbingan riset ilmiah',
                    'Tryout kompetisi nasional',
                ],
                'included' => [
                    'Pendampingan proposal riset',
                    'Forum diskusi eksklusif',
                    'Akses materi internasional',
                    'Coaching presentasi ilmiah',
                ],
            ],
            [
                'slug' => 'kelas-karakter',
                'level' => 'Kelas Pengembangan Karakter',
                'tag' => 'New',
                'card_price_label' => 'Rp 2,5jt',
                'detail_title' => 'Program Pengembangan Karakter',
                'detail_price_label' => 'Rp 2,5 jt',
                'image_url' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
                'price' => 2500000,
                'summary' => 'Kembangkan soft skill siswa melalui modul kepemimpinan, komunikasi, dan manajemen proyek mini.',
                'card_features' => [
                    'Pelatihan kepemimpinan',
                    'Simulasi proyek kolaboratif',
                    'Mentor profesional industri',
                    'Portofolio dan showcase karya',
                ],
                'included' => [
                    'Coaching 1-on-1 bulanan',
                    'Modul digital interaktif',
                    'Komunitas alumni MayClass',
                    'Sertifikat kompetensi soft skill',
                ],
            ],
        ];

        foreach ($packages as $data) {
            $features = [
                'card' => $data['card_features'],
                'included' => $data['included'],
            ];

            unset($data['card_features'], $data['included']);

            $package = Package::updateOrCreate(['slug' => $data['slug']], $data);

            $package->features()->delete();

            foreach ($features as $type => $items) {
                foreach ($items as $index => $label) {
                    $package->features()->create([
                        'type' => $type,
                        'label' => $label,
                        'position' => $index,
                    ]);
                }
            }
        }
    }
}
