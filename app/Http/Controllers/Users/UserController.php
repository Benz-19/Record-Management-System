<?php

namespace App\Http\Controllers\Users;

use App\Models\User;

class UserController
{
    public function renderAllUsers(): ?array
    {
        $user = new User();
        return $user->getAllUser() ?: null;
    }
}
