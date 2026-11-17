# Coffee Shop Company Profile Website & Integrated CMS

Website profil perusahaan (company profile) kedai kopi modern yang responsif dan elegan dengan sistem pengelolaan konten mandiri (**Content Management System / CMS**) terintegrasi penuh. Proyek ini dibangun menggunakan **Laravel 13**, **MySQL**, **Tailwind CSS**, dan mengimplementasikan sistem desain **Google Stitch** secara presisi.

---

## ☕ Ringkasan Fitur

### 1. Website Publik (Public Website)
- **Beranda (Homepage):** Hero banner dinamis dengan foto resolusi tinggi, pengantar filosofi kedai, katalog menu pilihan (pilihan barista), pilar nilai brand, artikel edukasi kopi terkini, galeri suasana kedai, dan informasi jam buka serta lokasi.
- **Tentang Kami (About Us):** Narasi brand story, visi & misi bisnis, nilai-nilai keramahan sosial, dan komitmen terhadap kopi single origin lokal.
- **Katalog Menu (Menu Catalog):** Katalog produk lengkap dengan filter kategori (*Espresso Based, Manual Brew, Signature Drinks, Non-Coffee, Food & Snacks*), indikator ketersediaan stok (*Tersedia / Habis*), lencana menu unggulan, dan harga dalam Rupiah (IDR).
- **Artikel & Cerita Kopi (Articles):** Publikasi wawasan kopi dengan pencarian (*search*), filter kategori, pagination, serta halaman detail artikel dengan artikel terkait (*related articles*). Artikel draf tersimpan aman dan tidak muncul di publik.
- **Galeri Foto (Photo Gallery):** Dokumentasi visual suasana kedai dan aktivitas barista dengan filter kategori dan fitur **Lightbox Modal** interaktif.
- **Kontak & Lokasi (Contact & Location):** Alamat kedai, jam operasional hari kerja & akhir pekan, tautan media sosial, sematan peta Google Maps interaktif, dan formulir pesan kontak dengan validasi server-side dan proteksi CSRF.

### 2. Admin CMS (Content Management System)
- **Dashboard Ikhtisar:** Metrik statistik real-time dari database (total artikel terbit vs draf, jumlah produk menu tersedia, total foto galeri, pesan masuk yang belum dibaca), daftar aktivitas terbaru, dan pintasan akses cepat.
- **Manajemen Artikel:** CRUD lengkap artikel dengan pembuatan slug otomatis yang unik, kategori artikel, excerpt, editor teks terformat, pengunggahan foto sampul (file atau URL), dan kontrol status (*Draft / Published*).
- **Manajemen Menu:** CRUD lengkap produk menu, penentuan harga IDR, kategori sajian, tombol cepat pengubahan ketersediaan stok (*Toggle Availability*), dan penandaan menu unggulan (*Toggle Featured*).
- **Manajemen Galeri:** Pengunggahan foto galeri (mendukung file gambar ganda maupun URL), pengelompokan kategori galeri, judul, deskripsi, dan penghapusan berkas terintegrasi.
- **Manajemen Konten Website (Web Content Management):** Modul krusial untuk mengubah seluruh materi teks publik tanpa coding: headline & deskripsi hero beranda, teks & tujuan tombol CTA, pengantar filosofi, narasi cerita brand, visi & 3 pilar misi, informasi kontak, jam buka, URL embed Google Maps, tautan media sosial, serta deskripsi footer & teks hak cipta.
- **Pengaturan Identitas & Profil (Website Settings):** Pengaturan nama brand, slogan/tagline, deskripsi website, palet warna primer (*Espresso*) dan sekunder (*Caramel*), logo, favicon, serta pembaruan profil admin & penggantian kata sandi.

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 13.x, PHP 8.2+ (Teruji pada PHP 8.5)
- **Database:** MySQL 8.x (Eloquent ORM, Migrations, Seeders)
- **Frontend:** Laravel Blade Templates, HTML5, CSS3, JavaScript
- **Styling:** Tailwind CSS (Custom Color Tokens: Espresso `#38251E`, Cream `#F5F0E8`, Caramel `#B98255`, Beige `#D9C7B5`, Charcoal `#292522`)
- **Tipografi:** *Playfair Display* (Editorial Headlines) & *Poppins* (Interface & Body Text)
- **Ikonografi:** Google Material Symbols Outlined
- **Autentikasi & Keamanan:** Laravel Session Auth, Bcrypt Password Hashing, CSRF Protection, Server-side Validation, Middleware Auth Guard

---

## 📋 Prasyarat Sistem (Prerequisites)

Sebelum menjalankan aplikasi, pastikan komputer Anda telah terpasang:
1. **PHP:** Versi 8.2 atau lebih baru dengan ekstensi `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`.
2. **Composer:** Versi 2.x
3. **MySQL Database Server:** MySQL 8.0+ atau MariaDB 10.4+ (dapat menggunakan Laragon, XAMPP, atau MySQL standalone)
4. **Node.js & NPM:** Node.js v18+ dan NPM (untuk build Tailwind & Vite)

---

## 🚀 Panduan Instalasi & Menjalankan Aplikasi

### 1. Masuk ke Direktori Proyek
Buka terminal (PowerShell, Command Prompt, atau Terminal Linux/macOS) di folder proyek:
```bash
cd "d:\Artemis\coffeshop csm"
```

### 2. Instal Dependensi Composer & Node
```bash
composer install
npm install
```

### 3. Konfigurasi Lingkungan (.env)
Salin berkas `.env.example` ke `.env` (jika belum ada) dan sesuaikan kredensial database Anda:
```bash
cp .env.example .env
php artisan key:generate
```

Pastikan konfigurasi database di berkas `.env` sesuai dengan MySQL Anda (contoh default Laragon):
```ini
APP_NAME="Coffee Shop"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=coffeeshop_cms
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database MySQL
Buat database bernama `coffeeshop_cms` melalui MySQL CLI, phpMyAdmin, atau HeidiSQL:
```sql
CREATE DATABASE IF NOT EXISTS coffeeshop_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Jalankan Migrasi & Seeder Demonstrasi
Jalankan perintah berikut untuk membuat seluruh tabel database dan mengisi data sampel realistis (Bahasa Indonesia):
```bash
php artisan migrate --seed
```

### 6. Hubungkan Penyimpanan Berkas (Storage Link)
Buat symlink folder `storage/app/public` ke `public/storage` untuk mendukung berkas unggahan:
```bash
php artisan storage:link
```

### 7. Kompilasi Aset Frontend
Kompilasi CSS dan JavaScript:
```bash
npm run build
```
*(Atau gunakan `npm run dev` jika ingin menjalankan live-reloading saat pengembangan)*.

### 8. Jalankan Server Lokal
Jalankan server pengembangan Laravel:
```bash
php artisan serve
```
Website kini dapat diakses di browser pada alamat:
👉 **[http://localhost:8000](http://localhost:8000)**

---

## 🔐 Kredensial Akun Demo Administrator

Gunakan akun berikut untuk masuk ke dashboard **Admin CMS**:

| Parameter | Kredensial Demo |
|---|---|
| **URL Login** | [http://localhost:8000/admin/login](http://localhost:8000/admin/login) |
| **Email** | `admin@coffeeshop.test` |
| **Password** | `admin123` |
| **Hak Akses** | Administrator Penuh |

---

## 🧪 Menjalankan Pengujian Otomatis (Automated Tests)

Aplikasi dilengkapi dengan 21 pengujian otomatis (*Feature Tests*) yang mencakup seluruh halaman publik, otentikasi admin, proteksi route middleware, operasi CRUD artikel & menu, serta pengujian sinkronisasi konten real-time ke halaman publik.

Jalankan test suite dengan perintah:
```bash
php artisan test
```

Hasil pengujian yang diharapkan:
```
PASS  Tests\Unit\ExampleTest
PASS  Tests\Feature\ExampleTest
PASS  Tests\Feature\PublicPagesTest (8 tests)
PASS  Tests\Feature\AdminAuthTest (4 tests)
PASS  Tests\Feature\AdminCrudTest (7 tests)

Tests:    21 passed (62 assertions)
Duration: ~2.1s
```

---

## 🗂️ Struktur Direktori Proyek

```
d:\Artemis\coffeshop csm\
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/
│   │   │   ├── AuthController.php        # Login & logout admin
│   │   │   ├── DashboardController.php   # Statistik real-time & aktivitas
│   │   │   ├── ArticleController.php     # CRUD artikel & unggah sampul
│   │   │   ├── MenuController.php        # CRUD menu, stok, & unggulan
│   │   │   ├── GalleryController.php     # CRUD galeri foto
│   │   │   ├── ContentController.php     # Pengelolaan konten website publik
│   │   │   └── SettingsController.php    # Pengaturan identitas brand & profil
│   │   └── Public/
│   │       ├── HomeController.php        # Halaman Beranda publik
│   │       ├── AboutController.php       # Halaman Tentang Kami
│   │       ├── MenuController.php        # Halaman Katalog Menu & filter
│   │       ├── ArticleController.php     # Halaman Artikel & detail slug
│   │       ├── GalleryController.php     # Halaman Galeri foto & filter
│   │       └── ContactController.php     # Halaman Kontak & penyimpanan pesan
│   └── Models/
│       ├── User.php                      # Model Admin
│       ├── Article.php                   # Model Artikel (scopePublished)
│       ├── ArticleCategory.php           # Kategori Artikel
│       ├── MenuProduct.php               # Produk Menu (scopeAvailable, scopeFeatured)
│       ├── MenuCategory.php              # Kategori Menu
│       ├── GalleryImage.php              # Foto Galeri
│       ├── GalleryCategory.php           # Kategori Galeri
│       ├── WebsiteSetting.php            # Pengaturan Key-Value
│       ├── WebsiteContent.php            # Konten Section/Key
│       └── ContactMessage.php            # Pesan Pengunjung
├── database/
│   ├── migrations/                       # Migrasi 10 tabel database
│   └── seeders/DatabaseSeeder.php        # Data percontohan lengkap
├── resources/
│   ├── css/app.css                       # Konfigurasi Tailwind & Google Fonts
│   └── views/
│       ├── layouts/
│       │   ├── public.blade.php          # Tata letak utama website publik
│       │   └── admin.blade.php           # Tata letak dashboard CMS 260px sidebar
│       ├── public/                       # View publik (home, about, menu, artikel, galeri, kontak)
│       └── admin/                        # View CMS (auth, dashboard, artikel, menu, galeri, konten, pengaturan)
├── routes/web.php                        # Rute publik & rute admin terlindungi
├── stitch_coffee_shop_cms_website/       # Aset referensi visual Google Stitch (tetap terjaga)
└── tests/Feature/                        # Pengujian fitur otomatis
```

---

## 📄 Lisensi
Proyek ini dikembangkan sebagai materi proposal pengembangan website profil bisnis dan sistem manajemen konten kedai kopi.
"# Coffee" 
