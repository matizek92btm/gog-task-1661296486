<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CartProductRepositoryInterface
{
    public function sumProductsInCart(int $productId, int $cartId): int;

    public function getCartProductsByCardId(int $cartId): Collection;

    public function getPriceForProductCartByProductCartIdAndCurrency(int $cartProductId, string $currency): float;
}
