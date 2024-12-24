<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function createProduct(CreateProductRequest $request)
    {
        return $this->sendResponse(
          data:   $this->productService->createProduct($request->validated()),
          status: Response::HTTP_CREATED
        );
    }
}
