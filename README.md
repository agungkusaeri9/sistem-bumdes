## Daftar Fitur Saat Ini

-   Login
-   Edit Profile
-   Edit Password
-   Manajemen User

## Persyaratan Sistem

Sebelum Anda memulai instalasi, pastikan komputer Anda memenuhi persyaratan sistem berikut:

-   PHP >= 8.1
-   Composer - [Panduan Instalasi Composer](https://getcomposer.org/doc/00-intro.md)
-   Node.js & NPM - [Panduan Instalasi Node.js](https://nodejs.org/)
-   Git - [Panduan Instalasi Git](https://git-scm.com/)

## Langkah 1: Clone Project

Buka aplikasi git yang sudah di download dan sesuaikan direktori nya, jika anda ingin disimpan di htdocs ketikan perintah berikut :

```bash
cd C:\xampp\htdocs
```

selanjutnya clone repositori proyek ini dari GitHub:

```bash
git clone https://github.com/agungkusaeri9/template-admin-laravel9-adminlte.git template-admin-laravel9-adminlte
```

## Langkah 2: Install Dependensi PHP

Anda perlu memasuki direktori proyek yang baru saja Anda clone dan menjalankan perintah berikut untuk menginstal semua dependensi PHP:

```bash
cd template-admin-laravel9-adminlte
composer install
```

## Langkah 3: Konfigurasi Lingkungan

Anda perlu menyalin file `.env.example` menjadi `.env` dan mengonfigurasi file `.env` sesuai dengan preferensi Anda:

```bash
cp .env.example .env
php artisan key:generate
```

## Langkah 4: Migrasi Database

Sesuaikan nama database, username, dan passwordnya, jika anda menggunakan xampp anda hanya menyesuaikan nama database nya saja, untuk mengkonfigurasi database di file `.env` seperti berikut :

```bash
DB_DATABASE=template_laravel
DB_USERNAME=root
DB_PASSWORD=
```

Kemudian anda perlu membuat tabel-tabel yang diperlukan sekaligus dibuatkan user untuk login, dengan menjalankan migrasi dan seeder database:

```bash
php artisan migrate --seed
```

## Langkah 5: Buat fungsi storage link

Agar yang berhubungan dengan gambar atau media lainnya di fungsi upload berjalan, tuliskan perintah berikut:

```bash
php artisan storage:link
```

## Langkah 6: Menjalankan server

Untuk menjalankan server, tuliskan perintah berikut:

```bash
php artisan serve
```

## Langkah 7: Instalasi NPM Dependencies

Untuk menginstal semua dependensi Node.js yang diperlukan, jalankan perintah berikut:

```bash
npm install
```

## Langkah 8: Kompilasi Asset

Untuk mengkompilasi asset, jalankan perintah berikut:

```bash
npm run dev
```

biarkan berjalan bersaamaan dengan server.

## Langkah 9 : Login ke Sistem

Setelah semuanya berjalan dengan lancar, silahkan buka google chrome dan akses

```bash
http://127.0.0.1:8000
```

Selanjutnya anda bisa melakukan login dengan :

-   Email : admin@gmail.com
-   Password : admin

## Selamat! Anda telah berhasil menginstal proyek tersebut.

Catatan : Fitur akan terus saya perbaharui, anda bisa mengklik start untuk updatean selanjutnya.
