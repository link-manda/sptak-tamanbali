<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $fillable = [
        'narasi_singkat',
        'narasi_panjang',
        'visi',
        'misi',
    ];

    /**
     * Ambil satu-satunya record profil desa (singleton).
     * Jika belum ada, kembalikan objek kosong agar view tidak error.
     */
    public static function getSingleton(): static
    {
        return static::firstOrNew([]);
    }
}
