<?php

namespace Tests\Unit;

use App\Repositories\CartProductRepository;
use App\Repositories\Contracts\CartProductRepositoryInterface;
use App\Services\Contracts\CartProductServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Mockery\MockInterface;
use StdClass;
use Tests\TestCase;

class CartProductServiceTest extends TestCase
{
    public function calculateProvider(): array
    {
        return [
            [1, 1, 'USD', 10, 5, 50.00],
            [1, 1, 'USD', 9.99, 5, 49.95],
        ];
    }

    /**
     * @dataProvider calculateProvider
     */
    public function testCalculatePriceForProductsInCart(
        int $cartId,
        int $cartProductId,
        string $currency,
        float $price,
        int $amount,
        float $expectedPrice,
    ): void {
        $repositoryMock = $this->mock(CartProductRepository::class);

        $repositoryMock->shouldReceive('getCartProductsByCardId')
            ->andReturn(new Collection([$this->getProductCartStdClassForRepository($cartProductId, $amount)]));

        $repositoryMock->shouldReceive('getPriceForProductCartByProductCartIdAndCurrency')
            ->andReturn($price);

        $calculatedPrice = app(CartProductServiceInterface::class)->calculatePriceForProductsInCart(
            $cartId,
            $currency
        );

        $this->assertEquals($expectedPrice, $calculatedPrice);
    }

    private function getProductCartStdClassForRepository(int $productCartId, int $amount): StdClass
    {
        $object = new StdClass();
        $object->id = $productCartId;
        $object->amount = $amount;

        return $object;
    }
}
