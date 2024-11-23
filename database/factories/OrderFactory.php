<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id' => User::factory(),            
            'restaurant_id' => Restaurant::factory(),
            'total_amount' => $this->faker->numberBetween(100, 5000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
            'payment_method' => $this->faker->randomElement(['credit card', 'cash', 'paypal']),
            'order_date' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'), 
            'delivery_address' => $this->faker->address(),
            'created_at' => now(), 
            'updated_at' => now(),
        ];
    }
}
