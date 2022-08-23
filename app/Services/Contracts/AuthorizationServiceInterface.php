<?php

namespace App\Services\Contracts;

use App\Models\User;

interface AuthorizationServiceInterface
{
    public function getAccess(string $email, string $password): User|bool;
}
