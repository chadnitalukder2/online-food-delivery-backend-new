<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'restaurant_id' => Restaurant::factory(),
            'image' => $this->faker->imageUrl(640, 480, 'food'), 
            'description' => $this->faker->sentence(10),
            'created_at' => now(), 
            'updated_at' => now(),
        ];
    }
}
