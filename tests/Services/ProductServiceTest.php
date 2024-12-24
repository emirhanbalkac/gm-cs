<?php

namespace Tests\Services;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ProductService $productService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productService = new ProductService();
    }

    #[Test]
    public function testCreateProduct(): void
    {
        $product = $this->productService->createProduct([
            'name' => 'Product 1',
        ]);

        $this->assertDatabaseHas(Product::class, [
            'id' => $product->id,
            'name' => 'Product 1'
        ]);
    }
}
