<?php
/**
 * Created by PhpStorm.
 * User: mmehe
 * Date: 2.06.2018
 * Time: 22:57
 */


Route::group(["prefix" => "admin", "as" => "backend", "namespace" => "Backend"/*,"middleware"=>"admin"*/], function () {
    Route::group(["as" => ".home", "namespace" => "Home"], function () {
        Route::get("/", "HomeController@index")->name(".index");

    });

    Route::group(["as" => ".auth", "namespace" => "Auth"], function () {
        Route::get("/giris", "AuthController@login")->name(".login");
        Route::post("/signin", "AuthController@signin")->name(".signin");
        Route::get("/cikis", "AuthController@logout")->name(".logout");

    });

    Route::group(["as" => ".user", "namespace" => "User"], function () {
        Route::get("/", "userController@index")->name(".index");


    });


});
