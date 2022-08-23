<?php

namespace App\JsonApi\V1\Prices;

use App\Enums\CurrencyType;
use App\JsonApi\V1\Request;
use App\Rules\ValidateCurrencyNotExistForProduct;
use Illuminate\Validation\Rule;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class PriceRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'value' => ['required', 'numeric'],
            'currency' => ['required', Rule::in(CurrencyType::valueArray())],
            'product' => [JsonApiRule::toOne()],
        ];

        if ($this->isCreating()) {
            $rules['currency'][] = new ValidateCurrencyNotExistForProduct(
                $this->json('data.relationships.product.data.id')
            );
        }

        return $rules;
    }
}
