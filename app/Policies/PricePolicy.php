<?php

namespace App\Policies;

use App\Enums\RoleSlug;
use App\Models\Price;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class PricePolicy
{
    use HandlesAuthorization;

    public function create(Authenticatable $authenticatable): bool
    {
        return $authenticatable->hasRole(RoleSlug::WORKER->value);
    }

    public function update(Authenticatable $authenticatable, Price $price): bool
    {
        return $authenticatable->hasRole(RoleSlug::WORKER->value);
    }

    public function delete(Authenticatable $authenticatable, Price $price): bool
    {
        return $authenticatable->hasRole(RoleSlug::WORKER->value);
    }
}
