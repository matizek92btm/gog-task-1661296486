<?php

namespace App\JsonApi\V1\CartProducts;

use App\JsonApi\V1\Request;
use App\Rules\CheckProductAmount;
use App\Rules\CheckProductHasPrice;
use App\Rules\CheckProductToCartAddLimit;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class CartProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'amount' => ['required', new CheckProductAmount($this->json('data.relationships.product.data.id'))],
            'product' => [JsonApiRule::toOne(), new CheckProductHasPrice(), new CheckProductToCartAddLimit()],
        ];
    }
}
