<?php

namespace App\Policies;

use App\Enums\RoleSlug;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(Authenticatable $authenticatable): bool
    {
        return true;
    }

    public function view(Authenticatable $authenticatable, Product $product): bool
    {
        return true;
    }

    public function create(Authenticatable $authenticatable): bool
    {
        return $authenticatable->hasRole(RoleSlug::WORKER->value);
    }

    public function update(Authenticatable $authenticatable, Product $product): bool
    {
        return $authenticatable->hasRole(RoleSlug::WORKER->value);
    }

    public function delete(Authenticatable $authenticatable, Product $product): bool
    {
        return $authenticatable->hasRole(RoleSlug::WORKER->value);
    }

    public function restore(Authenticatable $authenticatable, Product $product): bool
    {
        return $authenticatable->hasRole(RoleSlug::WORKER->value);
    }
}
