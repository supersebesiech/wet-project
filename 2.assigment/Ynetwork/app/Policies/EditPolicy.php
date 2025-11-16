<?php

namespace App\Policies;

use App\Models\User;

class EditPolicy
{
    public function edit(User $user, User $profileUser): bool
    {
        return $user->email === $profileUser->email;
    }
}
