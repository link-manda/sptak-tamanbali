<?php

namespace App\Policies;

use App\Models\Transaksi;
use App\Models\User;

class TransaksiPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_keuangan']);
    }

    public function view(User $user, Transaksi $transaksi): bool
    {
        return in_array($user->role, ['admin', 'staf_keuangan']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_keuangan']);
    }

    public function update(User $user, Transaksi $transaksi): bool
    {
        return in_array($user->role, ['admin', 'staf_keuangan']);
    }

    public function delete(User $user, Transaksi $transaksi): bool
    {
        return $user->role === 'admin';
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }
}