<?php

namespace App\JsonApi\V1\Prices;

use App\Enums\CurrencyType;
use App\JsonApi\V1\Request;
use Illuminate\Validation\Rule;

class PriceRequest extends Request
{
    public function rules(): array
    {
        return [
            'value' => ['required', 'number'],
            'currency' => ['required', Rule::in(CurrencyType::valueArray())],
        ];
    }
}
