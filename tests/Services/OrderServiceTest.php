<?php

namespace Tests\Services;

use App\Enums\OrderStatus;
use App\Exceptions\Order\OrderAlreadyProcessedException;
use App\Exceptions\Order\OrderNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Models\Order;
use App\Models\OrderLine;
use App\Services\OrderService;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    protected OrderService $orderService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->orderService = new OrderService();
    }

    #[Test]
    public function testCreateOrder(): void
    {
        $productOne = ProductFactory::new()->createOne();
        $productTwo = ProductFactory::new()->createOne();

        $order = $this->orderService->createOrder([
                                                    'order_date' => '2021-01-01',
                                                    'lines'      => [
                                                      [
                                                        'product_id' => $productOne->id,
                                                        'unit_price' => 100,
                                                        'quantity'   => 1,
                                                        'vat'        => 10,
                                                        'discount'   => 50,
                                                      ],
                                                      [
                                                        'product_id' => $productTwo->id,
                                                        'unit_price' => 50,
                                                        'quantity'   => 3,
                                                        'vat'        => 20,
                                                        'discount'   => 50,
                                                      ],
                                                    ],
                                                  ]);

        $this->assertDatabaseHas(OrderLine::class, [
          'order_id'   => $order->id,
          'product_id' => $productOne->id,
          'unit_price' => 100,
          'quantity'   => 1,
          'vat'        => 10,
          'discount'   => 50,
        ]);

        $this->assertDatabaseHas(OrderLine::class, [
          'order_id'   => $order->id,
          'product_id' => $productTwo->id,
          'unit_price' => 50,
          'quantity'   => 3,
          'vat'        => 20,
          'discount'   => 50,
        ]);

        $this->assertDatabaseHas(Order::class, [
          'id'          => $order->id,
          'order_date'  => '2021-01-01',
          'grand_total' => 145,
        ]);
    }

    #[Test]
    public function testCreateOrderWithNonExistingProduct(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $this->orderService->createOrder([
                                           'order_date' => '2021-01-01',
                                           'lines'      => [
                                             [
                                               'product_id' => 1,
                                               'unit_price' => 100,
                                               'quantity'   => 1,
                                               'vat'        => 10,
                                               'discount'   => 50,
                                             ],
                                           ],
                                         ]);
    }

    /**
     * @throws OrderNotFoundException
     * @throws OrderAlreadyProcessedException
     */
    #[Test]
    public function testProcessOrder(): void
    {
        $productOne = ProductFactory::new()->createOne();

        $order = $this->orderService->createOrder([
                                                    'order_date' => '2024-11-01',
                                                    'lines'      => [
                                                      [
                                                        'product_id' => $productOne->id,
                                                        'unit_price' => 100,
                                                        'quantity'   => 1,
                                                        'vat'        => 10,
                                                        'discount'   => 50,
                                                      ]
                                                    ],
                                                  ]);

        $this->orderService->processOrder($order->id, ['invoice_date' => '2024-12-01']);

        $this->assertDatabaseHas(Order::class, [
          'id'          => $order->id,
          'order_date'  => '2024-11-01',
          'grand_total' => 55,
          'status'      => OrderStatus::COMPLETED,
        ]);
    }

    /**
     * @throws OrderAlreadyProcessedException
     */
    #[Test]
    public function testProcessOrderWithNonExistingOrder(): void
    {
        $this->expectException(OrderNotFoundException::class);

        $this->orderService->processOrder(1, ['invoice_date' => '2023-12-01']);
    }
}
