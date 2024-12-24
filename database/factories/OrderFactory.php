<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'order_date'  => $this->faker->date(),
          'status'      => $this->faker->randomElement(OrderStatus::cases()),
          'grand_total' => $this->faker->randomFloat(2, 1, 10000000),
        ];
    }
}
