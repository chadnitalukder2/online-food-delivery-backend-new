<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\AuthRegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryPersonnelController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('restaurants', RestaurantController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('menus', MenuController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('deliveryPersonnel', DeliveryPersonnelController::class);
Route::apiResource('deliveries', DeliveryController::class);
Route::apiResource('reviews', ReviewController::class);
Route::apiResource('discounts', DiscountController::class);
Route::apiResource('wishlists', WishlistController::class);
Route::apiResource('orderTrackings', OrderTrackingController::class);
Route::apiResource('carts', CartController::class);

Route::apiResource('users', UserController::class);
Route::get('getCarts/{id}', [CartController::class, 'getCarts']);
Route::get('getRestaurantByOwner/{id}', [RestaurantController::class, 'getRestaurantByOwner']);
Route::get('getCategoryByOwner/{id}', [CategoryController::class, 'getCategoryByOwner']);

Route::get('getOrdersByUserId/{id}', [OrderController::class, 'getOrdersByUserId']);

Route::get('/searchRestaurant', [SearchController::class, 'searchRestaurant']);
Route::get('/searchMenu', [SearchController::class, 'searchMenu']);

Route::get('/getMenuByRestaurantIds/{id}', [MenuController::class, 'getMenuByRestaurantIds']);
Route::get('/getOrdersByRestaurantIds/{id}', [OrderController::class, 'getOrdersByRestaurantIds']);
//================================================================
Route::post('/register', [AuthRegisterController::class, 'register']);
Route::post('/login', [AuthLoginController::class, 'login']);


Route::post('/logout', [AuthLoginController::class, 'logout']);

