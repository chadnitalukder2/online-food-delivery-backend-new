<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchRestaurant(Request $request)
    {
        $query = $request->input('searchValue'); // Get the search query
        $results = Restaurant::where('name', 'LIKE', "%{$query}%")
                       ->orWhere('address', 'LIKE', "%{$query}%")
                       ->get();

        return response()->json($results);
    }

    public function searchMenu(Request $request)
    {
        $query = $request->input('searchValue'); // Get the search query
        $results = Menu::where('name', 'LIKE', "%{$query}%")
                       ->get();

        return response()->json($results);
    }
}
