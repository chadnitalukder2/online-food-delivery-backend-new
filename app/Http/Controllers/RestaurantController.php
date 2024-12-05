<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\restaurantService;
use App\Collections\RestaurantCollection;
use App\Http\Requests\RestaurantRequest;
use App\Http\Resources\RestaurantResource;

class RestaurantController extends Controller
{

    protected $restaurantService;

    public function __construct()
    {
        $this->restaurantService = new restaurantService();
    }
    public function getRestaurantByOwner($id) {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'Invalid user ID'], 400);
        }
        $restaurant = $this->restaurantService->getRestaurantByUserId($id);
        return $restaurant;
    }

    //get all
    public function index(Request $request)
    {
        $filters = $request->only('name', 'address');
        $restaurants = $this->restaurantService->getFilteredRestaurant($filters);
        return new RestaurantCollection($restaurants);
    }
    //show
    public function show($id)
    {

        $restaurants = $this->restaurantService->getRestaurantById($id);
        return new RestaurantResource($restaurants);
    }
    //store
    public function store(RestaurantRequest $request)
    {
        $restaurant = $this->restaurantService->createRestaurant($request->validated());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/restaurants', 'public');
            $restaurant->update(['image' => $imagePath]);
        }
        if ($request->hasFile('bg_image')) {
            $imagePath = $request->file('bg_image')->store('images/restaurants', 'public');
            $restaurant->update(['bg_image' => $imagePath]);
        }
        return new RestaurantResource($restaurant);
    }

    // Update an existing
    public function update(RestaurantRequest $request, $id)
    {
        $restaurant = $this->restaurantService->getRestaurantById($id);
        $updatedRestaurant = $this->restaurantService->updatedRestaurant($restaurant, $request->validated());
        return new RestaurantResource($updatedRestaurant);
    }

    // Delete 
    public function destroy($id)
    {
        $restaurant = $this->restaurantService->getRestaurantById($id);
        $this->restaurantService->deleteRestaurant($restaurant);
        return response()->json(null, 204);
    }
}
