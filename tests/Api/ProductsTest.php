<?php

namespace Tests\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\ApiTestCase;

class ProductsTest extends ApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testShowProductsUnauthorizedUser(): void
    {
        $response = $this->jsonApi()
            ->expects('products')
            ->get('/api/v1/products');

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testShowProducts(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);

        $response = $this->jsonApi()
            ->expects('products')
            ->get('/api/v1/products');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(5, count($response->json('data')));
    }

    public function testCreateProduct(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);

        $response = $this->jsonApi()
            ->expects('products')
            ->withData([
                'type' => 'products',
                'attributes' => [
                    'name' => 'some new products',
                ],
            ])
            ->post('/api/v1/products');

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertDatabaseHas('products', ['name' => 'some new products']);
    }

    public function testUpdateProduct(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $product = Product::factory()->create();

        $response = $this->jsonApi()
            ->expects('products')
            ->withData([
                'type' => 'products',
                'id' => (string)$product->id,
                'attributes' => [
                    'name' => 'some new name',
                ],
            ])
            ->patch('/api/v1/products/'.$product->id);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertDatabaseHas('products', ['name' => 'some new name']);
    }

    public function testDeleteProduct(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $product = Product::factory()->create();

        $response = $this->jsonApi()
            ->expects('products')
            ->delete('/api/v1/products/'.$product->id);

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    private function getUser(): User
    {
        return User::whereEmail('worker@example.com')->first();
    }
}
