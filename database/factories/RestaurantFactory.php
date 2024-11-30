<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->sentence(10),
            'status' => $this->faker->randomElement(['open', 'close']),
            'delivery_fee' => $this->faker->numberBetween(10, 100),
            'delivery_time' => $this->faker->numberBetween(10, 60) . ' minutes', 
            'image' => $this->faker->imageUrl(640, 480, 'logo'), 
            'created_at' => now(), 
            'updated_at' => now(),
        ];
        
    }
}
