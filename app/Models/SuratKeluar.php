<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $fillable = ['nomor_surat', 'tanggal_surat', 'tujuan_surat', 'perihal', 'file_surat', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}