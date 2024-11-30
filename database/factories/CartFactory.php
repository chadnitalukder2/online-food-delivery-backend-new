<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
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
            'menu_id' =>  Restaurant::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'line_total' =>$this->faker->numberBetween(100, 500),
            'status' => $this->faker->randomElement(['cart', 'ordered', 'completed']), // Random status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
