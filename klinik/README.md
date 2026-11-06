# Sistem Informasi Klinik & Rekam Medis Digital (Template Project)

Aplikasi web Sistem Informasi Manajemen Klinik dan Rekam Medis Digital berbasis **CodeIgniter 3** dan **Bootstrap (SB Admin 2)**. Dirancang dengan alur pelayanan kesehatan terpadu (Pasien &rarr; Petugas &rarr; Dokter &rarr; Admin), modular, aman, dan siap digunakan sebagai template proyek sistem klinik, puskesmas, atau aplikasi layanan kesehatan lainnya.

---

## 🌟 Fitur Utama

- **Authentication & Keamanan:**
  - Login multi-role (Admin, Petugas, Dokter, dan Pasien).
  - Enkripsi password menggunakan `password_hash()` (Bcrypt).
  - Proteksi brute force login (lockout timer 15 detik otomatis setelah 3x percobaan gagal).
  - Dynamic `base_url` (otomatis mendeteksi domain, port, atau subfolder tanpa perlu hardcode URL).
  - Notifikasi interaktif modern menggunakan **Toastr**.

- **Role Administrator:**
  - Dashboard statistik klinik (total pasien, dokter, obat, pemeriksaan, dan grafik aktivitas).
  - Manajemen Data Pengguna / User Management (Admin, Petugas, Dokter, Pasien) dengan upload foto profil.
  - Manajemen Data Dokter (spesialisasi, nomor telepon, alamat, keterkaitan akun user).
  - Manajemen Data Obat & Stok Farmasi (kategori bentuk sediaan obat: Tablet, Sirup, Kapsul, Salep, Tetes, Lainnya).
  - Rekapitulasi Laporan Pemeriksaan & Riwayat Rekam Medis (fitur cetak/print laporan klinik).

- **Role Petugas Klinik:**
  - Dashboard antrian dan ringkasan aktivitas pemeriksaan harian.
  - Pendaftaran & registrasi pasien baru secara langsung.
  - Input & validasi pendaftaran pemeriksaan pasien (keluhan, tanda-tanda vital: tensi, berat/tinggi badan, gula darah, riwayat alergi & penyakit).
  - Pengelolaan data stok obat di apotek/farmasi klinik.

- **Role Dokter:**
  - Dashboard antrian pasien periksa.
  - Pemeriksaan pasien (input diagnosis medis, advis/saran penanganan, dan tindakan).
  - E-Prescription / Resep Obat Digital terintegrasi dengan ketersediaan stok obat (aturan pakai, dosis, dan jumlah obat).
  - Riwayat rekam medis pasien yang pernah ditangani.

- **Role Pasien:**
  - Landing page informatif profil klinik dan fasilitas layanan.
  - Registrasi akun pasien online mandiri.
  - Pengajuan permohonan / booking pemeriksaan online (keluhan dan riwayat kesehatan).
  - Pemantauan status pemeriksaan (Menunggu &rarr; Diproses &rarr; Selesai).
  - Riwayat rekam medis pribadi, catatan diagnosis dokter, dan resep obat yang diterima.
  - Pengaturan profil pasien & ganti password.

---

## 🛠️ Kebutuhan Sistem (Prerequisites)

- **Web Server:** Apache (XAMPP / Laragon / WAMP / Standalone) dengan `mod_rewrite` aktif.
- **PHP Version:** PHP 7.4 s/d PHP 8.2 (disarankan PHP 8.x).
- **Database:** MySQL 5.7+ / MariaDB 10.4+.
- **Ekstensi PHP:** `mysqli`, `session`, `mbstring`, `json`, `gd`.

---

## 🚀 Panduan Instalasi & Penggunaan

### 1. Dapatkan Template Ini
Template ini merupakan bagian dari repositori kumpulan [**Template-Project**](https://github.com/kanjengdmas/Template-Project). Anda dapat meng-clone repositori utama:
```bash
git clone https://github.com/kanjengdmas/Template-Project.git
```
Kemudian salin atau gunakan folder `klinik/` di direktori web server lokal Anda, contohnya:
- XAMPP: `C:/xampp/htdocs/klinik`
- Laragon: `C:/laragon/www/klinik`
- Linux: `/var/www/html/klinik`

### 2. Import Database
1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`) atau database client favorit Anda (HeidiSQL, DBeaver, TablePlus, dll).
2. Buat database baru bernama `db_klinik`:
   ```sql
   CREATE DATABASE db_klinik;
   ```
3. Import file `db_klinik.sql` yang berada di root folder proyek ini ke dalam database `db_klinik`.

### 3. Konfigurasi Database (Jika Diperlukan)
File konfigurasi database berada di `application/config/database.php`:
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'db_klinik',
    'dbdriver' => 'mysqli',
    ...
);
```
*Secara default disesuaikan untuk konfigurasi default XAMPP (user `root`, password kosong).*

### 4. Jalankan Aplikasi
Buka web browser dan akses URL proyek:
```
http://localhost/klinik/
```

---

## 🔑 Akun Default (Demo Credentials)

| Role | Username / Email | Password | Keterangan |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin` / `admin@klinik.com` | `admin123` | Akses penuh manajemen master data, user, dokter, obat & laporan |
| **Petugas** | `petugas` / `petugas@klinik.com` | `petugas123` | Manajemen pendaftaran pasien, antrian periksa & stok obat |
| **Dokter Umum** | `dokterumum` / `dokter1@klinik.com` | `dokter123` | Pemeriksaan medis, diagnosis & resep obat |
| **Dokter Anak** | `dokteranak` / `dokter2@klinik.com` | `dokter123` | Pemeriksaan poli spesialis anak |
| **Pasien** | `pasien1` / `pasien1@klinik.com` | `password` | Pasien terdaftar untuk booking periksa & riwayat rekam medis |

---

## 📁 Struktur Direktori Utama

```
klinik/
├── application/            # Arsitektur MVC CodeIgniter 3
│   ├── config/            # Konfigurasi database, routes, autoload, dynamic base_url
│   ├── controllers/       # Admin, Auth, Dokter, Home, Pasien, Petugas, Profil
│   ├── models/            # Dokter_model, Obat_model, Pemeriksaan_model, User_model
│   └── views/             # Template antarmuka per role (admin, petugas, dokter, pasien, auth, landing)
├── assets/                # Aset statis & UI library
│   ├── css/               # Bootstrap 5, SB Admin 2, Toastr, FontAwesome, Outfit & Inter fonts
│   ├── js/                # jQuery, Bootstrap bundle, Toastr, Chart scripts
│   ├── fonts/             # Custom webfonts
│   └── img/               # Ilustrasi landing page & foto profil pengguna
├── system/                # CI3 Core Framework Engine
├── .editorconfig
├── .gitignore
├── .htaccess              # Clean URL rewriting
├── db_klinik.sql          # Dump skema tabel & data awal klinik
└── README.md              # Dokumentasi teknis template
```

---

## 📄 Lisensi
Proyek ini dibuat untuk keperluan template dasar pembelajaran dan percepatan pengembangan sistem informasi klinik/kesehatan. Bebas digunakan dan dimodifikasi sesuai kebutuhan proyek Anda.
