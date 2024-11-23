<?php

namespace App\Services;

use App\Models\Wishlist;
use GuzzleHttp\Psr7\Request;

class WishlistService
{
    public function getWishlists()
    {
        $query = Wishlist::query();
        return $query->get();

    }
    public function getWishlistById($id){
        return Wishlist::findOrFail($id);

    }

    public function createWishlist(array $data){
        return Wishlist::create($data);

    }

    public function updatedWishlists(Wishlist $wishlist, array $data)
    {
        $wishlist->update($data);
        return $wishlist;
    }

    // Delete a menu
    public function deleteWishlist(Wishlist $wishlist)
    {
        $wishlist->delete();
    }


}
