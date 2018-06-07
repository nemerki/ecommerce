<?php
/**
 * Created by PhpStorm.
 * User: mmehe
 * Date: 2.06.2018
 * Time: 22:57
 */

Route::group(["as" => "frontend", "namespace" => "Frontend"], function () {
    Route::group(["as" => ".home", "namespace" => "Home"], function () {
        Route::get("/", "HomeController@index")->name(".index");

    });

    Route::group(["prefix" => "kategori", "as" => ".category", "namespace" => "Category"], function () {
        Route::get("/{slug}", "CategoryController@index")->name(".index");

    });

    Route::group(["prefix" => "urun", "as" => ".product", "namespace" => "Product"], function () {
        Route::get("/{id}/{slug}", "ProductController@index")->name(".index");

    });

    Route::group(["prefix" => "sepet", "as" => ".basket", "namespace" => "Basket"], function () {
        Route::get("/", "BasketController@index")->name(".index");
        Route::post("/add", "BasketController@add")->name(".add");
        Route::post("/delete", "BasketController@delete")->name(".delete");
        Route::post("/destroy", "BasketController@destroy")->name(".destroy");
        Route::post("/qtyUpdate", "BasketController@qtyUpdate")->name(".qtyUpdate");

    });

    Route::group(["prefix" => "odeme", "as" => ".payment", "namespace" => "Payment"], function () {
        Route::get("/", "PaymentController@index")->name(".index");/*->middleware("auth");*/
        Route::post("/odemeyap", "PaymentController@odemeyap")->name(".odemeyap");/*->middleware("auth");*/

    });

    Route::group(["middleware" => "auth"], function () {
        Route::group(["prefix" => "siparis", "as" => ".order", "namespace" => "Order"], function () {
            Route::get("/", "OrderController@index")->name(".index");
            Route::get("/{id}", "OrderController@detail")->name(".detail");

        });
    });


    Route::group(["prefix" => "ara", "as" => ".search", "namespace" => "Search"], function () {
        Route::post("/", "SearchController@index")->name(".index");
        Route::get("/", "SearchController@index")->name(".index");


    });

    Route::group(["prefix" => "kullanici", "as" => ".auth", "namespace" => "User"], function () {
        Route::get("/giris", "UserController@signin_form")->name(".signin");
        Route::post("/giris", "UserController@signin");
        Route::get("/kaydol", "UserController@signup_form")->name(".signup");
        Route::post("/kaydol", "UserController@signup");
        Route::get("/aktiflesdir/{activation_key}", "UserController@activate")->name(".activate");
        Route::post("/cikis", "UserController@logout")->name(".logout");
    });
});

Route::get("/test/mail", function () {
    $user = \App\User::find(1);
    return new App\Mail\UserRegisterMail($user);
});
