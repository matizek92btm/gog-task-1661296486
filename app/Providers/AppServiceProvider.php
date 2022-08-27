<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Price;
use App\Models\Product;
use App\Services\CartService;
use App\Services\PriceService;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Model;
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
            'App\Repositories\Contracts\CartProductRepositoryInterface',
            'App\Repositories\CartProductRepository',
        );

        $this->app->when(CartService::class)
            ->needs(Model::class)
            ->give(function () {
                return new Cart();
            });

        $this->app->when(PriceService::class)
            ->needs(Model::class)
            ->give(function () {
                return new Price();
            });

        $this->app->when(ProductService::class)
            ->needs(Model::class)
            ->give(function () {
                return new Product();
            });
    }

    public function boot()
    {
    }
}
