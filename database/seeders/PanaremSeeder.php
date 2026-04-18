<?php

namespace Database\Seeders;

use App\Models\Pararem;
use Illuminate\Database\Seeder;

class PanaremSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'judul'              => 'Pararem Ketertiban Administrasi',
                'nomor_pararem'      => null,
                'status'             => 'aktif',
                'deskripsi'          => 'Mengatur standar pencatatan surat masuk, surat keluar, dan arsip digital untuk memastikan seluruh dokumen mudah ditelusuri.',
                'file_pdf'           => null,
                'nama_file_asli'     => null,
                'tanggal_ditetapkan' => null,
                'berlaku_mulai'      => null,
            ],
            [
                'judul'              => 'Pararem Pelaporan Keuangan Berkala',
                'nomor_pararem'      => null,
                'status'             => 'aktif',
                'deskripsi'          => 'Mewajibkan pelaporan kas dan realisasi kegiatan pada periode tertentu agar seluruh krama dapat memantau penggunaan dana desa.',
                'file_pdf'           => null,
                'nama_file_asli'     => null,
                'tanggal_ditetapkan' => null,
                'berlaku_mulai'      => null,
            ],
            [
                'judul'              => 'Pararem Dukungan Kegiatan Sosial Budaya',
                'nomor_pararem'      => null,
                'status'             => 'evaluasi',
                'deskripsi'          => 'Menentukan prioritas dukungan kegiatan upacara, kebersihan, dan program bersama antar banjar.',
                'file_pdf'           => null,
                'nama_file_asli'     => null,
                'tanggal_ditetapkan' => null,
                'berlaku_mulai'      => null,
            ],
        ];

        foreach ($items as $data) {
            Pararem::firstOrCreate(
                ['judul' => $data['judul']],
                $data
            );
        }
    }
}
