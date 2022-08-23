<?php

namespace App\JsonApi\V1;

use App\JsonApi\V1\CartProducts\CartProductObserver;
use App\JsonApi\V1\CartProducts\CartProductSchema;
use App\JsonApi\V1\Carts\CartSchema;
use App\JsonApi\V1\Prices\PriceSchema;
use App\JsonApi\V1\Products\ProductSchema;
use App\JsonApi\V1\Profiles\ProfileSchema;
use App\JsonApi\V1\Users\UserSchema;
use App\Models\CartProduct;
use LaravelJsonApi\Core\Server\Server as BaseServer;

class Server extends BaseServer
{
    protected string $baseUri = '/api/v1';

    public function serving(): void
    {
        CartProduct::observe(CartProductObserver::class);
    }

    protected function allSchemas(): array
    {
        return [
            UserSchema::class,
            ProfileSchema::class,
            ProductSchema::class,
            PriceSchema::class,
            CartSchema::class,
            CartProductSchema::class,
        ];
    }
}
