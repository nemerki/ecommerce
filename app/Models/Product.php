<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsToMany("App\Models\Category", "category_product");

    }

    public function detail()
    {
        return $this->hasOne("App\Models\ProductDetail")->withDefault();

    }


}

