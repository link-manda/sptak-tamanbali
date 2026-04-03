<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $fillable = ['nomor_surat', 'tanggal_surat', 'asal_surat', 'perihal', 'file_surat', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}