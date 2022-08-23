<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\AuthorizationServiceInterface;
use Illuminate\Support\Facades\Hash;

class AuthorizationService implements AuthorizationServiceInterface
{
    public function getAccess(string $email, string $password): User|bool
    {
        $user = User::whereEmail($email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            return false;
        }

        auth()->setUser($user);

        return $user;
    }
}
