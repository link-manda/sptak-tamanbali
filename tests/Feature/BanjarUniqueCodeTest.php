<?php

namespace Tests\Feature;

use App\Filament\Resources\Banjars\BanjarResource;
use App\Models\Banjar;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BanjarUniqueCodeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * U-5.1: Menguji ekstraksi inisial 2 huruf khas nama banjar Bali.
     */
    public function test_extract_prefix_generates_correct_initials_for_balinese_names(): void
    {
        $this->assertEquals('GG', Banjar::extractPrefix('Br. Adat Gaga'));
        $this->assertEquals('SL', Banjar::extractPrefix('Banjar Adat Siladan'));
        $this->assertEquals('UM', Banjar::extractPrefix('Banjar Adat Umanyar'));
        $this->assertEquals('BB', Banjar::extractPrefix('Banjar Batu Belig'));
        $this->assertEquals('KJ', Banjar::extractPrefix('Banjar Tamanbali Kaja'));
        $this->assertEquals('KL', Banjar::extractPrefix('Banjar Tamanbali Kelod'));
        $this->assertEquals('KL', Banjar::extractPrefix('Banjar Dinas Kelod'));
        $this->assertEquals('KH', Banjar::extractPrefix('Banjar Tamanbali Kauh'));
        $this->assertEquals('KN', Banjar::extractPrefix('Banjar Tamanbali Kangin'));
        $this->assertEquals('TN', Banjar::extractPrefix('Banjar Tamanbali Tengah'));
    }

    /**
     * U-5.2: Menguji edge cases ekstraksi prefix dan fallback ke TB.
     */
    public function test_extract_prefix_handles_edge_cases_and_falls_back_to_tb(): void
    {
        $this->assertEquals('TB', Banjar::extractPrefix(''));
        $this->assertEquals('TB', Banjar::extractPrefix(null));
        $this->assertEquals('TB', Banjar::extractPrefix('   '));
        $this->assertEquals('TB', Banjar::extractPrefix('12345'));
        $this->assertEquals('TB', Banjar::extractPrefix('Banjar Adat Tamanbali'));
        $this->assertEquals('AB', Banjar::extractPrefix('A'));
    }

    /**
     * U-5.3: Menguji format dan zero collision generator kode unik.
     */
    public function test_generate_unique_code_format_and_uniqueness(): void
    {
        $codes = [];

        for ($i = 0; $i < 50; $i++) {
            $code = Banjar::generateUniqueCode('Banjar Adat Gaga');
            $this->assertMatchesRegularExpression('/^GG-\d{5}$/', $code);
            $this->assertNotContains($code, $codes);

            $codes[] = $code;

            Banjar::create([
                'nama_banjar' => "Banjar Test {$i}",
                'kelian_banjar' => "Kelian {$i}",
                'kode_banjar' => $code,
            ]);
        }

        $this->assertCount(50, array_unique($codes));
    }

    /**
     * U-5.4: Menguji hook creating Banjar yang mengenerate kode otomatis jika kosong.
     */
    public function test_banjar_model_auto_generates_code_on_creation_when_empty(): void
    {
        $banjar = Banjar::create([
            'nama_banjar' => 'Br. Adat Siladan',
            'kelian_banjar' => 'I Wayan Siladan',
        ]);

        $this->assertNotNull($banjar->kode_banjar);
        $this->assertMatchesRegularExpression('/^SL-\d{5}$/', $banjar->kode_banjar);

        // Jika kode diinput manual, jangan override
        $customBanjar = Banjar::create([
            'nama_banjar' => 'Banjar Custom',
            'kelian_banjar' => 'I Ketut Custom',
            'kode_banjar' => 'CUST-0001',
        ]);

        $this->assertEquals('CUST-0001', $customBanjar->fresh()->kode_banjar);

        // Jika data banjar diupdate dengan kode kosong, pastikan otomatis digenerate ulang
        $customBanjar->update(['kode_banjar' => '']);
        $this->assertNotEmpty($customBanjar->fresh()->kode_banjar);
        $this->assertMatchesRegularExpression('/^CS-\d{5}$/', $customBanjar->fresh()->kode_banjar);
    }

    /**
     * U-5.5: Menguji normalisasi kode banjar menjadi huruf besar (UPPERCASE).
     */
    public function test_banjar_model_normalizes_code_to_uppercase(): void
    {
        $banjar = Banjar::create([
            'nama_banjar' => 'Banjar Gaga',
            'kelian_banjar' => 'I Made Gaga',
            'kode_banjar' => 'gg-99281',
        ]);

        $this->assertEquals('GG-99281', $banjar->fresh()->kode_banjar);

        $banjar->update(['kode_banjar' => 'custom-12345']);
        $this->assertEquals('CUSTOM-12345', $banjar->fresh()->kode_banjar);
    }

    /**
     * U-5.6: Menguji validasi keunikan database constraint, Filament attributes, dan tampilan publik.
     */
    public function test_banjar_filament_resource_renders_and_validates_uniqueness(): void
    {
        $banjar = Banjar::create([
            'nama_banjar' => 'Banjar Adat Gaga',
            'kelian_banjar' => 'I Wayan Gaga',
            'kode_banjar' => 'GG-88192',
        ]);

        // Verifikasi keunikan constraint di level database
        try {
            Banjar::create([
                'nama_banjar' => 'Banjar Duplikat',
                'kelian_banjar' => 'I Made Duplikat',
                'kode_banjar' => 'GG-88192',
            ]);
            $this->fail('Expected QueryException due to duplicate kode_banjar was not thrown');
        } catch (QueryException $e) {
            $this->assertTrue(true);
        }

        // Verifikasi global search attributes pada Filament Resource
        $searchAttrs = BanjarResource::getGloballySearchableAttributes();
        $this->assertContains('kode_banjar', $searchAttrs);

        // Verifikasi global search details
        $details = BanjarResource::getGlobalSearchResultDetails($banjar);
        $this->assertArrayHasKey('Kode', $details);
        $this->assertEquals('GG-88192', $details['Kode']);

        // Verifikasi halaman profil desa publik menampilkan badge kode unik banjar
        $response = $this->get(route('profil'));
        $response->assertStatus(200);
        $response->assertSee('GG-88192');
    }

    /**
     * U-5.7: Memastikan modul persuratan tetap terisolasi dan tidak terpengaruh oleh fitur kode banjar.
     */
    public function test_surat_modules_remain_isolated_and_unaffected(): void
    {
        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin.surat@tamanbali.desa.id',
            'password' => bcrypt('secret123'),
            'role' => 'admin',
        ]);

        $suratMasuk = SuratMasuk::create([
            'nomor_surat' => '005/TB/IX/2026',
            'tanggal_surat' => now(),
            'asal_surat' => 'Kantor Camat Bangli',
            'perihal' => 'Undangan Rapat Koordinasi',
            'user_id' => $user->id,
        ]);

        $this->assertEquals('005/TB/IX/2026', $suratMasuk->fresh()->nomor_surat);

        $suratKeluar = SuratKeluar::create([
            'nomor_surat' => '010/DESA-ADAT/TB/2026',
            'tanggal_surat' => now(),
            'tujuan_surat' => 'Bupati Bangli',
            'perihal' => 'Laporan Pararem',
            'user_id' => $user->id,
        ]);

        $this->assertEquals('010/DESA-ADAT/TB/2026', $suratKeluar->fresh()->nomor_surat);
    }
}
