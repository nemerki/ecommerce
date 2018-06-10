<?php

namespace App\Http\Controllers\Backend\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy("ust_id")->get();
        return view("backend.category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy("ust_id")->get();
        return view("backend.category.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->ust_id = $request->ust_id;

        $category->save();

        if ($category) {

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
        $allCategories = Category::all();
        $category = Category::where("id", $id)->firstOrFail();
        return view("backend.category.edit", compact("category", "allCategories"));
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
        $category = Category::where("id", $id)->update([
            "name" => $request->name,
            "slug" => str_slug($request->name),
            "ust_id" => $request->ust_id
        ]);

        if ($category) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kategori  Güncellendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kategori Güncellenemedi"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $category = Category::where("id", $request->id);
        $category->product()->detach();
        $category->delete();

        if ($category) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kategori  Silindi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kategori Silinemedi"];
    }
}
