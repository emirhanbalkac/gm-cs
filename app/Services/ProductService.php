<?php

namespace App\Services;

use App\Models\Product;

class ProductService extends BaseService
{
    public function createProduct(array $data): Product
    {
        $product = new Product($data);
        $product->save();

        return $product;
    }
}