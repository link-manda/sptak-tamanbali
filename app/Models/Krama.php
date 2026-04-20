<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krama extends Model
{
    protected $fillable = ['banjar_id', 'nama_lengkap', 'alamat', 'status_aktif'];

    public function banjar()
    {
        return $this->belongsTo(Banjar::class);
    }
}