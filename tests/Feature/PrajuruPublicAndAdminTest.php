<?php

namespace Tests\Feature;

use App\Models\Prajuru;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrajuruPublicAndAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_prajuru_public_page_renders_successfully(): void
    {
        Prajuru::create([
            'nama_lengkap' => 'Luh Putu Sri Anjani',
            'jabatan' => 'Kelian Banjar',
            'kategori' => Prajuru::CAT_KELIAN_BANJAR,
            'is_aktif' => true,
            'urutan' => 1,
        ]);

        $response = $this->get(route('prajuru'));

        $response->assertStatus(200);
        $response->assertSee('Luh Putu Sri Anjani');
        $response->assertSee('Kelian Banjar');
        $response->assertSee('Manggala Adat');
        $response->assertDontSee('Kelian Bala Angkep');
        $response->assertDontSee('Prajuru Inti');
    }

    public function test_prajuru_model_kategori_and_jabatan_options_contain_kelian_banjar_and_manggala_adat(): void
    {
        $kategoriOptions = Prajuru::kategoriOptions();
        $this->assertArrayHasKey(Prajuru::CAT_KELIAN_BANJAR, $kategoriOptions);
        $this->assertEquals('Kelian Banjar', $kategoriOptions[Prajuru::CAT_KELIAN_BANJAR]);
        $this->assertArrayHasKey(Prajuru::CAT_INTI, $kategoriOptions);
        $this->assertEquals('Manggala Adat', $kategoriOptions[Prajuru::CAT_INTI]);

        $jabatanOptions = Prajuru::jabatanOptions(Prajuru::CAT_KELIAN_BANJAR);
        $this->assertArrayHasKey('Kelian Banjar', $jabatanOptions);
    }
}
