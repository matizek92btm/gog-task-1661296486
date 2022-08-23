<?php

namespace App\JsonApi\V1\CartProducts;

use App\Models\CartProduct;

class CartProductObserver
{
    public function creating(CartProduct $cartProduct): void
    {
        $user = auth()->user();
        $cartProduct->cart()->associate($user->cart);
    }
}
