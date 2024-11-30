<?php

namespace App\Services;

use App\Models\Cart;
use GuzzleHttp\Psr7\Request;

class CartService
{
    public function getCarts()
    {
        $query = Cart::query();
        return $query->orderBy('id', 'desc')->get();
       
    }
    public function getCartById($id){
        return Cart::findOrFail($id);

    }

    public function createCart(array $data){
        return Cart::create($data);

    }

    public function updatedCart(Cart $cart, array $data)
    {
        $cart->update($data);
        return $cart;
    }

    // Delete a menu
    public function deleteCart(Cart $cart)
    {
        $cart->delete();
    }


}
