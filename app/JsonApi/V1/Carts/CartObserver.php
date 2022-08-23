<?php

namespace App\JsonApi\V1\Carts;

use App\Models\Cart;

class CartObserver
{
    public function creating(Cart $cart): void
    {
        $user = auth()->user();
        $cart->user()->associate($user);
    }
}
