-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 28, 2024 at 09:03 AM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_persediaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

DROP TABLE IF EXISTS `barangs`;
CREATE TABLE IF NOT EXISTS `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

DROP TABLE IF EXISTS `barang_keluar`;
CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `jumlah_keluar` int(11) DEFAULT NULL,
  `nama_petugas` varchar(255) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

DROP TABLE IF EXISTS `barang_masuk`;
CREATE TABLE IF NOT EXISTS `barang_masuk` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `jumlah_masuk` int(11) DEFAULT NULL,
  `nama_petugas` varchar(255) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods_outs`
--

DROP TABLE IF EXISTS `goods_outs`;
CREATE TABLE IF NOT EXISTS `goods_outs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplies_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_out` int(11) DEFAULT NULL,
  `operator` varchar(60) NOT NULL,
  `entry_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goods_outs_supplies_id_foreign` (`supplies_id`),
  KEY `goods_outs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incoming_goods`
--

DROP TABLE IF EXISTS `incoming_goods`;
CREATE TABLE IF NOT EXISTS `incoming_goods` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplies_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_in` int(11) DEFAULT NULL,
  `operator` varchar(60) NOT NULL,
  `entry_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incoming_goods_supplies_id_foreign` (`supplies_id`),
  KEY `incoming_goods_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incoming_goods`
--

INSERT INTO `incoming_goods` (`id`, `supplies_id`, `quantity_in`, `operator`, `entry_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 10, 'aa', '2024-07-28', 2, '2024-07-28 00:03:56', '2024-07-28 00:03:56'),
(2, 2, 8, 'aa', '2024-07-28', 2, '2024-07-28 00:16:17', '2024-07-28 01:16:17'),
(3, 3, 10, 'aa', '2024-07-28', 2, '2024-07-28 01:45:06', '2024-07-28 01:45:06'),
(4, 3, 5, 'aa', '2024-07-28', 2, '2024-07-28 01:45:38', '2024-07-28 01:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `master_goods`
--

DROP TABLE IF EXISTS `master_goods`;
CREATE TABLE IF NOT EXISTS `master_goods` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `packaging_type` varchar(40) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_goods_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_goods`
--

INSERT INTO `master_goods` (`id`, `code`, `name`, `packaging_type`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'QTVJ2BNM', 'Kopi Robusta', 'bungkus', 'Y', 2, '2024-07-27 18:07:00', '2024-07-28 01:54:49'),
(2, 'Z90IX4BT', 'KOPI ARABIKA', 'bungkus', 'Y', 2, '2024-07-28 00:27:07', '2024-07-28 00:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_28_163332_create_barang_masuk_table', 1),
(6, '2024_05_30_114035_create_barang_keluar_table', 1),
(7, '2024_06_07_072746_create_barangs_table', 1),
(11, '2024_07_26_093840_create_master_goods_table', 2),
(12, '2024_07_26_094653_create_supplies_table', 2),
(13, '2024_07_26_095755_create_incoming_goods_table', 2),
(14, '2024_07_26_100402_create_goods_outs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

DROP TABLE IF EXISTS `supplies`;
CREATE TABLE IF NOT EXISTS `supplies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `master_goods_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining_stock` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplies_master_goods_id_foreign` (`master_goods_id`),
  KEY `supplies_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `master_goods_id`, `quantity`, `remaining_stock`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, 18, 18, 2, '2024-07-28 00:03:56', '2024-07-28 01:16:17'),
(3, 2, 15, 13, 2, '2024-07-28 01:45:06', '2024-07-28 01:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('operator','admin') NOT NULL DEFAULT 'operator',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mas Operator', 'operator@gmail.com', NULL, '$2y$10$biMg85bnEe90.p2KRM6aveug1DQfZVOYJz/yjuWANOomuv0UOn/Gy', 'operator', NULL, '2024-07-21 00:52:39', '2024-07-21 00:52:39'),
(2, 'Mas Admin', 'admin@gmail.com', NULL, '$2y$10$aPaKU90U10TCJO3Y1O1Edef8yQALwI2OKTeICvigBBsO5aZlJOwfm', 'admin', NULL, '2024-07-21 00:52:39', '2024-07-21 00:52:39');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
