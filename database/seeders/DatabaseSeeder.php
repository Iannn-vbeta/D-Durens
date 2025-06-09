<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\ArtikelWisata;
use App\Models\ETicketing;
use App\Models\PemesananTiket;
use App\Models\KategoriBarang;
use App\Models\Ketersediaan;
use App\Models\Kelayakan;
use App\Models\Inventaris;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'user']
        ]);
    }
}

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            ['username' => 'admin', 'email' => 'admin@example.com', 'password' => Hash::make('admin123'), 'id_role' => 1],
            ['username' => 'pengunjung', 'email' => 'pengunjung@example.com', 'password' => Hash::make('pengunjung'), 'id_role' => 2],

            ['username' => 'admin1', 'email' => 'admin1@example.com', 'password' => Hash::make('password'), 'id_role' => 1],
            ['username' => 'admin2', 'email' => 'admin2@example.com', 'password' => Hash::make('password'), 'id_role' => 1],
            ['username' => 'admin3', 'email' => 'admin3@example.com', 'password' => Hash::make('password'), 'id_role' => 1],
            ['username' => 'admin4', 'email' => 'admin4@example.com', 'password' => Hash::make('password'), 'id_role' => 1],
            ['username' => 'admin5', 'email' => 'admin5@example.com', 'password' => Hash::make('password'), 'id_role' => 1],
            ['username' => 'admin6', 'email' => 'admin6@example.com', 'password' => Hash::make('password'), 'id_role' => 1],
            ['username' => 'admin7', 'email' => 'admin7@example.com', 'password' => Hash::make('password'), 'id_role' => 1],
            ['username' => 'admin8', 'email' => 'admin8@example.com', 'password' => Hash::make('password'), 'id_role' => 1],
            ['username' => 'admin9', 'email' => 'admin9@example.com', 'password' => Hash::make('password'), 'id_role' => 1],

            ['username' => 'andi',   'email' => 'andi@example.com',   'password' => Hash::make('andi1234'), 'id_role' => 2],
            ['username' => 'budi',   'email' => 'budi@example.com',   'password' => Hash::make('budi1234'), 'id_role' => 2],
            ['username' => 'citra',  'email' => 'citra@example.com',  'password' => Hash::make('citra123'), 'id_role' => 2],
            ['username' => 'dina',   'email' => 'dina@example.com',   'password' => Hash::make('dina1234'), 'id_role' => 2],
            ['username' => 'eko',    'email' => 'eko@example.com',    'password' => Hash::make('eko12345'), 'id_role' => 2],
            ['username' => 'fitri',  'email' => 'fitri@example.com',  'password' => Hash::make('fitri123'), 'id_role' => 2],
            ['username' => 'gina',   'email' => 'gina@example.com',   'password' => Hash::make('gina1234'), 'id_role' => 2],
            ['username' => 'hadi',   'email' => 'hadi@example.com',   'password' => Hash::make('hadi1234'), 'id_role' => 2],
            ['username' => 'intan',  'email' => 'intan@example.com',  'password' => Hash::make('intan123'), 'id_role' => 2],
        ]);
    }
}


class ArtikelWisataSeeder extends Seeder
{
    public function run(): void
    {
        ArtikelWisata::create([
            'title' => 'Wisata Pantai Indah',
            'description' => 'Menikmati keindahan pantai dengan pasir putih.',
            'created_at' => Carbon::now(),
            'user_id' => 1
        ]);
    }
}

class ETicketingSeeder extends Seeder
{
    public function run(): void
    {
        ETicketing::create([
            'kuota' => 50,
            'ticket_name' => 'Tiket Reguler',
            'price' => 15000,
            'deskripsi' => 'Tiket masuk untuk satu orang dan tidak menginap'
        ]);

        ETicketing::create([
            'kuota' => 55,
            'ticket_name' => 'Tiket Menginap',
            'price' => 40000,
            'deskripsi' => 'Tiket untuk satu orang dan dapat menginap'
        ]);
    }
}

class PemesananTiketSeeder extends Seeder
{
    public function run(): void
    {
        PemesananTiket::insert([
            [
                'total_ticket' => 2,
                'transaction_date' => Carbon::now(),
                'ordering_date' => Carbon::now()->subDays(1),
                'user_id' => 2,
                'ticket_id' => 1,
                'status_pemesanan_id' => 1
            ],
            [
                'total_ticket' => 1,
                'transaction_date' => Carbon::now()->subHours(2),
                'ordering_date' => Carbon::now()->subDays(1),
                'user_id' => 12,
                'ticket_id' => 2,
                'status_pemesanan_id' => 2
            ],
            [
                'total_ticket' => 3,
                'transaction_date' =>null,
                'ordering_date' => Carbon::now()->subDays(2),
                'user_id' => 13,
                'ticket_id' => 1,
                'status_pemesanan_id' => 3
            ],
            [
                'total_ticket' => 2,
                'transaction_date' => Carbon::now()->subHours(6),
                'ordering_date' => Carbon::now()->subDays(1),
                'user_id' => 14,
                'ticket_id' => 2,
                'status_pemesanan_id' => 2
            ],
            [
                'total_ticket' => 5,
                'transaction_date' => Carbon::now()->subDay(),
                'ordering_date' => Carbon::now()->subDays(2),
                'user_id' => 15,
                'ticket_id' => 2,
                'status_pemesanan_id' => 1
            ],
            [
                'total_ticket' => 1,
                'transaction_date' => null,
                'ordering_date' => Carbon::now()->subDay(),
                'user_id' => 16,
                'ticket_id' => 1,
                'status_pemesanan_id' => 3
            ],
            [
                'total_ticket' => 4,
                'transaction_date' => Carbon::now()->subHours(5),
                'ordering_date' => Carbon::now()->subDays(3),
                'user_id' => 17,
                'ticket_id' => 2,
                'status_pemesanan_id' => 2
            ],
            [
                'total_ticket' => 2,
                'transaction_date' => Carbon::now(),
                'ordering_date' => Carbon::now()->subDays(2),
                'user_id' => 18,
                'ticket_id' => 1,
                'status_pemesanan_id' => 1
            ],
            [
                'total_ticket' => 3,
                'transaction_date' => Carbon::now()->subHours(10),
                'ordering_date' => Carbon::now()->subDays(3),
                'user_id' => 19,
                'ticket_id' => 1,
                'status_pemesanan_id' => 2
            ],
            [
                'total_ticket' => 2,
                'transaction_date' => null,
                'ordering_date' => Carbon::now()->subDays(2),
                'user_id' => 20,
                'ticket_id' => 2,
                'status_pemesanan_id' => 3
            ],
            [
                'total_ticket' => 1,
                'transaction_date' => Carbon::now()->subHour(),
                'ordering_date' => Carbon::now()->subHours(26),
                'user_id' => 2,
                'ticket_id' => 2,
                'status_pemesanan_id' => 1
            ],
            [
                'total_ticket' => 2,
                'transaction_date' => null,
                'ordering_date' => Carbon::now()->subDays(3),
                'user_id' => 12,
                'ticket_id' => 1,
                'status_pemesanan_id' => 3
            ],
            [
                'total_ticket' => 6,
                'transaction_date' => Carbon::now()->subHours(4),
                'ordering_date' => Carbon::now()->subDay(),
                'user_id' => 13,
                'ticket_id' => 2,
                'status_pemesanan_id' => 2
            ],
            [
                'total_ticket' => 2,
                'transaction_date' => Carbon::now()->subDays(2),
                'ordering_date' => Carbon::now()->subDays(4),
                'user_id' => 14,
                'ticket_id' => 1,
                'status_pemesanan_id' => 1
            ],
            [
                'total_ticket' => 3,
                'transaction_date' => null,
                'ordering_date' => Carbon::now()->subDays(2),
                'user_id' => 15,
                'ticket_id' => 2,
                'status_pemesanan_id' => 3
            ],
        ]);
    }
}


class StatusPemesananSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_pemesanan')->insert([
            ['status_id' => 1, 'status_name' => 'Telah digunakan'],
            ['status_id' => 2, 'status_name' => 'Telah dibayar'],
            ['status_id' => 3, 'status_name' => 'Belum dibayar'],
        ]);
    }
}

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        KategoriBarang::insert([
            ['category_name' => 'Perlengkapan Renang'],
            ['category_name' => 'Souvenir Wisata'],
            ['category_name' => 'Peralatan Piknik'],
            ['category_name' => 'Mainan Air'],
            ['category_name' => 'Aksesori Outdoor'],
            ['category_name' => 'Perlengkapan Camping'],
            ['category_name' => 'Tas & Ransel Outdoor'],
            ['category_name' => 'Topi & Pelindung Matahari'],
            ['category_name' => 'Alat Fotografi & Aksesori'],
        ]);
    }
}


class KetersediaanSeeder extends Seeder
{
    public function run(): void
    {
        Ketersediaan::insert([
            ['status' => 'Tersedia'],
            ['status' => 'Tidak Tersedia'],
        ]);
    }
}

class KelayakanSeeder extends Seeder
{
    public function run(): void
    {
        Kelayakan::insert([
            ['kelayakan_id' => 'KL001', 'status' => 'Layak'],
            ['kelayakan_id' => 'KL002', 'status' => 'Tidak Layak'],
        ]);
    }
}

class InventarisSeeder extends Seeder
{
    public function run(): void
    {
        Inventaris::insert([
            [
                'item_name' => 'Kamera DSLR',
                'amount' => 5,
                'user_id' => 1,
                'category_id' => 9, // Alat Fotografi & Aksesori
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Digunakan untuk dokumentasi wisata.'
            ],
            [
                'item_name' => 'Pelampung Anak',
                'amount' => 10,
                'user_id' => 1,
                'category_id' => 1, // Perlengkapan Renang
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Pelampung untuk anak-anak di kolam renang.'
            ],
            [
                'item_name' => 'Gantungan Kunci Durian',
                'amount' => 200,
                'user_id' => 1,
                'category_id' => 2, // Souvenir Wisata
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Souvenir khas wisata buah durian.'
            ],
            [
                'item_name' => 'Tikar Piknik',
                'amount' => 25,
                'user_id' => 1,
                'category_id' => 3, // Peralatan Piknik
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Digunakan untuk duduk santai di kebun durian.'
            ],
            [
                'item_name' => 'Pelampung Ban',
                'amount' => 15,
                'user_id' => 1,
                'category_id' => 4, // Mainan Air
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Mainan air berbentuk ban untuk dewasa.'
            ],
            [
                'item_name' => 'Topi Jerami',
                'amount' => 30,
                'user_id' => 1,
                'category_id' => 8, // Topi & Pelindung Matahari
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Melindungi kepala dari sinar matahari saat tur kebun.'
            ],
            [
                'item_name' => 'Kompas Mini',
                'amount' => 12,
                'user_id' => 1,
                'category_id' => 5, // Aksesori Outdoor
                'ketersediaan_id' => 2,
                'kelayakan_id' => 'KL002',
                'deskripsi' => 'Kompas kecil untuk orientasi di hutan.'
            ],
            [
                'item_name' => 'Tenda 4 Orang',
                'amount' => 4,
                'user_id' => 1,
                'category_id' => 6, // Perlengkapan Camping
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Digunakan untuk camping di area wisata durian.'
            ],
            [
                'item_name' => 'Ransel Hiking',
                'amount' => 8,
                'user_id' => 1,
                'category_id' => 7, // Tas & Ransel Outdoor
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Ransel untuk pengunjung melakukan hiking ringan.'
            ],
            [
                'item_name' => 'Tripod Kamera',
                'amount' => 6,
                'user_id' => 1,
                'category_id' => 9,
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Digunakan untuk pengambilan gambar durian.'
            ],
            [
                'item_name' => 'Kamera Action Cam',
                'amount' => 3,
                'user_id' => 1,
                'category_id' => 9,
                'ketersediaan_id' => 2,
                'kelayakan_id' => 'KL002',
                'deskripsi' => 'Rusak dan belum diperbaiki.'
            ],
            [
                'item_name' => 'Kacamata Renang',
                'amount' => 20,
                'user_id' => 1,
                'category_id' => 1,
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Untuk pengunjung dewasa dan anak-anak.'
            ],
            [
                'item_name' => 'Baju Renang Dewasa',
                'amount' => 18,
                'user_id' => 1,
                'category_id' => 1,
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Bisa disewa untuk pengunjung.'
            ],
            [
                'item_name' => 'Souvenir Miniatur Pohon Durian',
                'amount' => 100,
                'user_id' => 1,
                'category_id' => 2,
                'ketersediaan_id' => 1,
                'kelayakan_id' => 'KL001',
                'deskripsi' => 'Miniatur pohon durian sebagai oleh-oleh.'
            ],
            [
                'item_name' => 'Matras Camping',
                'amount' => 10,
                'user_id' => 1,
                'category_id' => 6,
                'ketersediaan_id' => 2,
                'kelayakan_id' => 'KL002',
                'deskripsi' => 'Sudah tidak layak pakai.'
            ],
        ]);
    }
}


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            KategoriBarangSeeder::class,
            KetersediaanSeeder::class,
            KelayakanSeeder::class,
            ETicketingSeeder::class,
            ArtikelWisataSeeder::class,
            StatusPemesananSeeder::class,
            PemesananTiketSeeder::class,
            InventarisSeeder::class

        ]);
    }
}
