<?php

namespace Tests\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\ApiTestCase;

class PriceTest extends ApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testAddPriceWithoutPermission(): void
    {
        $product = Product::factory()->create();

        $response = $this->jsonApi()
            ->expects('prices')
            ->withData([
                'type' => 'prices',
                'attributes' => [
                    'value' => 300,
                    'currency' => 'USD',
                ],
                'relationships' => [
                    'product' => [
                        'data' => [
                            'type' => 'products',
                            'id' => "{$product->id}",
                        ],
                    ],
                ],
            ])
            ->post('/api/v1/prices');
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testAddPrice(): void
    {
        $product = Product::factory()->create();
        $user = $this->getWorker();
        $this->actingAs($user);

        $response = $this->jsonApi()
            ->expects('prices')
            ->withData([
                'type' => 'prices',
                'attributes' => [
                    'value' => 300,
                    'currency' => 'USD',
                ],
                'relationships' => [
                    'product' => [
                        'data' => [
                            'type' => 'products',
                            'id' => "{$product->id}",
                        ],
                    ],
                ],
            ])
            ->post('/api/v1/prices');
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertDatabaseHas('prices', ['product_id' => $product->id]);
    }

    public function testCantAddTheSameCurrency(): void
    {
        $product = Product::factory()->create();
        $user = $this->getWorker();
        $this->actingAs($user);

        $response = $this->jsonApi()
            ->expects('prices')
            ->withData([
                'type' => 'prices',
                'attributes' => [
                    'value' => 300,
                    'currency' => 'USD',
                ],
                'relationships' => [
                    'product' => [
                        'data' => [
                            'type' => 'products',
                            'id' => "{$product->id}",
                        ],
                    ],
                ],
            ])
            ->post('/api/v1/prices');
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertDatabaseHas('prices', ['product_id' => $product->id]);
        $response = $this->jsonApi()
            ->expects('prices')
            ->withData([
                'type' => 'prices',
                'attributes' => [
                    'value' => 300,
                    'currency' => 'USD',
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
            ->post('/api/v1/prices');
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
    }

    public function testCanUpdatePrice(): void
    {
        $product = Product::factory()->hasPrices()->create();
        $price = $product->prices->first();
        $user = $this->getWorker();
        $this->actingAs($user);

        $response = $this->jsonApi()
            ->expects('prices')
            ->withData([
                'type' => 'prices',
                'id' => (string)$price->id,
                'attributes' => [
                    'value' => 300,
                    'currency' => 'USD',
                ],
            ])
            ->patch('/api/v1/prices/'.$price->id);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertDatabaseHas('prices', ['product_id' => $price->product_id, 'value' => 300]);
    }

    public function testCanDeletePrice(): void
    {
        $product = Product::factory()->hasPrices()->create();
        $price = $product->prices->first();
        $user = $this->getWorker();
        $this->actingAs($user);

        $response = $this->jsonApi()
            ->expects('prices')
            ->delete('/api/v1/prices/'.$price->id);

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
        $this->assertDatabaseMissing('prices', ['product_id' => $price->product_id]);
    }

    public function testUserCantCreatePrice()
    {
        $product = Product::factory()->create();
        $user = $this->getUser();
        $this->actingAs($user);

        $response = $this->jsonApi()
            ->expects('prices')
            ->withData([
                'type' => 'prices',
                'attributes' => [
                    'value' => 300,
                    'currency' => 'USD',
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
            ->post('/api/v1/prices');
        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
    }

    public function testUserCantUpdatePrice(): void
    {
        $product = Product::factory()->hasPrices()->create();
        $price = $product->prices->first();
        $user = $this->getUser();
        $this->actingAs($user);

        $response = $this->jsonApi()
            ->expects('prices')
            ->withData([
                'type' => 'prices',
                'id' => (string)$price->id,
                'attributes' => [
                    'value' => 300,
                    'currency' => 'USD',
                ],
            ])
            ->patch('/api/v1/prices/'.$price->id);

        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
    }

    public function testUserCantDeletePrice(): void
    {
        $product = Product::factory()->hasPrices()->create();
        $price = $product->prices->first();
        $user = $this->getUser();
        $this->actingAs($user);

        $response = $this->jsonApi()
            ->expects('prices')
            ->delete('/api/v1/prices/'.$price->id);

        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
    }

    private function getWorker(): User
    {
        return User::whereEmail('worker@example.com')->first();
    }

    private function getUser(): User
    {
        return User::whereEmail('user@example.com')->first();
    }
}
