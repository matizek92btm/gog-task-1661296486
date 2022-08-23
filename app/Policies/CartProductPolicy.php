<?php

namespace App\Policies;

use App\Models\CartProduct;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class CartProductPolicy
{
    use HandlesAuthorization;

    public function create(Authenticatable $authenticatable): bool
    {
        return true;
    }

    public function delete(Authenticatable $authenticatable, CartProduct $cartProduct): bool
    {
        return $cartProduct->cart->is($authenticatable->cart);
    }

    public function view(Authenticatable $authenticatable, CartProduct $cart): bool
    {
        return true;
    }
}
