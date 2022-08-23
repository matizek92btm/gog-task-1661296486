<?php

namespace App\Services;

use App\Models\CartProduct;
use App\Services\Contracts\CartProductServiceInterface;

class CartProductService implements CartProductServiceInterface
{
    public function sumProductsInCart(int $productId, int $cartId): int
    {
        return CartProduct::whereProductId($productId)->whereCartId($cartId)->sum('amount');
    }

    public function calculatePriceForProductsInCart(int $cartId, string $currency): int
    {
        $sum = 0;
        $cartProducts = CartProduct::with('product.prices')->whereCartId($cartId)->get();
        $cartProducts->each(function ($cartProduct) use (&$sum, $currency) {
            $sum += $cartProduct->product->prices()->where('currency', $currency)->first()->value * $cartProduct->amount;
        });

        return $sum;
    }
}
