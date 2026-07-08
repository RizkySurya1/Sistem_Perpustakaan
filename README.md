# Sistem Perpustakaan

Sistem perpustakaan sederhana berbasis Laravel untuk mengelola data buku, anggota, peminjaman, pengembalian, dan laporan.

## Fitur Utama

- Login dan registrasi pengguna
- Manajemen data buku
- Manajemen data anggota
- Proses peminjaman dan pengembalian
- Export data ke Excel dan PDF
- Dashboard statistik sederhana
- Role akses admin dan petugas

## Role Pengguna

- Admin: dapat mengelola semua modul utama termasuk kategori buku
- Petugas: dapat mengelola data buku, anggota, peminjaman, dan pengembalian

## Persiapan Lokal

1. Install dependency:
   ```bash
   composer install
   npm install
   ```
2. Salin file environment:
   ```bash
   copy .env.example .env
   ```
3. Buat database MySQL dengan nama `perpustakaan`.
4. Generate app key:
   ```bash
   php artisan key:generate
   ```
5. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```
6. Buat link storage:
   ```bash
   php artisan storage:link
   ```
7. Jalankan aplikasi:
   ```bash
   php artisan serve
   ```

## Akun Default

Setelah seeding, akun berikut tersedia:

- Admin
  - Username: `admin`
  - Password: `password`
- Petugas
  - Username: `petugas`
  - Password: `password`

## Deploy ke Hosting

Untuk hosting seperti RumahWeb Entry, siapkan hal berikut:

1. Upload seluruh project ke folder domain Anda.
2. Arahkan document root ke folder `public`.
3. Buat file `.env` dari `.env.example` atau `.env.production.example`.
4. Isi konfigurasi database dan APP_URL.
5. Jalankan perintah:
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan key:generate
   php artisan migrate --force
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
6. Pastikan folder `storage` dan `bootstrap/cache` writable.

## Catatan

Aplikasi ini sudah disesuaikan untuk penggunaan lokal dengan database MySQL, dan juga sudah dilengkapi template konfigurasi produksi untuk hosting.
