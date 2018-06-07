<?php

namespace App\Http\Controllers\Frontend\Search;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $products = Product::where("tittle", "LIKE", "%$search%")
            ->orWhere("description", "LIKE", "%$search%")
            ->paginate(8);

        $request->flash();
        return view("frontend.search.index", compact("products","search"));
    }
}
