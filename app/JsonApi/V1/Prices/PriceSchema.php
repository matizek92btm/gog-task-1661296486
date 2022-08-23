<?php

namespace App\JsonApi\V1\Prices;

use App\Models\Price;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Number;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class PriceSchema extends Schema
{
    public static string $model = Price::class;

    public function fields(): array
    {
        return [
            ID::make(),
            Number::make('value'),
            Str::make('currency'),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function includePaths(): iterable
    {
        return [
            'product',
        ];
    }

    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }
}
