<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banjar extends Model
{
    protected $fillable = ['nama_banjar', 'kelian_banjar'];

    public function kramas()
    {
        return $this->hasMany(Krama::class);
    }
}