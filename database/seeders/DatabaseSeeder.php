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
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'id_role' => 1,
            ],
            [
                'username' => 'pengunjung',
                'email' => 'pengunjung@example.com',
                'password' => Hash::make('pengunjung'),
                'id_role' => 2,
            ],
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
            'kuota' => 100,
            'ticket_name' => 'Tiket Masuk Pantai',
            'price' => 25000,
            'deskripsi' => 'Tiket masuk untuk satu orang dewasa.'
        ]);
    }
}

class PemesananTiketSeeder extends Seeder
{
    public function run(): void
    {
        PemesananTiket::create([
        'total_ticket' => 2,
        'transaction_date' => Carbon::now(),
        'ordering_date' => Carbon::now()->subDays(1),
        'user_id' => 1,
        'ticket_id' => 1,
        'status_pemesanan_id' => 1  // ✅ BENAR
    ]);

    }
}

class StatusPemesananSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_pemesanan')->insert([
            ['status_name' => 'Berhasil'],
            ['status_name' => 'Gagal'],
            ['status_name' => 'Pending'],
        ]);
    }
}

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        KategoriBarang::insert([
            ['category_name' => 'Elektronik'],
            ['category_name' => 'Perlengkapan'],
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
        Inventaris::create([
            'item_name' => 'Kamera DSLR',
            'amount' => 5,
            'user_id' => 1,
            'category_id' => 1,
            'ketersediaan_id' => 1,
            'kelayakan_id' => 'KL001',
            'deskripsi' => 'Digunakan untuk dokumentasi wisata.'
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