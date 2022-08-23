<?php

namespace App\JsonApi\V1\Products;

use App\JsonApi\V1\Request;

class ProductRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'name' => ['required'],
        ];

        if ($this->isCreating()) {
            $rules['name'][] = 'unique:products';
        }

        if ($this->isUpdating()) {
            $rules['name'][] = 'unique:products,name,'.$this->json('data.id');
        }

        return $rules;
    }
}
