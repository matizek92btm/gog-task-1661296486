<?php

namespace App\JsonApi\V1\Carts;

use App\JsonApi\V1\Request;
use App\Rules\CheckUniqueCart;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class CartRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'user' => [new CheckUniqueCart(), JsonApiRule::toOne()],
        ];

        if ($this->isCreating()) {
            $rules['user'][] = 'required';
        }

        return $rules;
    }
}
