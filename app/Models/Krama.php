<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krama extends Model
{
    protected $fillable = [
        'banjar_id',
        'kode_krama',
        'nama_lengkap',
        'alamat',
        'status_aktif',
    ];

    protected static function booted(): void
    {
        static::saving(function (Krama $krama) {
            if (filled($krama->kode_krama)) {
                $krama->kode_krama = static::formatKodeKrama($krama->banjar_id, $krama->kode_krama);
            }
        });
    }

    public static function formatKodeKrama(?int $banjarId, ?string $number): string
    {
        $prefix = static::resolvePrefix($banjarId);
        $clean = preg_replace('/^[A-Za-z]{2}-KRM-/i', '', trim((string) $number));

        return filled($clean) ? sprintf('%s-KRM-%s', $prefix, strtoupper($clean)) : sprintf('%s-KRM-', $prefix);
    }

    public static function resolvePrefix(?int $banjarId = null): string
    {
        if (! $banjarId) {
            return 'TB';
        }

        $banjar = Banjar::find($banjarId);
        if (! $banjar || blank($banjar->nama_banjar)) {
            return 'TB';
        }

        $name = strtolower($banjar->nama_banjar);
        if (str_contains($name, 'kaja')) {
            return 'KJ';
        }
        if (str_contains($name, 'kelod')) {
            return 'KL';
        }
        if (str_contains($name, 'kauh')) {
            return 'KH';
        }
        if (str_contains($name, 'kangin')) {
            return 'KN';
        }
        if (str_contains($name, 'tengah')) {
            return 'TN';
        }

        // Fallback untuk variasi nama banjar lain
        $clean = preg_replace('/[^a-z\s]/', ' ', $name);
        $words = array_values(array_filter(explode(' ', (string) $clean)));
        $stopWords = ['banjar', 'br', 'adat', 'dinas', 'desa', 'dusun', 'lingkungan', 'tamanbali'];
        $meaningful = array_values(array_filter($words, fn ($w) => ! in_array($w, $stopWords)));

        if (empty($meaningful)) {
            return 'TB';
        }

        if (count($meaningful) >= 2) {
            return strtoupper(substr($meaningful[0], 0, 1).substr($meaningful[1], 0, 1));
        }

        $single = $meaningful[0];
        $firstChar = substr($single, 0, 1);
        $vowels = ['a', 'e', 'i', 'o', 'u'];

        for ($i = 1; $i < strlen($single); $i++) {
            $char = substr($single, $i, 1);
            if (! in_array($char, $vowels)) {
                return strtoupper($firstChar.$char);
            }
        }

        return strtoupper(substr($single, 0, 2));
    }

    public static function generateUniqueCode(?int $banjarId = null): string
    {
        $prefix = static::resolvePrefix($banjarId);

        for ($i = 0; $i < 20; $i++) {
            $code = sprintf('%s-KRM-%05d', $prefix, random_int(10000, 99999));
            if (! static::where('kode_krama', $code)->exists()) {
                return $code;
            }
        }

        return sprintf('%s-KRM-%s', $prefix, strtoupper(substr(uniqid(), -5)));
    }

    public function banjar()
    {
        return $this->belongsTo(Banjar::class);
    }
}
