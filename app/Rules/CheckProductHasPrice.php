<?php

namespace App\Rules;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;

class CheckProductHasPrice implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value): bool
    {
        return ! (app(ProductRepositoryInterface::class)->get($value['id'])->prices->isEmpty());
    }

    public function message(): string
    {
        return trans('validation.product_without_prices');
    }
}
