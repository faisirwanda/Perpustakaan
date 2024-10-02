<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Rack;
use App\Models\User;
use App\Models\Category;
use App\Models\Cupboard;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // metode memangggil seeder lain
        $this->call([
            WorkSeeder::class,
            RoleSeeder::class,
            // tambahkan seeder lainnya di sini jika diperlukan
        ]);

        // User
        User::create([
            'id' => '12345',
            'username' => 'Anggota',
            'slug' => 'anggota',
            'role_id' => '2',
            'email' => 'irwanakagami@gmail.com',
            'work_id' => '3',
            'gender' => 'Laki-laki',
            'class' => 'X IPA 1',
            'address' => 'Labuhan',
            'status' => 'active',
            'password'  => bcrypt(12345),
        ]);
        User::create([
            'id' => '11111',
            'username' => 'Fais',
            'slug' => 'fais',
            'role_id' => '2',
            'email' => 'fais@gmail.com',
            'work_id' => '3',
            'gender' => 'Laki-laki',
            'class' => 'XII IPA 2',
            'address' => 'Labuhan',
            'status' => 'nonactive',
            'password'  => bcrypt(12345),
        ]);
        User::create([
            'id' => '22222',
            'username' => 'Guru',
            'slug' => 'guru',
            'role_id' => '2',
            'email' => 'guru@gmail.com',
            'work_id' => '2',
            'gender' => 'Laki-laki',
            'class' => '-',
            'address' => 'Labuhan',
            'status' => 'inactive',
            'password'  => bcrypt(12345),
        ]);
        User::create([
            'id' => '198204172009022007',
            'username' => 'Admin',
            'slug' => 'admin',
            'role_id' => '1',
            'email' => 'admin@gmail.com',
            'work_id' => '2',
            'gender' => 'Perempuan',
            'class' => '-',
            'address' => 'Blega',
            'status' => 'active',
            'password'  => bcrypt(12345),
        ]);
        User::create([
            'id' => '196707181990011001',
            'username' => 'Super Admin',
            'slug' => 'super-admin',
            'role_id' => '3',
            'email' => 'super@gmail.com',
            'work_id' => '1',
            'gender' => 'Laki-laki',
            'class' => '-',
            'address' => 'Sampang',
            'status' => 'active',
            'password'  => bcrypt(12345),
        ]);

        //Lemari 
        Cupboard::create([
            'id' => '1',
            'name' => 'Lemari 1'
        ]);
        Cupboard::create([
            'id' => '2',
            'name' => 'Lemari 2'
        ]);
        Cupboard::create([
            'id' => '3',
            'name' => 'Lemari 3'
        ]);
        Cupboard::create([
            'id' => '4',
            'name' => 'Lemari 4'
        ]);
        Cupboard::create([
            'id' => '5',
            'name' => 'Lemari 5'
        ]);

        // Rak
        Rack::create([
            'id' => '1',
            'name' => 'Rak 1'
        ]);
        Rack::create([
            'id' => '2',
            'name' => 'Rak 2'
        ]);
        Rack::create([
            'id' => '3',
            'name' => 'Rak 3'
        ]);
        Rack::create([
            'id' => '4',
            'name' => 'Rak 4'
        ]);

        // Kategori
        Category::create([
            'id' => '370',
            'name' => 'Pendidikan',
            'slug' => 'pendidikan',
        ]);
        Category::create([
            'id' => '150',
            'name' => 'Psikologi',
            'slug' => 'psikologi',
        ]);
        Category::create([
            'id' => '900',
            'name' => 'Geografi',
            'slug' => 'geografi',
        ]);
        Category::create([
            'id' => '300',
            'name' => 'Ilmu Ilmu Sosial',
            'slug' => 'ilmu-ilmu-sosial',
        ]);
        Category::create([
            'id' => '297',
            'name' => 'Agama Islam',
            'slug' => 'agama-islam',
        ]);
        Category::create([
            'id' => '800',
            'name' => 'Kesusastraan',
            'slug' => 'kesusastraan',
        ]);

        // Buku
        Book::create([
            'id' => '150-001',
            'category_id' => '150',
            'title' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif',
            'slug' => 'pengembangan-kepribadian-tinjauan-praktis-menuju-pribadi-positif',
            'author' => 'Inge Hutagalung',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2007',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '1',
            'cover' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif-1710601917.jpg',
        ]);
        Book::create([
            'id' => '150-002',
            'category_id' => '150',
            'title' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif',
            'slug' => 'pengembangan-kepribadian-tinjauan-praktis-menuju-pribadi-positif-2',
            'author' => 'Inge Hutagalung',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2007',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '1',
            'cover' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif-1710601935.jpg',
        ]);
        Book::create([
            'id' => '150-003',
            'category_id' => '150',
            'title' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif',
            'slug' => 'pengembangan-kepribadian-tinjauan-praktis-menuju-pribadi-positif-3',
            'author' => 'Inge Hutagalung',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2007',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '1',
            'cover' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif-1710601949.jpg',
        ]);
        Book::create([
            'id' => '150-004',
            'category_id' => '150',
            'title' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif',
            'slug' => 'pengembangan-kepribadian-tinjauan-praktis-menuju-pribadi-positif-4',
            'author' => 'Inge Hutagalung',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2007',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '1',
            'cover' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif-1710601965.jpg',
        ]);
        Book::create([
            'id' => '150-005',
            'category_id' => '150',
            'title' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif',
            'slug' => 'pengembangan-kepribadian-tinjauan-praktis-menuju-pribadi-positif-5',
            'author' => 'Inge Hutagalung',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2007',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '1',
            'cover' => 'Pengembangan Kepribadian Tinjauan Praktis Menuju Pribadi Positif-1710601980.jpg',
        ]);

        // buku 2
        Book::create([
            'id' => '370-001',
            'category_id' => '370',
            'title' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa',
            'slug' => 'kognitivisme-dalam-metodologi-pembelajaran-bahasa',
            'author' => 'Nazri Syakur',
            'publisher' => 'Insan Madana',
            'Edition' => '10',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '2',
            'cover' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa-1710602421.jpg',
        ]);
        Book::create([
            'id' => '370-002',
            'category_id' => '370',
            'title' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa',
            'slug' => 'kognitivisme-dalam-metodologi-pembelajaran-bahasa-2',
            'author' => 'Nazri Syakur',
            'publisher' => 'Insan Madana',
            'Edition' => '10',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '2',
            'cover' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa-1710602513.jpg',
        ]);
        Book::create([
            'id' => '370-003',
            'category_id' => '370',
            'title' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa',
            'slug' => 'kognitivisme-dalam-metodologi-pembelajaran-bahasa-3',
            'author' => 'Nazri Syakur',
            'publisher' => 'Insan Madana',
            'Edition' => '10',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '2',
            'cover' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa-1710602530.jpg',
        ]);
        Book::create([
            'id' => '370-004',
            'category_id' => '370',
            'title' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa',
            'slug' => 'kognitivisme-dalam-metodologi-pembelajaran-bahasa-4',
            'author' => 'Nazri Syakur',
            'publisher' => 'Insan Madana',
            'Edition' => '10',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '2',
            'cover' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa-1710602547.jpg',
        ]);
        Book::create([
            'id' => '370-005',
            'category_id' => '370',
            'title' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa',
            'slug' => 'kognitivisme-dalam-metodologi-pembelajaran-bahasa-5',
            'author' => 'Nazri Syakur',
            'publisher' => 'Insan Madana',
            'Edition' => '10',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '1',
            'rack_id' => '2',
            'cover' => 'Kognitivisme Dalam Metodologi Pembelajaran Bahasa-1710602562.jpg',
        ]);

        // buku 3
        Book::create([
            'id' => '900-001',
            'category_id' => '900',
            'title' => 'Mapping The Worl 5',
            'slug' => 'Mapping-The-Worl-5',
            'author' => 'Evea Peter',
            'publisher' => 'Pakar Raya',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '3',
            'cover' => 'Mapping The Worl 5-1710603431.jpg',
        ]);
        Book::create([
            'id' => '900-002',
            'category_id' => '900',
            'title' => 'Mapping The Worl 5',
            'slug' => 'Mapping-The-Worl-5-2',
            'author' => 'Evea Peter',
            'publisher' => 'Pakar Raya',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '3',
            'cover' => 'Mapping The Worl 5-1710603448.jpg',
        ]);
        Book::create([
            'id' => '900-003',
            'category_id' => '900',
            'title' => 'Mapping The Worl 5',
            'slug' => 'Mapping-The-Worl-5-3',
            'author' => 'Evea Peter',
            'publisher' => 'Pakar Raya',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '3',
            'cover' => 'Mapping The Worl 5-1710603492.jpg',
        ]);
        Book::create([
            'id' => '900-004',
            'category_id' => '900',
            'title' => 'Mapping The Worl 5',
            'slug' => 'Mapping-The-Worl-5-4',
            'author' => 'Evea Peter',
            'publisher' => 'Pakar Raya',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '3',
            'cover' => 'Mapping The Worl 5-1710603513.jpg',
        ]);
        Book::create([
            'id' => '900-005',
            'category_id' => '900',
            'title' => 'Mapping The Worl 5',
            'slug' => 'Mapping-The-Worl-5-5',
            'author' => 'Evea Peter',
            'publisher' => 'Pakar Raya',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '3',
            'cover' => 'Mapping The Worl 5-1710603531.jpg',
        ]);

        // Buku 4
        Book::create([
            'id' => '370-051',
            'category_id' => '370',
            'title' => 'Trik & Taktik Mengajar',
            'slug' => 'trik-&-taktik-mengajar',
            'author' => 'Paul Ginnis',
            'publisher' => 'Indeks',
            'Edition' => '2',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '4',
            'cover' => 'Trik & Taktik Mengajar-1710602645.jpg',
        ]);
        Book::create([
            'id' => '370-052',
            'category_id' => '370',
            'title' => 'Trik & Taktik Mengajar',
            'slug' => 'trik-&-taktik-mengajar-2',
            'author' => 'Paul Ginnis',
            'publisher' => 'Indeks',
            'Edition' => '2',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '4',
            'cover' => 'Trik & Taktik Mengajar-1710602665.jpg',
        ]);
        Book::create([
            'id' => '370-053',
            'category_id' => '370',
            'title' => 'Trik & Taktik Mengajar',
            'slug' => 'trik-&-taktik-mengajar-3',
            'author' => 'Paul Ginnis',
            'publisher' => 'Indeks',
            'Edition' => '2',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '4',
            'cover' => 'Trik & Taktik Mengajar-1710602725.jpg',
        ]);
        Book::create([
            'id' => '370-054',
            'category_id' => '370',
            'title' => 'Trik & Taktik Mengajar',
            'slug' => 'trik-&-taktik-mengajar-4',
            'author' => 'Paul Ginnis',
            'publisher' => 'Indeks',
            'Edition' => '2',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '4',
            'cover' => 'Trik & Taktik Mengajar-1710602792.jpg',
        ]);
        Book::create([
            'id' => '370-055',
            'category_id' => '370',
            'title' => 'Trik & Taktik Mengajar',
            'slug' => 'trik-&-taktik-mengajar-5',
            'author' => 'Paul Ginnis',
            'publisher' => 'Indeks',
            'Edition' => '2',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '2',
            'rack_id' => '4',
            'cover' => 'Trik & Taktik Mengajar-1710602830.jpg',
        ]);

        // Buku 5
        Book::create([
            'id' => '370-101',
            'category_id' => '370',
            'title' => 'Teknik Teknik Yang Berpengaruh di Kelas',
            'slug' => 'teknikteknik-yang-berpengaruh-di-kelas',
            'author' => 'Danie Baeulieu, PhD',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '1',
            'cover' => 'Teknik Teknik Yang Berpengaruh di Kelas-1710602873.jpg',
        ]);
        Book::create([
            'id' => '370-102',
            'category_id' => '370',
            'title' => 'Teknik Teknik Yang Berpengaruh di Kelas',
            'slug' => 'teknikteknik-yang-berpengaruh-di-kelas-2',
            'author' => 'Danie Baeulieu, PhD',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '1',
            'cover' => 'Teknik Teknik Yang Berpengaruh di Kelas-1710602891.jpg',
        ]);
        Book::create([
            'id' => '370-103',
            'category_id' => '370',
            'title' => 'Teknik Teknik Yang Berpengaruh di Kelas',
            'slug' => 'teknikteknik-yang-berpengaruh-di-kelas-3',
            'author' => 'Danie Baeulieu, PhD',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '1',
            'cover' => 'Teknik Teknik Yang Berpengaruh di Kelas-1710602909.jpg',
        ]);
        Book::create([
            'id' => '370-104',
            'category_id' => '370',
            'title' => 'Teknik Teknik Yang Berpengaruh di Kelas',
            'slug' => 'teknikteknik-yang-berpengaruh-di-kelas-4',
            'author' => 'Danie Baeulieu, PhD',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '1',
            'cover' => 'Teknik Teknik Yang Berpengaruh di Kelas-1710602956.jpg',
        ]);
        Book::create([
            'id' => '370-105',
            'category_id' => '370',
            'title' => 'Teknik Teknik Yang Berpengaruh di Kelas',
            'slug' => 'teknikteknik-yang-berpengaruh-di-kelas-5',
            'author' => 'Danie Baeulieu, PhD',
            'publisher' => 'Indeks',
            'Edition' => '1',
            'publication_year' => '2008',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '1',
            'cover' => 'Teknik Teknik Yang Berpengaruh di Kelas-1710602988.jpg',
        ]);

        // Buku 6
        Book::create([
            'id' => '300-001',
            'category_id' => '300',
            'title' => 'Zamrud Khatulistiwa Negeri Yang Indah',
            'slug' => 'zamrud-khatulistiwa-negeri-yang-indah',
            'author' => 'Sulisno, dkk',
            'publisher' => 'Citra Aji Parama',
            'Edition' => '1',
            'publication_year' => '2013',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '2',
            'cover' => 'Zamrud Khatulistiwa Negeri Yang Indah-1710602317.jpg',
        ]);
        Book::create([
            'id' => '300-002',
            'category_id' => '300',
            'title' => 'Zamrud Khatulistiwa Negeri Yang Indah',
            'slug' => 'zamrud-khatulistiwa-negeri-yang-indah-2',
            'author' => 'Sulisno, dkk',
            'publisher' => 'Citra Aji Parama',
            'Edition' => '1',
            'publication_year' => '2013',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '2',
            'cover' => 'Zamrud Khatulistiwa Negeri Yang Indah-1710602351.jpg',
        ]);
        Book::create([
            'id' => '300-003',
            'category_id' => '300',
            'title' => 'Zamrud Khatulistiwa Negeri Yang Indah',
            'slug' => 'zamrud-khatulistiwa-negeri-yang-indah-3',
            'author' => 'Sulisno, dkk',
            'publisher' => 'Citra Aji Parama',
            'Edition' => '1',
            'publication_year' => '2013',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '2',
            'cover' => 'Zamrud Khatulistiwa Negeri Yang Indah-1710602367.jpg',
        ]);
        Book::create([
            'id' => '300-004',
            'category_id' => '300',
            'title' => 'Zamrud Khatulistiwa Negeri Yang Indah',
            'slug' => 'zamrud-khatulistiwa-negeri-yang-indah-4',
            'author' => 'Sulisno, dkk',
            'publisher' => 'Citra Aji Parama',
            'Edition' => '1',
            'publication_year' => '2013',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '2',
            'cover' => 'Zamrud Khatulistiwa Negeri Yang Indah-1710602383.jpg',
        ]);
        Book::create([
            'id' => '300-005',
            'category_id' => '300',
            'title' => 'Zamrud Khatulistiwa Negeri Yang Indah',
            'slug' => 'zamrud-khatulistiwa-negeri-yang-indah-5',
            'author' => 'Sulisno, dkk',
            'publisher' => 'Citra Aji Parama',
            'Edition' => '1',
            'publication_year' => '2013',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '3',
            'rack_id' => '2',
            'cover' => 'Zamrud Khatulistiwa Negeri Yang Indah-1710602399.jpg',
        ]);

        // Buku 7
        Book::create([
            'id' => '297-001',
            'category_id' => '297',
            'title' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an",
            'slug' => "tafsir-al-mishbah-pesan-Kesan-dan-keserasian-Al-Qur'an",
            'author' => 'M. Quraish Shihab',
            'publisher' => 'Lentera Hati',
            'Edition' => '10',
            'publication_year' => '2018',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '3',
            'cover' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an-1710602063.jpg",
        ]);
        Book::create([
            'id' => '297-002',
            'category_id' => '297',
            'title' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an",
            'slug' => "tafsir-al-mishbah-pesan-Kesan-dan-keserasian-Al-Qur'an-2",
            'author' => 'M. Quraish Shihab',
            'publisher' => 'Lentera Hati',
            'Edition' => '10',
            'publication_year' => '2018',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '3',
            'cover' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an-1710602166.jpg",
        ]);
        Book::create([
            'id' => '297-003',
            'category_id' => '297',
            'title' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an",
            'slug' => "tafsir-al-mishbah-pesan-Kesan-dan-keserasian-Al-Qur'an-3",
            'author' => 'M. Quraish Shihab',
            'publisher' => 'Lentera Hati',
            'Edition' => '10',
            'publication_year' => '2018',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '3',
            'cover' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an-1710602249.jpg",
        ]);
        Book::create([
            'id' => '297-004',
            'category_id' => '297',
            'title' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an",
            'slug' => "tafsir-al-mishbah-pesan-Kesan-dan-keserasian-Al-Qur'an-4",
            'author' => 'M. Quraish Shihab',
            'publisher' => 'Lentera Hati',
            'Edition' => '10',
            'publication_year' => '2018',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '3',
            'cover' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an-1710602269.jpg",
        ]);
        Book::create([
            'id' => '297-005',
            'category_id' => '297',
            'title' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an",
            'slug' => "tafsir-al-mishbah-pesan-Kesan-dan-keserasian-Al-Qur'an-5",
            'author' => 'M. Quraish Shihab',
            'publisher' => 'Lentera Hati',
            'Edition' => '10',
            'publication_year' => '2018',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '3',
            'cover' => "Tafsir Al-Mishbah Pesan, Kesan, dan Keserasian Al-Qur'an-1710602284.jpg",
        ]);

        // Buku 8
        Book::create([
            'id' => '800-001',
            'category_id' => '800',
            'title' => "Negeri 5 Menara",
            'slug' => "negeri-5-menara",
            'author' => 'Ahmad Fuadi',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '4',
            'cover' => 'Negeri 5 Menara-1710603033.jpg',
        ]);
        Book::create([
            'id' => '800-002',
            'category_id' => '800',
            'title' => "Negeri 5 Menara",
            'slug' => "negeri-5-menara-2",
            'author' => 'Ahmad Fuadi',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '4',
            'cover' => 'Negeri 5 Menara-1710603059.jpg',
        ]);
        Book::create([
            'id' => '800-003',
            'category_id' => '800',
            'title' => "Negeri 5 Menara",
            'slug' => "negeri-5-menara-3",
            'author' => 'Ahmad Fuadi',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '4',
            'cover' => 'Negeri 5 Menara-1710603093.jpg',
        ]);
        Book::create([
            'id' => '800-004',
            'category_id' => '800',
            'title' => "Negeri 5 Menara",
            'slug' => "negeri-5-menara-4",
            'author' => 'Ahmad Fuadi',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '4',
            'cover' => 'Negeri 5 Menara-1710603111.jpg',
        ]);
        Book::create([
            'id' => '800-005',
            'category_id' => '800',
            'title' => "Negeri 5 Menara",
            'slug' => "negeri-5-menara-5",
            'author' => 'Ahmad Fuadi',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2009',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '4',
            'rack_id' => '4',
            'cover' => 'Negeri 5 Menara-1710603130.jpg',
        ]);

        // buku 9
        Book::create([
            'id' => '800-051',
            'category_id' => '800',
            'title' => "Tentang Kamu",
            'slug' => "tentang-kamu",
            'author' => 'Tere Liye',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2016',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '1',
            'cover' => 'Tentang Kamu-1710603152.jpg',
        ]);
        Book::create([
            'id' => '800-052',
            'category_id' => '800',
            'title' => "Tentang Kamu",
            'slug' => "tentang-kamu-2",
            'author' => 'Tere Liye',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2016',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '1',
            'cover' => 'Tentang Kamu-1710603169.jpg',
        ]);
        Book::create([
            'id' => '800-053',
            'category_id' => '800',
            'title' => "Tentang Kamu",
            'slug' => "tentang-kamu-3",
            'author' => 'Tere Liye',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2016',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '1',
            'cover' => 'Tentang Kamu-1710603202.jpg',
        ]);
        Book::create([
            'id' => '800-054',
            'category_id' => '800',
            'title' => "Tentang Kamu",
            'slug' => "tentang-kamu-4",
            'author' => 'Tere Liye',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2016',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '1',
            'cover' => 'Tentang Kamu-1710603222.jpg',
        ]);
        Book::create([
            'id' => '800-055',
            'category_id' => '800',
            'title' => "Tentang Kamu",
            'slug' => "tentang-kamu-5",
            'author' => 'Tere Liye',
            'publisher' => 'Gramedia Pustaka Utama',
            'Edition' => '1',
            'publication_year' => '2016',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '1',
            'cover' => 'Tentang Kamu-1710603239.jpg',
        ]);

        // buku 10
        Book::create([
            'id' => '800-101',
            'category_id' => '800',
            'title' => "Sang Pemimpi",
            'slug' => "sang-pemimpi",
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '2',
            'cover' => 'Sang Pemimpi-1710603320.jpg',
        ]);
        Book::create([
            'id' => '800-102',
            'category_id' => '800',
            'title' => "Sang Pemimpi",
            'slug' => "sang-pemimpi-2",
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '2',
            'cover' => 'Sang Pemimpi-1710603340.jpg',
        ]);
        Book::create([
            'id' => '800-103',
            'category_id' => '800',
            'title' => "Sang Pemimpi",
            'slug' => "sang-pemimpi-3",
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '2',
            'cover' => 'Sang Pemimpi-1710603367.jpg',
        ]);
        Book::create([
            'id' => '800-104',
            'category_id' => '800',
            'title' => "Sang Pemimpi",
            'slug' => "sang-pemimpi-4",
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '2',
            'cover' => 'Sang Pemimpi-1710603383.jpg',
        ]);
        Book::create([
            'id' => '800-105',
            'category_id' => '800',
            'title' => "Sang Pemimpi",
            'slug' => "sang-pemimpi-5",
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'Edition' => '1',
            'publication_year' => '2006',
            'book_condition' => 'Baik',
            'status' => 'Ada',
            'cupboard_id' => '5',
            'rack_id' => '2',
            'cover' => 'Sang Pemimpi-1710603411.jpg',
        ]);
        
    }
}
