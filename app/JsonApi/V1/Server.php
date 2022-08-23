<?php

namespace App\JsonApi\V1;

use App\JsonApi\V1\Users\UserSchema;
use LaravelJsonApi\Core\Server\Server as BaseServer;

class Server extends BaseServer
{
    protected string $baseUri = '/api/v1';

    public function serving(): void
    {
    }

    protected function allSchemas(): array
    {
        return [
            UserSchema::class,
        ];
    }
}
