<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = "categories";
    protected $guarded = [];

    public function product(){
        return $this->belongsToMany("App\Models\Product","category_product");
    }
}
