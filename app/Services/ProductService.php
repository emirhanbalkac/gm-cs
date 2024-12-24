<?php

namespace App\Services;

use App\Models\Product;

class ProductService extends BaseService
{
    /**
     * @param array $data
     *
     * @return Product
     */
    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }
}