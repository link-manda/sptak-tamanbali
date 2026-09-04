<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriTransaksi extends Model
{
    protected $fillable = [
        'nama_kategori',
        'jenis',
    ];

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'kategori_transaksi_id');
    }
}
