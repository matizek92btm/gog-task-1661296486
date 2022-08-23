<?php

namespace Tests\Api;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\ApiTestCase;

class CartTest extends ApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateCartWithoutPermission(): void
    {
        $response = $this->jsonApi()
            ->expects('carts')
            ->withData([
                'type' => 'carts',
            ])
            ->post('/api/v1/carts');
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testCanCreateCart(): void
    {
        $user = $this->getWorker();
        $this->actingAs($user);
        $response = $this->jsonApi()
            ->expects('carts')
            ->withData([
                'type' => 'carts',
            ])
            ->post('/api/v1/carts');
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testCanGetCart(): void
    {
        $user = $this->getWorker();
        $cart = Cart::factory()->setUser($user->id)->create();
        $this->actingAs($user);
        $response = $this->jsonApi()
            ->expects('carts')
            ->get('/api/v1/carts/'.$cart->id);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testCanAddDeleteProductFromCart(): void
    {
        $user = $this->getWorker();
        $product = Product::factory()->hasPrices()->create();
        $this->actingAs($user);
        $response = $this->jsonApi()
            ->expects('cart-products')
            ->withData([
                'type' => 'cart-products',
                'attributes' => [
                    'amount' => 5,
                ],
                'relationships' => [
                    'product' => [
                        'data' => [
                            'type' => 'products',
                            'id' => (string)$product->id,
                        ],
                    ],
                ],
            ])
            ->post('/api/v1/cart-products');
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertDatabaseHas('cart_product', ['cart_id' => $user->cart->id, 'product_id' => $product->id]);

        $response = $this->jsonApi()
            ->expects('cart-products')
            ->delete('/api/v1/cart-products/'.$response->json('data.id'));

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
        $this->assertDatabaseMissing('cart_product', ['cart_id' => $user->cart->id, 'product_id' => $product->id]);
    }

    public function testCantAddTooMuchProductsAmountInSingleRequest(): void
    {
        $user = $this->getWorker();
        $product = Product::factory()->hasPrices()->create();
        $this->actingAs($user);
        $response = $this->jsonApi()
            ->expects('cart-products')
            ->withData([
                'type' => 'cart-products',
                'attributes' => [
                    'amount' => 20,
                ],
                'relationships' => [
                    'product' => [
                        'data' => [
                            'type' => 'products',
                            'id' => (string)$product->id,
                        ],
                    ],
                ],
            ])
            ->post('/api/v1/cart-products');
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
    }

    public function testCantAddTooMuchProductsAmountInTwoRequest(): void
    {
        $user = $this->getWorker();
        $product = Product::factory()->hasPrices()->create();
        $this->actingAs($user);
        $response = $this->jsonApi()
            ->expects('cart-products')
            ->withData([
                'type' => 'cart-products',
                'attributes' => [
                    'amount' => 5,
                ],
                'relationships' => [
                    'product' => [
                        'data' => [
                            'type' => 'products',
                            'id' => (string)$product->id,
                        ],
                    ],
                ],
            ])
            ->post('/api/v1/cart-products');
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertDatabaseHas('cart_product', ['cart_id' => $user->cart->id, 'product_id' => $product->id]);

        $response = $this->jsonApi()
            ->expects('cart-products')
            ->withData([
                'type' => 'cart-products',
                'attributes' => [
                    'amount' => 12,
                ],
                'relationships' => [
                    'product' => [
                        'data' => [
                            'type' => 'products',
                            'id' => (string)$product->id,
                        ],
                    ],
                ],
            ])
            ->post('/api/v1/cart-products');

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
    }

    private function getWorker(): User
    {
        return User::whereEmail('worker@example.com')->first();
    }
}
