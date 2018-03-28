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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//Route::get("/{id}","userController@show");

Route::group([

    'prefix' => 'auth'

], function () {
    Route::get('show', 'AuthController@show');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register','Auth\RegisterController@create');

});

Route::group([
  'prefix'=>'item'
],function(){
    //items
    Route::get("/get","itemController@index");
    Route::get("/get/{id}","itemController@show");
    Route::post("/add","itemController@store");
    Route::post("/change/{id}","itemController@update");
    Route::delete("/del/{id}","itemController@destroy");
    Route::get("/search/{q}","itemController@search");

    Route::get("/itembycat/{id}","itemController@itemByCat");
});

Route::group([
  'prefix'=>'cat'
],function(){
    //categories
    Route::get("/get","catController@index");
    Route::get("/get/{id}","catController@show");
    Route::post("/add","catController@store");
    Route::post("/change/{id}","catController@update");
    Route::delete("/del/{id}","catController@destroy");
});

Route::group([
  'prefix'=>'bill'
],function(){
  Route::get("/get","billController@index");
  //Route::get("/get/{id}","billController@show");
  Route::post("/add","billController@store");
  Route::post("/change/{id}","billController@update");
  Route::delete("/del/{id}","billController@destroy");

  Route::get("/get/{id}","billController@print");
});

Route::group([
  'prefix'=>'trans'
],function(){
//transaction
Route::get("/get","transController@index");
Route::get("/get/{id}","transController@show");
Route::post("/add","transController@store");
Route::post("/change/{id}","transController@update");
Route::delete("/del/{id}","transController@destroy");

//Route::get("/bill/{cust_id}/{item_id}","transController@subtotal");
Route::get("/bill/{bill_id}","transController@printBill");
});
