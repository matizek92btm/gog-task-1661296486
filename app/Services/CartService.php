<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use App\Services\Contracts\CartServiceInterface;

class CartService implements CartServiceInterface
{
    public function create(User $user): Cart
    {
        $cart = Cart::make();
        $cart->user()->associate($user);
        $cart->save();

        return $cart;
    }
}
