<?php

namespace App\Services;

use App\Models\User;

class UserProfileService
{
    public function isProfileComplete(User $user)
    {
        return $user->isProfileComplete();
    }
}
