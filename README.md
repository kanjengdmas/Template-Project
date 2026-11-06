# 📦 Kumpulan Template Proyek (Project Templates Collection)

Selamat datang di repositori **Template-Project**! Repositori ini berfungsi sebagai kumpulan template proyek aplikasi web, sistem informasi, dan starter kit siap pakai. Anda dapat memilih template yang diinginkan dan menggunakannya sebagai fondasi awal untuk mempercepat pengembangan proyek baru.

---

## 📂 Daftar Template Proyek

| No | Folder | Nama Template Proyek | Tech Stack | Keterangan & Fitur Utama |
| :---: | :--- | :--- | :--- | :--- |
| 1 | [`perpus/`](./perpus/) | **Sistem Informasi Perpustakaan** | CodeIgniter 3, MySQL, Bootstrap (SB Admin 2) | Sistem manajemen perpustakaan lengkap: login multi-role (Admin & Anggota), manajemen buku & kategori, transaksi peminjaman & pengembalian, riwayat sirkulasi, proteksi brute force login, dan dynamic `base_url`. |

> 💡 *Template proyek lainnya akan terus ditambahkan secara bertahap.*

---

## 🚀 Panduan Penggunaan Template

Setiap folder di dalam repositori ini merupakan satu proyek mandiri yang dilengkapi dokumentasi instalasi dan file database-nya masing-masing.

### Cara Menggunakan:
1. **Clone Repositori:**
   ```bash
   git clone https://github.com/kanjengdmas/Template-Project.git
   ```
2. **Pilih Template:**
   Masuk ke folder template yang ingin Anda gunakan, misalnya `perpus/`.
3. **Pindahkan ke Web Server:**
   Salin atau pindahkan folder template tersebut ke direktori web server Anda (misal `C:/xampp/htdocs/` atau `/var/www/html/`).
4. **Ikuti Panduan Khusus:**
   Buka file `README.md` di dalam folder template yang dipilih untuk melihat langkah konfigurasi database, requirements, dan kredensial default.

---

## 🛠️ Cara Menambahkan Template Baru (Untuk Pemilik Repositori)

Untuk menambahkan template proyek baru ke repositori ini:
1. Buat folder baru di root repositori dengan nama proyek Anda (misal: `surat-rujukan/`, `spp-online/`).
2. Masukkan source code proyek dan file database (`.sql`).
3. Tambahkan file `README.md` di dalam folder tersebut berisi panduan instalasi.
4. Perbarui tabel daftar template pada file `README.md` utama ini.
5. Lakukan commit dan push:
   ```bash
   git add .
   git commit -m "feat: tambah template <nama-project>"
   git push origin main
   ```

---

## 📄 Lisensi
Seluruh template dalam repositori ini bebas digunakan dan dimodifikasi untuk keperluan pembelajaran maupun pengembangan proyek pribadi/komersial.
