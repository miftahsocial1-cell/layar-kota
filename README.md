# Layar Kota

Simulasi pemesanan tiket bioskop dengan Laravel, Blade, SQLite, CSS, dan JavaScript. Alurnya terdiri dari katalog film, rincian dan jadwal tayang, denah kursi dan data pemesan, lalu e-ticket.
Dibuat oleh:
Nama : Miftah Farid
NPM : 2510010280
Kelas : TI 3G Reguler Banjarmasin

## Jalankan secara lokal

Siapkan PHP 8.2 atau lebih baru dengan ekstensi PDO SQLite, serta Composer.

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item database/database.sqlite -ItemType File
php artisan migrate --seed
php artisan serve
```

Buka [Layar Kota](http://127.0.0.1:8000). Jika PHP berasal dari XAMPP dan belum ada di PATH, gunakan `C:\xampp\php\php.exe` sebagai pengganti `php` pada perintah Artisan.

Seeder membuat jadwal relatif terhadap hari ini dalam WITA. Jalankan `php artisan db:seed` untuk menambah jadwal baru ketika jadwal demo sudah lewat.

Film di bagian **Segera Tayang** mulai bisa dipesan pada tanggal rilis yang ditampilkan. Di halaman bukti pemesanan, pilih **Cetak e-ticket** untuk mencetak tiket atau menyimpannya sebagai PDF lewat dialog browser.

## Poster film

Sebelas poster film fiksi dibuat dengan ImageGen bawaan dan disimpan sebagai WebP di `public/posters/`. Setiap judul memakai pola prompt ini dengan adegan masing-masing.

> Use case: stylized-concept. Asset: standalone portrait theatrical film poster artwork for an Indonesian fictional cinema catalog. Scene: {adegan}. Refined cinematic composition, iconic central focal point inside the middle 60%, finely graded light, believable film grain, readable at thumbnail size. Full-bleed vertical 2:3 artwork. Image only; the site typesets the film title separately. No text, lettering, logo, border, or watermark.

- `orbit-terakhir` — a lone Indonesian space technician silhouetted at a damaged orbital station viewport, distant escape capsule and the lavender rim of a planet, retro futuristic violet and burnt orange, tension
- `sebelum-fajar` — two Indonesian siblings sitting in a modest coastal food stall just before sunrise, half-open shutters with a peach horizon and the ocean beyond, intimate naturalistic film still
- `jalur-senyap` — a lone conductor silhouette and an old suitcase in a near-empty Indonesian night train, narrow carriage vanishing point, moody forest-green shadows and amber lamps
- `peta-hujan` — a young Indonesian cartographer unfolding a weathered map on an open rain-soaked rooftop in a misty hillside city, deep blue monsoon sky and golden reflections
- `nada-di-ujung-kota` — a young Indonesian musician with an acoustic guitar standing on a city rooftop at blue hour, neighbors' lit windows, distant skyline, cobalt and sunset magenta
- `penjaga-karang` — an Indonesian free diver descending toward a coral reef and a submerged stone gate, rays of light, turquoise sea with rich orange coral
- `rumah-nomor-tujuh` — a narrow dark Indonesian colonial-era house behind an iron gate on a wet street, one upper window glowing red, quiet psychological horror
- `satu-putaran-lagi` — two Indonesian cyclists sprinting side by side down an outdoor velodrome at golden hour, graphic curved lanes, vivid rust red and cream, energetic sports drama
- `kota-tanpa-bayang` — an Indonesian city square under an unsettling vertical beam of noon sunlight, a woman with a pale umbrella at center, long architecture lines, surreal silver and teal atmosphere
- `surat-dari-utara` — a weathered handwritten envelope held beside an Indonesian ferry railing, distant mountains and layered blue waves at twilight, intimate melancholy
- `kereta-pukul-nol` — a black vintage locomotive pulling into a deserted tropical railway platform at midnight, ghostly steam and a single sodium-orange signal, midnight blue suspense

### Poster Hollywood

Judul Hollywood mengikuti jadwal pemutaran ulang demo Layar Kota. Poster studio untuk [Black Panther](https://movies.disney.com/black-panther) dan [Avengers: Endgame](https://www.marvel.com/movies/avengers-untitled) berada di `public/posters/studio/`.

Poster `titanic.webp` dan `top-gun-maverick.webp` dibuat dengan ImageGen bawaan.

> Use case: stylized-concept. Asset: Titanic (1997), an original fan-made cinema poster illustration, two young lovers seen from behind by the bow of a grand 1912 ocean liner with a golden sunset on the Atlantic, romantic historical drama. Full-bleed vertical 2:3 portrait, sharp cinematic focal point in the middle 60%, refined light and subtle film grain. Image only, website typesets the title. No text, lettering, studio logo, border, or watermark.

> Use case: stylized-concept. Asset: Top Gun: Maverick, an original fan-made cinema poster illustration, a fighter pilot viewed from behind on an aircraft carrier deck with two fighter jets crossing above, golden sunset and steel blue, aerial action blockbuster. Full-bleed vertical 2:3 portrait, sharp cinematic focal point in the middle 60%, refined light and subtle film grain. Image only, website typesets the title. No text, lettering, studio logo, border, or watermark.

## Logo

Ikon transparan dari ImageGen bawaan berada di `public/brand/layar-kota-icon.png` dan dipakai di header, footer, serta tab browser.

> Use case: logo-brand. Create a single icon-only logo for Layar Kota, an Indonesian cinema ticket website with a dark aubergine theme and warm peach accents. A compact vintage cinema admission ticket silhouette with clear notches and a bold play triangle knocked out at its center; a small four-point projection sparkle integrated as a simple accent near the top right. Flat graphic, clean geometry, minimal, large readable forms at favicon size, warm peach and creamy gold on actual transparency. Center a square icon with tight but safe 8% transparent padding. No text, no initials, no border around the canvas, no drop shadow, no gradients, no background, no mockup.
