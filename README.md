# Aplikasi Keuangan Pribadi

Aplikasi untuk mengelola keuangan rumah tangga / pribadi berbasis **Laravel 12** dan **FilamentPHP 4**.  
Membantu mencatat transaksi, mengatur anggaran, mengelola akun, hingga membuat laporan sederhana.

## Fitur

- [ ] **Akun Akuntansi** – Kelola berbagai akun (Cash, Bank, E-Wallet, Tabungan, Hutang, Piutang).
- [ ] **Laporan Keuangan** – Ringkasan pemasukan, pengeluaran, saldo, dan grafik keuangan.
- [ ] **Transaksi** – Catat transaksi pemasukan, pengeluaran, hutang, dan piutang.
- [ ] **Kategori Keuangan/Transaksi** – Kategorisasi transaksi untuk analisis lebih mudah.
- [ ] **Anggaran** – Tetapkan budget per kategori atau bulan.
- [ ] **Pengingat** – Notifikasi untuk transaksi berulang atau pembayaran tagihan.
- [ ] **Multi Pengguna** – Akses bersama dengan role berbeda (misalnya: admin, anggota keluarga).

## Teknologi

- [Laravel 12](https://laravel.com/) – Framework PHP modern
- [FilamentPHP 4](https://filamentphp.com/) – Admin panel & form builder
- [PHP ^8.2](https://www.php.net/) – Bahasa backend
- [SQLite/MySQL/PostgreSQL] – Database fleksibel
- [TailwindCSS](https://tailwindcss.com/) – Styling bawaan dari Filament

## Instalasi

1. Clone repository
   ```bash
   git clone https://github.com/username/finance-app.git
   cd finance-app
   ```

2. Install dependency

   ```bash
   composer install
   npm install && npm run build
   ```

3. Copy file `.env` lalu generate key

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Jalankan migrasi database

   ```bash
   php artisan migrate --seed
   ```

5. Jalankan server

   ```bash
   php artisan serve
   ```

6. Akses aplikasi di [http://localhost:8000](http://localhost:8000)

## Scripts Penting

* Jalankan development mode:

  ```bash
  composer dev
  ```

* Jalankan test:

  ```bash
  composer test
  ```

## Kontak

Website: [https://neon.web.id](https://neon.web.id)
Email: [neonwebid@gmail.com](mailto:neonwebid@gmail.com)
