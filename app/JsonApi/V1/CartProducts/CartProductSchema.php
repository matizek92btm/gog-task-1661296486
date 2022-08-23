<?php

namespace App\JsonApi\V1\CartProducts;

use App\Models\CartProduct;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Number;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsTo;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class CartProductSchema extends Schema
{
    public static string $model = CartProduct::class;

    public function fields(): array
    {
        return [
            ID::make(),
            Number::make('amount'),

            BelongsTo::make('user')->readOnly(),
            BelongsTo::make('product'),

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
