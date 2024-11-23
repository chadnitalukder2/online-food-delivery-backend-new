<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
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
            'menu_id' => Menu::factory(),
            'created_at' => now(), 
            'updated_at' => now(),
        ];
    }
}
