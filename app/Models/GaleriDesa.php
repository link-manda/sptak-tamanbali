<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GaleriDesa extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'foto',
        'tanggal_kegiatan',
        'urutan',
        'is_aktif',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'is_aktif'         => 'boolean',
        'urutan'           => 'integer',
    ];

    const CAT_UPAKARA = 'upakara';
    const CAT_PARUMAN = 'paruman';
    const CAT_NGAYAH  = 'ngayah';
    const CAT_SITUS   = 'situs';
    const CAT_LAINNYA = 'lainnya';

    /**
     * Pilihan Kategori Dokumentasi Adat.
     */
    public static function kategoriOptions(): array
    {
        return [
            self::CAT_UPAKARA => 'Piodalan & Upakara',
            self::CAT_PARUMAN => 'Paruman & Musyawarah',
            self::CAT_NGAYAH  => 'Ngayah & Gotong Royong',
            self::CAT_SITUS   => 'Situs & Palemahan',
            self::CAT_LAINNYA => 'Kegiatan Lainnya',
        ];
    }

    /**
     * URL Foto Publik dengan fallback graceful.
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return Storage::disk('public')->url($this->foto);
        }

        return asset('images/batik_patern.jpeg');
    }

    /**
     * Label Kategori dalam Bahasa Indonesia.
     */
    public function getKategoriLabelAttribute(): string
    {
        return static::kategoriOptions()[$this->kategori] ?? ucfirst($this->kategori);
    }

    /**
     * Scope data aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    /**
     * Hook model: Hapus file fisik saat record dihapus.
     */
    protected static function booted()
    {
        static::deleting(function ($record) {
            if ($record->foto && Storage::disk('public')->exists($record->foto)) {
                Storage::disk('public')->delete($record->foto);
            }
        });
    }
}
