<?php

namespace App\Services\Contracts;

interface PriceServiceInterface
{
    public function delete(int $prizeId): bool;
}
