<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Delivery;
use App\Models\DeliveryPersonnel;
use App\Models\Discount;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderTracking;
use App\Models\Payment;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use App\Models\Wishlist;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Restaurant::factory(10)->create();
        Menu::factory(50)->create();
        Order::factory(30)->create();
        Payment::factory(30)->create();
        DeliveryPersonnel::factory(20)->create();
        Delivery::factory(50)->create();
        Review::factory(50)->create();
        Category::factory(10)->create();
        Discount::factory(10)->create();
        Wishlist::factory(10)->create();
        OrderTracking::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        
        
    }
}
