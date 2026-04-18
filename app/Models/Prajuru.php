<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prajuru extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'jabatan',
        'deskripsi',
        'foto',
        'urutan',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
        'urutan'   => 'integer',
    ];

    /**
     * Daftar jabatan preset untuk tipe Prajuru.
     */
    public static function jabatanOptions(): array
    {
        return [
            'Bendesa Adat'   => 'Bendesa Adat',
            'Penyarikan'     => 'Penyarikan',
            'Petengen'       => 'Petengen',
            'Petajuh'        => 'Petajuh',
            'Juru Raksa'     => 'Juru Raksa',
            'Kelian Banjar'  => 'Kelian Banjar',
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
