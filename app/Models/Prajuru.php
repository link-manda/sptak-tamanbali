<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prajuru extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'kategori',
        'parent_id',
        'jabatan',
        'deskripsi',
        'foto',
        'urutan',
        'is_aktif',
    ];

    /**
     * Relasi ke Atasan.
     */
    public function parent()
    {
        return $this->belongsTo(Prajuru::class, 'parent_id');
    }

    /**
     * Relasi ke Bawahan.
     */
    public function children()
    {
        return $this->hasMany(Prajuru::class, 'parent_id')->orderBy('urutan');
    }

    // Koleksi Kategori
    const CAT_INTI         = 'inti';
    const CAT_BALA_ANGKEP  = 'bala_angkep';
    const CAT_SABHA_DESA   = 'sabha_desa';
    const CAT_KERTA_DESA   = 'kerta_desa';

    /**
     * Daftar Kategori Prajuru.
     */
    public static function kategoriOptions(): array
    {
        return [
            self::CAT_INTI        => 'Prajuru Inti',
            self::CAT_BALA_ANGKEP => 'Kelian Bala Angkep',
            self::CAT_SABHA_DESA  => 'Sabha Desa',
            self::CAT_KERTA_DESA  => 'Kerta Desa',
        ];
    }

    /**
     * Daftar jabatan yang difilter berdasarkan kategori.
     */
    public static function jabatanOptions(?string $category = null): array
    {
        $mapping = [
            self::CAT_INTI => [
                'Bendesa Adat' => 'Bendesa Adat',
                'Penyarikan'   => 'Penyarikan',
                'Petengen'     => 'Petengen',
                'Petajuh'      => 'Petajuh',
                'Juru Raksa'   => 'Juru Raksa',
            ],
            self::CAT_BALA_ANGKEP => [
                'Kelian Bala' => 'Kelian Bala',
            ],
            self::CAT_SABHA_DESA => [
                'Ketua Sabha'   => 'Ketua Sabha',
                'Sekretaris'    => 'Sekretaris',
                'Anggota Sabha' => 'Anggota Sabha',
            ],
            self::CAT_KERTA_DESA => [
                'Ketua Kerta'   => 'Ketua Kerta',
                'Anggota Kerta' => 'Anggota Kerta',
            ],
        ];

        if ($category && isset($mapping[$category])) {
            return $mapping[$category];
        }

        // Gabungkan semua jika tidak ada kategori (untuk pencarian/filter global)
        $all = [];
        foreach ($mapping as $items) {
            $all = array_merge($all, $items);
        }
        return $all;
    }

    /**
     * URL foto profil, fallback ke placeholder jika tidak ada.
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto) {
            return \Storage::disk('public')->url($this->foto);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama_lengkap) . '&background=00236f&color=fff&size=128';
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}
