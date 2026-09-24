<?php

namespace Tests\Feature;

use App\Filament\Resources\Kramas\KramaResource;
use App\Models\Banjar;
use App\Models\Krama;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KramaUniqueCodeTest extends TestCase
{
    use RefreshDatabase;

    private function createBanjar(string $nama, string $kelian = 'I Made Kelian'): Banjar
    {
        return Banjar::create([
            'nama_banjar' => $nama,
            'kelian_banjar' => $kelian,
        ]);
    }

    public function test_resolve_prefix_matches_correct_banjar_initials(): void
    {
        $kaja = $this->createBanjar('Banjar Tamanbali Kaja');
        $kelod = $this->createBanjar('Banjar Tamanbali Kelod');
        $kauh = $this->createBanjar('Banjar Tamanbali Kauh');
        $kangin = $this->createBanjar('Banjar Tamanbali Kangin');
        $tengah = $this->createBanjar('Banjar Tamanbali Tengah');
        $other = $this->createBanjar('Banjar Adat Sidan');

        $this->assertEquals('KJ', Krama::resolvePrefix($kaja->id));
        $this->assertEquals('KL', Krama::resolvePrefix($kelod->id));
        $this->assertEquals('KH', Krama::resolvePrefix($kauh->id));
        $this->assertEquals('KN', Krama::resolvePrefix($kangin->id));
        $this->assertEquals('TN', Krama::resolvePrefix($tengah->id));
        $this->assertEquals('SD', Krama::resolvePrefix($other->id));
        $this->assertEquals('TB', Krama::resolvePrefix(null));
        $this->assertEquals('TB', Krama::resolvePrefix(999999));
    }

    public function test_generate_unique_code_format_and_zero_collision(): void
    {
        $banjar = $this->createBanjar('Banjar Tamanbali Kaja');
        $codes = [];

        for ($i = 0; $i < 100; $i++) {
            $code = Krama::generateUniqueCode($banjar->id);
            $this->assertMatchesRegularExpression('/^KJ-KRM-\d{5}$/', $code);

            // Simpan record agar pengujian collision loop 20x benar-benar menguji eksistensi di DB
            Krama::create([
                'banjar_id' => $banjar->id,
                'kode_krama' => $code,
                'nama_lengkap' => "Warga {$i}",
                'alamat' => 'Tamanbali',
                'status_aktif' => true,
            ]);

            $codes[] = $code;
        }

        $this->assertCount(100, array_unique($codes));
    }

    public function test_krama_model_auto_generates_code_on_saving_when_empty(): void
    {
        $banjar = $this->createBanjar('Banjar Tamanbali Kelod');

        $krama = Krama::create([
            'banjar_id' => $banjar->id,
            'nama_lengkap' => 'I Wayan Balik',
            'alamat' => 'Banjar Kelod',
            'status_aktif' => true,
        ]);

        $this->assertNotEmpty($krama->kode_krama);
        $this->assertMatchesRegularExpression('/^KL-KRM-\d{5}$/', $krama->kode_krama);
    }

    public function test_krama_model_preserves_custom_code_and_normalizes_uppercase(): void
    {
        $banjar = $this->createBanjar('Banjar Tamanbali Kauh');

        $krama = Krama::create([
            'banjar_id' => $banjar->id,
            'kode_krama' => 'kh-krm-77881',
            'nama_lengkap' => 'I Made Suartana',
            'alamat' => 'Banjar Kauh',
            'status_aktif' => true,
        ]);

        $this->assertEquals('KH-KRM-77881', $krama->refresh()->kode_krama);
    }

    public function test_krama_database_unique_constraint_prevents_duplicate(): void
    {
        $banjar = $this->createBanjar('Banjar Tamanbali Tengah');

        Krama::create([
            'banjar_id' => $banjar->id,
            'kode_krama' => 'TN-KRM-11223',
            'nama_lengkap' => 'I Ketut Rai',
            'alamat' => 'Banjar Tengah',
            'status_aktif' => true,
        ]);

        $this->expectException(QueryException::class);

        Krama::create([
            'banjar_id' => $banjar->id,
            'kode_krama' => 'TN-KRM-11223',
            'nama_lengkap' => 'I Ketut Duplikat',
            'alamat' => 'Banjar Tengah',
            'status_aktif' => true,
        ]);
    }

    public function test_krama_filament_resource_searchable_attributes_contain_kode_krama(): void
    {
        $searchable = KramaResource::getGloballySearchableAttributes();
        $this->assertContains('kode_krama', $searchable);
        $this->assertContains('nama_lengkap', $searchable);
        $this->assertContains('alamat', $searchable);

        $banjar = $this->createBanjar('Banjar Tamanbali Kangin');
        $krama = Krama::create([
            'banjar_id' => $banjar->id,
            'kode_krama' => 'KN-KRM-55443',
            'nama_lengkap' => 'Ni Luh Putu Aryani',
            'alamat' => 'Banjar Kangin',
            'status_aktif' => true,
        ]);

        $details = KramaResource::getGlobalSearchResultDetails($krama);
        $this->assertArrayHasKey('Kode', $details);
        $this->assertEquals('KN-KRM-55443', $details['Kode']);
        $this->assertArrayHasKey('Banjar', $details);
        $this->assertEquals('Banjar Tamanbali Kangin', $details['Banjar']);
    }

    public function test_surat_modules_remain_isolated_and_unaffected(): void
    {
        $user = User::create([
            'name' => 'Staf Admin',
            'email' => 'admin_test@tamanbali.desa.id',
            'password' => bcrypt('password'),
            'role' => 'staf_admin',
        ]);

        $suratMasuk = SuratMasuk::create([
            'nomor_surat' => '001/SM/TB/IX/2026',
            'tanggal_surat' => '2026-09-24',
            'asal_surat' => 'Kantor Camat Bangli',
            'perihal' => 'Undangan Rapat Koordinasi',
            'user_id' => $user->id,
        ]);

        $suratKeluar = SuratKeluar::create([
            'nomor_surat' => '001/SK/TB/IX/2026',
            'tanggal_surat' => '2026-09-24',
            'tujuan_surat' => 'Dinas Kebudayaan Kab. Bangli',
            'perihal' => 'Laporan Kegiatan Adat',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('surat_masuks', ['id' => $suratMasuk->id, 'nomor_surat' => '001/SM/TB/IX/2026']);
        $this->assertDatabaseHas('surat_keluars', ['id' => $suratKeluar->id, 'nomor_surat' => '001/SK/TB/IX/2026']);
    }
}
