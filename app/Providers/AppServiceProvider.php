<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Services\Contracts\AuthorizationServiceInterface',
            'App\Services\AuthorizationService',
        );

        $this->app->bind(
            'App\Services\Contracts\ProductServiceInterface',
            'App\Services\ProductService',
        );

        $this->app->bind(
            'App\Services\Contracts\PriceServiceInterface',
            'App\Services\PriceService',
        );
    }

    public function boot()
    {
    }
}
