<?php

namespace App\Repositories;

use App\Repositories\Contracts\CartProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
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

    public function getCartProductsByCardId(int $cartId): Collection
    {
        return $this->cartProduct->with('product.prices')->whereCartId($cartId)->get();
    }

    public function getPriceForProductCartByProductCartIdAndCurrency(int $cartProductId, string $currency): float
    {
        $price = $this->cartProduct->find($cartProductId)->product->prices()->where('currency', $currency)->first();

        return (float)$price->value;
    }
}
