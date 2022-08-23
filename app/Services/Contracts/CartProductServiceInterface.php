<?php

namespace App\Services\Contracts;

interface CartProductServiceInterface
{
    public function sumProductsInCart(int $productId, int $cartId): int;

    public function calculatePriceForProductsInCart(int $cartId, string $currency): int;
}
