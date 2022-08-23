<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use LaravelJsonApi\Core\Exceptions\JsonApiException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        JsonApiException::class,
    ];

    public function register()
    {
        $this->renderable(
            \LaravelJsonApi\Exceptions\ExceptionParser::make()->renderable()
        );
    }
}
