<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'kategori_transaksi_id', 'user_id', 'jenis',
        'nominal', 'tanggal_transaksi', 'keterangan', 'bukti_file'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriTransaksi::class, 'kategori_transaksi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}