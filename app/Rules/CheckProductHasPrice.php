<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class CheckProductHasPrice implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value): bool
    {
        return ! (Product::find($value['id'])->prices->isEmpty());
    }

    public function message(): string
    {
        return trans('validation.product_without_prices');
    }
}
