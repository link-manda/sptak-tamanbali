<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use Notifiable;

    /**
     * Daftar seluruh role yang tersedia dalam sistem.
     */
    const ROLES = [
        'admin'          => 'Admin',
        'staf_admin'     => 'Staf Admin',
        'staf_keuangan'  => 'Staf Keuangan',
        'petajuh'        => 'Petajuh',
        'juru_raksa'     => 'Juru Raksa',
        'masyarakat'     => 'Masyarakat',
    ];

    /**
     * Role yang diperbolehkan mengakses panel admin Filament.
     */
    const PANEL_ROLES = [
        'admin',
        'staf_admin',
        'staf_keuangan',
        'petajuh',
        'juru_raksa',
    ];

    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar_url',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Method wajib dari FilamentUser untuk keamanan panel.
     * Petajuh & Juru Raksa kini bisa mengakses panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, self::PANEL_ROLES);
    }

    // ─── Helper Methods ───────────────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPrajuru(): bool
    {
        return in_array($this->role, ['admin', 'staf_admin', 'staf_keuangan', 'petajuh', 'juru_raksa']);
    }

    public function isPetajuh(): bool
    {
        return $this->role === 'petajuh';
    }

    public function isJuruRaksa(): bool
    {
        return $this->role === 'juru_raksa';
    }

    public function getRoleLabelAttribute(): string
    {
        return self::ROLES[$this->role] ?? ucfirst($this->role);
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}