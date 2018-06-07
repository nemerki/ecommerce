<?php

use App\Models\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $tittle = $faker->sentence(2);
    $slug = str_slug($tittle);
    return [
        "tittle" => $tittle,
        "slug" => $slug,
        "description" => $faker->sentence(50),
        "image"=>"http://via.placeholder.com/350x150?text=Ürün Resmi",
        "price" => $faker->randomFloat(3, 1, 200),
        "user_id" => function () {
            return User::all()->random();
        }
    ];
});
