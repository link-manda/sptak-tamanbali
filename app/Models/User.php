<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    // Method wajib dari FilamentUser untuk keamanan
    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya Admin, Staf Admin, dan Staf Keuangan yang bisa masuk panel
        return in_array($this->role, ['admin', 'staf_admin', 'staf_keuangan']);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}