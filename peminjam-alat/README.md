# Sipanja - Sistem Informasi Peminjaman Alat (Template Project)

Aplikasi web Sistem Informasi Manajemen Peminjaman Alat & Inventaris berbasis **CodeIgniter 3**, **MySQL**, dan **Bootstrap**. Dirancang rapi, modular, aman, dan siap digunakan sebagai template proyek sistem peminjaman alat laboratorium, multimedia, bengkel, perkantoran, maupun inventaris umum lainnya.

---

## 🌟 Fitur Utama

- **Authentication & Security:**
  - Login multi-role (**Admin**, **Petugas**, dan **Peminjam**).
  - Registrasi mandiri akun peminjam baru dengan validasi NIM/NIK serta email unik.
  - Enkripsi password menggunakan `password_hash()` (Bcrypt).
  - Dynamic `base_url` (otomatis mendeteksi HTTPS/HTTP, domain/IP, port, dan subfolder tanpa perlu ubah config).

- **Landing Page Publik:**
  - Katalog pencarian alat lengkap dengan foto dan status ketersediaan stok.
  - Kartu statistik sistem (total alat, total peminjam, total riwayat transaksi).
  - Tampilan alat paling populer yang sering dipinjam.

- **Role Administrator:**
  - Dashboard analitik interaktif: grafik tren peminjaman & pengembalian bulanan, distribusi status (Chart.js), dan timeline aktivitas sirkulasi terkini.
  - Manajemen Data Alat (CRUD, kode alat, kategori, stok, kondisi fisik, upload foto, status ketersediaan).
  - Manajemen Kategori Alat (CRUD).
  - Manajemen Pengguna (CRUD akun Admin, Petugas, dan Peminjam).
  - Rekap seluruh transaksi peminjaman, pengembalian, dan denda.
  - Laporan sirkulasi alat & cetak laporan.

- **Role Petugas:**
  - Verifikasi dan persetujuan (*Approve* / *Reject*) pengajuan pinjam alat dari peminjam.
  - Konfirmasi penyerahan alat (update status menjadi "Dipinjam").
  - Pemrosesan pengembalian alat dan inspeksi kondisi barang (Baik, Rusak Ringan, Rusak Berat, Hilang).
  - Penerbitan tagihan denda otomatis jika alat mengalami kerusakan atau hilang.

- **Role Peminjam:**
  - Eksplorasi katalog inventaris alat dan pengecekan stok siap pakai.
  - Pengajuan permohonan peminjaman alat dengan memilih tanggal rencana pengembalian.
  - Tracking status pengajuan secara real-time (*Menunggu Persetujuan*, *Disetujui*, *Dipinjam*, *Ditolak*, *Selesai*).
  - Riwayat peminjaman dan informasi status pembayaran denda (jika ada).

---

## 🛠️ Kebutuhan Sistem (Prerequisites)

- **Web Server:** Apache (XAMPP / Laragon / WAMP / Standalone) dengan `mod_rewrite` aktif.
- **PHP Version:** PHP 7.4 s/d PHP 8.2 (disarankan PHP 8.x).
- **Database:** MySQL 5.7+ / MariaDB 10.4+.
- Ekstensi PHP: `mysqli`, `session`, `mbstring`, `json`, `gd`.

---

## 🚀 Panduan Instalasi & Penggunaan

### 1. Dapatkan Template Ini
Template ini merupakan bagian dari repositori kumpulan [**Template-Project**](https://github.com/kanjengdmas/Template-Project). Anda dapat meng-clone repositori utama:
```bash
git clone https://github.com/kanjengdmas/Template-Project.git
```
Kemudian salin atau pindahkan folder `peminjam-alat/` ke direktori web server lokal Anda, contohnya:
- XAMPP: `C:/xampp/htdocs/peminjam-alat`
- Laragon: `C:/laragon/www/peminjam-alat`
- Linux: `/var/www/html/peminjam-alat`

### 2. Import Database
1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`) atau MySQL client favorit Anda.
2. Buat database baru dengan nama `peminjamanalat`:
   ```sql
   CREATE DATABASE peminjamanalat;
   ```
3. Import file `peminjam-alat.sql` (atau `schema.sql`) yang ada di root folder proyek ini ke dalam database `peminjamanalat`.

### 3. Konfigurasi Database (Jika Diperlukan)
File konfigurasi database berada di `application/config/database.php`:
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'peminjamanalat',
    'dbdriver' => 'mysqli',
    ...
);
```
*Konfigurasi default sudah disesuaikan untuk standar XAMPP (user `root`, password kosong).*

### 4. Jalankan Aplikasi
Buka web browser dan akses URL:
```
http://localhost/peminjam-alat/
```

---

## 🔑 Akun Default (Demo Credentials)

| Role | Username | Password | Keterangan |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin` | `admin123` | Akses penuh master data & laporan |
| **Petugas** | `petugas1` | `admin123` | Akses verifikasi peminjaman & pengembalian |
| **Peminjam** | `peminjam1` | `admin123` | Akses pengajuan pinjam alat |

---

## 📁 Struktur Direktori Utama

```
peminjam-alat/
├── application/            # Source code & logika aplikasi CodeIgniter 3
│   ├── config/            # Konfigurasi database, routes, autoload, config
│   ├── controllers/       # Controller (Admin, Alat, Auth, Dashboard, Denda, Home, Kategori, Laporan, Peminjam, Petugas, Transaksi, User)
│   ├── models/            # Model database (Alat_model, Denda_model, Kategori_model, Peminjaman_model, User_model)
│   └── views/             # Template antarmuka (admin, alat, auth, dashboard, denda, landing, laporan, peminjam, petugas, transaksi, user)
├── assets/                # Aset statis (CSS, JS, FontAwesome, Bootstrap, jQuery, uploads gambar)
├── system/                # CI3 System Framework Core
├── .htaccess              # Konfigurasi URL rewriting (clean URL tanpa index.php)
├── peminjam-alat.sql      # Dump skema database lengkap & seed data demo
├── schema.sql             # Skema database alternatif
└── README.md              # Dokumentasi & panduan instalasi template
```

---

## 📄 Lisensi
Template proyek ini bebas digunakan, dimodifikasi, dan dikembangkan kembali untuk keperluan tugas akhir, skripsi, prototipe, maupun sistem operasional institusi/perusahaan Anda.
