<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Exceptions\Order\OrderAlreadyProcessedException;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class InvoiceService extends BaseService
{
    /**
     * @param Order $order
     * @param array $data
     *
     * @return void
     * @throws OrderAlreadyProcessedException
     */
    public function createInvoice(Order $order, array $data): void
    {
        if (OrderStatus::COMPLETED->value === $order->status) {
            throw new OrderAlreadyProcessedException();
        }

        DB::transaction(function () use ($order, $data) {
            Invoice::create([
                              'order_id'     => $order->id,
                              'invoice_date' => $data['invoice_date'],
                              'grand_total'  => $order->grand_total
                            ]);

            $order->update([
                             'status' => OrderStatus::COMPLETED
                           ]);
        });
    }
}