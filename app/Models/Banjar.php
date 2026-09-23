<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banjar extends Model
{
    protected $fillable = ['nama_banjar', 'kelian_banjar', 'kode_banjar'];

    protected static function booted(): void
    {
        static::creating(function (Banjar $banjar) {
            if (blank($banjar->kode_banjar)) {
                $banjar->kode_banjar = static::generateUniqueCode($banjar->nama_banjar);
            }
        });

        static::saving(function (Banjar $banjar) {
            if (filled($banjar->kode_banjar)) {
                $banjar->kode_banjar = strtoupper(trim((string) $banjar->kode_banjar));
            }
        });
    }

    public static function extractPrefix(?string $name): string
    {
        if (blank($name)) {
            return 'TB';
        }

        // 1. Sanitasi karakter selain alfabet dan spasi
        $clean = preg_replace('/[^a-z\s]/', ' ', strtolower((string) $name));
        $words = array_values(array_filter(explode(' ', (string) $clean)));

        // 2. Filter kata umum / stop-words banjar di Bali
        $stopWords = ['banjar', 'br', 'adat', 'desa', 'dusun', 'lingkungan', 'tamanbali'];
        $meaningful = array_values(array_filter($words, fn ($w) => ! in_array($w, $stopWords)));

        if (empty($meaningful)) {
            return 'TB';
        }

        // 3. Jika >= 2 kata: ambil huruf pertama kata ke-1 dan kata ke-2
        if (count($meaningful) >= 2) {
            return strtoupper(substr($meaningful[0], 0, 1) . substr($meaningful[1], 0, 1));
        }

        // 4. Jika hanya 1 kata:
        $single = $meaningful[0];
        if (strlen($single) === 1) {
            return strtoupper($single . 'B');
        }

        $firstChar = substr($single, 0, 1);
        $vowels = ['a', 'e', 'i', 'o', 'u'];

        // Jika berawalan vokal (misal Umanyar -> UM)
        if (in_array($firstChar, $vowels)) {
            for ($i = 1; $i < strlen($single); $i++) {
                $char = substr($single, $i, 1);
                if (! in_array($char, $vowels)) {
                    return strtoupper($firstChar . $char);
                }
            }
            return strtoupper(substr($single, 0, 2));
        }

        // Jika berawalan konsonan (misal Gaga -> GG, Siladan -> SL, Kaja -> KJ)
        for ($i = 1; $i < strlen($single); $i++) {
            $char = substr($single, $i, 1);
            if (! in_array($char, $vowels)) {
                return strtoupper($firstChar . $char);
            }
        }

        return strtoupper(substr($single, 0, 2));
    }

    public static function generateUniqueCode(?string $name = null): string
    {
        $prefix = static::extractPrefix($name);

        for ($i = 0; $i < 20; $i++) {
            $code = sprintf('%s-%05d', $prefix, random_int(10000, 99999));
            if (! static::where('kode_banjar', $code)->exists()) {
                return $code;
            }
        }

        return sprintf('%s-%s', $prefix, strtoupper(substr(uniqid(), -5)));
    }

    public function kramas()
    {
        return $this->hasMany(Krama::class);
    }
}
