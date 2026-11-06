# Sistem Informasi Perpustakaan (SIPERPOS / Template Project)

Aplikasi web Sistem Informasi Manajemen Perpustakaan berbasis **CodeIgniter 3** dan **Bootstrap**. Dirancang rapi, modular, dan siap digunakan sebagai template proyek sistem perpustakaan atau aplikasi web berbasis CI3 lainnya.

---

## 🌟 Fitur Utama

- **Authentication & Security:**
  - Login multi-role (Admin & Anggota/Member).
  - Enkripsi password menggunakan `password_hash()` (Bcrypt).
  - Proteksi brute force login (lockout timer setelah 3x gagal).
  - Dynamic `base_url` (otomatis mendeteksi domain, port, atau subfolder).

- **Role Administrator:**
  - Dashboard statistik (total buku, total anggota, status peminjaman, pengembalian).
  - Manajemen Data Buku (CRUD, upload cover, filter/kategori, stok).
  - Manajemen Kategori Buku (CRUD).
  - Manajemen Anggota / User (CRUD, status, foto profil).
  - Transaksi Peminjaman & Pengembalian Buku.
  - Laporan & Riwayat Sirkulasi.

- **Role Anggota (Member):**
  - Katalog pencarian buku & ketersediaan stok buku.
  - Riwayat peminjaman & pengembalian buku mandiri.
  - Pengaturan profil & ganti password.

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
Kemudian salin atau gunakan folder `perpus/` di direktori web server lokal Anda, contohnya:
- XAMPP: `C:/xampp/htdocs/perpus`
- Laragon: `C:/laragon/www/perpus`
- Linux: `/var/www/html/perpus`

### 2. Import Database
1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`) atau MySQL client favorit Anda.
2. Buat database baru dengan nama `perpus`:
   ```sql
   CREATE DATABASE perpus;
   ```
3. Import file `perpus.sql` yang berada di root folder proyek ini ke dalam database `perpus`.

### 3. Konfigurasi Database (Jika Diperlukan)
File konfigurasi database berada di `application/config/database.php`:
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'perpus',
    'dbdriver' => 'mysqli',
    ...
);
```
*Secara default disesuaikan untuk konfigurasi default XAMPP (user `root`, password kosong).*

### 4. Jalankan Aplikasi
Buka web browser dan akses URL proyek:
```
http://localhost/perpus/
```

---

## 🔑 Akun Default (Demo Credentials)

| Role | Username | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin` | `admin123` |
| **Anggota (Member)** | `member123` | `member123` |

---

## 📁 Struktur Direktori Utama

```
perpus/
├── application/            # Logika aplikasi CodeIgniter 3
│   ├── config/            # File konfigurasi (database, routes, autoload, dll)
│   ├── controllers/       # Controller (Admin, Anggota, Auth, Home)
│   ├── models/            # Model data perpustakaan (M_Buku, M_Kategori, M_Peminjaman, M_User)
│   └── views/             # Template antarmuka pengguna (Admin, Anggota, Auth, Landing)
├── assets/                # Aset statis (CSS, JS, Vendor Bootstrap/SB Admin, Gambar)
│   ├── css/
│   ├── js/
│   └── img/               # Aset gambar cover buku & foto profil
├── system/                # CI3 Core Framework
├── .editorconfig
├── .gitignore
├── .htaccess
├── perpus.sql             # Skema & data awal database
└── README.md
```

---

## 📄 Lisensi
Proyek ini dibuat untuk keperluan template dasar pembelajaran dan pengembangan sistem informasi perpustakaan. Bebas digunakan dan dimodifikasi sesuai kebutuhan Anda.
