<?php

namespace Database\Seeders;

use App\Models\AwigAwig;
use Illuminate\Database\Seeder;

class AwigAwigSeeder extends Seeder
{
    public function run(): void
    {
        $prinsips = [
            [
                'judul'              => 'Tertib Paruman',
                'nomor_pasal'        => 'Prinsip 1',
                'deskripsi'          => 'Setiap keputusan strategis desa adat diambil melalui musyawarah dan dituangkan dalam berita acara yang dapat dipertanggungjawabkan.',
                'file_pdf'           => null,
                'nama_file_asli'     => null,
                'tanggal_ditetapkan' => null,
                'urutan'             => 1,
                'is_aktif'           => true,
            ],
            [
                'judul'              => 'Gotong Royong Krama',
                'nomor_pasal'        => 'Prinsip 2',
                'deskripsi'          => 'Krama berperan aktif dalam kegiatan adat, sosial, dan kebersihan lingkungan sebagai bentuk ngayah dan tanggung jawab bersama.',
                'file_pdf'           => null,
                'nama_file_asli'     => null,
                'tanggal_ditetapkan' => null,
                'urutan'             => 2,
                'is_aktif'           => true,
            ],
            [
                'judul'              => 'Akuntabilitas Aset Adat',
                'nomor_pasal'        => 'Prinsip 3',
                'deskripsi'          => 'Pengelolaan keuangan, sarana upacara, dan aset desa dilakukan terbuka untuk menjaga kepercayaan warga.',
                'file_pdf'           => null,
                'nama_file_asli'     => null,
                'tanggal_ditetapkan' => null,
                'urutan'             => 3,
                'is_aktif'           => true,
            ],
            [
                'judul'              => 'Harmoni Sosial',
                'nomor_pasal'        => 'Prinsip 4',
                'deskripsi'          => 'Awig-awig menjaga hubungan yang seimbang antara sesama krama, prajuru, dan lingkungan desa.',
                'file_pdf'           => null,
                'nama_file_asli'     => null,
                'tanggal_ditetapkan' => null,
                'urutan'             => 4,
                'is_aktif'           => true,
            ],
        ];

        foreach ($prinsips as $data) {
            AwigAwig::firstOrCreate(
                ['judul' => $data['judul']],
                $data
            );
        }
    }
}
