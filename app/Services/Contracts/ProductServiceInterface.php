<?php

namespace App\Services\Contracts;

use App\Models\Product;

interface ProductServiceInterface
{
    public function create(array $productAttributes): Product;

    public function update(Product $product, array $attributes): Product;

    public function delete(int $productId): bool;
}
