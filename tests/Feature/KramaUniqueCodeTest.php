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

    public function test_format_kode_krama_stitches_prefix_and_manual_number(): void
    {
        $kaja = $this->createBanjar('Banjar Tamanbali Kaja');

        // Nomor murni tanpa prefix
        $this->assertEquals('KJ-KRM-001', Krama::formatKodeKrama($kaja->id, '001'));
        // Nomor dengan huruf kecil
        $this->assertEquals('KJ-KRM-001A', Krama::formatKodeKrama($kaja->id, '001a'));
        // Input sudah menyertakan prefix yang sama
        $this->assertEquals('KJ-KRM-10294', Krama::formatKodeKrama($kaja->id, 'kj-krm-10294'));
        // Jika nomor kosong, tetap kembalikan prefix dasar
        $this->assertEquals('KJ-KRM-', Krama::formatKodeKrama($kaja->id, ''));
    }

    public function test_format_kode_krama_swaps_prefix_when_banjar_changes_preserving_number(): void
    {
        $kaja = $this->createBanjar('Banjar Tamanbali Kaja');
        $kelod = $this->createBanjar('Banjar Tamanbali Kelod');

        // Misal user awalnya mengetik nomor untuk Banjar Kaja
        $codeKaja = Krama::formatKodeKrama($kaja->id, '042');
        $this->assertEquals('KJ-KRM-042', $codeKaja);

        // Saat banjar diganti ke Banjar Kelod, nomor 042 tetap dipertahankan dan prefix berganti ke KL
        $codeKelod = Krama::formatKodeKrama($kelod->id, $codeKaja);
        $this->assertEquals('KL-KRM-042', $codeKelod);
    }

    public function test_krama_model_preserves_manual_code_and_normalizes_uppercase(): void
    {
        $banjar = $this->createBanjar('Banjar Tamanbali Kauh');

        $krama = Krama::create([
            'banjar_id' => $banjar->id,
            'kode_krama' => 'kh-krm-007',
            'nama_lengkap' => 'I Made Suartana',
            'alamat' => 'Banjar Kauh',
            'status_aktif' => true,
        ]);

        $this->assertEquals('KH-KRM-007', $krama->refresh()->kode_krama);
    }

    public function test_krama_model_auto_prepends_prefix_on_saving_if_only_number_provided(): void
    {
        $banjar = $this->createBanjar('Banjar Tamanbali Kelod');

        $krama = Krama::create([
            'banjar_id' => $banjar->id,
            'kode_krama' => '125',
            'nama_lengkap' => 'I Wayan Balik',
            'alamat' => 'Banjar Kelod',
            'status_aktif' => true,
        ]);

        $this->assertEquals('KL-KRM-125', $krama->refresh()->kode_krama);
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
