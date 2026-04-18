<?php

namespace Database\Seeders;

use App\Models\ProfilDesa;
use App\Models\TimelineDesa;
use Illuminate\Database\Seeder;

class ProfilDesaSeeder extends Seeder
{
    public function run(): void
    {
        // Profil desa — singleton record
        ProfilDesa::firstOrCreate(
            ['id' => 1],
            [
                'narasi_singkat'  => 'Ruang hidup adat yang menjaga keseimbangan antara tradisi, pelayanan masyarakat, dan tata kelola digital yang terbuka.',
                'narasi_panjang'  => "Desa Adat Tamanbali membangun tata kelola yang menempatkan paruman sebagai pusat pengambilan keputusan, sementara administrasi modern membantu memastikan keputusan tersebut tercatat, dilaksanakan, dan dapat diawasi oleh warga.\n\nTransformasi digital bukan menggantikan adat, tetapi memperkuatnya: arsip surat menjadi rapi, keuangan lebih mudah dipantau, dan informasi penting lebih cepat menjangkau krama dari berbagai banjar.",
                'visi'            => null,
                'misi'            => null,
            ]
        );

        // Timeline sejarah desa
        $timelines = [
            [
                'tahun_label' => 'Awal 1900-an',
                'judul'       => 'Tumbuh sebagai pusat banjar adat',
                'deskripsi'   => 'Tamanbali berkembang sebagai ruang hidup adat yang menata kegiatan keagamaan, sosial, dan pengelolaan banjar berbasis musyawarah.',
                'urutan'      => 1,
            ],
            [
                'tahun_label' => 'Era Pembaruan Desa',
                'judul'       => 'Administrasi adat makin tertib',
                'deskripsi'   => 'Pencatatan warga, kegiatan desa, dan pengelolaan surat diperkuat untuk mendukung pelayanan yang lebih rapi dan terbuka.',
                'urutan'      => 2,
            ],
            [
                'tahun_label' => 'Transformasi Digital',
                'judul'       => 'Lahirnya portal transparansi',
                'deskripsi'   => 'Desa Adat Tamanbali mengadopsi sistem digital untuk membuka akses informasi keuangan dan administrasi kepada seluruh krama.',
                'urutan'      => 3,
            ],
        ];

        foreach ($timelines as $data) {
            TimelineDesa::firstOrCreate(
                ['judul' => $data['judul']],
                $data
            );
        }
    }
}
