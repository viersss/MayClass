# MayClass: Sistem Informasi Bimbingan Belajar

MayClass adalah sistem informasi bimbingan belajar (e-learning) berbasis website yang dirancang untuk mendigitalkan dan mengelola proses bisnis di Bimbel MayClass.

Proyek ini dikembangkan oleh Tim 1 3SD2 sebagai bagian dari pemenuhan tugas mata kuliah **Rekayasa Perangkat Lunak** di Politeknik Statistika STIS.

## Problem

Klien (Bimbel MayClass) saat ini mengelola seluruh operasional secara manual. Informasi seperti jadwal, materi, dan data siswa masih tersebar dalam bentuk file PDF atau tautan Google Drive. Proses ini tidak efisien, menyulitkan siswa dan orang tua untuk mendapatkan informasi terpusat, dan menghambat pendokumentasian progres belajar siswa.

## 💡 Solusi

Website MayClass hadir sebagai platform terintegrasi yang berfungsi sebagai:
1.  **Pusat Informasi:** Menyediakan informasi resmi mengenai profil, paket harga, jadwal, dan profil tentor.
2.  **Manajemen Akademik:** Mengelola data siswa, tentor, materi pembelajaran, dan bank soal secara terstruktur.
3.  **Platform E-Learning:** Memfasilitasi siswa untuk mengakses materi, mengerjakan kuis/tugas, dan melihat progres belajar.
4.  **Alat Branding:** Menampilkan testimoni dan foto kegiatan untuk meningkatkan kepercayaan calon siswa.

## ✨ Fitur Utama

Sistem ini memiliki 5 peran pengguna utama:

* **Pengunjung (Publik):**
    * Melihat halaman informasi: profil bimbel, paket belajar, dan profil tentor.
    * Melihat kontak dan testimoni.
    * Melakukan registrasi untuk menjadi siswa.

* **Siswa:**
    * Login ke sistem.
    * Mengakses materi pembelajaran dan bank soal.
    * Mengerjakan tugas atau kuis.
    * Melihat progres belajar.

* **Tentor:**
    * Login ke sistem.
    * Mengelola (mengunggah, update, hapus) materi dan bank soal.

* **Admin Utama:**
    * Mengelola seluruh data pengguna (siswa, tentor, admin lainnya).

* **Admin Keuangan:**
    * Mengelola tagihan siswa.
    * Memverifikasi pembayaran yang masuk.

## 🛠️ Tumpukan Teknologi (Technology Stack)

* **Backend:** Laravel (PHP Framework)
* **Frontend:** Vue.js & Blade Templates
* **Styling:** Tailwind CSS
* **Database:** MySQL

## 🎨 Desain & Wireframe

Rancangan antarmuka (UI/UX) dan prototipe interaktif untuk proyek ini dibuat menggunakan Figma.

* **Tautan Utama Desain:** [Lihat Desain Lengkap di Figma](https://www.figma.com/design/FYcvU8p4W8qNuyghlN4VFk/WIREFRAME?node-id=134-348&t=359dHXDoq8JX47xF-1)
* **Prototipe Alur Siswa:** [Coba Alur Siswa](https://www.figma.com/proto/FYcvU8p4W8qNuyghlN4VFk/WIREFRAME?node-id-1-188&p=f&t=UEcMAvLIo68NX2km-1&scaling-min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=1%3A188)
* **Prototipe Alur Tentor:** [Coba Alur Tentor](https://www.figma.com/proto/FYcvU8p4W8qNuyghlN4VFk/WIREFRAME?node-id=134-1161&p=f&t=2VXB CyG9sHr6oUd-1&scaling-min-zoom&content-scaling=fixed&page-id=134%3A348)

## 🚀 Instalasi dan Menjalankan Proyek

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

1.  **Clone repositori:**
    ```bash
    git clone [https://github.com/viersss/MayClass.git](https://github.com/viersss/MayClass.git)
    cd MayClass
    ```

2.  **Install dependensi Backend (Composer):**
    ```bash
    composer install
    ```

3.  **Install dependensi Frontend (NPM):**
    ```bash
    npm install
    ```

4.  **Setup file `.env`:**
    * Salin file `.env.example` menjadi `.env`.
    * ```bash
        cp .env.example .env
        ```
    * Buka file `.env` dan konfigurasikan koneksi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

5.  **Generate Kunci Aplikasi Laravel:**
    ```bash
    php artisan key:generate
    ```

6.  **Jalankan Migrasi Database:**
    * (Pastikan Anda sudah membuat database di MySQL sesuai nama di file `.env`)
    ```bash
    php artisan migrate
    ```

7.  **(Opsional) Jalankan Database Seeder (jika ada):**
    ```bash
    php artisan db:seed
    ```

8.  **Jalankan server pengembangan:**
    * Terminal 1 (Vite/NPM):
        ```bash
        npm run dev
        ```
    * Terminal 2 (Laravel/PHP):
        ```bash
        php artisan serve
        ```

9.  Buka aplikasi di `http://localhost:8000`.

## 🔧 Troubleshooting

### Error `HY000/1045` saat login MySQL atau phpMyAdmin

Apabila phpMyAdmin menampilkan pesan `Access denied for user 'root'@'localhost' (using password: NO)` berarti server
MySQL Anda membutuhkan kata sandi untuk akun `root`. Laragon secara bawaan memperbolehkan login tanpa kata sandi, namun
pengaturan lokal Anda bisa saja sudah berubah. Lakukan langkah-langkah berikut untuk memastikan aplikasi dapat terhubung
dengan database:

1.  Buka **Laragon → Menu → Database → mysql → Reset/Change password** lalu tentukan kata sandi baru untuk pengguna
    `root`.
2.  Setelah password diperbarui, sesuaikan kredensial pada file `.env`:

    ```ini
    DB_USERNAME=root
    DB_PASSWORD=kata_sandi_baru_anda
    ```

3.  Restart layanan MySQL melalui Laragon agar konfigurasi baru diterapkan.
4.  Uji kembali koneksi melalui phpMyAdmin menggunakan username dan kata sandi yang sama seperti di `.env`.
5.  Jalankan kembali migrasi aplikasi apabila sebelumnya gagal:

    ```bash
    php artisan migrate
    ```

Apabila Anda tidak ingin menggunakan akun `root`, buat pengguna baru di MySQL dengan hak akses yang dibutuhkan dan masukkan
credential tersebut ke dalam file `.env`.

## 👥 Tim Pengembang (Kelompok 1 - 3SD2)

Proyek ini dikerjakan oleh:

| Nama | NIM |
| :--- | :--- |
| Ahmad Husein Nasution | 222312952 |
| Henny Merry Astutik | 222313120 |
| Johana Putri Natasya Sitorus | 222313150 |
| Lisa Fajrianti | 222313174 |
| Triangga Hafid Rifa'i | 222313408 |
| Xavier Yubin Raditio | 222313427 |
| Yudha Putra Tiara | 222313433 |
