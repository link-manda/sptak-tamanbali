<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwigAwig extends Model
{
    protected $fillable = [
        'judul',
        'nomor_pasal',
        'deskripsi',
        'file_pdf',
        'nama_file_asli',
        'tanggal_ditetapkan',
        'urutan',
        'is_aktif',
    ];

    protected $casts = [
        'tanggal_ditetapkan' => 'date',
        'is_aktif' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * URL publik untuk mengunduh file PDF.
     */
    public function getFilePdfUrlAttribute(): ?string
    {
        return $this->file_pdf ? '/storage/'.ltrim($this->file_pdf, '/') : null;
    }

    /**
     * Label yang tampil pada tombol unduh.
     */
    public function getLabelUnduhAttribute(): string
    {
        return $this->nama_file_asli ?? 'Awig-Awig.pdf';
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}
