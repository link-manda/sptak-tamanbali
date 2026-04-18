<?php

namespace Database\Seeders;

use App\Models\Prajuru;
use Illuminate\Database\Seeder;

class PrajuruSeeder extends Seeder
{
    /**
     * Data awal berdasarkan hardcode yang ada di PublicController sebelumnya.
     */
    public function run(): void
    {
        $prajurus = [
            [
                'nama_lengkap' => 'I Made Dharma Putra',
                'jabatan'      => 'Bendesa Adat',
                'deskripsi'    => 'Memimpin arah kebijakan desa adat dan memastikan keputusan paruman dijalankan secara tertib.',
                'foto'         => null,
                'urutan'       => 1,
                'is_aktif'     => true,
            ],
            [
                'nama_lengkap' => 'Ni Luh Sri Ayuni',
                'jabatan'      => 'Penyarikan',
                'deskripsi'    => 'Mengelola administrasi persuratan, notulen rapat, dan dokumentasi keputusan desa adat.',
                'foto'         => null,
                'urutan'       => 2,
                'is_aktif'     => true,
            ],
            [
                'nama_lengkap' => 'I Ketut Arsana',
                'jabatan'      => 'Petengen',
                'deskripsi'    => 'Mengawasi pengelolaan keuangan, pencatatan kas, dan pelaporan transparansi desa.',
                'foto'         => null,
                'urutan'       => 3,
                'is_aktif'     => true,
            ],
        ];

        foreach ($prajurus as $data) {
            Prajuru::firstOrCreate(
                ['nama_lengkap' => $data['nama_lengkap'], 'jabatan' => $data['jabatan']],
                $data
            );
        }
    }
}
