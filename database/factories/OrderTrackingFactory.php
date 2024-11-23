<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderTracking>
 */
class OrderTrackingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'current_status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
            'status_update_time' => $this->faker->dateTimeBetween('-2 days', 'now')->format('Y-m-d H:i:s'),
            'estimated_delivery_time' => $this->faker->dateTimeBetween('now', '+3 hours')->format('Y-m-d H:i:s'),
            'created_at' => now(), 
            'updated_at' => now(),
        ];
    }
}
