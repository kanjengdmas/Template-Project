# Toko Online & Kasir POS (E-Commerce Template Project)

Aplikasi web **Toko Online (E-Commerce)** dan **Sistem Kasir (Point of Sale / POS)** terintegrasi berbasis **CodeIgniter 3** dan **Bootstrap**. Dirancang rapi, modular, dan siap digunakan sebagai starter kit / template proyek e-commerce, UMKM, toko ritel, maupun aplikasi tugas akhir / portofolio.

---

## 🌟 Fitur Utama

- **Authentication & Security:**
  - Login multi-role otomatis mengarahkan ke dashboard masing-masing role (**Admin**, **Kasir**, & **Customer**).
  - Enkripsi password aman menggunakan `password_hash()` (Bcrypt).
  - Proteksi brute force login (lockout timer setelah 3x percobaan gagal berturut-turut).
  - Validasi domain email untuk akun customer.
  - Dynamic `base_url` (otomatis mendeteksi domain, port, atau subfolder server tanpa perlu hardcode URL).

- **Role Administrator:**
  - Dashboard statistik analitik (total pendapatan, pesanan baru, grafik transaksi, dan ringkasan aktivitas).
  - **Manajemen Pengguna (User Management):** Tambah, edit, nonaktifkan akun Admin, Kasir, dan Customer.
  - **Profil & Pengaturan Toko:** Kelola logo toko, nama toko, alamat, kontak WhatsApp, jam operasional, rekening bank pembayaran, dan deskripsi toko.
  - **Manajemen Konten:** Kelola data layanan (*services*), tim toko (*team*), dan informasi kontak landing page.
  - **Laporan Penjualan Komprehensif:** Rekapitulasi penjualan dengan filter rentang tanggal, status pesanan, dan cetak laporan.
  - **Audit Trail (Activity Logs):** Pencatatan riwayat setiap aktivitas penting dalam sistem.

- **Role Kasir (Cashier / POS):**
  - **Manajemen Produk & Kategori:** CRUD katalog barang, penentuan harga jual, kategori, dan foto produk.
  - **Manajemen Stok Barang:** Pencatatan stok masuk (*inflow*), stok keluar (*outflow*), dan riwayat log stok (*stock logs*).
  - **Transaksi Penjualan (POS):** Input transaksi langsung di kasir toko secara cepat dan akurat.
  - **Manajemen Pesanan Online:** Verifikasi pembayaran transfer bank, konfirmasi bukti pembayaran, update status pengiriman (*pending*, *processed*, *shipping*, *completed*, *cancelled*).
  - **Laporan Transaksi Kasir:** Rekap transaksi harian dan periodik kasir.

- **Role Customer (Pelanggan / Frontend Storefront):**
  - Antarmuka storefront modern, responsif, dan mobile-friendly.
  - Katalog produk dengan filter kategori, pencarian produk, dan detail deskripsi.
  - Keranjang belanja (*Shopping Cart*) interaktif.
  - Checkout pesanan dengan berbagai opsi pembayaran (Transfer Bank BCA/BRI/Mandiri, E-Wallet OVO/GoPay/Dana, COD).
  - Unggah bukti pembayaran / transfer langsung melalui dashboard pelanggan.
  - Pelacakan status pesanan secara real-time (*order tracking*).
  - Riwayat pembelanjaan dan pembatalan pesanan mandiri.
  - Manajemen profil dan foto avatar pengguna.

---

## 🛠️ Kebutuhan Sistem (Prerequisites)

- **Web Server:** Apache (XAMPP / Laragon / WAMP / Standalone) dengan `mod_rewrite` aktif.
- **PHP Version:** PHP 7.4 s/d PHP 8.2 (disarankan PHP 8.x).
- **Database:** MySQL 5.7+ / MariaDB 10.4+.
- Ekstensi PHP yang dibutuhkan: `mysqli`, `session`, `mbstring`, `json`, `gd`.

---

## 🚀 Panduan Instalasi & Penggunaan

### 1. Dapatkan Template Ini
Template ini merupakan bagian dari repositori kumpulan [**Template-Project**](https://github.com/kanjengdmas/Template-Project). Anda dapat meng-clone repositori utama:
```bash
git clone https://github.com/kanjengdmas/Template-Project.git
```
Kemudian salin atau gunakan folder `toko-online/` di direktori web server lokal Anda, contohnya:
- **XAMPP:** `C:/xampp/htdocs/toko-online`
- **Laragon:** `C:/laragon/www/toko-online`
- **Linux:** `/var/www/html/toko-online`

### 2. Import Database
1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`) atau MySQL client favorit Anda (HeidiSQL, DBeaver, Navicat).
2. Buat database baru dengan nama `toko_online`:
   ```sql
   CREATE DATABASE toko_online;
   ```
3. Import file `toko_online.sql` yang berada di root folder proyek ini ke dalam database `toko_online`.

### 3. Konfigurasi Database (Jika Diperlukan)
File konfigurasi database berada di `application/config/database.php`:
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'toko_online',
    'dbdriver' => 'mysqli',
    ...
);
```
*Secara default disesuaikan untuk konfigurasi default XAMPP (user `root`, password kosong).*

### 4. Jalankan Aplikasi
Buka web browser favorit Anda dan akses URL:
```
http://localhost/toko-online/
```

---

## 🔑 Akun Default (Demo Credentials)

| Role | Username | Password | Deskripsi Akses |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin` | `admin123` | Akses penuh dashboard admin, pengaturan toko, user, & laporan keuangan |
| **Kasir (POS)** | `kasir` | `kasir123` | Akses manajemen produk, stok, transaksi penjualan, & pesanan masuk |
| **Customer** | `customer` | `customer123` | Akses belanja frontend, keranjang belanja, checkout, & upload bukti bayar |

---

## 📁 Struktur Direktori Utama

```
toko-online/
├── application/                # Logika utama aplikasi CodeIgniter 3
│   ├── config/                # Konfigurasi aplikasi, database, routes, autoload
│   ├── controllers/           # Controller CI3
│   │   ├── admin/             # Controller khusus role Administrator
│   │   ├── kasir/             # Controller khusus role Kasir / POS
│   │   ├── Auth.php           # Autentikasi (login, register, logout, brute-force lockout)
│   │   └── Landing.php        # Halaman muka (landing page, katalog, cart, checkout)
│   ├── models/                # Model database (Admin_model, Auth_model, Landing_model)
│   └── views/                 # Template tampilan antarmuka (Admin, Kasir, Customer, Auth)
├── assets/                    # Aset statis pendukung
│   ├── css/                   # Stylesheet kustom & framework
│   ├── js/                    # Script JavaScript interaktif & AJAX
│   ├── img/                   # Aset grafis bawaan toko & ilustrasi
│   ├── uploads/               # Direktori upload dinamis (bukti pembayaran & avatar pengguna)
│   └── vendor/                # Vendor pustaka pihak ketiga (FontAwesome, Bootstrap, jQuery)
├── system/                    # CI3 Core Framework Engine
├── .editorconfig
├── .gitignore
├── .htaccess
├── index.php
├── toko_online.sql            # Skema tabel & data awal database lengkap
└── README.md
```

---

## 📄 Lisensi
Seluruh template dalam proyek ini bebas digunakan, dimodifikasi, dan dikembangkan lebih lanjut untuk keperluan pembelajaran, tugas akademik, maupun proyek komersial.
