<?php

namespace Tests\Api;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\ApiTestCase;

class UsersTest extends ApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testLogin(): void
    {
        $user = User::factory()->create();

        $response = $this->jsonApi()
            ->expects('users')
            ->withData([
                'attributes' => [
                    'email' => $user->email,
                    'password' => 'Example1%',
                ],
            ])
            ->post('/api/v1/users/-/login');

        $response->assertFetchedOne([
            'id' => $user->getRouteKey(),
        ]);

        $response->assertMeta([
            'accessToken' => [],
        ]);
    }

    public function testLoginWrongPassword(): void
    {
        $user = User::factory()->create();

        $response = $this->jsonApi()
            ->expects('users')
            ->withData([
                'attributes' => [
                    'email' => $user->email,
                    'password' => 'Secret11%',
                ],
            ])
            ->post('/api/v1/users/-/login');

        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testLoginWrongEmail(): void
    {
        $response = $this->jsonApi()
            ->expects('users')
            ->withData([
                'attributes' => [
                    'email' => 'someExample@gmail.com',
                    'password' => 'Example1%',
                ],
            ])
            ->post('/api/v1/users/-/login');

        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testLogout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->jsonApi()->delete('/api/v1/users/-/logout');

        $response->assertNoContent();
    }
}
