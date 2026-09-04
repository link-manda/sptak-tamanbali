<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProgramPrioritas extends Model
{
    protected $table = 'program_prioritas';

    protected $fillable = [
        'nama_program',
        'bidang',
        'deskripsi',
        'target_output',
        'penanggung_jawab',
        'tahun_anggaran',
        'estimasi_anggaran',
        'realisasi_anggaran',
        'persentase_progress',
        'status',
        'foto',
        'tanggal_mulai',
        'target_selesai',
        'urutan',
        'is_tampil_beranda',
        'is_aktif',
    ];

    protected $casts = [
        'tahun_anggaran' => 'integer',
        'estimasi_anggaran' => 'integer',
        'realisasi_anggaran' => 'integer',
        'persentase_progress' => 'integer',
        'tanggal_mulai' => 'date',
        'target_selesai' => 'date',
        'urutan' => 'integer',
        'is_tampil_beranda' => 'boolean',
        'is_aktif' => 'boolean',
    ];

    // Konstanta Bidang Tri Hita Karana
    const BIDANG_PARAHYANGAN = 'parahyangan';

    const BIDANG_PAWONGAN = 'pawongan';

    const BIDANG_PALEMAHAN = 'palemahan';

    const BIDANG_TATA_KELOLA = 'tata_kelola';

    // Konstanta Status Program
    const STATUS_DIRENCANAKAN = 'direncanakan';

    const STATUS_BERJALAN = 'berjalan';

    const STATUS_SELESAI = 'selesai';

    const STATUS_TERTUNDA = 'tertunda';

    /**
     * Opsi Bidang Program Tri Hita Karana.
     */
    public static function bidangOptions(): array
    {
        return [
            self::BIDANG_PARAHYANGAN => 'Parahyangan (Keagamaan & Pura)',
            self::BIDANG_PAWONGAN => 'Pawongan (Sosial & Budaya)',
            self::BIDANG_PALEMAHAN => 'Palemahan (Lingkungan & Fasilitas)',
            self::BIDANG_TATA_KELOLA => 'Tata Kelola & Digitalisasi',
        ];
    }

    /**
     * Opsi Status Pelaksanaan Program.
     */
    public static function statusOptions(): array
    {
        return [
            self::STATUS_DIRENCANAKAN => 'Direncanakan',
            self::STATUS_BERJALAN => 'Sedang Berjalan',
            self::STATUS_SELESAI => 'Selesai / Terlaksana',
            self::STATUS_TERTUNDA => 'Tertunda',
        ];
    }

    /**
     * Accessor URL Foto.
     */
    public function getFotoUrlAttribute(): ?string
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return Storage::disk('public')->url($this->foto);
        }

        return null;
    }

    /**
     * Label Bidang.
     */
    public function getBidangLabelAttribute(): string
    {
        return static::bidangOptions()[$this->bidang] ?? ucfirst($this->bidang);
    }

    /**
     * Label Singkat Bidang.
     */
    public function getBidangShortLabelAttribute(): string
    {
        return match ($this->bidang) {
            self::BIDANG_PARAHYANGAN => 'Parahyangan',
            self::BIDANG_PAWONGAN => 'Pawongan',
            self::BIDANG_PALEMAHAN => 'Palemahan',
            self::BIDANG_TATA_KELOLA => 'Tata Kelola',
            default => ucfirst($this->bidang),
        };
    }

    /**
     * Label Status.
     */
    public function getStatusLabelAttribute(): string
    {
        return static::statusOptions()[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Format Rupiah Estimasi Anggaran.
     */
    public function getEstimasiAnggaranRpAttribute(): string
    {
        return 'Rp '.number_format($this->estimasi_anggaran, 0, ',', '.');
    }

    /**
     * Format Rupiah Realisasi Anggaran.
     */
    public function getRealisasiAnggaranRpAttribute(): string
    {
        return 'Rp '.number_format($this->realisasi_anggaran, 0, ',', '.');
    }

    /**
     * Scope data aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    /**
     * Scope tampil di landing page.
     */
    public function scopeTampilBeranda($query)
    {
        return $query->where('is_tampil_beranda', true);
    }

    /**
     * Hook model: Hapus foto dari disk saat record dihapus.
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
