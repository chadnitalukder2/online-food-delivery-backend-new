<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryPersonnel>
 */
class DeliveryPersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'vehicle_type' => $this->faker->randomElement(['car', 'bike', 'van', 'truck']),
            'availability' => $this->faker->randomElement(['available', 'unavailable']),
            'created_at' => now(), 
            'updated_at' => now(),
        ];
    }
}
