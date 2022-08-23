<?php

namespace App\Services;

use App\Models\Price;
use App\Services\Contracts\PriceServiceInterface;

class PriceService implements PriceServiceInterface
{
    public function delete(int $prizeId): bool
    {
        return Price::destroy($prizeId);
    }
}
