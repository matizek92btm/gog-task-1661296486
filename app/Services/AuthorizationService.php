<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\AuthorizationServiceInterface;
use Illuminate\Support\Facades\Hash;

class AuthorizationService implements AuthorizationServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function getAccess(string $email, string $password): User|bool
    {
        $user = $this->userRepository->findByEmail($email);

        if (! $user || ! Hash::check($password, $user->password)) {
            return false;
        }

        auth()->setUser($user);

        return $user;
    }
}
