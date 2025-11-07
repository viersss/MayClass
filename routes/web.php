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

Route::get('/checkout/{slug}/success', function (string $slug) use ($packages) {
    if (! array_key_exists($slug, $packages)) {
        abort(404);
    }

    return view('checkout.success', ['package' => $packages[$slug]]);
})->name('checkout.success');

$learningMaterials = [
    'persamaan-linear' => [
        'slug' => 'persamaan-linear',
        'subject' => 'Matematika',
        'title' => 'Persamaan Linear',
        'level' => 'SMA IPA',
        'summary' => 'Pendalaman konsep persamaan linear dua variabel lengkap dengan contoh kontekstual dan latihan terstruktur.',
        'thumbnail' => 'https://images.unsplash.com/photo-1588072432836-e10032774350?auto=format&fit=crop&w=900&q=80',
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
    'kimia-termokimia' => [
        'slug' => 'kimia-termokimia',
        'subject' => 'Kimia',
        'title' => 'Kimia: Termokimia',
        'level' => 'SMA IPA',
        'summary' => 'Pelajari konsep perubahan entalpi, hukum Hess, dan penerapan termokimia pada reaksi sehari-hari.',
        'thumbnail' => 'https://images.unsplash.com/photo-1559757175-5700dde6756b?auto=format&fit=crop&w=900&q=80',
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
    'bahasa-grammar' => [
        'slug' => 'bahasa-grammar',
        'subject' => 'Bahasa Inggris',
        'title' => 'Grammar Intensif',
        'level' => 'SMP',
        'summary' => 'Kuasai struktur kalimat bahasa Inggris melalui praktik interaktif dan evaluasi otomatis.',
        'thumbnail' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
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
    'sd-literasi' => [
        'slug' => 'sd-literasi',
        'subject' => 'SD Terpadu',
        'title' => 'Literasi Tematik SD',
        'level' => 'SD (Kelas 3-4)',
        'summary' => 'Pendekatan tematik untuk meningkatkan kemampuan literasi dan numerasi dasar siswa SD.',
        'thumbnail' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
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

$materialCollections = [
    [
        'label' => 'Matematika',
        'accent' => '#37b6ad',
        'items' => [
            $learningMaterials['persamaan-linear'],
        ],
    ],
    [
        'label' => 'Kimia',
        'accent' => '#5f6af8',
        'items' => [
            $learningMaterials['kimia-termokimia'],
        ],
    ],
    [
        'label' => 'Bahasa',
        'accent' => '#f1a82e',
        'items' => [
            $learningMaterials['bahasa-grammar'],
        ],
    ],
    [
        'label' => 'SD Terpadu',
        'accent' => '#8e65d4',
        'items' => [
            $learningMaterials['sd-literasi'],
        ],
    ],
];

$quizModules = [
    'persamaan-linear' => [
        'slug' => 'persamaan-linear',
        'subject' => 'Matematika',
        'title' => 'Quiz Persamaan Linear',
        'summary' => 'Uji kemampuanmu menyelesaikan soal persamaan linear satu dan dua variabel.',
        'duration' => '45 Menit',
        'questions' => 30,
        'levels' => ['Dasar', 'Menengah', 'Lanjutan'],
        'takeaways' => [
            'Analisis pola pengerjaan paling efisien.',
            'Evaluasi otomatis dengan rekomendasi remedi.',
            'Pembahasan video untuk soal HOTS.',
        ],
        'thumbnail' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
    ],
    'kimia-termokimia' => [
        'slug' => 'kimia-termokimia',
        'subject' => 'Kimia',
        'title' => 'Quiz Termokimia',
        'summary' => 'Tantang pemahaman energi reaksi, perubahan entalpi, dan hukum Hess.',
        'duration' => '35 Menit',
        'questions' => 25,
        'levels' => ['Dasar', 'Menengah'],
        'takeaways' => [
            'Latihan menghitung entalpi dengan data tabel.',
            'Skor langsung dengan grafik kemampuan.',
            'Saran penguatan materi setelah quiz.',
        ],
        'thumbnail' => 'https://images.unsplash.com/photo-1559757175-5700dde6756b?auto=format&fit=crop&w=900&q=80',
    ],
    'bahasa-grammar' => [
        'slug' => 'bahasa-grammar',
        'subject' => 'Bahasa Inggris',
        'title' => 'Quiz Grammar Adaptive',
        'summary' => 'Cek penguasaan grammar dengan soal adaptif dan feedback instan.',
        'duration' => '30 Menit',
        'questions' => 28,
        'levels' => ['Dasar', 'Menengah'],
        'takeaways' => [
            'Deteksi kesalahan umum dan koreksi otomatis.',
            'Simulasi soal TOEFL junior dan AKM.',
            'Rencana belajar personal untuk grammar.',
        ],
        'thumbnail' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80',
    ],
    'sd-literasi' => [
        'slug' => 'sd-literasi',
        'subject' => 'SD Terpadu',
        'title' => 'Quiz Literasi Tematik',
        'summary' => 'Pertanyaan literasi-numerasi yang menyenangkan untuk siswa SD kelas menengah.',
        'duration' => '25 Menit',
        'questions' => 20,
        'levels' => ['Dasar'],
        'takeaways' => [
            'Cerita interaktif dengan pertanyaan pemahaman.',
            'Skor langsung untuk siswa dan orang tua.',
            'Saran aktivitas lanjutan di rumah.',
        ],
        'thumbnail' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
    ],
];

$quizCollections = [
    [
        'label' => 'Matematika',
        'accent' => '#37b6ad',
        'items' => [
            $quizModules['persamaan-linear'],
        ],
    ],
    [
        'label' => 'Kimia',
        'accent' => '#5f6af8',
        'items' => [
            $quizModules['kimia-termokimia'],
        ],
    ],
    [
        'label' => 'Bahasa',
        'accent' => '#f1a82e',
        'items' => [
            $quizModules['bahasa-grammar'],
        ],
    ],
    [
        'label' => 'SD Terpadu',
        'accent' => '#8e65d4',
        'items' => [
            $quizModules['sd-literasi'],
        ],
    ],
];

$studentSchedule = [
    'highlight' => [
        'title' => 'Persamaan Linear',
        'category' => 'Matematika',
        'date' => 'Selasa, 12 Desember 2023',
        'time' => '16.00 - 17.30 WIB',
        'mentor' => 'Ahmad Rizki',
    ],
    'upcoming' => [
        [
            'title' => 'Grammar Intensive',
            'category' => 'Bahasa Inggris',
            'date' => 'Rabu, 13 Desember 2023',
            'time' => '19.00 - 20.30 WIB',
            'mentor' => 'Ayu Pratiwi',
        ],
        [
            'title' => 'Kimia: Termokimia',
            'category' => 'Kimia',
            'date' => 'Kamis, 14 Desember 2023',
            'time' => '17.00 - 18.30 WIB',
            'mentor' => 'Dr. Budi Santoso',
        ],
        [
            'title' => 'Literasi Tematik',
            'category' => 'SD Terpadu',
            'date' => 'Sabtu, 16 Desember 2023',
            'time' => '09.00 - 10.30 WIB',
            'mentor' => 'Mentor Laila',
        ],
    ],
    'calendar' => [
        ['label' => 'Sen', 'days' => [27, 4, 11, 18, 25]],
        ['label' => 'Sel', 'days' => [28, 5, 12, 19, 26]],
        ['label' => 'Rab', 'days' => [29, 6, 13, 20, 27]],
        ['label' => 'Kam', 'days' => [30, 7, 14, 21, 28]],
        ['label' => 'Jum', 'days' => [1, 8, 15, 22, 29]],
        ['label' => 'Sab', 'days' => [2, 9, 16, 23, 30]],
        ['label' => 'Min', 'days' => [3, 10, 17, 24, 31]],
    ],
    'activeDays' => [5, 7, 12, 13, 14, 16, 22, 29],
    'mutedCells' => [
        'Sen' => [27],
        'Sel' => [28],
        'Rab' => [29],
        'Kam' => [30],
    ],
];

Route::get('/student/dashboard', function () use ($materialCollections, $learningMaterials, $studentSchedule) {
    $activePackage = [
        'title' => 'SD (Kelas 6) - Paket Intensif',
        'period' => 'Aktif hingga 31 Desember 2023',
        'status' => 'Berjalan',
    ];

    $recentMaterials = array_slice(array_values($learningMaterials), 0, 3);

    return view('student.dashboard', [
        'schedule' => $studentSchedule,
        'recentMaterials' => $recentMaterials,
        'activePackage' => $activePackage,
    ]);
})->name('student.dashboard');

Route::get('/student/jadwal', function () use ($studentSchedule) {
    return view('student.schedule', ['schedule' => $studentSchedule]);
})->name('student.schedule');

Route::get('/student/materi', function () use ($materialCollections) {
    return view('student.materials.index', ['collections' => $materialCollections]);
})->name('student.materials');

Route::get('/student/materi/{slug}', function (string $slug) use ($learningMaterials) {
    if (! array_key_exists($slug, $learningMaterials)) {
        abort(404);
    }

    return view('student.materials.show', ['material' => $learningMaterials[$slug]]);
})->name('student.materials.show');

Route::get('/student/quiz', function () use ($quizCollections) {
    return view('student.quiz.index', ['collections' => $quizCollections]);
})->name('student.quiz');

Route::get('/student/quiz/{slug}', function (string $slug) use ($quizModules) {
    if (! array_key_exists($slug, $quizModules)) {
        abort(404);
    }

    return view('student.quiz.show', ['quiz' => $quizModules[$slug]]);
})->name('student.quiz.show');

Route::get('/student/profile', function () {
    $profile = [
        'name' => 'Ahmad Rizki',
        'email' => 'ahmad.rizki@email.com',
        'studentId' => 'MC-102938',
        'phone' => '081234567890',
        'gender' => 'Laki-laki',
        'parentName' => 'Budi Santoso',
        'address' => 'Jl. Melati No. 12, Bandung',
    ];

    return view('student.profile', ['profile' => $profile]);
})->name('student.profile');
