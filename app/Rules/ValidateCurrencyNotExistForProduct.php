<?php

namespace App\Rules;

use App\Models\Price;
use Illuminate\Contracts\Validation\Rule;

class ValidateCurrencyNotExistForProduct implements Rule
{
    public function __construct(private ?int $productId)
    {
    }

    public function passes($attribute, $value): bool
    {
        if (! $this->productId) {
            return false;
        }

        return ! Price::whereProductId($this->productId)->whereCurrency($value)->exists();
    }

    public function message(): string
    {
        return trans('validation.cant_add_price');
    }
}
