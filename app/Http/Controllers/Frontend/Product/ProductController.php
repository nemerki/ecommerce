<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index($id, $slug)
    {
        $product = Product::where("id", $id)->firstOrFail();
        $categories = $product->category()->distinct()->get();
        return view("frontend.product.index", compact("product","categories"));
    }
}
