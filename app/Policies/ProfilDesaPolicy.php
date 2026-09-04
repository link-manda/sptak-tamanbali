<?php

namespace App\Policies;

use App\Models\ProfilDesa;
use App\Models\User;

class ProfilDesaPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function view(User $user, ProfilDesa $profilDesa): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function update(User $user, ProfilDesa $profilDesa): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function delete(User $user, ProfilDesa $profilDesa): bool
    {
        return $user->role === 'admin';
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }
}
