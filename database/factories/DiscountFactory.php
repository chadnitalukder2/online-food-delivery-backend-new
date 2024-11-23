<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::factory(), 
            'code' => strtoupper($this->faker->unique()->lexify('DISCOUNT???')), 
            'discount_percentage' => $this->faker->numberBetween(5, 50), 
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'), 
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'usage_limit' => $this->faker->numberBetween(1, 100),  
            'min_order_amount' => $this->faker->numberBetween(100, 1000),
            'created_at' => now(), 
            'updated_at' => now(),
        ];
    }
}
