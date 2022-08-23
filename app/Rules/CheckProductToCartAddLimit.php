<?php

namespace App\Rules;

use App\Enums\CartElementAmount;
use Illuminate\Contracts\Validation\Rule;

class CheckProductToCartAddLimit implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value): bool
    {
        $userCart = auth()->user()->cart;

        return ! ($userCart->cartProducts->count() >= CartElementAmount::MAX->value);
    }

    public function message()
    {
        return trans('validation.too_much_product_in_cart');
    }
}
