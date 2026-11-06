CREATE DATABASE IF NOT EXISTS peminjamanalat;
USE peminjamanalat;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` enum('Admin','Petugas','Peminjam') NOT NULL,
  `nim_nik` varchar(50) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed data for `users` (Password default untuk semua akun: 'admin123')
INSERT INTO `users` (`username`, `password`, `nama`, `role`) VALUES
('admin', '$2y$10$kYxXlQf0FT79QtMNUCFauOtDxuaF1VQqh5Fx8XUHJOabLMukWyity', 'Administrator', 'Admin'),
('petugas1', '$2y$10$kYxXlQf0FT79QtMNUCFauOtDxuaF1VQqh5Fx8XUHJOabLMukWyity', 'Petugas Satu', 'Petugas'),
('peminjam1', '$2y$10$kYxXlQf0FT79QtMNUCFauOtDxuaF1VQqh5Fx8XUHJOabLMukWyity', 'Peminjam Satu', 'Peminjam');

-- --------------------------------------------------------
-- Table structure for table `kategori`
-- --------------------------------------------------------
CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `kategori` (`nama_kategori`) VALUES
('Elektronik'), ('Kendaraan'), ('Peralatan Medis');

-- --------------------------------------------------------
-- Table structure for table `alat`
-- --------------------------------------------------------
CREATE TABLE `alat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alat` varchar(20) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `kondisi` enum('Baik','Rusak Ringan','Rusak Berat') NOT NULL DEFAULT 'Baik',
  `lokasi_penyimpanan` varchar(100) DEFAULT NULL,
  `foto_alat` varchar(255) DEFAULT 'default.png',
  `status_ketersediaan` enum('Tersedia','Tidak Tersedia') NOT NULL DEFAULT 'Tersedia',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_alat` (`kode_alat`),
  FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `alat` (`kode_alat`, `nama_alat`, `kategori_id`, `stok`, `kondisi`, `lokasi_penyimpanan`, `foto_alat`, `status_ketersediaan`) VALUES
('ALT-001', 'Proyektor Epson EB-X400', 1, 5, 'Baik', 'Lemari A1 - Lab Multimedia', 'default.png', 'Tersedia'),
('ALT-002', 'Kamera DSLR Canon EOS 3000D', 1, 3, 'Baik', 'Lemari A2 - Lab Multimedia', 'default.png', 'Tersedia'),
('ALT-003', 'Mikroskop Binokuler Olympus', 3, 4, 'Baik', 'Rak Medis B - Lab Biologi', 'default.png', 'Tersedia'),
('ALT-004', 'Mobil Operasional Avanza', 2, 2, 'Baik', 'Garasi Utama', 'default.png', 'Tersedia'),
('ALT-005', 'Tensimeter Digital Omron', 3, 6, 'Baik', 'Rak Medis A - Lab Kesehatan', 'default.png', 'Tersedia');

-- --------------------------------------------------------
-- Table structure for table `peminjaman`
-- --------------------------------------------------------
CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_peminjaman` varchar(30) NOT NULL,
  `peminjam_id` int(11) NOT NULL,
  `petugas_id_acc` int(11) DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT CURRENT_TIMESTAMP,
  `tanggal_pinjam` datetime DEFAULT NULL,
  `tanggal_kembali_rencana` date NOT NULL,
  `status` enum('Menunggu Persetujuan','Disetujui','Ditolak','Dipinjam','Selesai') NOT NULL DEFAULT 'Menunggu Persetujuan',
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_peminjaman` (`kode_peminjaman`),
  FOREIGN KEY (`peminjam_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`petugas_id_acc`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `detail_peminjaman`
-- --------------------------------------------------------
CREATE TABLE `detail_peminjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peminjaman_id` int(11) NOT NULL,
  `alat_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`alat_id`) REFERENCES `alat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `pengembalian`
-- --------------------------------------------------------
CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peminjaman_id` int(11) NOT NULL,
  `petugas_id_kembali` int(11) NOT NULL,
  `tanggal_dikembalikan` datetime DEFAULT CURRENT_TIMESTAMP,
  `kondisi_alat_kembali` enum('Baik','Rusak Ringan','Rusak Berat','Hilang') NOT NULL DEFAULT 'Baik',
  `catatan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`petugas_id_kembali`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `denda`
-- --------------------------------------------------------
CREATE TABLE `denda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_denda` varchar(30) NOT NULL,
  `pengembalian_id` int(11) NOT NULL,
  `jenis_kerusakan` enum('Rusak Ringan','Rusak Berat','Hilang') NOT NULL,
  `nominal_denda` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status_pembayaran` enum('Belum Dibayar','Sudah Dibayar') NOT NULL DEFAULT 'Belum Dibayar',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_denda` (`nomor_denda`),
  FOREIGN KEY (`pengembalian_id`) REFERENCES `pengembalian` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
