<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends CRUDRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?Model
    {
        return $this->model->whereEmail($email)->first();
    }
}
