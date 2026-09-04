<?php

namespace Database\Seeders;

use App\Models\Banjar;
use App\Models\KategoriTransaksi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Seed initial master and admin data for production environment.
     */
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::firstOrCreate(
            ['email' => 'admin@tamanbali.desa.id'],
            [
                'name' => 'Administrator Desa Adat Tamanbali',
                'password' => Hash::make(env('INITIAL_ADMIN_PASSWORD', 'TamanbaliAdat2026!')),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Data Banjar Adat
        $banjars = [
            ['nama_banjar' => 'Banjar Tamanbali Kaja', 'kelian_banjar' => 'I Made Suardana'],
            ['nama_banjar' => 'Banjar Tamanbali Kelod', 'kelian_banjar' => 'I Nyoman Dana'],
            ['nama_banjar' => 'Banjar Tamanbali Kauh', 'kelian_banjar' => 'I Ketut Sukarja'],
            ['nama_banjar' => 'Banjar Tamanbali Kangin', 'kelian_banjar' => 'I Wayan Merta'],
            ['nama_banjar' => 'Banjar Tamanbali Tengah', 'kelian_banjar' => 'I Komang Sudira'],
        ];

        foreach ($banjars as $b) {
            Banjar::firstOrCreate(['nama_banjar' => $b['nama_banjar']], $b);
        }

        // 3. Kategori Transaksi Standar
        $kategoris = [
            ['nama_kategori' => 'Dana Punia Warga', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Dana Upacara Adat', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Bantuan Pemerintah', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Biaya Operasional Kantor', 'jenis' => 'pengeluaran'],
            ['nama_kategori' => 'Kebersihan & Lingkungan', 'jenis' => 'pengeluaran'],
            ['nama_kategori' => 'Kegiatan Sosial Adat', 'jenis' => 'pengeluaran'],
        ];

        foreach ($kategoris as $k) {
            KategoriTransaksi::firstOrCreate(['nama_kategori' => $k['nama_kategori']], $k);
        }

        // 4. Data Master Profil, Prajuru, Regulasi
        $this->call([
            PrajuruSeeder::class,
            ProfilDesaSeeder::class,
            AwigAwigSeeder::class,
            PanaremSeeder::class,
        ]);
    }
}
