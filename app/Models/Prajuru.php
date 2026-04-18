<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prajuru extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'kategori',
        'jabatan',
        'deskripsi',
        'foto',
        'urutan',
        'is_aktif',
    ];

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
     * Daftar jabatan preset (Saran).
     */
    public static function jabatanOptions(): array
    {
        return [
            'Bendesa Adat'     => 'Bendesa Adat',
            'Penyarikan'       => 'Penyarikan',
            'Petengen'         => 'Petengen',
            'Petajuh'          => 'Petajuh',
            'Juru Raksa'       => 'Juru Raksa',
            'Kelian Banjar'    => 'Kelian Banjar',
            'Kelian Bala'      => 'Kelian Bala',
            'Ketua Sabha'      => 'Ketua Sabha',
            'Anggota Sabha'    => 'Anggota Sabha',
            'Ketua Kerta'      => 'Ketua Kerta',
            'Anggota Kerta'    => 'Anggota Kerta',
        ];
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
