<?php

use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\CartProductController;
use App\Http\Controllers\Api\V1\PriceController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Routing\ActionRegistrar;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

JsonApiRoute::server('v1')->prefix('v1')->resources(function ($server) {
    $server->resource('users', UserController::class)
        ->actions('-', function (ActionRegistrar $actionRegistrar) {
            $actionRegistrar->post('login', 'login');
            $actionRegistrar->delete('logout', 'logout');
        });

    $server->resource('products', ProductController::class)
        ->only('index', 'store', 'show', 'update', 'delete');

    $server->resource('prices', PriceController::class)
        ->only('store', 'update', 'delete')
        ->relationships(function ($relations) {
            $relations->hasOne('product');
        });

    $server->resource('carts', CartController::class)
        ->only('store', 'show')
        ->relationships(function ($relations) {
            $relations->hasOne('user');
        });

    $server->resource('cart-products', CartProductController::class)
        ->only('store', 'delete', 'show');
});
