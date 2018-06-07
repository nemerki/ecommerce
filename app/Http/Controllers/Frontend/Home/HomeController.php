<?php

namespace App\Http\Controllers\Frontend\Home;

use App\CategoryProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where("ust_id", null)->take(8)->get();
//        $sliders = ProductDetail::where("slider", 1)->with("product")->take(5)->get();
//        $gunun_firsati=Product::where("gunun_firsati",1)->with("product")->take(1)->get();
        $slider=Product::select("products.*")
            ->join("product_details","product_details.product_id","products.id")
            ->where("product_details.slider",1)
            ->orderBy("created_at","desc")
            ->take(5)
            ->get();

        $gunun_firsati = Product::select("products.*")
            ->join("product_details", "product_details.product_id", "products.id")
            ->where("product_details.gunun_firsati", 1)
            ->orderBy("updated_at", "desc")
            ->first();

        $one_cikan=Product::select("products.*")
            ->join("product_details","product_details.product_id","products.id")
            ->where("product_details.one_cikan",1)
            ->orderBy("created_at","desc")
            ->take(4)
            ->get();

        $indirimli=Product::select("products.*")
            ->join("product_details","product_details.product_id","products.id")
            ->where("product_details.indirimli",1)
            ->orderBy("created_at","desc")
            ->take(4)
            ->get();

        $cok_satan=Product::select("products.*")
            ->join("product_details","product_details.product_id","products.id")
            ->where("product_details.cok_satan",1)
            ->orderBy("created_at","desc")
            ->take(4)
            ->get();
        return view("frontend.home.index", compact("categories", "slider", "gunun_firsati","one_cikan","indirimli","cok_satan"));
    }
}
