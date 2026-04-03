<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

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
