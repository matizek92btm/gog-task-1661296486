<?php

namespace App\Rules;

use App\Enums\CartProductAmount;
use App\Services\Contracts\CartProductServiceInterface;
use Illuminate\Contracts\Validation\Rule;

class CheckProductAmount implements Rule
{
    public function __construct(private int $productId)
    {
    }

    public function passes($attribute, $value): bool
    {
        $productSumInCart = app(CartProductServiceInterface::class)->sumProductsInCart(
            $this->productId,
            auth()->user()->cart->id
        );

        return ! ($value > CartProductAmount::MAX->value || $productSumInCart + $value > CartProductAmount::MAX->value)

         ;
    }

    public function message(): string
    {
        return trans('validation.too_much_amount_for_the_same_product');
    }
}
