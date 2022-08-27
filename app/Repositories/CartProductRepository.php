<?php

namespace App\Repositories;

use App\Repositories\Contracts\CartProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CartProductRepository implements CartProductRepositoryInterface
{
    public function __construct(private Model $cartProduct)
    {
    }

    public function sumProductsInCart(int $productId, int $cartId): int
    {
        return $this->cartProduct->whereProductId($productId)->whereCartId($cartId)->sum('amount');
    }

    public function calculatePriceForProductsInCart(int $cartId, string $currency): int
    {
        $sum = 0;
        $cartProducts = $this->cartProduct->with('product.prices')->whereCartId($cartId)->get();
        $cartProducts->each(function ($cartProduct) use (&$sum, $currency) {
            $sum += $cartProduct->product->prices()->where('currency', $currency)->first()->value * $cartProduct->amount;
        });

        return $sum;
    }
}
