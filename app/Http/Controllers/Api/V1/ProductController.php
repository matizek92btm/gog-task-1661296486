<?php

namespace App\Http\Controllers\Api\V1;

use App\JsonApi\V1\Products\ProductRequest;
use App\Models\Product;
use App\Repositories\Contracts\PriceRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Response;
use LaravelJsonApi\Core\Responses\DataResponse;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private PriceRepositoryInterface $priceRepository
    ) {
    }

    public function creating(ProductRequest $productRequest): DataResponse
    {
        $productAttributes = $productRequest->validated();
        $product = $this->productRepository->create($productAttributes);

        return DataResponse::make($product)->didCreate();
    }

    public function updating(Product $product, ProductRequest $productRequest)
    {
        $product = $this->productRepository->update($product->id, $productRequest->validated());

        return DataResponse::make($product);
    }

    public function deleting(Product $product): Response
    {
        $prices = $product->prices;
        $prices->each(function ($price) {
            $this->priceRepository->delete($price->id);
        });

        $this->productRepository->delete($product->id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
