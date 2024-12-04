<?php

namespace App\Http\Controllers;

use App\Collections\CartCollection;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $CartService;

    public function __construct()
    {
        $this->CartService = new CartService();
    }

    public function index(Request $request)
    {
        $cart = $this->CartService->getCarts();
        return new CartCollection($cart);
    }
    
    public function show($id){
        $cart = $this->CartService->getCartById($id);
        return new CartResource($cart);
    }

    public function store(CartRequest $request){
  
        $cart = $this->CartService->createCart($request->validated());
      
        return new CartResource($cart);
    }

    public function update(CartRequest $request, $id)
    {
        $cart = $this->CartService->getCartById($id);
        $updatedCart = $this->CartService->updatedCart($cart, $request->validated());
      
        return new CartResource($updatedCart);
    }

    // Delete 
    public function destroy($id)
    {
        $cart = $this->CartService->getCartById($id);
        $this->CartService->deleteCart($cart);
        return response()->json(null, 204);
    }
}
