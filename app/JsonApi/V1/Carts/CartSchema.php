<?php

namespace App\JsonApi\V1\Carts;

use App\Models\Cart;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Number;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsTo;
use LaravelJsonApi\Eloquent\Fields\Relations\HasMany;
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
            Number::make('totalPrice')->extractUsing(static function (Cart $cart) {
                return 0;
            }),

            HasMany::make('cartProducts')->readOnly(),
            BelongsTo::make('user')->readOnly(),
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
            'cartProducts.product.prices'
        ];
    }

    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }
}
