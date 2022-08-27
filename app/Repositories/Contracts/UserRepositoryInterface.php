<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface extends CRUDRepositoryInterface
{
    public function findByEmail(string $email): ?Model;
}
