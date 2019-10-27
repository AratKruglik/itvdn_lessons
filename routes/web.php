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

Auth::routes();

Route::get('/', 'PageController@index')->name('index');

Route::resource('catalog', 'CatalogController')->parameters([
    'catalog' => 'slug'
]);

Route::prefix('cart')->group(function () {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::get('add/{productId}', 'CartController@add')->name('cart.add');
});
