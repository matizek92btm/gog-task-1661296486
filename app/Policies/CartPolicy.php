<?php

namespace App\Policies;

use App\Models\Cart;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class CartPolicy
{
    use HandlesAuthorization;

    public function create(Authenticatable $authenticatable): bool
    {
        return true;
    }

    public function view(Authenticatable $authenticatable, Cart $cart): bool
    {
        return $cart->user->is($authenticatable);
    }

    public function update(Authenticatable $authenticatable, Cart $cart): bool
    {
        return $cart->user->is($authenticatable);
    }

    public function delete(Authenticatable $authenticatable, Cart $cart): bool
    {
        return $cart->user->is($authenticatable);
    }
}
