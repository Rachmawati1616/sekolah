# Sistem Presensi SD Negeri Deyangan 2

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

Sistem Presensi Web Modern untuk mengelola data kehadiran siswa-siswi secara efisien di SD Negeri Deyangan 2. Dibangun menggunakan framework Laravel yang tangguh dan tampilan antarmuka yang modern dengan Tailwind CSS.

## 🚀 Fitur Utama

- **Autentikasi Aman:** Sistem login yang dilindungi khusus untuk Guru / Tenaga Pendidik.
- **Dashboard Interaktif:** Ringkasan *real-time* mengenai total siswa, kelas, dan status presensi hari ini (Hadir, Izin, Sakit, Alpa).
- **Manajemen Data Kelas (CRUD):** Tambah, ubah, dan hapus data kelas dengan mudah.
- **Manajemen Data Siswa (CRUD):** Kelola profil siswa lengkap beserta Nomor Induk Siswa (NIS) dan penempatannya di masing-masing kelas.
- **Presensi Harian:** Antarmuka pencatatan kehadiran yang sangat intuitif, terbagi berdasarkan kelas dan tanggal.
- **Responsif:** Tampilan yang dioptimalkan untuk berbagai ukuran layar (Desktop, Tablet, maupun Mobile).

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 11.x
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Database:** SQLite / MySQL / PostgreSQL (Sesuai Konfigurasi Lingkungan)
- **Authentication:** Laravel Breeze

## 📋 Persyaratan Sistem

Sebelum menjalankan aplikasi ini, pastikan sistem Anda telah menginstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- Database Server (MySQL / MariaDB / SQLite)

## ⚙️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

1. **Clone repositori ini:**
   ```bash
   git clone https://github.com/username/sekolah.git
   cd sekolah
   ```

2. **Instal dependensi PHP:**
   ```bash
   composer install
   ```

3. **Instal dependensi Frontend (NPM):**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment:**
   Salin file `.env.example` menjadi `.env` dan atur konfigurasi database Anda.
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan Migrasi dan Seeder (Untuk mendapatkan data awal/dummy):**
   ```bash
   php artisan migrate --seed
   ```

7. **Compile aset Frontend:**
   ```bash
   npm run build
   ```

8. **Jalankan local server:**
   ```bash
   php artisan serve
   ```

   Aplikasi kini dapat diakses melalui `http://localhost:8000`.

## 🔑 Akun Demo (Default Seeder)

Jika Anda menjalankan migrasi dengan seeder, Anda dapat menggunakan kredensial berikut untuk masuk:
- **Email:** `guru@example.com`
- **Password:** `password`

## 🤝 Berkontribusi

Kontribusi selalu diterima! Jika Anda menemukan bug atau memiliki saran perbaikan, silakan buat *Pull Request* atau ajukan *Issue* di repositori ini.

## 📄 Lisensi

Proyek ini berlisensi di bawah [MIT License](https://opensource.org/licenses/MIT).
