<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param CreateProductRequest $request
     *
     * @return JsonResponse
     */
    public function createProduct(CreateProductRequest $request): JsonResponse
    {
        $product = $this->productService->createProduct($request->validated());

        return $this->sendResponse(
          data:   $product,
          status: Response::HTTP_CREATED
        );
    }
}
