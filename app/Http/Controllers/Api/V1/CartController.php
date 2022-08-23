<?php

namespace App\Http\Controllers\Api\V1;

use App\JsonApi\V1\Carts\CartRequest;
use App\Services\Contracts\CartServiceInterface;
use LaravelJsonApi\Core\Responses\DataResponse;

class CartController extends Controller
{
    public function __construct(private CartServiceInterface $cartService)
    {
    }

    public function creating(CartRequest $cartRequest): DataResponse
    {
        $user = auth()->user();
        $cart = $user->cart;

        if (! $cart) {
            $cart = $this->cartService->create($user);
        }

        return DataResponse::make($cart);
    }
}
