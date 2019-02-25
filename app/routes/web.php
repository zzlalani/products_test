<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:api')->group( function () {
    Route::post('/products', ['as' => 'product.post', 'uses' => 'Api\ProductController@store']);
});

Route::get('/products', ['as' => 'products.all', 'uses'=>'Api\ProductController@index'] );
Route::get('/products/{id}', 'Api\ProductController@show');

Route::fallback(function(){
    return response()->json(['error' => 'Route not found.'], 404);
})->name('fallback.404');