-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 10, 2025 at 08:16 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u255203686_sertifmahad`
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('bambang.bstwk@gmail.com|127.0.0.1', 'i:1;', 1735806751),
('bambang.bstwk@gmail.com|127.0.0.1:timer', 'i:1735806751;', 1735806751);

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
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `program_studi` varchar(255) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `nama`, `nim`, `program_studi`, `fakultas`, `email`, `created_at`, `updated_at`) VALUES
(529, 'BIMO AHMAD FIRDAUS', '241111001', 'Ilmu Al-Qur`an dan Tafsir', 'Fakultas Ushuluddin dan Dakwah', '241111001@mhs.uinsaid.ac.id', '2025-02-06 04:18:47', '2025-02-06 04:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_ujian`
--

CREATE TABLE `mahasiswa_ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `ujian_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(12, '2024_12_28_173953_create_ujian_table', 1),
(44, '0001_01_01_000000_create_users_table', 2),
(45, '0001_01_01_000001_create_cache_table', 2),
(46, '0001_01_01_000002_create_jobs_table', 2),
(47, '2024_12_28_070914_create_mahasiswas_table', 2),
(48, '2024_12_28_130012_create_sertifikats_table', 2),
(49, '2024_12_28_173953_create_ujians_table', 2),
(50, '2024_12_28_180701_create_mahasiswa_ujian_table', 2),
(51, '2024_12_30_084131_add_background_image_to_sertifikats_table', 2),
(52, '2025_01_31_074528_update_sertifikat_table', 3),
(53, '2025_01_31_075145_update_sertifikat_table', 4);

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
-- Table structure for table `sertifikats`
--

CREATE TABLE `sertifikats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `status_ujian_ibadah` enum('lulus','tidak_lulus') NOT NULL,
  `status_ujian_alquran` enum('lulus','tidak_lulus') NOT NULL,
  `no_sertifikat` varchar(255) NOT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sertifikats`
--

INSERT INTO `sertifikats` (`id`, `mahasiswa_id`, `status_ujian_ibadah`, `status_ujian_alquran`, `no_sertifikat`, `background_image`, `created_at`, `updated_at`) VALUES
(27, 529, 'lulus', 'lulus', 'SERT-IBD-QRN-2025-ILM-241111001', NULL, '2025-02-06 04:19:24', '2025-02-06 04:19:24');

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
('1lHswe4EbHPpPyOtSHIlaGEKHlilH1Czm18vhKTN', 1, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjBEVkJWVVBseGNNZUczdG9ZcFlWbUQ5NVhxcHplbnRGaUNmWm5CRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL3NlcnRpZmlrYXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1739155783),
('1zPU3jeIrILy01jcmxyCTLoQpIbUjdDoEPh2jp2Y', NULL, '140.213.166.163', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEJUblJ6S0RWd3BMMjd6NnRNVUg0ZktIbkhyVWNCZlR3SkJFSHNvdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzg6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL3NlcnRpZmlrYXQvdmFsaWRhc2kvU0VSVC1JQkQtUVJOLTIwMjUtSUxNLTI0MTExMTAwMSI7fX0=', 1738815580),
('4j15z8n03nlKSodxaMBAASnmMIX7mhZXFxNHGity', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMW9EcExCVVB1VzFpZzc3RUNNR3JPaFNtSGNLWllMSlVnRDM2OFJudCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738819492),
('9htc88iRcDgg2ashV5wABxPjAOwdp3yBT0pm7TTa', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1FIcWRoQzhScVBmTVMwN3ZpOVRTa0JySE05eE8zanY3YWI5YzE4ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738814303),
('defbNus8FER5r4oUyWWLQUXhnFKEMiR7qiZza9Mc', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDVxODdVUUh4UUoybWZMVHFSUXVYOGFyODg0SzFYUENhdTNiTzNNQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738814303),
('ds1pFDBGgT9UNiSCkOqp5e6RCyBFzO7okluKbcJS', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOXg5UWxyTTJXOEZBanJMcFdzTlprblVmQlU2NHZaZjM0dG5FOUlkTyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NjoiaHR0cHM6Ly90aXBkZGV2LmNvbS9wdWJsaWMvc2VydGlmaWthdC9nZW5lcmF0ZSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ2OiJodHRwczovL3RpcGRkZXYuY29tL3B1YmxpYy9zZXJ0aWZpa2F0L2dlbmVyYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738820402),
('i9LHac6s76hveYIYuxk6StVQPH5f5NucWgNfTGnN', 1, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSEZEcU55dTY3cU5Yc1dJSHFkV2F6S2lKTFJza1h3a1phbEs5dnBEWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL3NlcnRpZmlrYXQvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1738815564),
('iS235r8guWK877tRv6Qcof7t9YTzLYLtZhAVUjOQ', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMjVCcEZ4R2NUNWNTQ0Z2OGtLQ0IwWG9zRWY5MDQ0T25PUm5GMGx4OSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cHM6Ly90aXBkZGV2LmNvbS9wdWJsaWMvbWFoYXNpc3dhIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739172344),
('is9yhu1XFdSrdkzyNIYF136PCpb7R6Pr1lHMr5HP', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0hZNlREZWxpR3hKaEU5NjRuSGdkUDdsVGRTdm11MWJoQlBnSlMxUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739172493),
('LFRCuYms5nRQCayyMrti6REWoBF9l4T9cpbG6izj', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSHcxd01PZUxQTTI1Y3JTU3gyZEdWSmhPaUdWMHJFbGl6S1IwbWlWdyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cHM6Ly90aXBkZGV2LmNvbS9wdWJsaWMvc2VydGlmaWthdC9jcmVhdGUiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NDoiaHR0cHM6Ly90aXBkZGV2LmNvbS9wdWJsaWMvc2VydGlmaWthdC9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1738819552),
('m5kP8G3F44VIEmO7YRGsZ9hu35kplhTkjNUX9lUs', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTG9DUllpV3BHcFFTRkpLN09GakJiOWNkYmVYSWUycnhXVW5qNHpZRyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cHM6Ly90aXBkZGV2LmNvbS9wdWJsaWMvc2VydGlmaWthdC8yMSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwczovL3RpcGRkZXYuY29tL3B1YmxpYy9zZXJ0aWZpa2F0LzIxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738815521),
('MgrbA4SivLtU1pPx1olNGvKMkoibeqd0CmRgysDB', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVzFaT0lkWjRIamdIVHJQN1UxSEdNVHB6UmZZVlVObnMySEdwRzFmcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738820402),
('MuoN7Wkfi39k8yK2s5wb2SoiZju2upVafWmCBin7', NULL, '103.209.98.100', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOGV4aTdMN2luVEV6UXMzbUNxcFczaHdzWVRmbnZhdFJveDdTTmpmSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzg6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL3NlcnRpZmlrYXQvdmFsaWRhc2kvU0VSVC1JQkQtUVJOLTIwMjUtSUxNLTI0MTExMTAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739165312),
('MW8huLXI18Me5yRQ08yuwVMvUtmMlXzvMNN9fskQ', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUN0RkVXRFQwYXhLbHdQZ3VZTnVSZ2hQZDZRQ1ZSUTg1MjlCNTJ2TSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738819552),
('n6zrKICLI2HPK4GL0rDHrPiiJe9EVxEJKcRVKoo2', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib2JnSUgxWFJpaWlmUm1EcWszWXg5SjlsZDZjNHVYUnZheDhkeUlHYyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cHM6Ly90aXBkZGV2LmNvbS9wdWJsaWMvbWFoYXNpc3dhIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL21haGFzaXN3YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1738819492),
('QaW0KSvzHFA3roXPV40USebh6kKOYsKIgSYSazz5', 1, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZHMwMTIydXQwbnpEVDUzY3pkOGVvczJMcXFxclphZXdqNE9TVG5QQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL21haGFzaXN3YSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1738813058),
('tysP9H3gKmPLcVNqXAjJPQrr8RrUGv0LuIB7apDO', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRjVKU1VUd0psaU9pVmZMMlVPWFZtemV6eDhRZENqbWFjRzJXMkhGQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738815521),
('xtb39kri3DzMTp5xQFBf6WSmdrbm2qHCzTx66A59', NULL, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1EwUGFxd0JTdmIyT2RRVUVlZ3hpbk1vaW5wR2hFQ3RXaXE4eWF0byI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljIjt9fQ==', 1739175295),
('z4gDUMUgh78Wh9EcuyngUFCUT1CN92YX2gheVnJM', 1, '103.209.98.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2N2bkh0emx0azhkb04xU1laMkx2TGJsbEMzYUhyMjU2NGdReGtOciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzg6Imh0dHBzOi8vdGlwZGRldi5jb20vcHVibGljL3NlcnRpZmlrYXQvZG93bmxvYWQvU0VSVC1JQkQtUVJOLTIwMjUtSUxNLTI0MTExMTAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1739165113);

-- --------------------------------------------------------

--
-- Table structure for table `ujians`
--

CREATE TABLE `ujians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ujian` varchar(255) NOT NULL,
  `deskripsi_ujian` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bambang Suko Winarno', 'admin@uinsaid.ac.id', NULL, '$2y$12$VLeb0hf3SrxzUc13ue0/1OA7goF7SBAtuF.FpeuKWVhc00ZXwDa0C', NULL, '2024-12-30 07:07:54', '2024-12-30 07:07:54'),
(2, 'adminmahad', 'mahad.aljamiah@uinsaid.ac.id', NULL, '$2y$12$r8xNxvsbY8ZZIFZFywScKuILIRq2/L0lQm7LDv2aXZH4ZaXBXYJsq', NULL, '2025-02-10 08:13:21', '2025-02-10 08:13:21');

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
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswas_nim_unique` (`nim`),
  ADD UNIQUE KEY `mahasiswas_email_unique` (`email`);

--
-- Indexes for table `mahasiswa_ujian`
--
ALTER TABLE `mahasiswa_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_ujian_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `mahasiswa_ujian_ujian_id_foreign` (`ujian_id`);

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
-- Indexes for table `sertifikats`
--
ALTER TABLE `sertifikats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sertifikats_no_sertifikat_unique` (`no_sertifikat`),
  ADD KEY `sertifikats_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ujians`
--
ALTER TABLE `ujians`
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
-- AUTO_INCREMENT for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=538;

--
-- AUTO_INCREMENT for table `mahasiswa_ujian`
--
ALTER TABLE `mahasiswa_ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sertifikats`
--
ALTER TABLE `sertifikats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ujians`
--
ALTER TABLE `ujians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mahasiswa_ujian`
--
ALTER TABLE `mahasiswa_ujian`
  ADD CONSTRAINT `mahasiswa_ujian_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mahasiswa_ujian_ujian_id_foreign` FOREIGN KEY (`ujian_id`) REFERENCES `ujians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sertifikats`
--
ALTER TABLE `sertifikats`
  ADD CONSTRAINT `sertifikats_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
