<?php

namespace App\Http\Controllers;

use App\Collections\WishlistCollection;
use App\Http\Requests\WishlistsRequest;
use App\Http\Resources\WishlistsResource;
use App\Services\WishlistService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    protected $WishlistService;

    public function __construct()
    {
        $this->WishlistService = new WishlistService();
    }

    public function index(Request $request)
    {
        $wishlists = $this->WishlistService->getWishlists();
        return new WishlistCollection($wishlists);
    }
    public function show($id)
    {
        $wishlist = $this->WishlistService->getWishlistById($id);
        return new WishlistsResource($wishlist);
    }

    public function store(WishlistsRequest $request)
    {
        $wishlists = $this->WishlistService->createWishlist($request->validated());
        return new WishlistsResource($wishlists);
    }

    public function update(WishlistsRequest $request, $id)
    {
        $wishlists = $this->WishlistService->getWishlistById($id);
        $updatedWishlists = $this->WishlistService->updatedWishlists($wishlists, $request->validated());
        return new WishlistsResource($updatedWishlists);
    }

    // Delete 
    public function destroy($id)
    {
        $Wishlists = $this->WishlistService->getWishlistById($id);
        $this->WishlistService->deleteWishlist($Wishlists);
        return response()->json(null, 204);
    }
}
