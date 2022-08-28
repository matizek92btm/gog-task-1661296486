<?php

namespace App\Repositories\Contracts;

interface PriceRepositoryInterface extends CRUDRepositoryInterface
{
    public function priceForProductIdAndCurrencyExist(int $productId, string $currency): bool;
}
