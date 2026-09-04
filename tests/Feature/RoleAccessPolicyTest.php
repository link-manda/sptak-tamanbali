<?php

namespace Tests\Feature;

use App\Models\AwigAwig;
use App\Models\GaleriDesa;
use App\Models\KategoriTransaksi;
use App\Models\Pararem;
use App\Models\Prajuru;
use App\Models\ProfilDesa;
use App\Models\ProgramPrioritas;
use App\Models\TimelineDesa;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class RoleAccessPolicyTest extends TestCase
{
    public function test_staf_keuangan_cannot_access_galeri_desa_and_program_prioritas(): void
    {
        $stafKeuangan = new User(['role' => 'staf_keuangan']);

        // Staf Keuangan dilarang akses GaleriDesa
        $this->assertFalse(Gate::forUser($stafKeuangan)->allows('viewAny', GaleriDesa::class));
        $this->assertFalse(Gate::forUser($stafKeuangan)->allows('create', GaleriDesa::class));

        // Staf Keuangan dilarang akses ProgramPrioritas
        $this->assertFalse(Gate::forUser($stafKeuangan)->allows('viewAny', ProgramPrioritas::class));
        $this->assertFalse(Gate::forUser($stafKeuangan)->allows('create', ProgramPrioritas::class));
    }

    public function test_staf_admin_and_admin_can_access_galeri_desa_and_program_prioritas(): void
    {
        $stafAdmin = new User(['role' => 'staf_admin']);
        $admin = new User(['role' => 'admin']);

        // Staf Admin diizinkan akses GaleriDesa & ProgramPrioritas
        $this->assertTrue(Gate::forUser($stafAdmin)->allows('viewAny', GaleriDesa::class));
        $this->assertTrue(Gate::forUser($stafAdmin)->allows('create', GaleriDesa::class));
        $this->assertTrue(Gate::forUser($stafAdmin)->allows('viewAny', ProgramPrioritas::class));
        $this->assertTrue(Gate::forUser($stafAdmin)->allows('create', ProgramPrioritas::class));

        // Admin diizinkan akses penuh
        $this->assertTrue(Gate::forUser($admin)->allows('viewAny', GaleriDesa::class));
        $this->assertTrue(Gate::forUser($admin)->allows('create', GaleriDesa::class));
        $this->assertTrue(Gate::forUser($admin)->allows('viewAny', ProgramPrioritas::class));
        $this->assertTrue(Gate::forUser($admin)->allows('create', ProgramPrioritas::class));
    }

    public function test_staf_keuangan_can_still_access_transaksi_and_kategori(): void
    {
        $stafKeuangan = new User(['role' => 'staf_keuangan']);
        $stafAdmin = new User(['role' => 'staf_admin']);

        // Staf Keuangan diizinkan akses Transaksi
        $this->assertTrue(Gate::forUser($stafKeuangan)->allows('viewAny', Transaksi::class));
        $this->assertTrue(Gate::forUser($stafKeuangan)->allows('viewAny', KategoriTransaksi::class));

        // Staf Admin dilarang akses Transaksi
        $this->assertFalse(Gate::forUser($stafAdmin)->allows('viewAny', Transaksi::class));
        $this->assertFalse(Gate::forUser($stafAdmin)->allows('viewAny', KategoriTransaksi::class));
    }

    public function test_customary_and_profile_policies_enforce_role_boundaries(): void
    {
        $stafKeuangan = new User(['role' => 'staf_keuangan']);
        $stafAdmin = new User(['role' => 'staf_admin']);
        $admin = new User(['role' => 'admin']);

        $models = [
            AwigAwig::class,
            Pararem::class,
            Prajuru::class,
            ProfilDesa::class,
            TimelineDesa::class,
        ];

        foreach ($models as $model) {
            // Staf Keuangan tidak boleh akses manajemen profil/regulasi
            $this->assertFalse(Gate::forUser($stafKeuangan)->allows('viewAny', $model));
            $this->assertFalse(Gate::forUser($stafKeuangan)->allows('create', $model));

            // Staf Admin boleh view & create
            $this->assertTrue(Gate::forUser($stafAdmin)->allows('viewAny', $model));
            $this->assertTrue(Gate::forUser($stafAdmin)->allows('create', $model));

            // Staf Admin tidak boleh delete (hanya admin yang boleh)
            $this->assertFalse(Gate::forUser($stafAdmin)->allows('deleteAny', $model));

            // Admin punya akses penuh
            $this->assertTrue(Gate::forUser($admin)->allows('viewAny', $model));
            $this->assertTrue(Gate::forUser($admin)->allows('create', $model));
            $this->assertTrue(Gate::forUser($admin)->allows('deleteAny', $model));
        }
    }
}
