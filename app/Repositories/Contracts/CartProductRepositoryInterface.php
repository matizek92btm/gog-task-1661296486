<?php

namespace App\Repositories\Contracts;

interface CartProductRepositoryInterface
{
    public function sumProductsInCart(int $productId, int $cartId): int;

    public function calculatePriceForProductsInCart(int $cartId, string $currency): int;
}
