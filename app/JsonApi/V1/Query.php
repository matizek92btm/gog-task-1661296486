<?php

namespace App\JsonApi\V1;

use LaravelJsonApi\Laravel\Http\Requests\ResourceQuery;
use LaravelJsonApi\Validation\Rule;

abstract class Query extends ResourceQuery
{
    public function rules(): array
    {
        return [
            'fields' => Rule::notSupported(),
            'filter' => Rule::notSupported(),
            'include' => ['nullable', 'string', Rule::includePaths()],
            'page' => Rule::notSupported(),
            'sort' => Rule::notSupported(),
            'withCount' => ['nullable', 'string', Rule::countable()],
        ];
    }
}
