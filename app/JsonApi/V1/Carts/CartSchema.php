<?php

namespace App\JsonApi\V1\Carts;

use App\Models\Cart;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Number;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsTo;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class CartSchema extends Schema
{
    public static string $model = Cart::class;

    public function fields(): array
    {
        return [
            ID::make(),
            Number::make('max'),

            BelongsTo::make('user'),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function includePaths(): iterable
    {
        return [
            'user',
        ];
    }

    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }
}
