<?php

namespace App\Http\Controllers\Api\V1;

use App\JsonApi\V1\Products\ProductRequest;
use App\Models\Product;
use App\Services\Contracts\PriceServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Response;
use LaravelJsonApi\Core\Responses\DataResponse;

class ProductController extends Controller
{
    public function __construct(
        private ProductServiceInterface $productService,
        private PriceServiceInterface $priceService
    ) {
    }

    public function creating(ProductRequest $productRequest): DataResponse
    {
        $productAttributes = $productRequest->validated();
        $product = $this->productService->create($productAttributes);

        return DataResponse::make($product)->didCreate();
    }

    public function updating(Product $product, ProductRequest $productRequest)
    {
        $product = $this->productService->update($product, $productRequest->validated());

        return DataResponse::make($product);
    }

    public function deleting(Product $product): Response
    {
        $prices = $product->prices;
        $prices->each(function ($price) {
            $this->priceService->delete($price->id);
        });

        $this->productService->delete($product->id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
