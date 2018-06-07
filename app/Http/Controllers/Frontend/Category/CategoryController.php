<?php

namespace App\Http\Controllers\Frontend\Category;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::where("slug", $slug)->firstOrFail();
        $altcategories = Category::where("ust_id", $category->id)->get();


        $order = request("order");
        if ($order == "coksatan") {
            $products = $category->product()
                ->distinct()
                ->join("product_details","product_details.product_id","products.id")
                ->orderByDesc("product_details.cok_satan")
                ->paginate(8);
        } elseif ($order == "yeni") {
            $products=$category->product()
                ->distinct()
                ->join("product_details","product_details.product_id","products.id")
                ->orderByDesc("created_at")
                ->paginate(8);
        } else {
            $products = $category->product()->distinct()->paginate(8);
//        $products=Product::where("id",$category->product->id)->get();
        }


        return view("frontend.category.index", compact("category", "altcategories", "products"));
    }
}
