<?php
/**
 * Created by PhpStorm.
 * User: mmehe
 * Date: 2.06.2018
 * Time: 22:57
 */


Route::group(["prefix" => "admin", "as" => "backend", "namespace" => "Backend"/*,"middleware"=>"admin"*/], function () {

    Route::group(["as" => ".auth", "namespace" => "Auth"], function () {
        Route::get("/giris", "AuthController@login")->name(".login");
        Route::post("/signin", "AuthController@signin")->name(".signin");
        Route::get("/cikis", "AuthController@logout")->name(".logout");

    });

    Route::group(["middleware" => "admin"], function () {


        Route::group(["as" => ".home", "namespace" => "Home"], function () {
            Route::get("/", "HomeController@index")->name(".index");

        });


        Route::group(["prefix" => "kullanici", "as" => ".user", "namespace" => "User"], function () {
            Route::get("/", "UserController@index")->name(".index");
            Route::get("/duzenle/{id}", "UserController@edit")->name(".edit");
            Route::post("/update/{id}", "UserController@update")->name(".update");
            Route::post("/delete", "UserController@destroy")->name(".delete");
            Route::get("/ekle", "UserController@create")->name(".create");
            Route::post("/store", "UserController@store")->name(".store");


        });

        Route::group(["prefix" => "kategori", "as" => ".category", "namespace" => "Category"], function () {
            Route::get("/", "CategoryController@index")->name(".index");
            Route::get("/duzenle/{id}", "CategoryController@edit")->name(".edit");
            Route::post("/update/{id}", "CategoryController@update")->name(".update");
            Route::post("/delete", "CategoryController@destroy")->name(".delete");
            Route::get("/ekle", "CategoryController@create")->name(".create");
            Route::post("/store", "CategoryController@store")->name(".store");
        });

        Route::group(["prefix" => "urun", "as" => ".product", "namespace" => "Product"], function () {
            Route::get("/", "ProductController@index")->name(".index");
            Route::get("/duzenle/{id}", "ProductController@edit")->name(".edit");
            Route::post("/update/{id}", "ProductController@update")->name(".update");
            Route::post("/delete", "ProductController@destroy")->name(".delete");
            Route::get("/ekle", "ProductController@create")->name(".create");
            Route::post("/store", "ProductController@store")->name(".store");
        });

        Route::group(["prefix" => "siparis", "as" => ".order", "namespace" => "Order"], function () {
            Route::get("/", "OrderController@index")->name(".index");
            Route::get("/detay/{id}", "OrderController@detail")->name(".detail");
            Route::post("/update/{id}", "OrderController@update")->name(".update");

        });

    });
});
