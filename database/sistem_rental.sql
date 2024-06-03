-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 04:21 PM
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
-- Database: `sistem_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `alats`
--

CREATE TABLE `alats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_id` bigint(20) UNSIGNED NOT NULL,
  `merk` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `harga_perhari` decimal(10,2) NOT NULL DEFAULT 0.00,
  `denda_perhari` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL,
  `gambar_alat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alats`
--

INSERT INTO `alats` (`id`, `jenis_id`, `merk`, `type`, `harga_perhari`, `denda_perhari`, `status`, `gambar_alat`, `created_at`, `updated_at`) VALUES
(1, 1, 'wayang', 'mtsa', 900000.00, 10000.00, 'Tersedia', 'ini exa.img', '2024-05-26 22:25:33', '2024-05-28 22:50:23'),
(2, 1, 'wayangssss', 'mtsa', 900000.00, 10000.00, 'Tidak Tersedia', 'ini exa.img', '2024-05-28 07:18:23', '2024-05-28 07:18:41'),
(3, 1, 'komatsu', 'ssasdasdasd', 300000.00, 10000.00, 'Tersedia', 'ini exa.img', '2024-05-28 07:19:26', '2024-05-29 22:41:40'),
(4, 1, 'wayang', 'mtsa', 900000.00, 300000.00, 'Tersedia', 'ini exa.img', '2024-05-28 22:46:14', '2024-05-29 22:43:00'),
(5, 2, 'komatsu', 'mtsa', 900000.00, 900000.00, 'Tersedia', 'ini exa.img', '2024-05-29 22:51:35', '2024-05-29 22:52:04');

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
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `nama_jenis`, `created_at`, `updated_at`) VALUES
(1, 'Exavator', '2024-05-26 22:24:59', '2024-05-26 22:24:59'),
(2, 'Bulldozer', '2024-05-29 22:50:26', '2024-05-29 22:50:26');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_01_005349_create_pelanggans_table', 1),
(6, '2024_05_01_005357_create_kategoris_table', 1),
(7, '2024_05_01_005409_create_alats_table', 1),
(8, '2024_05_01_005426_create_rentals_table', 1),
(9, '2024_05_18_181344_create_pengembalians_table', 1);

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
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telpon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `email`, `nama_pelanggan`, `alamat`, `no_telpon`, `created_at`, `updated_at`) VALUES
(1, 'irfanfadillah272@gmail.com', 'taichen', 'serang', '081214805759', '2024-05-26 22:25:12', '2024-05-26 22:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalians`
--

CREATE TABLE `pengembalians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rental_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `kondisi_alat` varchar(255) NOT NULL,
  `denda_perhari` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status_pengembalian` varchar(255) NOT NULL,
  `total_pembayaran` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_invoice` varchar(255) NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `alat_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `lama_sewa` varchar(255) NOT NULL,
  `biaya_sewa` decimal(10,2) NOT NULL DEFAULT 0.00,
  `denda_perhari` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status_pembayaran` varchar(255) NOT NULL,
  `status_rental` varchar(255) NOT NULL,
  `status_pengembalian` varchar(255) NOT NULL,
  `total_pembayaran` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `no_invoice`, `pelanggan_id`, `alat_id`, `tanggal_sewa`, `tanggal_kembali`, `tanggal_pengembalian`, `lama_sewa`, `biaya_sewa`, `denda_perhari`, `status_pembayaran`, `status_rental`, `status_pengembalian`, `total_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 'RT-1', 1, 1, '2024-05-27', '2024-05-28', '2024-06-01', '2 hari', 1800000.00, 200000.00, 'Sudah Bayar', 'Tidak Aktif', 'Terlambat', 2000000.00, '2024-05-26 22:25:58', '2024-05-28 22:50:23'),
(6, 'RT-6', 1, 3, '2024-05-28', '2024-05-31', '2024-06-01', '4 hari', 1200000.00, 50000.00, 'Sudah Bayar', 'Tidak Aktif', 'Terlambat', 1250000.00, '2024-05-28 07:20:57', '2024-05-28 22:50:49'),
(7, 'RT-7', 1, 3, '2024-05-31', '2024-06-08', '2024-05-30', '9 hari', 2700000.00, 0.00, 'Sudah Bayar', 'Tidak Aktif', 'Tepat Waktu', 2700000.00, '2024-05-28 23:47:37', '2024-05-29 22:40:09'),
(8, 'RT-8', 1, 4, '2024-05-28', '2024-05-28', '2024-05-30', '1 hari', 900000.00, 100000.00, 'Sudah Bayar', 'Tidak Aktif', 'Terlambat', 1000000.00, '2024-05-28 23:48:09', '2024-05-29 22:41:14'),
(9, 'RT-9', 1, 3, '2024-06-07', '2024-06-14', '2024-06-20', '8 hari', 2400000.00, 300000.00, 'Sudah Bayar', 'Tidak Aktif', 'Terlambat', 2700000.00, '2024-05-29 22:40:56', '2024-05-29 22:41:40'),
(10, 'RT-10', 1, 4, '2024-06-01', '2024-06-05', '2024-06-14', '5 hari', 4500000.00, 450000.00, 'Sudah Bayar', 'Tidak Aktif', 'Terlambat', 4950000.00, '2024-05-29 22:42:46', '2024-05-29 22:43:00'),
(11, 'RT-11', 1, 5, '2024-05-31', '2024-05-31', '2024-05-31', '1 hari', 900000.00, 0.00, 'Sudah Bayar', 'Tidak Aktif', 'Tepat Waktu', 900000.00, '2024-05-29 22:51:51', '2024-05-29 22:52:04');

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
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alats`
--
ALTER TABLE `alats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alats_jenis_id_foreign` (`jenis_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelanggans_email_unique` (`email`);

--
-- Indexes for table `pengembalians`
--
ALTER TABLE `pengembalians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalians_rental_id_foreign` (`rental_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rentals_no_invoice_unique` (`no_invoice`),
  ADD KEY `rentals_pelanggan_id_foreign` (`pelanggan_id`),
  ADD KEY `rentals_alat_id_foreign` (`alat_id`);

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
-- AUTO_INCREMENT for table `alats`
--
ALTER TABLE `alats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengembalians`
--
ALTER TABLE `pengembalians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alats`
--
ALTER TABLE `alats`
  ADD CONSTRAINT `alats_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalians`
--
ALTER TABLE `pengembalians`
  ADD CONSTRAINT `pengembalians_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_alat_id_foreign` FOREIGN KEY (`alat_id`) REFERENCES `alats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rentals_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
