<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
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
            'user_id' => $this->getRandomUserId('user'),
            'seller_id' => $this->getRandomUserId('seller'),
            'order_code' => $this->generateOrderCode(),
            'total_price' => $this->faker->numberBetween(100000, 1000000),
            'payment_status' => $this->faker->randomElement([1, 2, 3]),
            'payment_url' => $this->faker->optional()->url(),
            'delivery_address' => $this->faker->address,
        ];
    }

    /**
     * Generate a random order code.
     *
     * @return string
     */
    private function generateOrderCode()
    {
        return strtoupper(Str::random(16));
    }

    /**
     * Get a random user ID based on role.
     *
     * @param string $role
     * @return int
     */
    private function getRandomUserId(string $role): int
    {
        return User::where('role', $role)->inRandomOrder()->value('id');
    }
}
