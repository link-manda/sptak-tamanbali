<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pararem extends Model
{
    /**
     * Nama tabel disesuaikan dengan nama yang digunakan dalam migration.
     * Default Eloquent akan mencari 'pararems', padahal migration membuat 'panarems'.
     */
    protected $table = 'panarems';

    protected $fillable = [
        'judul',
        'nomor_pararem',
        'status',
        'deskripsi',
        'file_pdf',
        'nama_file_asli',
        'tanggal_ditetapkan',
        'berlaku_mulai',
    ];

    protected $casts = [
        'tanggal_ditetapkan' => 'date',
        'berlaku_mulai'      => 'date',
    ];

    /**
     * Pilihan status pararem.
     */
    public static function statusOptions(): array
    {
        return [
            'aktif'       => 'Aktif',
            'evaluasi'    => 'Evaluasi Tahunan',
            'tidak_aktif' => 'Tidak Aktif',
        ];
    }

    /**
     * Warna badge untuk status.
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'aktif'       => 'success',
            'evaluasi'    => 'warning',
            'tidak_aktif' => 'danger',
            default       => 'gray',
        };
    }

    /**
     * Label status yang ditampilkan.
     */
    public function getStatusLabelAttribute(): string
    {
        return static::statusOptions()[$this->status] ?? ucfirst($this->status);
    }

    /**
     * URL publik untuk mengunduh file PDF.
     */
    public function getFilePdfUrlAttribute(): ?string
    {
        if ($this->file_pdf) {
            return Storage::disk('public')->url($this->file_pdf);
        }

        return null;
    }

    /**
     * Label yang tampil pada tombol unduh.
     */
    public function getLabelUnduhAttribute(): string
    {
        return $this->nama_file_asli ?? 'Pararem.pdf';
    }
}
