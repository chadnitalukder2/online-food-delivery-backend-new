<?php

namespace App\Services;

use App\Models\Cart;
use GuzzleHttp\Psr7\Request;

class CartService
{
    public function getCartsByUserId($id)
    {
        return Cart::where('user_id', $id)->with('menu', 'restaurant')->where('status', 'cart')->get();
    }
    public function getCarts()
    {
        return Cart::with('menu')->orderBy('id', 'desc')->get();
    }
    public function getCartById($id)
    {
        return Cart::findOrFail($id);
    }

    public function createCart(array $data)
    {
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
