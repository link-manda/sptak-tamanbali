<?php

namespace App\Policies;

use App\Models\KategoriTransaksi;
use App\Models\User;

class KategoriTransaksiPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_keuangan']);
    }

    public function view(User $user, KategoriTransaksi $kategoriTransaksi): bool
    {
        return in_array($user->role, ['admin', 'staf_keuangan']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_keuangan']);
    }

    public function update(User $user, KategoriTransaksi $kategoriTransaksi): bool
    {
        return in_array($user->role, ['admin', 'staf_keuangan']);
    }

    public function delete(User $user, KategoriTransaksi $kategoriTransaksi): bool
    {
        return $user->role === 'admin';
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }
}
