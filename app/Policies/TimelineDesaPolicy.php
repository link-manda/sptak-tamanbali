<?php

namespace App\Policies;

use App\Models\TimelineDesa;
use App\Models\User;

class TimelineDesaPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function view(User $user, TimelineDesa $timelineDesa): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function update(User $user, TimelineDesa $timelineDesa): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function delete(User $user, TimelineDesa $timelineDesa): bool
    {
        return $user->role === 'admin';
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }
}
