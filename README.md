# Layar Kota

Simulasi pemesanan tiket bioskop dengan Laravel, Blade, SQLite, CSS, dan JavaScript. Alurnya terdiri dari katalog film, rincian dan jadwal tayang, denah kursi dan data pemesan, lalu e-ticket.

## Dibuat oleh

| | |
| --- | --- |
| Nama | Miftah Farid |
| NPM | 2510010280 |
| Kelas | TI 3G Reguler Banjarmasin |

## Setup Laravel

Siapkan PHP 8.2 atau lebih baru dengan ekstensi PDO SQLite (`pdo_sqlite`), serta Composer.

Jalankan perintah berikut di PowerShell dari folder proyek.

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item database/database.sqlite -ItemType File
php artisan migrate --seed
php artisan serve
```

Buka [Layar Kota](http://127.0.0.1:8000) setelah server Laravel berjalan.
