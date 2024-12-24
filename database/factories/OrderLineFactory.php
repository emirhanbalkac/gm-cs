<?php

namespace Database\Factories;

use App\Models\OrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderLine>
 */
class OrderLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'quantity'   => $this->faker->randomNumber(1, 5),
          'unit_price' => $this->faker->randomFloat(2, 1, 10000000),
          'vat'        => $this->faker->randomNumber(0, 20)
        ];
    }
}
