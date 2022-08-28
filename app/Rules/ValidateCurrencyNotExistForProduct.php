<?php

namespace App\Rules;

use App\Repositories\Contracts\PriceRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;

class ValidateCurrencyNotExistForProduct implements Rule
{
    public function __construct(private ?int $productId)
    {
    }

    public function passes($attribute, $value): bool
    {
        return ! app(PriceRepositoryInterface::class)->priceForProductIdAndCurrencyExist(
            $this->productId,
            $value
        );
    }

    public function message(): string
    {
        return trans('validation.price_with_currency_exist');
    }
}
