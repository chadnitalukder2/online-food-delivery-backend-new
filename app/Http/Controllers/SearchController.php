<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('searchValue'); // Get the search query
        $results = Restaurant::where('name', 'LIKE', "%{$query}%")
                       ->orWhere('address', 'LIKE', "%{$query}%")
                       ->get();

        return response()->json($results);
    }
}
