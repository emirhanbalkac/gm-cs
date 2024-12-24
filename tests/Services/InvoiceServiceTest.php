<?php

namespace Tests\Services;

use App\Enums\OrderStatus;
use App\Exceptions\Order\OrderAlreadyProcessedException;
use App\Models\Invoice;
use App\Models\Order;
use App\Services\InvoiceService;
use Database\Factories\OrderFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class InvoiceServiceTest extends TestCase
{
    use RefreshDatabase;

    protected InvoiceService $invoiceService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->invoiceService = new InvoiceService();
    }

    /**
     * @throws OrderAlreadyProcessedException
     */
    #[Test]
    public function testCreateInvoice(): void
    {
        $order = OrderFactory::new()->createOne([
                                                  'status' => OrderStatus::PENDING->value
                                                ]);

        $this->invoiceService->createInvoice($order, [
          'invoice_date' => '2021-01-01',
        ]);

        $this->assertDatabaseHas(Invoice::class, [
          'order_id'     => $order->id,
          'invoice_date' => '2021-01-01',
        ]);

        $this->assertDatabaseHas(Order::class, [
          'id'     => $order->id,
          'status' => OrderStatus::COMPLETED->value,
        ]);
    }

    #[Test]
    public function testCreateInvoiceThrowsOrderAlreadyProcessedException(): void
    {
        $order = OrderFactory::new()->createOne([
                                                  'status' => OrderStatus::COMPLETED->value,
                                                ]);

        $this->expectException(OrderAlreadyProcessedException::class);

        $this->invoiceService->createInvoice($order, [
          'invoice_date' => '2021-01-01',
        ]);
    }
}
