<?php

namespace App\JsonApi\V1;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;

abstract class Request extends ResourceRequest
{
    protected function prepareRules(iterable $rules, bool $rejectRequired = false): array
    {
        return collect($rules)
            ->when($rejectRequired, function (Collection $collection) {
                return $collection->map(fn (array $rules) => $this->rejectRequired($rules));
            })
            ->mapWithKeys(fn (array $rules, string $key) => [Str::camel($key) => $rules])
            ->toArray();
    }

    protected function rejectRequired(array $rules): array
    {
        return array_filter($rules, function ($rule) {
            return ! (is_string($rule) && preg_match('/^required(_if:|$)/', $rule));
        });
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        if ($this->isCreatingOrUpdating()) {
            $input = $this->input();
            $attributes = $this->prepareAttributesForValidation(Arr::get($input, 'data.attributes', []));

            Arr::set($input, 'data.attributes', $attributes);

            $this->replace($input);
        }
    }

    protected function prepareAttributesForValidation(array $attributes): array
    {
        return $attributes;
    }
}
