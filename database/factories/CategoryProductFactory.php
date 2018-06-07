<?php

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(App\CategoryProduct::class, function (Faker $faker) {
    return [
        "category_id" => function () {
            return Category::all()->random();
        },
        "product_id" => function () {
            return Product::all()->random();
        }

    ];
});
