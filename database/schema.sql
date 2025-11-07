-- Schema and seed data for MayClass platform
-- Generated on 2025-11-07 06:21 UTC

CREATE DATABASE IF NOT EXISTS mayclass CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mayclass;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `material_objectives`;
DROP TABLE IF EXISTS `material_chapters`;
DROP TABLE IF EXISTS `package_features`;
DROP TABLE IF EXISTS `quiz_takeaways`;
DROP TABLE IF EXISTS `quiz_levels`;
DROP TABLE IF EXISTS `schedule_sessions`;
DROP TABLE IF EXISTS `materials`;
DROP TABLE IF EXISTS `quizzes`;
DROP TABLE IF EXISTS `enrollments`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `packages`;
DROP TABLE IF EXISTS `users`;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` VARCHAR(50) NOT NULL DEFAULT 'student',
    `student_id` VARCHAR(255) NULL UNIQUE,
    `phone` VARCHAR(255) NULL,
    `gender` ENUM('male','female','other') NULL,
    `parent_name` VARCHAR(255) NULL,
    `address` VARCHAR(255) NULL,
    `avatar_path` VARCHAR(255) NULL,
    `email_verified_at` TIMESTAMP NULL,
    `remember_token` VARCHAR(100) NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `packages` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `level` VARCHAR(255) NOT NULL,
    `tag` VARCHAR(255) NULL,
    `card_price_label` VARCHAR(255) NOT NULL,
    `detail_title` VARCHAR(255) NOT NULL,
    `detail_price_label` VARCHAR(255) NOT NULL,
    `image_url` VARCHAR(255) NOT NULL,
    `price` DECIMAL(12,2) NOT NULL,
    `summary` TEXT NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `package_features` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `package_id` BIGINT UNSIGNED NOT NULL,
    `type` VARCHAR(50) NOT NULL,
    `label` VARCHAR(255) NOT NULL,
    `position` INT UNSIGNED NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `package_features_package_id_foreign` (`package_id`),
    CONSTRAINT `package_features_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `orders` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `package_id` BIGINT UNSIGNED NOT NULL,
    `subtotal` DECIMAL(12,2) NOT NULL,
    `tax` DECIMAL(12,2) NOT NULL,
    `total` DECIMAL(12,2) NOT NULL,
    `status` VARCHAR(50) NOT NULL DEFAULT 'pending',
    `payment_method` VARCHAR(255) NULL,
    `cardholder_name` VARCHAR(255) NULL,
    `card_number_last_four` VARCHAR(4) NULL,
    `payment_proof_path` VARCHAR(255) NULL,
    `paid_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `orders_user_id_foreign` (`user_id`),
    KEY `orders_package_id_foreign` (`package_id`),
    CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `orders_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `enrollments` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `package_id` BIGINT UNSIGNED NOT NULL,
    `order_id` BIGINT UNSIGNED NOT NULL,
    `starts_at` DATE NOT NULL,
    `ends_at` DATE NOT NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    UNIQUE KEY `enrollments_unique_user_package_order` (`user_id`,`package_id`,`order_id`),
    KEY `enrollments_package_id_foreign` (`package_id`),
    KEY `enrollments_order_id_foreign` (`order_id`),
    CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `enrollments_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `enrollments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `materials` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `subject` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `level` VARCHAR(255) NOT NULL,
    `summary` TEXT NOT NULL,
    `thumbnail_url` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `material_objectives` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `material_id` BIGINT UNSIGNED NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `position` INT UNSIGNED NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `material_objectives_material_id_foreign` (`material_id`),
    CONSTRAINT `material_objectives_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `material_chapters` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `material_id` BIGINT UNSIGNED NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `position` INT UNSIGNED NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `material_chapters_material_id_foreign` (`material_id`),
    CONSTRAINT `material_chapters_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `quizzes` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `subject` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `summary` TEXT NOT NULL,
    `thumbnail_url` VARCHAR(255) NOT NULL,
    `duration_label` VARCHAR(255) NOT NULL,
    `question_count` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `quiz_levels` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `quiz_id` BIGINT UNSIGNED NOT NULL,
    `label` VARCHAR(255) NOT NULL,
    `position` INT UNSIGNED NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `quiz_levels_quiz_id_foreign` (`quiz_id`),
    CONSTRAINT `quiz_levels_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `quiz_takeaways` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `quiz_id` BIGINT UNSIGNED NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `position` INT UNSIGNED NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `quiz_takeaways_quiz_id_foreign` (`quiz_id`),
    CONSTRAINT `quiz_takeaways_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `schedule_sessions` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `package_id` BIGINT UNSIGNED NULL,
    `title` VARCHAR(255) NOT NULL,
    `category` VARCHAR(255) NOT NULL,
    `mentor_name` VARCHAR(255) NOT NULL,
    `start_at` DATETIME NOT NULL,
    `is_highlight` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `schedule_sessions_user_id_foreign` (`user_id`),
    KEY `schedule_sessions_package_id_foreign` (`package_id`),
    CONSTRAINT `schedule_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
    CONSTRAINT `schedule_sessions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed base packages
INSERT INTO `packages` (`id`,`slug`,`level`,`tag`,`card_price_label`,`detail_title`,`detail_price_label`,`image_url`,`price`,`summary`,`created_at`,`updated_at`) VALUES (1, 'sd-kelas-1-3', 'SD (Kelas 1-3)', 'Popular', 'Rp 2jt', 'Paket SD Kelas 1-3', 'Rp 2 jt', 'package_sd_1_3', 2000000.00, 'Bangun pondasi akademik yang kuat untuk siswa SD kelas awal melalui pembelajaran tematik dan aktivitas interaktif.', '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `packages` (`id`,`slug`,`level`,`tag`,`card_price_label`,`detail_title`,`detail_price_label`,`image_url`,`price`,`summary`,`created_at`,`updated_at`) VALUES (2, 'sd-kelas-4-6', 'SD (Kelas 4-6)', 'Best', 'Rp 3jt', 'Paket SD Kelas 4-6', 'Rp 3 jt', 'package_sd_4_6', 3000000.00, 'Siapkan siswa untuk ujian akhir SD dengan modul latihan terarah, pemantauan progres, dan sesi klinik soal mingguan.', '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `packages` (`id`,`slug`,`level`,`tag`,`card_price_label`,`detail_title`,`detail_price_label`,`image_url`,`price`,`summary`,`created_at`,`updated_at`) VALUES (3, 'smp-kelas-7-9', 'SMP (Kelas 7-9)', 'Favorite', 'Rp 3,2jt', 'Paket SMP Kelas 7-9', 'Rp 3,2 jt', 'package_smp_7_9', 3200000.00, 'Dukung persiapan AKM dan ujian sekolah dengan kombinasi konsep inti, eksperimen virtual, dan klinik mentoring.', '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `packages` (`id`,`slug`,`level`,`tag`,`card_price_label`,`detail_title`,`detail_price_label`,`image_url`,`price`,`summary`,`created_at`,`updated_at`) VALUES (4, 'sma-ipa', 'SMA (Jurusan IPA)', 'Best', 'Rp 3,5jt', 'Paket SMA IPA', 'Rp 3,5 jt', 'package_sma_ipa', 3500000.00, 'Dalami materi STEM dengan eksperimen virtual, sesi pemantapan UTBK, serta klinik soal intensif setiap pekan.', '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `packages` (`id`,`slug`,`level`,`tag`,`card_price_label`,`detail_title`,`detail_price_label`,`image_url`,`price`,`summary`,`created_at`,`updated_at`) VALUES (5, 'sma-ips', 'SMA (Jurusan IPS)', 'Popular', 'Rp 3,3jt', 'Paket SMA IPS', 'Rp 3,3 jt', 'package_sma_ips', 3300000.00, 'Fokus pada pemahaman konsep sosial, ekonomi, dan sejarah melalui studi kasus dan presentasi kolaboratif.', '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `packages` (`id`,`slug`,`level`,`tag`,`card_price_label`,`detail_title`,`detail_price_label`,`image_url`,`price`,`summary`,`created_at`,`updated_at`) VALUES (6, 'persiapan-utbk', 'Persiapan UTBK', 'Intensif', 'Rp 4jt', 'Bootcamp Persiapan UTBK', 'Rp 4 jt', 'package_utbk', 4000000.00, 'Program percepatan UTBK dengan tryout mingguan, klinik pembahasan, dan mentoring strategi penalaran.', '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `packages` (`id`,`slug`,`level`,`tag`,`card_price_label`,`detail_title`,`detail_price_label`,`image_url`,`price`,`summary`,`created_at`,`updated_at`) VALUES (7, 'olimpiade-sains', 'Olimpiade Sains', 'Elite', 'Rp 4,5jt', 'Program Olimpiade Sains', 'Rp 4,5 jt', 'package_olimpiade', 4500000.00, 'Pendampingan khusus siswa berprestasi dengan modul penelitian, bimbingan eksperimen, dan coaching nasional.', '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `packages` (`id`,`slug`,`level`,`tag`,`card_price_label`,`detail_title`,`detail_price_label`,`image_url`,`price`,`summary`,`created_at`,`updated_at`) VALUES (8, 'kelas-karakter', 'Kelas Pengembangan Karakter', 'New', 'Rp 2,5jt', 'Program Pengembangan Karakter', 'Rp 2,5 jt', 'package_karakter', 2500000.00, 'Kembangkan soft skill siswa melalui modul kepemimpinan, komunikasi, dan manajemen proyek mini.', '2025-11-07 06:21:55', '2025-11-07 06:21:55');

-- Seed package features
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (1,1,'card','Pendampingan tematik sesuai kurikulum',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (2,1,'card','Latihan literasi dan numerasi',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (3,1,'card','Kelas interaktif 3x per minggu',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (4,1,'card','Mentor ramah dan bersertifikasi',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (5,1,'included','Jadwal belajar fleksibel',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (6,1,'included','Akses perangkat apa pun',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (7,1,'included','Kelas tematik kreatif',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (8,1,'included','Evaluasi perkembangan bulanan',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (9,2,'card','Materi lengkap Matematika & IPA',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (10,2,'card','Tryout bulanan terukur',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (11,2,'card','Bank soal adaptif',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (12,2,'card','Parent report otomatis',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (13,2,'included','Money back guarantee',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (14,2,'included','Akses materi 24/7',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (15,2,'included','120+ video pembelajaran',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (16,2,'included','Sertifikat kelulusan program',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (17,3,'card','Pendalaman konsep Matematika & IPA',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (18,3,'card','Bahasa Inggris komunikatif',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (19,3,'card','Penjurusan dan konsultasi karier',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (20,3,'card','Komunitas diskusi siswa',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (21,3,'included','Bank soal adaptif',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (22,3,'included','Live class interaktif',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (23,3,'included','Rekaman kelas tersimpan',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (24,3,'included','Laporan perkembangan personal',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (25,4,'card','Kelas premium STEM',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (26,4,'card','UTBK dan ujian sekolah',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (27,4,'card','Mentor dari PTN unggulan',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (28,4,'card','Grup belajar eksklusif',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (29,4,'included','Simulasi UTBK rutin',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (30,4,'included','Modul digital interaktif',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (31,4,'included','Akses perangkat apapun',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (32,4,'included','Sertifikat kelulusan program',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (33,5,'card','Kelas live interaktif',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (34,5,'card','Klinik esai dan debat',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (35,5,'card','Mentor profesional',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (36,5,'card','Pendampingan tugas sekolah',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (37,5,'included','Rencana belajar personal',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (38,5,'included','Akses materi kapan saja',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (39,5,'included','Bimbingan konseling lanjutan',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (40,5,'included','Tryout dan analisis nilai',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (41,6,'card','Tryout mingguan intensif',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (42,6,'card','Analisis nilai realtime',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (43,6,'card','Strategi pengerjaan soal',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (44,6,'card','Sesi motivasi dan coaching',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (45,6,'included','Simulasi CBT premium',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (46,6,'included','Bank soal 1500+',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (47,6,'included','Live review soal',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (48,6,'included','Kelas strategi kampus tujuan',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (49,7,'card','Mentor pemenang olimpiade',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (50,7,'card','Lab virtual eksperimental',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (51,7,'card','Bimbingan riset ilmiah',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (52,7,'card','Tryout kompetisi nasional',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (53,7,'included','Pendampingan proposal riset',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (54,7,'included','Forum diskusi eksklusif',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (55,7,'included','Akses materi internasional',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (56,7,'included','Coaching presentasi ilmiah',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (57,8,'card','Pelatihan kepemimpinan',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (58,8,'card','Simulasi proyek kolaboratif',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (59,8,'card','Mentor profesional industri',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (60,8,'card','Portofolio dan showcase karya',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (61,8,'included','Coaching 1-on-1 bulanan',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (62,8,'included','Modul digital interaktif',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (63,8,'included','Komunitas alumni MayClass',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `package_features` (`id`,`package_id`,`type`,`label`,`position`,`created_at`,`updated_at`) VALUES (64,8,'included','Sertifikat kompetensi soft skill',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');

-- Seed learning materials
INSERT INTO `materials` (`id`,`slug`,`subject`,`title`,`level`,`summary`,`thumbnail_url`,`created_at`,`updated_at`) VALUES (1,'persamaan-linear','Matematika','Persamaan Linear','SMA IPA','Pendalaman konsep persamaan linear dua variabel lengkap dengan contoh kontekstual dan latihan terstruktur.','persamaan_linear','2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `materials` (`id`,`slug`,`subject`,`title`,`level`,`summary`,`thumbnail_url`,`created_at`,`updated_at`) VALUES (2,'kimia-termokimia','Kimia','Kimia: Termokimia','SMA IPA','Pelajari konsep perubahan entalpi, hukum Hess, dan penerapan termokimia pada reaksi sehari-hari.','kimia_termokimia','2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `materials` (`id`,`slug`,`subject`,`title`,`level`,`summary`,`thumbnail_url`,`created_at`,`updated_at`) VALUES (3,'bahasa-grammar','Bahasa Inggris','Grammar Intensif','SMP','Kuasai struktur kalimat bahasa Inggris melalui praktik interaktif dan evaluasi otomatis.','bahasa_grammar','2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `materials` (`id`,`slug`,`subject`,`title`,`level`,`summary`,`thumbnail_url`,`created_at`,`updated_at`) VALUES (4,'sd-literasi','SD Terpadu','Literasi Tematik SD','SD (Kelas 3-4)','Pendekatan tematik untuk meningkatkan kemampuan literasi dan numerasi dasar siswa SD.','sd_literasi','2025-11-07 06:21:55','2025-11-07 06:21:55');

-- Seed material objectives and chapters
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (1,1,'Menjabarkan bentuk umum persamaan linear satu dan dua variabel.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (2,1,'Menggunakan metode subtitusi dan eliminasi pada soal cerita.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (3,1,'Menganalisis kesalahan umum dan strategi mempercepat pengerjaan.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (4,1,'Menghubungkan konsep linear dengan model masalah kehidupan nyata.',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (1,1,'Konsep Dasar','Memahami definisi, notasi, dan representasi grafis persamaan linear.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (2,1,'Metode Penyelesaian','Berlatih eliminasi, subtitusi, dan grafik lengkap dengan simulasi digital.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (3,1,'Aplikasi Kontekstual','Studi kasus finansial, sosial, dan ilmiah yang memanfaatkan model linear.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (4,1,'Bank Soal Premium','Kumpulan 120 soal bertingkat lengkap dengan pembahasan video.',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (5,2,'Menjelaskan konsep energi dan entalpi reaksi secara kualitatif.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (6,2,'Menggunakan hukum Hess dan data entalpi standar.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (7,2,'Menganalisis grafik profil energi untuk reaksi endoterm dan eksoterm.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (8,2,'Mensimulasikan eksperimen sederhana termokimia di rumah.',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (5,2,'Dasar Termodinamika','Konsep energi, kerja, dan panas dalam sistem kimia.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (6,2,'Hukum Hess','Latihan menyusun reaksi bertingkat untuk menghitung entalpi.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (7,2,'Profil Energi','Membaca kurva energi dan menentukan sifat reaksi.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (8,2,'Praktikum Rumah','Eksperimen sederhana dengan bahan aman untuk memahami kalorimeter.',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (9,3,'Memahami tenses dasar hingga kompleks secara runtut.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (10,3,'Mengidentifikasi kesalahan umum dalam writing dan speaking.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (11,3,'Latihan grammar adaptif dengan feedback instan.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (12,3,'Menyusun paragraf akademik dengan struktur tepat.',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (9,3,'Tenses Fondasi','Simple, continuous, perfect, dan kombinasi tens yang sering muncul.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (10,3,'Sentence Building','Membangun kalimat majemuk, kompleks, dan voice variations.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (11,3,'Error Correction','Latihan identifikasi dan perbaikan kalimat dalam konteks ujian.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (12,3,'Writing Clinic','Workshop menulis esai pendek dengan rubrik penilaian.',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (13,4,'Membangun kebiasaan membaca aktif melalui cerita tematik.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (14,4,'Melatih pemahaman bacaan dengan pertanyaan inferensi.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (15,4,'Mengintegrasikan numerasi sederhana ke dalam aktivitas literasi.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_objectives` (`id`,`material_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (16,4,'Kolaborasi orang tua-siswa melalui lembar aktivitas mingguan.',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (13,4,'Cerita Tematik','Cerita interaktif dengan audio dan lembar aktivitas.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (14,4,'Literasi Visual','Melatih interpretasi infografis sederhana untuk anak.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (15,4,'Numerasi Kontekstual','Menghubungkan cerita dengan perhitungan sehari-hari.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `material_chapters` (`id`,`material_id`,`title`,`description`,`position`,`created_at`,`updated_at`) VALUES (16,4,'Proyek Mini','Panduan membuat jurnal keluarga dan presentasi singkat.',3,'2025-11-07 06:21:55','2025-11-07 06:21:55');

-- Seed quizzes
INSERT INTO `quizzes` (`id`,`slug`,`subject`,`title`,`summary`,`thumbnail_url`,`duration_label`,`question_count`,`created_at`,`updated_at`) VALUES (1,'persamaan-linear','Matematika','Quiz Persamaan Linear','Uji kemampuanmu menyelesaikan soal persamaan linear satu dan dua variabel.','persamaan_linear','45 Menit',30,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quizzes` (`id`,`slug`,`subject`,`title`,`summary`,`thumbnail_url`,`duration_label`,`question_count`,`created_at`,`updated_at`) VALUES (2,'kimia-termokimia','Kimia','Quiz Termokimia','Tantang pemahaman energi reaksi, perubahan entalpi, dan hukum Hess.','kimia_termokimia','35 Menit',25,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quizzes` (`id`,`slug`,`subject`,`title`,`summary`,`thumbnail_url`,`duration_label`,`question_count`,`created_at`,`updated_at`) VALUES (3,'bahasa-grammar','Bahasa Inggris','Quiz Grammar Adaptive','Cek penguasaan grammar dengan soal adaptif dan feedback instan.','bahasa_grammar','30 Menit',28,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quizzes` (`id`,`slug`,`subject`,`title`,`summary`,`thumbnail_url`,`duration_label`,`question_count`,`created_at`,`updated_at`) VALUES (4,'sd-literasi','SD Terpadu','Quiz Literasi Tematik','Pertanyaan literasi-numerasi yang menyenangkan untuk siswa SD kelas menengah.','sd_literasi','25 Menit',20,'2025-11-07 06:21:55','2025-11-07 06:21:55');

-- Seed quiz levels and takeaways
INSERT INTO `quiz_levels` (`id`,`quiz_id`,`label`,`position`,`created_at`,`updated_at`) VALUES (1,1,'Dasar',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_levels` (`id`,`quiz_id`,`label`,`position`,`created_at`,`updated_at`) VALUES (2,1,'Menengah',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_levels` (`id`,`quiz_id`,`label`,`position`,`created_at`,`updated_at`) VALUES (3,1,'Lanjutan',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (1,1,'Analisis pola pengerjaan paling efisien.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (2,1,'Evaluasi otomatis dengan rekomendasi remedi.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (3,1,'Pembahasan video untuk soal HOTS.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_levels` (`id`,`quiz_id`,`label`,`position`,`created_at`,`updated_at`) VALUES (4,2,'Dasar',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_levels` (`id`,`quiz_id`,`label`,`position`,`created_at`,`updated_at`) VALUES (5,2,'Menengah',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (4,2,'Latihan menghitung entalpi dengan data tabel.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (5,2,'Skor langsung dengan grafik kemampuan.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (6,2,'Saran penguatan materi setelah quiz.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_levels` (`id`,`quiz_id`,`label`,`position`,`created_at`,`updated_at`) VALUES (6,3,'Dasar',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_levels` (`id`,`quiz_id`,`label`,`position`,`created_at`,`updated_at`) VALUES (7,3,'Menengah',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (7,3,'Deteksi kesalahan umum dan koreksi otomatis.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (8,3,'Simulasi soal TOEFL junior dan AKM.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (9,3,'Rencana belajar personal untuk grammar.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_levels` (`id`,`quiz_id`,`label`,`position`,`created_at`,`updated_at`) VALUES (8,4,'Dasar',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (10,4,'Cerita interaktif dengan pertanyaan pemahaman.',0,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (11,4,'Skor langsung untuk siswa dan orang tua.',1,'2025-11-07 06:21:55','2025-11-07 06:21:55');
INSERT INTO `quiz_takeaways` (`id`,`quiz_id`,`description`,`position`,`created_at`,`updated_at`) VALUES (12,4,'Saran aktivitas lanjutan di rumah.',2,'2025-11-07 06:21:55','2025-11-07 06:21:55');

-- Seed schedule sessions for the upcoming week
SET @base_monday = DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 7 DAY);
INSERT INTO `schedule_sessions` (`id`,`title`,`category`,`mentor_name`,`start_at`,`is_highlight`,`created_at`,`updated_at`) VALUES (1,'Persamaan Linear','Matematika','Ahmad Rizki', DATE_ADD(@base_monday, INTERVAL 1 DAY) + INTERVAL 16 HOUR + INTERVAL 0 MINUTE, 1, '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `schedule_sessions` (`id`,`title`,`category`,`mentor_name`,`start_at`,`is_highlight`,`created_at`,`updated_at`) VALUES (2,'Grammar Intensive','Bahasa Inggris','Ayu Pratiwi', DATE_ADD(@base_monday, INTERVAL 2 DAY) + INTERVAL 19 HOUR + INTERVAL 0 MINUTE, 0, '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `schedule_sessions` (`id`,`title`,`category`,`mentor_name`,`start_at`,`is_highlight`,`created_at`,`updated_at`) VALUES (3,'Kimia: Termokimia','Kimia','Dr. Budi Santoso', DATE_ADD(@base_monday, INTERVAL 3 DAY) + INTERVAL 17 HOUR + INTERVAL 0 MINUTE, 0, '2025-11-07 06:21:55', '2025-11-07 06:21:55');
INSERT INTO `schedule_sessions` (`id`,`title`,`category`,`mentor_name`,`start_at`,`is_highlight`,`created_at`,`updated_at`) VALUES (4,'Literasi Tematik','SD Terpadu','Mentor Laila', DATE_ADD(@base_monday, INTERVAL 5 DAY) + INTERVAL 9 HOUR + INTERVAL 0 MINUTE, 0, '2025-11-07 06:21:55', '2025-11-07 06:21:55');

-- Seed demo student account and enrollment
INSERT INTO `users` (`id`,`name`,`email`,`password`,`role`,`student_id`,`phone`,`gender`,`parent_name`,`address`,`created_at`,`updated_at`) VALUES (1,'Ahmad Rizki','demo@student.mayclass.test','$2y$12$TsjhbYziRgp8AJImFxN1/.cWbSymHeZPYXGz0P9.D7EsSr/n4nWIq','student','MC-102938','081234567890','male','Budi Santoso','Jl. Melati No. 12, Bandung','2025-11-07 06:21:55','2025-11-07 06:21:55') ON DUPLICATE KEY UPDATE `id`=VALUES(`id`);
INSERT INTO `orders` (`id`,`user_id`,`package_id`,`subtotal`,`tax`,`total`,`status`,`payment_method`,`cardholder_name`,`card_number_last_four`,`paid_at`,`created_at`,`updated_at`) VALUES (1,1,4,3500000.00,385000.00,3885000.00,'paid','transfer_bank','Ahmad Rizki','1234',NOW() - INTERVAL 1 DAY,'2025-11-07 06:21:55','2025-11-07 06:21:55') ON DUPLICATE KEY UPDATE `id`=VALUES(`id`);
INSERT INTO `enrollments` (`id`,`user_id`,`package_id`,`order_id`,`starts_at`,`ends_at`,`is_active`,`created_at`,`updated_at`) VALUES (1,1,4,1,DATE_FORMAT(DATE_SUB(LAST_DAY(CURDATE()), INTERVAL DAY(LAST_DAY(CURDATE()))-1 DAY),'%Y-%m-01'),LAST_DAY(CURDATE()),1,'2025-11-07 06:21:55','2025-11-07 06:21:55') ON DUPLICATE KEY UPDATE `id`=VALUES(`id`);
