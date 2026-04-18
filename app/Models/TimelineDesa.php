<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineDesa extends Model
{
    protected $fillable = [
        'tahun_label',
        'judul',
        'deskripsi',
        'urutan',
    ];

    protected $casts = [
        'urutan' => 'integer',
    ];
}
