-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2026 pada 14.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--
CREATE DATABASE IF NOT EXISTS `toko_online` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `toko_online`;


-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `user_fullname`, `activity`, `created_at`) VALUES
(1, 2, 'Cashier User', 'Mengubah data barang: Veridian Emerald S25', '2026-05-14 12:14:37'),
(2, 1, 'Administrator', 'Mengubah data layanan: Original Produk', '2026-05-15 08:31:25'),
(3, 1, 'Administrator', 'Menambahkan layanan baru: wfwf', '2026-05-15 08:31:50'),
(4, 1, 'Administrator', 'Menghapus layanan: wfwf', '2026-05-15 08:32:05'),
(5, 1, 'Administrator', 'Mengubah data anggota tim: Alexander Pierce', '2026-05-15 08:32:41'),
(6, 1, 'Administrator', 'Mengubah data anggota tim: Alexander Pierce', '2026-05-15 08:32:54'),
(7, 1, 'Administrator', 'Memperbarui informasi kontak toko', '2026-05-15 08:33:31'),
(8, 2, 'Cashier User', 'Mengubah data barang: Veridian Emerald S24', '2026-05-15 08:37:11'),
(9, 2, 'Cashier User', 'Mengubah data barang: Veridian Emerald S25', '2026-05-15 08:52:58'),
(10, 1, 'Administrator', 'Menambahkan anggota tim baru: yanto', '2026-05-15 08:56:06'),
(11, 1, 'Administrator', 'Menghapus anggota tim: yanto', '2026-05-15 08:56:20'),
(12, 4, 'dimas', 'Melakukan pesanan baru: Rp 28.499.000', '2026-05-16 13:11:42'),
(13, 2, 'Cashier User', 'Mengubah status pesanan ID #5 menjadi completed', '2026-05-16 13:12:16'),
(14, 5, 'Customer', 'Melakukan pesanan baru: Rp 24.999.000', '2026-05-16 13:21:38'),
(15, 2, 'Cashier User', 'Mengubah status pesanan ID #6 menjadi completed', '2026-05-16 13:22:04'),
(16, 5, 'Customer', 'Melakukan pesanan baru: Rp 28.499.000', '2026-05-16 13:30:54'),
(17, 2, 'Cashier User', 'Mengubah status pesanan ID #7 menjadi completed (Stok dikurangi)', '2026-05-16 13:31:17'),
(18, 5, 'Customer', 'Melakukan pesanan baru: Rp 35.000.000', '2026-05-16 13:52:16'),
(19, 2, 'Cashier User', 'Mengubah status pesanan ID #8 menjadi shipping', '2026-05-16 13:53:02'),
(20, 4, 'dimas', 'Melakukan pesanan baru: Rp 25.000.000', '2026-05-16 13:54:36'),
(21, 2, 'Cashier User', 'Mengubah status pesanan ID #9 menjadi processed', '2026-05-16 13:56:05'),
(22, 2, 'Cashier User', 'Mengubah status pesanan ID #9 menjadi shipping', '2026-05-16 14:04:10'),
(23, 4, 'dimas', 'Melakukan pesanan baru: Rp 24.999.000', '2026-05-20 01:55:01'),
(24, 2, 'Cashier User', 'Mengubah status pesanan ID #10 menjadi completed (Stok dikurangi)', '2026-05-20 01:55:30'),
(25, 7, 'dimaskasep', 'Melakukan pesanan baru: Rp 101.297.000', '2026-05-28 15:27:55'),
(26, 2, 'Cashier User', 'Mengubah status pesanan ID #11 menjadi completed (Stok dikurangi)', '2026-05-28 15:29:26'),
(27, 2, 'Cashier User', 'Mengubah data barang: Obsidian Gold Pro', '2026-05-28 15:29:56'),
(28, 2, 'Cashier User', 'Mengubah data barang: Obsidian Gold Pro', '2026-05-28 15:33:47'),
(29, 1, 'Administrator', 'Mengubah data layanan: Layanan Purna Jual', '2026-05-28 16:36:35'),
(30, 7, 'dimaskasep', 'Melakukan pesanan baru: Rp 25.000.000', '2026-05-29 01:50:15'),
(31, 2, 'Cashier User', 'Mengubah status pesanan ID #12 menjadi completed (Stok dikurangi)', '2026-05-29 01:53:00'),
(32, 1, 'Administrator', 'Memperbarui informasi Tentang Kami', '2026-05-29 09:05:00'),
(33, 1, 'Administrator', 'Memperbarui informasi Tentang Kami', '2026-05-29 09:06:31'),
(34, 7, 'dimaskasep', 'Melakukan pesanan baru: Rp 35.000.000', '2026-06-02 14:00:05'),
(35, 2, 'Cashier User', 'Mengubah status pesanan ID #13 menjadi processed', '2026-06-02 14:01:12'),
(36, 1, 'Administrator', 'Memperbarui informasi kontak toko', '2026-06-02 14:21:16'),
(37, 1, 'Administrator', 'Memperbarui informasi kontak toko', '2026-06-02 14:22:58'),
(38, 2, 'Cashier User', 'Mengubah status pesanan ID #13 menjadi cancelled', '2026-06-04 12:50:34'),
(39, 4, 'dimas', 'Melakukan pesanan baru: Rp 28.499.000', '2026-06-04 12:54:16'),
(40, 2, 'Cashier User', 'Mengubah data barang: Veridian Emerald S25', '2026-06-10 12:34:21'),
(41, 7, 'dimaskasep', 'Melakukan pesanan baru: Rp 28.499.000', '2026-06-12 05:54:37'),
(42, 7, 'dimaskasep', 'Membatalkan pesanan #15', '2026-06-12 05:54:43'),
(43, 7, 'dimaskasep', 'Melakukan pesanan baru: Rp 28.499.000', '2026-06-12 06:00:36'),
(44, 7, 'dimaskasep', 'Membatalkan pesanan #16 (Alasan: Saya berubah pikiran)', '2026-06-12 06:02:23'),
(45, 4, 'dimas', 'Melakukan pesanan baru: Rp 28.499.000', '2026-06-12 06:07:53'),
(46, 2, 'Cashier User', 'Mengubah status pesanan ID #17 menjadi processed', '2026-06-12 06:09:27'),
(47, 4, 'dimas', 'Membatalkan pesanan #14 (Alasan: Pembayaran tidak dapat dilanjutkan)', '2026-06-12 06:10:22'),
(48, 7, 'dimaskasep', 'Melakukan pesanan baru: Rp 22.000.000', '2026-06-12 07:08:35'),
(49, 7, 'dimaskasep', 'Membatalkan pesanan #18 (Alasan: Salah memilih produk)', '2026-06-12 07:09:34'),
(50, 2, 'Cashier User', 'Mengubah status pesanan ID #18 menjadi processed (Stok dikurangi)', '2026-06-12 07:27:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(15,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_detail` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `payment_proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `recipient_name`, `phone_number`, `address`, `order_date`, `total_amount`, `payment_method`, `payment_detail`, `status`, `payment_proof`) VALUES
(1, 3, NULL, NULL, NULL, '2026-05-14 07:35:24', 24999000.00, NULL, NULL, 'confirmed', NULL),
(2, 3, NULL, NULL, NULL, '2026-05-14 07:42:54', 24999000.00, NULL, NULL, 'completed', NULL),
(3, 3, 'dimas', '08961809701', 'munjul', '2026-05-14 08:33:36', 25000000.00, 'cod', '', 'completed', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 24999000.00),
(2, 2, 1, 1, 24999000.00),
(3, 3, 4, 1, 25000000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `stock`, `image`, `description`, `created_at`) VALUES
(1, 'Veridian Emerald S25', 'Premium Flagship', 24999000.00, 10, 'prod1.png', 'Emerald Green / Ceramic Titanium / 12GB RAM', '2026-05-14 05:53:53'),
(2, 'Obsidian Gold Pro', 'Premium Flagship', 28499000.00, 13, 'prod2.png', 'Obsidian Black / 24K Gold Rim / 16GB RAM', '2026-05-14 05:53:53'),
(3, 'Aero Pearl Gold', 'Value Luxury', 22799000.00, 14, 'prod3.png', 'Pearl White / Satin Champagne / 12GB RAM', '2026-05-14 05:53:53'),
(4, 'Veridian Carbon X', 'Laptop', 25000000.00, 8, 'lap1.png', 'Laptop ultra-tipis dengan bodi serat karbon dan performa bertenaga untuk profesional.', '2026-05-14 07:32:38'),
(5, 'Veridian Titan Pro', 'Laptop', 35000000.00, 5, 'lap2.png', 'Laptop workstation dengan kartu grafis kelas atas, ideal untuk rendering 3D dan gaming berat.', '2026-05-14 07:32:38'),
(6, 'Veridian Aura', 'Laptop', 22000000.00, 7, 'lap3.png', 'Laptop dengan desain artistik dan layar OLED 4K untuk para kreator konten.', '2026-05-14 07:32:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `created_at`) VALUES
(1, 'Original Produk', '100% Produk Orisinil & Bersertifikat', 'fa-shield-alt', '2026-05-14 05:53:53'),
(2, 'Official Warranty', 'Garansi resmi hingga 2 tahun', 'fa-gem', '2026-05-14 05:53:53'),
(3, 'Secure Shipping', 'Pengiriman Peti Kayu Berasuransi Penuh', 'fa-box', '2026-05-14 05:53:53'),
(4, '24/7 Concierge', 'Layanan VIP Concierge Personal 24 Jam', 'fa-headset', '2026-05-14 05:53:53'),
(6, 'Layanan Purna Jual', 'Dukungan penuh setelah pembelian mulai dari bantuan konfigurasi, transfer data, hingga klaim garansi super cepat.', 'fa-tools', '2026-05-28 16:31:02'),
(7, 'Garansi Proteksi Plus', 'Perlindungan ekstra hingga 2 tahun penuh serta jaminan penggantian unit baru untuk menjamin ketenangan gadget premium Anda.', 'fa-award', '2026-05-28 16:31:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_logs`
--

CREATE TABLE `stock_logs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `type` enum('masuk','keluar') DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stock_logs`
--

INSERT INTO `stock_logs` (`id`, `product_id`, `type`, `quantity`, `description`, `created_at`) VALUES
(1, 1, 'masuk', 3, 'Penambahan barang baru: asus', '2026-05-14 12:05:12'),
(2, 2, 'keluar', 1, 'Penjualan ke dimas', '2026-05-16 13:11:42'),
(3, 1, 'keluar', 1, 'Penjualan ke Customer', '2026-05-16 13:21:38'),
(4, 2, 'keluar', 1, 'Penjualan ke Customer', '2026-05-16 13:30:54'),
(5, 2, 'keluar', 1, 'Pesanan Selesai/Dikirim (Order ID: #7)', '2026-05-16 13:31:17'),
(6, 5, 'keluar', 1, 'Penjualan ke Customer', '2026-05-16 13:52:16'),
(7, 4, 'keluar', 1, 'Penjualan ke dimas', '2026-05-16 13:54:36'),
(8, 1, 'keluar', 1, 'Penjualan ke dimas', '2026-05-20 01:55:01'),
(9, 1, 'keluar', 1, 'Pesanan Selesai/Dikirim (Order ID: #10)', '2026-05-20 01:55:30'),
(10, 2, 'keluar', 1, 'Penjualan ke dimaskasep', '2026-05-28 15:27:55'),
(11, 1, 'keluar', 1, 'Penjualan ke dimaskasep', '2026-05-28 15:27:55'),
(12, 4, 'keluar', 1, 'Penjualan ke dimaskasep', '2026-05-28 15:27:55'),
(13, 3, 'keluar', 1, 'Penjualan ke dimaskasep', '2026-05-28 15:27:55'),
(14, 2, 'keluar', 1, 'Pesanan Selesai/Dikirim (Order ID: #11)', '2026-05-28 15:29:26'),
(15, 1, 'keluar', 1, 'Pesanan Selesai/Dikirim (Order ID: #11)', '2026-05-28 15:29:26'),
(16, 4, 'keluar', 1, 'Pesanan Selesai/Dikirim (Order ID: #11)', '2026-05-28 15:29:26'),
(17, 3, 'keluar', 1, 'Pesanan Selesai/Dikirim (Order ID: #11)', '2026-05-28 15:29:26'),
(18, 2, 'masuk', 1, 'Stok diubah dari 12 menjadi 13 (Penyesuaian Masuk)', '2026-05-28 15:33:47'),
(19, 4, 'keluar', 1, 'Penjualan ke dimaskasep', '2026-05-29 01:50:15'),
(20, 4, 'keluar', 1, 'Pesanan Selesai/Dikirim (Order ID: #12)', '2026-05-29 01:53:00'),
(21, 5, 'keluar', 1, 'Penjualan ke dimaskasep', '2026-06-02 14:00:05'),
(22, 2, 'keluar', 1, 'Penjualan ke dimas', '2026-06-04 12:54:15'),
(23, 1, 'masuk', 2, 'Stok diubah dari 8 menjadi 10 (Penyesuaian Masuk)', '2026-06-10 12:34:21'),
(24, 2, 'keluar', 1, 'Penjualan ke dimaskasep', '2026-06-12 05:54:37'),
(25, 2, 'masuk', 1, 'Pembatalan Pesanan #15', '2026-06-12 05:54:43'),
(26, 2, 'keluar', 1, 'Penjualan ke dimaskasep', '2026-06-12 06:00:36'),
(27, 2, 'masuk', 1, 'Pembatalan Pesanan #16 (Alasan: Saya berubah pikiran)', '2026-06-12 06:02:23'),
(28, 2, 'keluar', 1, 'Penjualan ke dimas', '2026-06-12 06:07:53'),
(29, 2, 'masuk', 1, 'Pembatalan Pesanan #14 (Alasan: Pembayaran tidak dapat dilanjutkan)', '2026-06-12 06:10:22'),
(30, 6, 'keluar', 1, 'Penjualan ke dimaskasep (Order ID: #18)', '2026-06-12 07:08:35'),
(31, 6, 'masuk', 1, 'Pembatalan Pesanan #18 (Alasan: Salah memilih produk)', '2026-06-12 07:09:34'),
(32, 6, 'keluar', 1, 'Perubahan Status Pesanan ke Aktif (Order ID: #18)', '2026-06-12 07:27:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `store_info`
--

CREATE TABLE `store_info` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `hours` varchar(100) DEFAULT NULL,
  `maps_link` text DEFAULT NULL,
  `about_title` varchar(255) DEFAULT 'Tentang VERIDIAN LTD',
  `about_subtitle` varchar(255) DEFAULT 'Solusi Gadget & Teknologi Premium Terbaik untuk Anda',
  `about_content` text DEFAULT NULL,
  `about_image` varchar(255) DEFAULT 'about_banner.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `store_info`
--

INSERT INTO `store_info` (`id`, `name`, `logo`, `address`, `email`, `whatsapp`, `hours`, `maps_link`, `about_title`, `about_subtitle`, `about_content`, `about_image`) VALUES
(1, 'VERIDIAN Luxury Tech Development', 'logo.png', 'Menara Kencana Lantai 42, Jakarta Selatan', 'veridian@gmail.com', '0867-3558-8615', '09:00 - 22:00', 'https://www.google.com/maps/embed?pb=!4v1780410143694!6m8!1m7!1sxu0naIH3tPaxpy78NVi7Nw!2m2!1d-6.198681712538625!2d106.7622509094443!3f281.5149247579657!4f0.25369876488291254!5f0.7820865974627469\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade', 'Mengenal Lebih Dekat VERIDIAN Luxury Tech Development', 'Solusi Gadget Apple & Android Premium Terpercaya', 'Selamat datang di VERIDIAN Luxury Tech Development, destinasi terpercaya Anda untuk semua kebutuhan gadget flagship premium dengan garansi resmi dan orisinalitas mutlak.\r\n\r\nDidirikan dengan komitmen untuk menghadirkan teknologi terbaik, kami mengedepankan kualitas pelayanan dan kepuasan pelanggan di atas segalanya. Kami memiliki tim ahli yang selalu siap melayani konsultasi pembelian, transfer data, serta purna jual premium.', 'about_banner.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `team`
--

INSERT INTO `team` (`id`, `name`, `position`, `photo`, `created_at`) VALUES
(1, 'Alexander Pierce', 'CEO & Founder', 'team1.png', '2026-05-14 06:46:31'),
(2, 'Elena Rodriguez', 'Chief Tech Officer', 'team2.png', '2026-05-14 06:46:31'),
(3, 'Marcus Wright', 'Head of Design', 'team3.png', '2026-05-14 06:46:31'),
(4, 'Sofia Chen', 'Lead Developer', 'team4.png', '2026-05-14 06:46:31'),
(6, 'Dwi Cahyo Prasetyo', 'Lead Mobile Developer', 'team5.png', '2026-05-28 16:09:28'),
(7, 'Siti Rahmawati', 'Senior UI/UX Designer', 'team6.png', '2026-05-28 16:09:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role` enum('admin','kasir','customer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `image`, `phone`, `address`, `password`, `fullname`, `role`, `created_at`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, '$2y$10$Im3KM6NrTcrIbNwzn4XyM.yYWFQClY2sAmtRSIJdda5j6JgJS1.oS', 'Administrator', 'admin', '2026-05-14 05:53:53'),
(2, 'kasir', 'kasir@kasir.com', NULL, NULL, NULL, '$2y$10$1bsxPWFeUO0V29pkDWEar.hjOfN3b0XftWDrEhzKanhkcgf0gtjg2', 'Cashier User', 'kasir', '2026-05-14 05:53:53'),
(3, 'customer', 'customer@customer.com', NULL, NULL, NULL, '$2y$10$feTwtD3eKMh98YmFX2cm9Ob60lN2jZ9FTrUBP/jn4sKqkvqOZ6IXy', 'Customer User', 'customer', '2026-05-14 05:53:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_logs`
--
ALTER TABLE `stock_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `store_info`
--
ALTER TABLE `store_info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `stock_logs`
--
ALTER TABLE `stock_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `store_info`
--
ALTER TABLE `store_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
