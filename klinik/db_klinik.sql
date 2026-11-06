-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2026 pada 11.51
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
-- Database: `db_klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `spesialis` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `user_id`, `spesialis`, `no_telp`, `alamat`) VALUES
(1, 3, 'Dokter Umum', '081234567891', 'Jl. Merdeka No 10'),
(2, 4, 'Spesialis Anak', '081234567892', 'Jl. Sudirman No 20'),
(3, 8, 'Spesialis Mata', '08120000001', 'Poli Mata Klinik Digital'),
(4, 9, 'Spesialis Jantung', '08120000002', 'Poli Jantung Klinik Digital'),
(5, 10, 'Spesialis Gigi', '08120000003', 'Poli Gigi Klinik Digital'),
(6, 11, 'Spesialis Kulit', '08120000004', 'Poli Kulit Klinik Digital'),
(7, 12, 'Spesialis THT', '08120000005', 'Poli THT Klinik Digital'),
(8, 13, 'Spesialis Penyakit Dalam', '08120000006', 'Poli Penyakit Dalam Klinik Digital');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `jenis_obat` enum('Tablet','Sirup','Kapsul','Salep','Tetes','Lainnya') NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `deskripsi_obat` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `jenis_obat`, `stok`, `deskripsi_obat`, `created_at`) VALUES
(1, 'Paracetamol 500mg', 'Tablet', 99, 'Obat penurun panas dan pereda nyeri ringan.', '2026-06-16 15:04:43'),
(2, 'Amoxicillin 500mg', 'Kapsul', 50, 'Antibiotik untuk infeksi bakteri.', '2026-06-16 15:04:43'),
(3, 'Sanmol Syrup', 'Sirup', 29, 'Obat penurun panas untuk anak-anak.', '2026-06-16 15:04:43'),
(4, 'Vitamin C 1000mg', 'Tablet', 199, 'Suplemen vitamin C untuk daya tahan tubuh.', '2026-06-16 15:04:43'),
(5, 'Insto Regular Drops 7.5ml', 'Tetes', 50, 'Obat tetes mata steril untuk mengatasi mata merah dan iritasi ringan.', '2026-06-16 15:38:26'),
(6, 'Cendo Xitrol Eye Drops 5ml', 'Tetes', 30, 'Obat tetes mata antibiotik dan anti-peradangan (Untuk Spesialis Mata).', '2026-06-16 15:38:26'),
(7, 'Amlodipine 5mg', 'Tablet', 100, 'Obat antihipertensi untuk menurunkan tekanan darah (Untuk Spesialis Jantung/Penyakit Dalam).', '2026-06-16 15:38:26'),
(8, 'Clopidogrel 75mg', 'Tablet', 80, 'Obat pengencer darah untuk mencegah pembekuan darah (Untuk Spesialis Jantung).', '2026-06-16 15:38:26'),
(9, 'Asam Mefenamat 500mg', 'Tablet', 150, 'Obat pereda nyeri ringan hingga sedang, sangat efektif untuk sakit gigi.', '2026-06-16 15:38:26'),
(10, 'Cataflam 50mg', 'Tablet', 100, 'Obat pereda nyeri dan peradangan kuat untuk sakit gigi atau pasca cabut gigi.', '2026-06-16 15:38:26'),
(11, 'Ketoconazole Cream 2%', 'Salep', 60, 'Salep antijamur untuk mengatasi infeksi jamur pada kulit (Untuk Spesialis Kulit).', '2026-06-16 15:38:26'),
(12, 'Hydrocortisone Cream 1%', 'Salep', 70, 'Salep kortikosteroid ringan untuk meredakan radang, gatal, dan kemerahan pada kulit.', '2026-06-16 15:38:26'),
(13, 'Otilon Ear Drops 8ml', 'Tetes', 40, 'Obat tetes telinga untuk meredakan rasa sakit dan peradangan (Untuk Spesialis THT).', '2026-06-16 15:38:26'),
(14, 'Iliadin Nasal Spray 0.05%', 'Lainnya', 50, 'Semprot hidung untuk meredakan hidung tersumbat (Untuk Spesialis THT).', '2026-06-16 15:38:26'),
(15, 'Metformin 500mg', 'Tablet', 200, 'Obat antidiabetes oral untuk mengontrol gula darah (Untuk Penyakit Dalam).', '2026-06-16 15:38:26'),
(16, 'Omeprazole 20mg', 'Kapsul', 150, 'Obat untuk menurunkan produksi asam lambung (Untuk Penyakit Dalam/Umum).', '2026-06-16 15:38:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `umur` int(11) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `berat_badan` float DEFAULT NULL,
  `tinggi_badan` float DEFAULT NULL,
  `tekanan_darah` varchar(20) DEFAULT NULL,
  `gula_darah` varchar(20) DEFAULT NULL,
  `riwayat_penyakit` text DEFAULT NULL,
  `riwayat_alergi` text DEFAULT NULL,
  `keluhan` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Menunggu','Diproses','Selesai','Ditolak') DEFAULT 'Menunggu',
  `dokter_id` int(11) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `saran` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id` int(11) NOT NULL,
  `pemeriksaan_id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `aturan_pakai` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas','dokter','pasien') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role`, `created_at`, `foto`) VALUES
(1, 'Administrator', 'admin', 'admin@klinik.com', '$2y$10$9FSyS/SnO668lvmYuuMF4uYMN9iDYPOTFjZaTO5MHzyYugoWmB8e6', 'admin', '2026-06-16 14:48:31', 'admin.jpg'),
(2, 'Petugas Klinik 1', 'petugas', 'petugas@klinik.com', '$2y$10$gLVp.wIR5tq8Oo4wBWZWaOnlD7D1TV/gAby0NHFy5cPC1.YQVeBU.', 'petugas', '2026-06-16 15:04:43', 'petugas1.jpg'),
(3, 'dr. Budi Santoso', 'dokterumum', 'dokter1@klinik.com', '$2y$10$MVVQbGtRyc72Yx7QvM5trOdUnbE7.UfiNb2BmSxRg3iaErCVtsUji', 'dokter', '2026-06-16 15:04:43', 'dr_budi.jpg'),
(4, 'dr. Siti Aminah', 'dokteranak', 'dokter2@klinik.com', '$2y$10$MVVQbGtRyc72Yx7QvM5trOdUnbE7.UfiNb2BmSxRg3iaErCVtsUji', 'dokter', '2026-06-16 15:04:43', 'dr_siti.jpg'),
(5, 'Andi Pratama', 'pasien1', 'pasien1@klinik.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pasien', '2026-06-16 15:04:43', 'default.jpg'),
(6, 'Rina Melati', 'pasien2', 'pasien2@klinik.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pasien', '2026-06-16 15:04:43', 'default.jpg'),
(8, 'dr. Reza', 'doktermata', 'mata@klinik.com', '$2y$10$NfNU1lXX5AzcKD5INbaA2uhUVmREvc6aRRQ7QHXqiTdWvMr134/ly', 'dokter', '2026-06-16 15:28:49', 'dr_reza.jpg'),
(9, 'dr. Anton', 'dokterjantung', 'jantung@klinik.com', '$2y$10$NfNU1lXX5AzcKD5INbaA2uhUVmREvc6aRRQ7QHXqiTdWvMr134/ly', 'dokter', '2026-06-16 15:28:49', 'dr_anton.jpg'),
(10, 'drg. Rina', 'doktergigi', 'gigi@klinik.com', '$2y$10$NfNU1lXX5AzcKD5INbaA2uhUVmREvc6aRRQ7QHXqiTdWvMr134/ly', 'dokter', '2026-06-16 15:28:49', 'drg_rina.jpg'),
(11, 'dr. Sarah', 'dokterkulit', 'kulit@klinik.com', '$2y$10$NfNU1lXX5AzcKD5INbaA2uhUVmREvc6aRRQ7QHXqiTdWvMr134/ly', 'dokter', '2026-06-16 15:28:49', 'dr_sarah.jpg'),
(12, 'dr. Farhan', 'doktertht', 'tht@klinik.com', '$2y$10$NfNU1lXX5AzcKD5INbaA2uhUVmREvc6aRRQ7QHXqiTdWvMr134/ly', 'dokter', '2026-06-16 15:28:49', 'dr_farhan.jpg'),
(13, 'dr. Dina', 'dokterdalam', 'dalam@klinik.com', '$2y$10$NfNU1lXX5AzcKD5INbaA2uhUVmREvc6aRRQ7QHXqiTdWvMr134/ly', 'dokter', '2026-06-16 15:28:49', 'dr_dina.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_id` (`pasien_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indeks untuk tabel `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaan_id` (`pemeriksaan_id`),
  ADD KEY `obat_id` (`obat_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD CONSTRAINT `resep_obat_ibfk_1` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resep_obat_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
