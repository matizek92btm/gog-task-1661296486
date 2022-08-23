<?php

namespace App\JsonApi\V1\CartProducts;

use App\Enums\CartProductAmount;
use App\JsonApi\V1\Request;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class CartProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'amount' => 'required|digits_between:1, '.CartProductAmount::MAX->value,
            'product' => [JsonApiRule::toOne()],
        ];
    }
}
