<?php

namespace App\JsonApi\V1\Products;

use App\Models\Product;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class ProductSchema extends Schema
{
    public static string $model = Product::class;

    public function fields(): array
    {
        return [
            ID::make(),
            Str::make('name'),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function includePaths(): iterable
    {
        return [];
    }

    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }
}
