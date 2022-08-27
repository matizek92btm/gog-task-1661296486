<?php

namespace App\Services\Contracts;

interface CartProductServiceInterface
{
    public function calculatePriceForProductsInCart(int $cartId, string $currency): float;
}
