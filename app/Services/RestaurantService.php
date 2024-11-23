<?php

namespace App\Services;

use App\Models\Restaurant;
class restaurantService
{
    public function getFilteredRestaurant(array $filters, $perPage = 10)
    {
        $query = Restaurant::query();

        if (isset($filters['name'])) {
            $query->where('name', $filters['name']);
        }

        if (isset($filters['address'])) {
            $query->where('address', $filters['address']);
        }

        return $query->get();

    }

    public function getRestaurantById($id){
        return Restaurant::findOrFail($id);

    }

    public function createRestaurant(array $data){
        return Restaurant::create($data);

    }

    public function updatedRestaurant(Restaurant $restaurant, array $data)
    {
        $restaurant->update($data);
        return $restaurant;
    }

    // Delete a menu
    public function deleteRestaurant(Restaurant $restaurant)
    {
        $restaurant->delete();
    }


}
