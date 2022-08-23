<?php

namespace App\JsonApi\V1\Users;

use App\Models\User;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class UserSchema extends Schema
{
    public static string $model = User::class;

    public function fields(): array
    {
        $auth = auth()->user();

        return [
            ID::make('id'),
            Str::make('email'),
            Str::make('password')->hidden(),
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
