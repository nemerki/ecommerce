<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view("backend.product.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("backend.product.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product();
        $product->tittle = $request->tittle;
        if (request()->filled('slug')) {
            $product->slug = $request->slug;
        } else {
            $product->slug = str_slug($request->tittle);
        }
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        $categories = request("category");
        $product->category()->attach($categories);


        $data = request()->only("slider", "gunun_firsati", "one_cikan", "cok_satan", "indirimli");

        $product->detail()->create($data);

        $file = Storage::disk("uploads")->putFile("/product", $request->file("product_img"));
        $filePath = "uploads/" . $file;

        $product_id = $product->id;
        $product_detail = ProductDetail::where("product_id", $product_id)->first();

        $product_detail->update([
            "product_img" => $filePath
        ]);


        if ($product && $product_detail) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kategori  Eklendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kategori Eklenemedi"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::where("id", $id)->firstOrFail();
        $category_product = $product->category()->pluck('category_id')->all(); //pluck ile sadece belirli kolonu çekiyoruz
        return view("backend.product.edit", compact("product", "categories", "category_product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oldFile = ProductDetail::where("product_id", $id)->first();
        $filePath = $oldFile->product_img;

        if ($request->file("product_img") != null) {
            $oldPath = substr($filePath, 8);

            Storage::disk("uploads")->delete($oldPath);
            $file = Storage::disk("uploads")->putFile("/product", $request->file("product_img"));
            $filePath = "uploads/" . $file;
        }


        $product = Product::where("id", $id)->firstOrFail();
        $product->update(request()->only("tittle", "price", "description"));
        if (request()->filled('slug')) {
            $slug = $request->slug;
        } else {
            $slug = str_slug($request->tittle);
        }
        $product->update([
            "slug" => $slug
        ]);

        $product->detail()->update(request()->only("slider", "gunun_firsati", "one_cikan", "cok_satan", "indirimli"));

        $product_id = $product->id;
        $product_detail = ProductDetail::where("product_id", $product_id)->first();

        $product_detail->update([
            "product_img" => $filePath
        ]);


        $categories = request("category");
        $product->category()->sync($categories);

        if ($product) {

            return ["status" => "success", "title" => "başarılı", "message" => "Ürün  Güncellendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Ürün  Güncellenemedi"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $product = Product::find($id);
        $product_id = $product->id;
        $product_detail = ProductDetail::where("product_id", $product_id)->first();
        $filePath = $product_detail->product_img;
        $deletePath = substr($filePath, 8);
        Storage::disk("uploads")->delete($deletePath);

        $product->category()->detach(); //bire çok ilişki olduğu için detach() ile siliyoruz
        $product->detail()->delete(); //bire bir ilişkide delete diyoruz
        $product->delete();





        if ($product) {

            return ["status" => "success", "title" => "başarılı", "message" => "Ürün  Silindi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Ürün  Silinemedi"];
    }
}
