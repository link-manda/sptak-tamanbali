<?php

namespace App\Policies;

use App\Models\ProgramPrioritas;
use App\Models\User;

class ProgramPrioritasPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function view(User $user, ProgramPrioritas $programPrioritas): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function update(User $user, ProgramPrioritas $programPrioritas): bool
    {
        return in_array($user->role, ['admin', 'staf_admin']);
    }

    public function delete(User $user, ProgramPrioritas $programPrioritas): bool
    {
        return $user->role === 'admin';
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }
}
