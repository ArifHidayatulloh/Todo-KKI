-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 13, 2024 at 05:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `report`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dep_code` varchar(10) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `dep_code`, `departemen`, `created_at`, `updated_at`) VALUES
(1, 'D001', 'KKB/KMC', '2024-08-06 18:23:15', '2024-08-06 18:23:15'),
(2, 'D002', 'SPBU', '2024-08-06 18:23:28', '2024-08-06 18:23:28'),
(3, 'D003', 'TREN', '2024-08-06 18:23:38', '2024-08-06 18:23:38'),
(4, 'D004', 'SIMPIN', '2024-08-06 18:23:54', '2024-08-06 18:23:54'),
(5, 'D005', 'TOKO', '2024-08-06 18:24:07', '2024-08-06 18:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `departmens_users`
--

CREATE TABLE `departmens_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(10) NOT NULL,
  `dep_code` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departmens_users`
--

INSERT INTO `departmens_users` (`id`, `nik`, `dep_code`, `created_at`, `updated_at`) VALUES
(1, 'K166730', 'D001', '2024-08-06 18:42:33', '2024-08-06 18:42:33'),
(2, 'K166730', 'D002', '2024-08-06 18:43:29', '2024-08-06 18:43:29'),
(3, 'K166730', 'D003', '2024-08-06 18:43:44', '2024-08-06 18:43:44'),
(4, 'K156606', 'D004', '2024-08-06 18:43:56', '2024-08-06 18:43:56'),
(5, 'K156606', 'D005', '2024-08-06 18:44:08', '2024-08-06 18:44:08'),
(6, 'K962706', 'D001', '2024-08-06 18:44:19', '2024-08-06 18:44:19'),
(7, 'K156534', 'D004', '2024-08-06 18:44:27', '2024-08-06 18:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `nama`, `email`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, '000000', 'Admin', 'admin@kki.com', '$2y$06$NO4KXqn2zCmAAUPcvan7e.tdaHOHcvZioPHtQYhCywhV6tDG7THjO', 1, NULL, NULL),
(2, 'K187107', 'Warjianto', 'warjianto@kopkarindocement.com', '$2y$12$J5nIMWgyNeRGbnrHQ8yCyOvelFxahNdloiuBA2GOIO1ngk/OmZZ7i', 2, '2024-08-06 18:33:56', '2024-08-06 18:33:56'),
(3, 'K146571', 'Wendi Margana', 'wendi@kopkarindocement.com', '$2y$12$HuEBfzAt2i0OWKwF430.HONaR6Z8Jwl0Psie6y1jxeRKF003LKBfC', 3, '2024-08-06 18:34:40', '2024-08-06 18:34:40'),
(4, 'K166730', 'Wiwik Widiastuti', 'wiwik@kopkarindocement.com', '$2y$12$8gkZ1B92oBVOrGVtF5TYzOKk7NcwhunIihZkUl524jz72Wssok3oS', 3, '2024-08-06 18:35:20', '2024-08-06 18:35:20'),
(5, 'K156606', 'Reva Stegobiona', 'reva@kopkarindocement.com', '$2y$12$oaVsf8h8cONUY9YY5tI/hudoD.QXHVBx8huCoVoZbjH1383ImlIju', 3, '2024-08-06 18:36:01', '2024-08-06 18:36:01'),
(6, 'K962706', 'Supriyanto', 'supriyanto@kopkarindocement.com', '$2y$12$AJ9yqnNH8B/h9/tDCgulpez9nLo/3O/RvkbTudVpn/QvVRkhoMJ/q', 4, '2024-08-06 18:36:48', '2024-08-06 18:36:48'),
(7, 'K156534', 'Noviyani', 'noviyani@gmail.com', '$2y$12$dEoe5ok8dmTMUIBdh8MmVekaVWbi/pbwO2FK8.a57P4AwnZSEaX.O', 4, '2024-08-06 18:41:47', '2024-08-06 18:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_19_064938_create_departemens_table', 1),
(5, '2024_07_19_064953_create_karyawans_table', 1),
(6, '2024_07_22_090849_create_todos_table', 1),
(7, '2024_08_05_004000_create_departmens_users_table', 1),
(8, '2024_08_12_022057_create_notification_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `todo_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `todo_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'K962706', 11, 'Pengoperasian harmony corner', 1, '2024-08-11 19:42:17', '2024-08-11 21:06:15'),
(15, 'K156534', 25, 'Jumlah anggota keluar bulan Agustus', 1, '2024-08-12 02:13:13', '2024-08-12 02:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bugVKVqLemXAVylZs9At2jDfkNne3iSyEOZQE3rz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiT3o1RFhlSjk1MU5tNlh6TmZUeFBPSUZkYzZ5cEY3U21WdmtKY3FPeSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aTo3O3M6NDoibmFtYSI7czo4OiJOb3ZpeWFuaSI7czozOiJuaWsiO3M6NzoiSzE1NjUzNCI7czo5OiJkZWVwX2NvZGUiO047czo1OiJsZXZlbCI7aTo0O3M6NjoiZGlidWF0IjtzOjEwOiIwNyAwOCAyMDI0IjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL25vdGlmaWNhdGlvbnMvZmV0Y2giO319', 1723454963),
('EeaVoffSnMP0kRn0MBHjkkecNnGTBzWZIHIBgxLF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiT3FQcDVyemRVM04zNUtpdXl6QWN3cm1jRTVzRVpGR1JtY0hlSzlsSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6NDoibmFtYSI7czo1OiJBZG1pbiI7czozOiJuaWsiO3M6NjoiMDAwMDAwIjtzOjk6ImRlZXBfY29kZSI7TjtzOjU6ImxldmVsIjtpOjE7czo2OiJkaWJ1YXQiO3M6MTA6IjEyIDA4IDIwMjQiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbm90aWZpY2F0aW9ucy9mZXRjaCI7fX0=', 1723454935);

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dep_code` varchar(10) NOT NULL,
  `working_list` varchar(255) NOT NULL,
  `pic` varchar(10) NOT NULL,
  `relatedpic` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`relatedpic`)),
  `deadline` date NOT NULL,
  `status` int(11) NOT NULL,
  `complete_date` date DEFAULT NULL,
  `comment_dephead` varchar(500) NOT NULL,
  `update_pic` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `dep_code`, `working_list`, `pic`, `relatedpic`, `deadline`, `status`, `complete_date`, `comment_dephead`, `update_pic`, `created_at`, `updated_at`) VALUES
(7, 'D004', 'Menghitung peminjaman pada bulan juli', 'K156534', '[\"K166730\",\"K156534\"]', '2024-08-15', 1, '2024-08-24', 'tes ubah lagi', NULL, '2024-08-06 19:41:26', '2024-08-11 18:59:42'),
(8, 'D004', 'Menghitung peminjaman pada bulan Agustus', 'K156534', '[\"K166730\",\"K156534\"]', '2024-08-14', 2, NULL, 'Tugas Bu novi', '1. Melakukan penghitungan\r\n2. Pembuatan laporan', '2024-08-06 20:19:53', '2024-08-06 20:21:18'),
(9, 'D001', 'Rental motor', 'K962706', '[\"K166730\"]', '2024-08-15', 2, NULL, 'Tes', NULL, '2024-08-06 22:24:13', '2024-08-06 22:24:13'),
(11, 'D001', 'Pengoperasian harmony corner', 'K962706', '[\"K166730\"]', '2024-08-30', 2, NULL, 'Membuat sistem kasir', NULL, '2024-08-11 19:42:17', '2024-08-11 19:42:17'),
(25, 'D004', 'Jumlah anggota keluar bulan Agustus', 'K156534', '[\"K156606\"]', '2024-08-30', 2, NULL, 'Jumlah anggota keluar total', NULL, '2024-08-12 02:13:13', '2024-08-12 02:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departemen_dep_code_unique` (`dep_code`);

--
-- Indexes for table `departmens_users`
--
ALTER TABLE `departmens_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawan_nik_unique` (`nik`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departmens_users`
--
ALTER TABLE `departmens_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
