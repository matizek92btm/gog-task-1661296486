<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use App\Repositories\CartProductRepository;
use App\Repositories\CartRepository;
use App\Repositories\PriceRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
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
            'App\Services\Contracts\CartProductServiceInterface',
            'App\Services\CartProductService',
        );

        $this->app->bind(
            'App\Repositories\Contracts\ProductRepositoryInterface',
            'App\Repositories\ProductRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\PriceRepositoryInterface',
            'App\Repositories\PriceRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\CartRepositoryInterface',
            'App\Repositories\CartRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\CartProductRepositoryInterface',
            'App\Repositories\CartProductRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\UserRepository',
        );

        $this->app->when(CartRepository::class)
            ->needs(Model::class)
            ->give(function () {
                return new Cart();
            });

        $this->app->when(PriceRepository::class)
            ->needs(Model::class)
            ->give(function () {
                return new Price();
            });

        $this->app->when(ProductRepository::class)
            ->needs(Model::class)
            ->give(function () {
                return new Product();
            });

        $this->app->when(CartProductRepository::class)
            ->needs(Model::class)
            ->give(function () {
                return new CartProduct();
            });

        $this->app->when(UserRepository::class)
            ->needs(Model::class)
            ->give(function () {
                return new User();
            });
    }

    public function boot()
    {
    }
}
