<?php

namespace App\Services;

use App\Repositories\CartProductRepository;
use App\Services\Contracts\CartProductServiceInterface;

class CartProductService implements CartProductServiceInterface
{
    public function __construct(private CartProductRepository $cartProductRepository)
    {
    }

    public function calculatePriceForProductsInCart(int $cartId, string $currency): float
    {
        $sum = 0;

        $cartProducts = $this->cartProductRepository->getCartProductsByCardId($cartId);

        $cartProducts->each(function ($cartProduct) use (&$sum, $currency) {
            $sum += $this->cartProductRepository->getPriceForProductCartByProductCartIdAndCurrency(
                $cartProduct->id,
                $currency
            ) * $cartProduct->amount;
        });

        return $sum;
    }
}
