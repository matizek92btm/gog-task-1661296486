<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Contracts\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    public function create(array $productAttributes): Product
    {
        return Product::create($productAttributes);
    }

    public function update(Product $product, array $attributes): Product
    {
        $product->update($attributes);

        return $product->fresh();
    }

    public function delete(int $productId): bool
    {
        return Product::destroy($productId);
    }
}
