<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    if(Auth::check()){
        return redirect()->route("home");
    }else{
        return redirect()->route("login");
    }
});

Route::get("/login", function () {
    if(Auth::check()){
        return redirect()->route("home");
    }else{
        return view("login");
    }
})->name("login");

Route::get("/register", function () {
    return view("register");
})->name("register");



Route::post("/login", "RestaurantController@login");
Route::post("/register", "RestaurantController@register");

/**
 * AUTHENTICATED ROUTES
 */

Route::get("/logout", "RestaurantController@logout")->middleware("auth")->name("logout");


Route::prefix("/home")->group(function () {

    Route::get("/", "RestaurantController@home")->name("home");

    Route::prefix("/person")->group(function (){
        Route::post("insert", "PersonController@insert")->name("insert-person");
        Route::get("delete/{id}", "PersonController@delete")->name("delete-person");
    });

    Route::prefix("/profile")->group(function (){

        Route::get("/", function(){
            return view("profile.home");
        })->name("profile-home");

        Route::post("edit", "RestaurantController@editProfile")->name("edit-profile");
    });

});