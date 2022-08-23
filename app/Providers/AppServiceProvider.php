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

        $this->app->bind(
            'App\Services\Contracts\CartServiceInterface',
            'App\Services\CartService',
        );

        $this->app->bind(
            'App\Services\Contracts\CartProductServiceInterface',
            'App\Services\CartProductService',
        );
    }

    public function boot()
    {
    }
}
