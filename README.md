# Rentel

Proyek website penyewaan mobil berbasis Laravel 12 dengan panel admin Filament 4 dan frontend Vite (React + Tailwind CSS v4). Ikuti panduan ini untuk menyiapkan lingkungan lokal.

## Prasyarat
- PHP 8.2+ dan Composer
- Node.js 18+ dan npm
- MySQL atau MariaDB (default DB_DATABASE=rentel)
- Ekstensi PHP standar Laravel (OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath)

## Setup Cepat
1) Instal dependensi
```bash
composer install
npm install
```
2) Salin dan konfigurasi env
```bash
cp .env.example .env
php artisan key:generate
```
   - Set `APP_URL`, `DB_*` sesuai database Anda. Tersedia koneksi `mysql_admin` opsional bila ingin memisah DB admin.
   - Set kredensial admin Filament sebelum seeding: `ADMIN_EMAIL`, `ADMIN_PASSWORD`, `ADMIN_NAME` (default: admin@example.com / password).
   - Nilai bawaan `QUEUE_CONNECTION=database` memakai tabel jobs; pastikan database sudah dimigrasi.
3) Migrasi, seeder, dan storage link
```bash
php artisan migrate --seed
php artisan storage:link
```
4) Jalankan aplikasi (pilih salah satu)
   - Terpisah: `php artisan serve` lalu `npm run dev`
   - Sekaligus dengan queue listener dan Vite (butuh npx): `composer run dev`
5) Buka http://127.0.0.1:8000

## Panel Admin (Filament)
- URL: `/admin`
- Guard: `admin`
- Kredensial default dari seeder: admin@example.com / password (ubah via env sebelum seeding atau langsung di DB).
- Upload gambar mobil tersimpan di `storage/app/public/cars`; `php artisan storage:link` wajib agar bisa diakses publik.

## Build/Deploy Produksi
```bash
npm run build       # build aset + SSR
php artisan migrate --force
php artisan optimize   # opsional: cache config/route/view
```
Jika `QUEUE_CONNECTION=database`, jalankan worker di background: `php artisan queue:work`.

## Endpoint Utama
- Publik: `/` (landing), `/cars` (katalog), `/book`, `/book/success`, `/my-bookings`
- Auth: `/login`, `/register`
- API JSON: `GET /api/cars` (mendukung filter query seperti `?type=suv&seats=5&max_price=500`)

## Perintah Bantu
- Setup sekali jalan (dev/staging, jalankan migrate otomatis): `composer run setup`
- Tes: `php artisan test`
