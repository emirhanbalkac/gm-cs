<?php

namespace App\Services;

use App\Exceptions\Product\ProductNotFoundException;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{
    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $order = Order::create([
                                     'order_date'  => $data['order_date'],
                                     'grand_total' => 0
                                   ]);

            $grandTotal = 0;

            foreach ($data['lines'] as $line) {
                $this->checkProduct($line['product_id']);

                $this->createOrderLine($order, $line);

                $grandTotal += ($line['unit_price'] * $line['quantity']) * (1 + $line['vat'] / 100) * (1 - $line['discount'] / 100);
            }

            $order->update(['grand_total' => $grandTotal]);

            return $order;
        });
    }

    /**
     * @throws ProductNotFoundException
     */
    private function checkProduct(int $productId): void
    {
        $product = Product::find($productId);
        if (empty($product)) {
            throw new ProductNotFoundException();
        }
    }

    private function createOrderLine(Order $order, array $line): void
    {
        $order->lines()
              ->create([
                         'product_id' => $line['product_id'],
                         'quantity'   => $line['quantity'],
                         'unit_price' => $line['unit_price'],
                         'vat'        => $line['vat'],
                         'discount'   => $line['discount']
                       ]);
    }
}