<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil ID acak dari tabel orders dan products
        $orderIds = Order::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        return [
            'order_id' => $this->faker->randomElement($orderIds),
            'product_id' => $this->faker->randomElement($productIds),
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
