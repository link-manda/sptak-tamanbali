<?php

namespace Database\Seeders;

use App\Models\Banjar;
use App\Models\KategoriTransaksi;
use App\Models\Krama;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TamanbaliDummySeeder extends Seeder
{
    public function run(): void
    {
        $this->truncateCoreTables();

        $users = $this->seedUsers();
        $banjars = $this->seedBanjars();
        $this->seedKramas($banjars);
        $kategoris = $this->seedKategoriTransaksi();
        $this->seedTransaksis($users, $kategoris);
        $this->seedSuratMasuk($users);
        $this->seedSuratKeluar($users);
    }

    private function truncateCoreTables(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Transaksi::truncate();
        SuratMasuk::truncate();
        SuratKeluar::truncate();
        Krama::truncate();
        KategoriTransaksi::truncate();
        Banjar::truncate();

        User::query()
            ->whereIn('email', [
                'admin@example.com',
                'staf.admin@example.com',
                'staf.keuangan@example.com',
            ])
            ->orWhere('email', 'like', 'warga.tamanbali%')
            ->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /** @return array<string, User> */
    private function seedUsers(): array
    {
        $password = Hash::make('password123');

        $admin = User::create([
            'name' => 'Admin Desa Tamanbali',
            'email' => 'admin@example.com',
            'password' => $password,
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $stafAdmin = User::create([
            'name' => 'Staf Administrasi Tamanbali',
            'email' => 'staf.admin@example.com',
            'password' => $password,
            'role' => 'staf_admin',
            'email_verified_at' => now(),
        ]);

        $stafKeuangan = User::create([
            'name' => 'Staf Keuangan Tamanbali',
            'email' => 'staf.keuangan@example.com',
            'password' => $password,
            'role' => 'staf_keuangan',
            'email_verified_at' => now(),
        ]);

        for ($i = 1; $i <= 12; $i++) {
            User::create([
                'name' => 'Warga Tamanbali ' . $i,
                'email' => sprintf('warga.tamanbali%02d@example.com', $i),
                'password' => $password,
                'role' => 'masyarakat',
                'email_verified_at' => now(),
            ]);
        }

        return [
            'admin' => $admin,
            'staf_admin' => $stafAdmin,
            'staf_keuangan' => $stafKeuangan,
        ];
    }

    /** @return \Illuminate\Support\Collection<int, Banjar> */
    private function seedBanjars()
    {
        $data = [
            ['nama_banjar' => 'Banjar Tamanbali Kaja', 'kelian_banjar' => 'I Made Suardana'],
            ['nama_banjar' => 'Banjar Tamanbali Kelod', 'kelian_banjar' => 'I Nyoman Dana'],
            ['nama_banjar' => 'Banjar Tamanbali Kauh', 'kelian_banjar' => 'I Ketut Sukarja'],
            ['nama_banjar' => 'Banjar Tamanbali Kangin', 'kelian_banjar' => 'I Wayan Merta'],
            ['nama_banjar' => 'Banjar Tamanbali Tengah', 'kelian_banjar' => 'I Komang Sudira'],
        ];

        $banjars = collect();

        foreach ($data as $row) {
            $banjars->push(Banjar::create($row));
        }

        return $banjars;
    }

    private function seedKramas($banjars): void
    {
        $faker = fake('id_ID');

        foreach ($banjars as $banjar) {
            for ($i = 1; $i <= 16; $i++) {
                Krama::create([
                    'banjar_id' => $banjar->id,
                    'nik' => $this->generateNik($banjar->id, $i),
                    'nama_lengkap' => $faker->name(),
                    'alamat' => 'Br. ' . $banjar->nama_banjar . ', Desa Tamanbali, Kec. Bangli',
                    'status_aktif' => $faker->boolean(85),
                ]);
            }
        }
    }

    /** @return \Illuminate\Support\Collection<int, KategoriTransaksi> */
    private function seedKategoriTransaksi()
    {
        $data = [
            ['nama_kategori' => 'Dana Punia Warga', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Dana Upacara Adat', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Bantuan Pemerintah', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Biaya Operasional Kantor', 'jenis' => 'pengeluaran'],
            ['nama_kategori' => 'Kebersihan & Lingkungan', 'jenis' => 'pengeluaran'],
            ['nama_kategori' => 'Kegiatan Sosial Adat', 'jenis' => 'pengeluaran'],
        ];

        $kategoris = collect();

        foreach ($data as $row) {
            $kategoris->push(KategoriTransaksi::create($row));
        }

        return $kategoris;
    }

    private function seedTransaksis(array $users, $kategoris): void
    {
        $faker = fake('id_ID');
        $start = Carbon::now()->subMonths(12)->startOfMonth();

        for ($i = 0; $i < 140; $i++) {
            $kategori = $kategoris->random();
            $tanggal = $start->copy()->addDays(random_int(0, 364));

            Transaksi::create([
                'kategori_transaksi_id' => $kategori->id,
                'user_id' => $kategori->jenis === 'pemasukan' ? $users['staf_keuangan']->id : $users['admin']->id,
                'jenis' => $kategori->jenis,
                'nominal' => $kategori->jenis === 'pemasukan'
                    ? random_int(250000, 7500000)
                    : random_int(100000, 4000000),
                'tanggal_transaksi' => $tanggal,
                'keterangan' => Str::of($faker->sentence(6))->trim()->append(' - Desa Tamanbali')->value(),
                'bukti_file' => null,
            ]);
        }
    }

    private function seedSuratMasuk(array $users): void
    {
        $asalSurat = [
            'Kantor Camat Bangli',
            'Dinas PMD Kabupaten Bangli',
            'Desa Adat Penglipuran',
            'Bendesa Adat Kubu',
            'Sekretariat Majelis Desa Adat Bali',
        ];

        $perihal = [
            'Undangan rapat koordinasi desa adat',
            'Pemberitahuan jadwal pembinaan adat',
            'Permohonan data administrasi desa',
            'Sosialisasi program tata kelola keuangan',
            'Koordinasi kegiatan budaya tingkat kecamatan',
        ];

        for ($i = 1; $i <= 36; $i++) {
            SuratMasuk::create([
                'nomor_surat' => sprintf('SM/TMB/%03d/%d', $i, now()->year),
                'tanggal_surat' => now()->subDays(random_int(1, 320))->toDateString(),
                'asal_surat' => $asalSurat[array_rand($asalSurat)],
                'perihal' => $perihal[array_rand($perihal)],
                'file_surat' => null,
                'user_id' => $users['staf_admin']->id,
            ]);
        }
    }

    private function seedSuratKeluar(array $users): void
    {
        $tujuanSurat = [
            'Kantor Camat Bangli',
            'Dinas Kebudayaan Kabupaten Bangli',
            'Majelis Desa Adat Kabupaten Bangli',
            'Kepala Desa Tamanbali',
            'Bendesa Adat se-Kecamatan Bangli',
        ];

        $perihal = [
            'Permohonan dukungan kegiatan adat',
            'Laporan administrasi bulanan',
            'Undangan paruman desa adat',
            'Pemberitahuan kegiatan gotong royong',
            'Pengajuan fasilitasi kegiatan budaya',
        ];

        for ($i = 1; $i <= 34; $i++) {
            SuratKeluar::create([
                'nomor_surat' => sprintf('SK/TMB/%03d/%d', $i, now()->year),
                'tanggal_surat' => now()->subDays(random_int(1, 320))->toDateString(),
                'tujuan_surat' => $tujuanSurat[array_rand($tujuanSurat)],
                'perihal' => $perihal[array_rand($perihal)],
                'file_surat' => null,
                'user_id' => $users['staf_admin']->id,
            ]);
        }
    }

    private function generateNik(int $banjarId, int $index): string
    {
        return str_pad((string) (5106_0000_0000 + ($banjarId * 10_000) + $index), 16, '0', STR_PAD_LEFT);
    }
}
