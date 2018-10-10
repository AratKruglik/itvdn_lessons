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

Route::get('/', 'PageController@getIndex')->name('index');

Auth::routes(['verify' => true]);

Route::resource('catalog', 'CatalogController');
Route::get('catalog/{slug}', 'CatalogController@show')->name('catalog.show');
Route::post('comments/add', 'CommentController@add')->name('comments.add')->middleware('verified');

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::get('checkout', 'CartController@checkout')->name('cart.checkout');
    Route::any('add/{productId}', 'CartController@add')->name('cart.add');
    Route::patch('update', 'CartController@update')->name('cart.update');
    Route::get('drop/{productId}', 'CartController@drop')->name('cart.drop');
    Route::get('destroy', 'CartController@destroy')->name('cart.destroy');
    Route::post('order', 'CartController@order')->name('cart.order');
    Route::get('{orderId}/success', 'CartController@success')->name('cart.order.success');
});
