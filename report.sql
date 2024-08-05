-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 05, 2024 at 10:07 AM
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
(1, 'D001', 'KKB/KMC', '2024-08-04 18:12:31', '2024-08-04 23:59:46'),
(2, 'D002', 'SPBU', '2024-08-04 18:13:59', '2024-08-04 23:59:56'),
(3, 'D003', 'TREN', '2024-08-04 18:14:21', '2024-08-05 00:00:06'),
(4, 'D004', 'MIS', '2024-08-04 18:17:46', '2024-08-04 18:17:46'),
(5, 'D005', 'SIMPIN', '2024-08-05 00:00:27', '2024-08-05 00:00:27'),
(6, 'D006', 'TOKO', '2024-08-05 00:00:41', '2024-08-05 00:00:41');

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
(9, 'K166730', 'D001', '2024-08-05 00:02:32', '2024-08-05 00:02:32'),
(10, 'K166730', 'D002', '2024-08-05 00:02:45', '2024-08-05 00:02:45'),
(11, 'K166730', 'D003', '2024-08-05 00:02:58', '2024-08-05 00:02:58'),
(12, 'K156606', 'D005', '2024-08-05 00:03:10', '2024-08-05 00:03:10'),
(13, 'K156606', 'D006', '2024-08-05 00:03:22', '2024-08-05 00:03:22'),
(14, 'KKI-7321', 'D004', '2024-08-05 00:03:39', '2024-08-05 00:03:39'),
(15, 'KKI-7221', 'D004', '2024-08-05 00:03:57', '2024-08-05 00:03:57'),
(16, 'K9262706', 'D001', '2024-08-05 00:04:41', '2024-08-05 00:04:41'),
(17, 'K942106', 'D002', '2024-08-05 00:04:55', '2024-08-05 00:04:55'),
(18, 'K920384', 'D003', '2024-08-05 00:05:06', '2024-08-05 00:05:17'),
(19, 'K156534', 'D005', '2024-08-05 00:05:35', '2024-08-05 00:05:35'),
(20, 'K115242', 'D006', '2024-08-05 00:05:50', '2024-08-05 00:05:50');

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
(1, '000000', 'Admin', 'admin@kki.com', '$2y$10$oQ7epam.46y0RE0iNm.fNOZ6iOiB7NxbGh7ZTTL6d254Gz/U0pR0S', 1, '2024-08-05 01:05:14', NULL),
(2, 'KKI-7321', 'Arif Hidayatulloh', 'hidayatulloharif590@gmail.com', '$2y$12$UYfCTZkF02h2bHGZcNuatOaJKXQ5xM2E.ddWUu0RvNu21yZ0f3AP.', 4, '2024-08-04 18:22:13', '2024-08-04 18:22:13'),
(3, 'KKI-7221', 'Agus', 'agusmis@gmail.com', '$2y$12$reKJElS52d95vNzS1xofR.NbG8xORpFZzZrUPZq7gNX9jZEbLAkG.', 3, '2024-08-04 18:24:11', '2024-08-04 18:24:11'),
(4, 'K166730', 'Wiwik Widiastuti', 'wiwik@gmail.com', '$2y$12$qmRNM.80RY3I8FzVvlMmYOMIoybsWr16fobd3qlxi3PghK9yyZoqC', 2, '2024-08-04 18:41:38', '2024-08-04 23:53:46'),
(5, 'K156606', 'Reva Stegobiona', 'reva@gmail.com', '$2y$12$YhkLXeJuba.TsiCmnN2zyOkCh.mulw.apxiEzVOk0y5Cb5qukZ38S', 2, '2024-08-04 18:45:04', '2024-08-04 23:54:36'),
(6, 'K9262706', 'Supriyanto', 'supriyanto@gmail.com', '$2y$12$UUHgI6jr.O8GUxVW5H6s0usDlgagdYhp9pAK32OFcEtzbN/N.skfq', 3, '2024-08-04 23:12:37', '2024-08-04 23:55:34'),
(7, 'K942106', 'Muslim', 'muslim@gmail.com', '$2y$12$PKovFYMDyFnBX/eX/Ka8KOT6aNx5p1gU1R4bRkcyliHNHDBHyfOD6', 3, '2024-08-04 23:56:07', '2024-08-04 23:56:07'),
(8, 'K920384', 'Asel Abdulloh', 'asep@gmail.com', '$2y$12$W/e3ngUbr4pd5pKWdsx8COa1PdsK.PYHZ11pPM24bhTVpo1jxbGY2', 3, '2024-08-04 23:57:13', '2024-08-04 23:57:13'),
(9, 'K156534', 'Noviyani', 'noviyani@gmail.com', '$2y$12$U8ccLRi0lSplM2JXYGpECu5dKYyEnvInOo0ip/QNRCyZBUaaJfXbu', 3, '2024-08-04 23:58:02', '2024-08-04 23:58:02'),
(10, 'K115242', 'Ales', 'ales@gmail.com', '$2y$12$T.RecLlb8PEm6qNTW4ZapOkhxSFe2b33epC..GaB4VIYw/pf355eW', 3, '2024-08-04 23:58:32', '2024-08-04 23:58:32'),
(11, 'K146571', 'Wendi Margana', 'wendi@gmail.com', '$2y$12$VNYU8tMzm9MX1atkjChLW.p5.wWP5.4Z/aFEgqIVQ2dVJ/Li2Xh0u', 2, '2024-08-04 23:59:24', '2024-08-04 23:59:24');

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
(6, '2024_07_22_071653_create_terminals_table', 1),
(7, '2024_07_22_071722_create_related_pics_table', 1),
(8, '2024_07_22_090849_create_todos_table', 1),
(9, '2024_08_05_004000_create_departmens_users_table', 1);

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
-- Table structure for table `relatedpic`
--

CREATE TABLE `relatedpic` (
  `id_relatedpic` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(10) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
('1BpaEa9RqkepJIJcYRAgZpejoAj2WuUBnFkjlrK2', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 7.0; SM-G930V Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.125 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmpqN09pdGNEV1RSQXpmU0ZSYTNaaXJpWlZTbW9wMVUyaTc1aTZIRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njc6Imh0dHA6Ly9mMjRlLTEyNS0xNjYtMTA5LTAubmdyb2stZnJlZS5hcHAvdG9kby9maWx0ZXJTdGF0dXM/c3RhdHVzPTEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1722843959),
('5x3F8RZkzbqckW6oRiZlB43xixtLjUhWny9Zr3ye', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 7.0; SM-G930V Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.125 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZU1jRG5MejFCaldSUWN3b2pXc0lyeFJidndWSWo1WFhZdDdvcWlhRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njc6Imh0dHA6Ly9mMjRlLTEyNS0xNjYtMTA5LTAubmdyb2stZnJlZS5hcHAvdG9kby9maWx0ZXJTdGF0dXM/c3RhdHVzPTEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1722843957),
('HA3p1J3uB5BV0ydF0NJToZkvkp0kSFDQFeZ1hcBC', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakZJYjdxTDkxVHdieHJsU0JLWE0yR3h6OVlFSlRDRm9ab1k0cUl2ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9mMjRlLTEyNS0xNjYtMTA5LTAubmdyb2stZnJlZS5hcHAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1722843703),
('jncLf5tc5OWlNPS2FfGwNVLN5BecDNGP0i5hkd2S', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVlxbnFCSVNVTXUxcXBJTTdCRmpMc01OUHE4dmRGeUpIUHgwN3lOUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly81ZGVmLTM2LTkyLTEyMC04NS5uZ3Jvay1mcmVlLmFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1722840408),
('kjdkDQAUzzOHOexRo4o164cuWFT3UJtvLRLy9CFx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiU2pCUVNtaUVFTDFYTjNUd3FEUFI5RGFOak1LNzEybGQzOGJQbFUzUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9mMjRlLTEyNS0xNjYtMTA5LTAubmdyb2stZnJlZS5hcHAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6NDoibmFtYSI7czo1OiJBZG1pbiI7czozOiJuaWsiO3M6NjoiMDAwMDAwIjtzOjk6ImRlZXBfY29kZSI7TjtzOjU6ImxldmVsIjtpOjE7czo2OiJkaWJ1YXQiO3M6MTA6IjA1IDA4IDIwMjQiO30=', 1722843850),
('kY4NeTjLmuT0gugaJgT1cHuOBzkLvvnqsXaIZGTQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiM1RLQndRWlVxZ1U2RDlsZThDYWRFeDlVb3dHbGVJVkc3V0x4V1Q4RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly81ZGVmLTM2LTkyLTEyMC04NS5uZ3Jvay1mcmVlLmFwcC90b2RvL2NyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjoiaWQiO2k6MTtzOjQ6Im5hbWEiO3M6NToiQWRtaW4iO3M6MzoibmlrIjtzOjY6IjAwMDAwMCI7czo5OiJkZWVwX2NvZGUiO047czo1OiJsZXZlbCI7aToxO3M6NjoiZGlidWF0IjtzOjEwOiIwNSAwOCAyMDI0Ijt9', 1722840428),
('MZaT1fh1SMY6Ou1bfu3NhxaJi6t4I4WfmUlYBF5G', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiWktjY1NicHFMbUltUGpka2daRjJZbWV4WUw0UU9uWGdySUJUQkg4VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90b2RvL2ZpbHRlclN0YXR1cz9zdGF0dXM9MSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjoiaWQiO2k6MTtzOjQ6Im5hbWEiO3M6NToiQWRtaW4iO3M6MzoibmlrIjtzOjY6IjAwMDAwMCI7czo5OiJkZWVwX2NvZGUiO047czo1OiJsZXZlbCI7aToxO3M6NjoiZGlidWF0IjtzOjEwOiIwNSAwOCAyMDI0Ijt9', 1722843143),
('qF4hc47RQC291iANer9wACfaN8rvAyLM8hz3hc9B', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 7.0; SM-G930V Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.125 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRkpKMHdOMnNrV3pRU2RmWUdpQjdJbHptdm9hRlk5blZ1QXpUQ0l1SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njc6Imh0dHA6Ly9mMjRlLTEyNS0xNjYtMTA5LTAubmdyb2stZnJlZS5hcHAvdG9kby9maWx0ZXJTdGF0dXM/c3RhdHVzPTEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1722843959),
('sWYzCnFZTu3xvFTfpXVTR6976RNIubPe978zi2W9', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Mobile Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiamliazNsZldWWjdHR0tRQ0x5aUk0ZmY5T295R01VVzBhUFJyMjVqcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9mMjRlLTEyNS0xNjYtMTA5LTAubmdyb2stZnJlZS5hcHAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6NDoibmFtYSI7czo1OiJBZG1pbiI7czozOiJuaWsiO3M6NjoiMDAwMDAwIjtzOjk6ImRlZXBfY29kZSI7TjtzOjU6ImxldmVsIjtpOjE7czo2OiJkaWJ1YXQiO3M6MTA6IjA1IDA4IDIwMjQiO30=', 1722844063),
('Ws1KeelGNQay6RWtA6bCrigrXGUUCkXDHlpT1Nzh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibzBqUVNwREV6b1FtWG12Q1F4THRDa1VvaVpBOHRTWUpuQUR5elNSNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1722843422);

-- --------------------------------------------------------

--
-- Table structure for table `terminal`
--

CREATE TABLE `terminal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terminal_code` varchar(10) NOT NULL,
  `nm_terminal` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dep_code` varchar(10) NOT NULL,
  `working_list` varchar(255) NOT NULL,
  `pic` varchar(10) NOT NULL,
  `relatedpic1` varchar(10) NOT NULL,
  `relatedpic2` varchar(10) DEFAULT NULL,
  `relatedpic3` varchar(10) DEFAULT NULL,
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

INSERT INTO `todo` (`id`, `dep_code`, `working_list`, `pic`, `relatedpic1`, `relatedpic2`, `relatedpic3`, `deadline`, `status`, `complete_date`, `comment_dephead`, `update_pic`, `created_at`, `updated_at`) VALUES
(4, 'D004', 'Membuat sistem todolist', 'KKI-7321', 'KKI-7221', NULL, NULL, '2024-08-09', 2, NULL, '1. Membuat sistem todo list', '1. Mulai pengerjaan', '2024-08-05 00:07:09', '2024-08-05 00:43:10'),
(5, 'D001', 'Menjalankan harmony corner', 'K9262706', 'K166730', NULL, NULL, '2024-08-16', 1, NULL, 'Membuat sistem kasir', NULL, '2024-08-05 00:08:19', '2024-08-05 00:08:19'),
(6, 'D002', 'Menambah pipa penguapan', 'K942106', 'K166730', NULL, NULL, '2024-08-24', 1, NULL, 'Menambah pipa penguapan tangki pendam', NULL, '2024-08-05 00:11:19', '2024-08-05 00:11:19'),
(7, 'D003', 'Melelang kendaraan bermotor', 'K920384', 'K166730', NULL, NULL, '2024-08-30', 1, NULL, 'Lelang KLX', NULL, '2024-08-05 00:12:12', '2024-08-05 00:12:12'),
(8, 'D005', 'Menghitung SHU', 'K156534', 'K156606', NULL, NULL, '2024-08-16', 1, NULL, 'Membuat penghitungan SHU', NULL, '2024-08-05 00:12:51', '2024-08-05 00:12:51'),
(9, 'D006', 'Membuat sistem point transaksi', 'K115242', 'K156606', NULL, NULL, '2024-08-30', 1, NULL, 'Tes Simpin', NULL, '2024-08-05 00:13:16', '2024-08-05 00:13:16');

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `relatedpic`
--
ALTER TABLE `relatedpic`
  ADD PRIMARY KEY (`id_relatedpic`),
  ADD UNIQUE KEY `relatedpic_nik_unique` (`nik`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `terminal_terminal_code_unique` (`terminal_code`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departmens_users`
--
ALTER TABLE `departmens_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `relatedpic`
--
ALTER TABLE `relatedpic`
  MODIFY `id_relatedpic` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terminal`
--
ALTER TABLE `terminal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
