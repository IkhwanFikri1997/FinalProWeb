<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get("/{id}","userController@show");

//items
Route::get("/getitems","itemController@index");
Route::get("/getitem/{id}","itemController@show");
Route::post("/additem","itemController@store");
Route::post("/changeitem","itemController@update");
Route::get("/delitem/{id}","itemController@destroy");

Route::get("/itembycat/{id}","itemController@itemByCat");

//categories
Route::get("/getcats","catController@index");
Route::get("/getcat/{id}","catController@show");
Route::post("/addcat","catController@store");
Route::post("/changecat","catController@update");
Route::get("/delcat/{id}","catController@destroy");

//transaction
Route::get("/getalltrans","transController@index");
Route::get("/gettrans/{id}","transController@show");
Route::post("/addtrans","transController@store");
Route::post("/changetrans","transController@update");
Route::get("/deltrans/{id}","transController@destroy");

Route::get("/bill/{cust_id}/{item_id}","transController@subtotal");
Route::get("/bill/{cust_id}","transController@printBill");


//users
Route::get("/getusers","userController@index");
Route::get("/getuser/{id}","userController@show");
Route::post("/adduser","userController@store");
Route::post("/changeuser","userController@update");
Route::get("/deluser/{id}","userController@destroy");
