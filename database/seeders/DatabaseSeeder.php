<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $films = [
            [
                'slug' => 'orbit-terakhir',
                'title' => 'Orbit Terakhir',
                'genre' => 'Fiksi ilmiah',
                'duration' => 118,
                'synopsis' => 'Saat stasiun riset kehilangan daya, seorang teknisi muda menangkap sinyal dari kapsul yang dianggap hilang bertahun-tahun. Ia punya satu putaran orbit untuk mencari sumbernya sebelum jalur pulang tertutup.',
                'poster' => 'orbit-terakhir',
            ],
            [
                'slug' => 'sebelum-fajar',
                'title' => 'Sebelum Fajar',
                'genre' => 'Drama',
                'duration' => 104,
                'synopsis' => 'Dua saudara kembali ke kota pesisir untuk membuka warung keluarga selama satu malam. Di antara pesanan terakhir dan matahari terbit, mereka harus menentukan apa yang masih ingin mereka pertahankan.',
                'poster' => 'sebelum-fajar',
            ],
            [
                'slug' => 'jalur-senyap',
                'title' => 'Jalur Senyap',
                'genre' => 'Misteri',
                'duration' => 110,
                'synopsis' => 'Konduktor kereta malam menemukan koper dengan namanya sendiri di gerbong terakhir. Saat satu per satu stasiun lenyap dari papan jadwal, ia mulai menanyai para penumpang.',
                'poster' => 'jalur-senyap',
            ],
            [
                'slug' => 'peta-hujan',
                'title' => 'Peta Hujan',
                'genre' => 'Petualangan',
                'duration' => 112,
                'synopsis' => 'Seorang kartografer menemukan bahwa peta warisan kakeknya hanya bisa dibaca saat hujan. Ia menyusuri kota perbukitan untuk mencari jalan yang menghilang dari semua peta lain.',
                'poster' => 'peta-hujan',
            ],
            [
                'slug' => 'nada-di-ujung-kota',
                'title' => 'Nada di Ujung Kota',
                'genre' => 'Drama musikal',
                'duration' => 107,
                'synopsis' => 'Gitaris muda merekam bunyi dari lingkungan tempat ia tumbuh untuk konser pertamanya. Ketika ia berlatih di atap, para tetangga mulai menambahkan nada mereka sendiri.',
                'poster' => 'nada-di-ujung-kota',
            ],
            [
                'slug' => 'penjaga-karang',
                'title' => 'Penjaga Karang',
                'genre' => 'Petualangan',
                'duration' => 121,
                'synopsis' => 'Seorang penyelam menemukan gerbang batu di antara terumbu yang ia lindungi. Menjelang musim badai, ia harus memutuskan kepada siapa ia bisa mempercayakan temuan itu.',
                'poster' => 'penjaga-karang',
                'release_in' => 5,
            ],
            [
                'slug' => 'rumah-nomor-tujuh',
                'title' => 'Rumah Nomor Tujuh',
                'genre' => 'Horor',
                'duration' => 98,
                'synopsis' => 'Setiap tengah malam, lampu rumah kosong di ujung jalan menyala sendiri. Seorang tetangga yang menyelidikinya menemukan foto rumah itu dengan dirinya berdiri di jendela.',
                'poster' => 'rumah-nomor-tujuh',
                'release_in' => 6,
            ],
            [
                'slug' => 'satu-putaran-lagi',
                'title' => 'Satu Putaran Lagi',
                'genre' => 'Drama olahraga',
                'duration' => 105,
                'synopsis' => 'Dua mantan rekan satu tim bertemu lagi di lintasan velodrom. Satu putaran penentu memaksa mereka memilih antara mempertahankan rekor atau menepati janji lama.',
                'poster' => 'satu-putaran-lagi',
                'release_in' => 8,
            ],
            [
                'slug' => 'kota-tanpa-bayang',
                'title' => 'Kota Tanpa Bayang',
                'genre' => 'Fiksi ilmiah',
                'duration' => 116,
                'synopsis' => 'Pada tengah hari, seluruh bayangan di sebuah kota lenyap. Seorang fotografer mengikuti satu bayangan yang tersisa dan menemukan bahwa waktunya sendiri mulai melambat.',
                'poster' => 'kota-tanpa-bayang',
                'release_in' => 7,
            ],
            [
                'slug' => 'surat-dari-utara',
                'title' => 'Surat dari Utara',
                'genre' => 'Drama',
                'duration' => 102,
                'synopsis' => 'Seorang penumpang feri menerima surat yang ditulis ibunya puluhan tahun lalu. Ia mengubah tujuan perjalanan demi mengantar surat itu kepada orang yang disebut di dalamnya.',
                'poster' => 'surat-dari-utara',
                'release_in' => 14,
            ],
            [
                'slug' => 'kereta-pukul-nol',
                'title' => 'Kereta Pukul Nol',
                'genre' => 'Thriller',
                'duration' => 109,
                'synopsis' => 'Sebuah lokomotif tiba di peron yang telah lama ditutup. Petugas malam menemukan daftar penumpang yang memuat nama warga kota yang masih hidup, termasuk namanya sendiri.',
                'poster' => 'kereta-pukul-nol',
                'release_in' => 21,
            ],
            [
                'slug' => 'black-panther',
                'title' => 'Black Panther',
                'genre' => 'Superhero',
                'duration' => 134,
                'synopsis' => 'T’Challa kembali ke Wakanda untuk menjadi raja. Ketika seorang penantang menggugat takhtanya, ia harus menentukan bagaimana Wakanda akan berhubungan dengan dunia di luar perbatasannya.',
                'poster' => 'studio/black-panther',
                'release_in' => 9,
            ],
            [
                'slug' => 'avengers-endgame',
                'title' => 'Avengers: Endgame',
                'genre' => 'Superhero',
                'duration' => 181,
                'synopsis' => 'Para Avengers yang tersisa berkumpul lagi setelah kekalahan mereka dari Thanos. Dengan satu peluang terakhir, mereka mencoba memulihkan apa yang telah hilang.',
                'poster' => 'studio/avengers-endgame',
                'release_in' => 10,
            ],
            [
                'slug' => 'titanic',
                'title' => 'Titanic',
                'genre' => 'Romansa',
                'duration' => 194,
                'synopsis' => 'Rose dan Jack bertemu dalam pelayaran perdana Titanic. Perbedaan kelas menguji hubungan mereka, lalu sebuah tabrakan mengubah perjalanan itu menjadi perjuangan untuk bertahan hidup.',
                'poster' => 'titanic',
                'release_in' => 11,
            ],
            [
                'slug' => 'top-gun-maverick',
                'title' => 'Top Gun: Maverick',
                'genre' => 'Aksi',
                'duration' => 131,
                'synopsis' => 'Pete “Maverick” Mitchell kembali melatih pilot tempur untuk sebuah misi berisiko tinggi. Salah satu pilotnya adalah putra rekan terbang yang pernah ia kehilangan.',
                'poster' => 'top-gun-maverick',
                'release_in' => 12,
            ],
        ];

        $today = today('Asia/Makassar')->toImmutable();
        $tomorrow = $today->addDay();

        foreach ($films as $index => $film) {
            $releaseIn = $film['release_in'] ?? null;
            unset($film['release_in']);
            $releaseDate = $releaseIn === null ? null : $today->addDays($releaseIn)->toDateString();

            DB::table('films')->upsert(
                [$film + ['release_date' => $releaseDate]],
                ['slug'],
                ['title', 'genre', 'duration', 'synopsis', 'poster'],
            );
            if ($releaseDate !== null) {
                DB::table('films')->where('slug', $film['slug'])->whereNull('release_date')
                    ->update(['release_date' => $releaseDate]);
            }

            $savedFilm = DB::table('films')->where('slug', $film['slug'])->first();
            $start = $savedFilm->release_date !== null && $savedFilm->release_date >= $today->toDateString()
                ? $today->setDateFrom($savedFilm->release_date)
                : $tomorrow->addDays($index % 3);

            foreach ([[0, 14, 35000], [0, 19, 45000], [1, 17, 40000]] as [$day, $hour, $price]) {
                $startsAt = $start->addDays($day)->setHour($hour)->utc()->toDateTimeString();

                DB::table('showtimes')->updateOrInsert([
                    'film_id' => $savedFilm->id,
                    'starts_at' => $startsAt,
                ], ['price' => $price]);
            }
        }
    }
}
