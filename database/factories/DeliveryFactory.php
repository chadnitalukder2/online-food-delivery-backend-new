<?php

namespace Database\Factories;

use App\Models\DeliveryPersonnel;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
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
            'delivery_personnel_id' => DeliveryPersonnel::factory(), 
            'estimated_time' => $this->faker->time('H:i'),
            'status' => $this->faker->randomElement(['pending', 'on the way', 'delivered', 'failed']),
            'created_at' => now(), 
            'updated_at' => now(),
        ];
    }
}
