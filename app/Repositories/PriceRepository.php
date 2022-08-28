<?php

namespace App\Repositories;

use App\Repositories\Contracts\PriceRepositoryInterface;

class PriceRepository extends CRUDRepository implements PriceRepositoryInterface
{
    public function priceForProductIdAndCurrencyExist(int $productId, string $currency): bool
    {
        return $this->model->whereProductId($productId)->whereCurrency($currency)->exists();
    }
}
