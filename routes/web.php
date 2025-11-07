<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.index', ['mode' => 'login']);
})->name('login');

Route::get('/register', function () {
    return view('auth.index', ['mode' => 'register']);
})->name('register');

$packages = [
    'sd-kelas-1-3' => [
        'slug' => 'sd-kelas-1-3',
        'level' => 'SD (Kelas 1-3)',
        'tag' => 'Popular',
        'card_price' => 'Rp 2jt',
        'detail_title' => 'Paket SD Kelas 1-3',
        'detail_price' => 'Rp 2 jt',
        'summary' => 'Bangun pondasi akademik yang kuat untuk siswa SD kelas awal melalui pembelajaran tematik dan aktivitas interaktif.',
        'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
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
        'price_numeric' => 2000000,
    ],
    'sd-kelas-4-6' => [
        'slug' => 'sd-kelas-4-6',
        'level' => 'SD (Kelas 4-6)',
        'tag' => 'Best',
        'card_price' => 'Rp 3jt',
        'detail_title' => 'Paket SD Kelas 4-6',
        'detail_price' => 'Rp 3 jt',
        'summary' => 'Siapkan siswa untuk ujian akhir SD dengan modul latihan terarah, pemantauan progres, dan sesi klinik soal mingguan.',
        'image' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=900&q=80',
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
        'price_numeric' => 3000000,
    ],
    'smp-kelas-7-9' => [
        'slug' => 'smp-kelas-7-9',
        'level' => 'SMP (Kelas 7-9)',
        'tag' => 'Favorite',
        'card_price' => 'Rp 3,2jt',
        'detail_title' => 'Paket SMP Kelas 7-9',
        'detail_price' => 'Rp 3,2 jt',
        'summary' => 'Dukung persiapan AKM dan ujian sekolah dengan kombinasi konsep inti, eksperimen virtual, dan klinik mentoring.',
        'image' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
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
        'price_numeric' => 3200000,
    ],
    'sma-ipa' => [
        'slug' => 'sma-ipa',
        'level' => 'SMA (Jurusan IPA)',
        'tag' => 'Best',
        'card_price' => 'Rp 3,5jt',
        'detail_title' => 'Paket SMA IPA',
        'detail_price' => 'Rp 3,5 jt',
        'summary' => 'Dalami materi STEM dengan eksperimen virtual, sesi pemantapan UTBK, serta klinik soal intensif setiap pekan.',
        'image' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=900&q=80',
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
        'price_numeric' => 3500000,
    ],
    'sma-ips' => [
        'slug' => 'sma-ips',
        'level' => 'SMA (Jurusan IPS)',
        'tag' => 'Popular',
        'card_price' => 'Rp 3,3jt',
        'detail_title' => 'Paket SMA IPS',
        'detail_price' => 'Rp 3,3 jt',
        'summary' => 'Fokus pada pemahaman konsep sosial, ekonomi, dan sejarah melalui studi kasus dan presentasi kolaboratif.',
        'image' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
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
        'price_numeric' => 3300000,
    ],
    'persiapan-utbk' => [
        'slug' => 'persiapan-utbk',
        'level' => 'Persiapan UTBK',
        'tag' => 'Intensif',
        'card_price' => 'Rp 4jt',
        'detail_title' => 'Bootcamp Persiapan UTBK',
        'detail_price' => 'Rp 4 jt',
        'summary' => 'Program percepatan UTBK dengan tryout mingguan, klinik pembahasan, dan mentoring strategi penalaran.',
        'image' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=900&q=80',
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
        'price_numeric' => 4000000,
    ],
    'olimpiade-sains' => [
        'slug' => 'olimpiade-sains',
        'level' => 'Olimpiade Sains',
        'tag' => 'Elite',
        'card_price' => 'Rp 4,5jt',
        'detail_title' => 'Program Olimpiade Sains',
        'detail_price' => 'Rp 4,5 jt',
        'summary' => 'Pendampingan khusus siswa berprestasi dengan modul penelitian, bimbingan eksperimen, dan coaching nasional.',
        'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
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
        'price_numeric' => 4500000,
    ],
    'kelas-karakter' => [
        'slug' => 'kelas-karakter',
        'level' => 'Kelas Pengembangan Karakter',
        'tag' => 'New',
        'card_price' => 'Rp 2,5jt',
        'detail_title' => 'Program Pengembangan Karakter',
        'detail_price' => 'Rp 2,5 jt',
        'summary' => 'Kembangkan soft skill siswa melalui modul kepemimpinan, komunikasi, dan manajemen proyek mini.',
        'image' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
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
        'price_numeric' => 2500000,
    ],
];

Route::get('/packages', function () use ($packages) {
    return view('packages.index', ['packages' => $packages]);
})->name('packages.index');

Route::get('/packages/{slug}', function (string $slug) use ($packages) {
    if (! array_key_exists($slug, $packages)) {
        abort(404);
    }

    return view('packages.show', ['package' => $packages[$slug]]);
})->name('packages.show');

Route::get('/checkout/{slug}', function (string $slug) use ($packages) {
    if (! array_key_exists($slug, $packages)) {
        abort(404);
    }

    return view('checkout.index', ['package' => $packages[$slug]]);
})->name('checkout.show');
