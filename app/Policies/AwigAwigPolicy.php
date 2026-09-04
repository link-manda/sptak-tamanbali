<?php

namespace App\Policies;

use App\Models\AwigAwig;
use App\Models\User;

class AwigAwigPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function view(User $user, AwigAwig $awigAwig): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function update(User $user, AwigAwig $awigAwig): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function delete(User $user, AwigAwig $awigAwig): bool
    {
        return $user->role === 'admin';
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }
}
