<?php

namespace App\JsonApi\V1\Profiles;

use App\Models\Profile;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsTo;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class ProfileSchema extends Schema
{
    public static string $model = Profile::class;

    public function fields(): array
    {
        return [
            ID::make('id'),
            Str::make('currency'),

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
