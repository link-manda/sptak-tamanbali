<?php

namespace App\Policies;

use App\Models\GaleriDesa;
use App\Models\User;

class GaleriDesaPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function view(User $user, GaleriDesa $galeriDesa): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function update(User $user, GaleriDesa $galeriDesa): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function delete(User $user, GaleriDesa $galeriDesa): bool
    {
        return $user->role === 'admin';
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }
}
