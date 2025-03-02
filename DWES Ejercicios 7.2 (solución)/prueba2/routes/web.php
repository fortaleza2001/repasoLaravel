<?php

use Illuminate\Support\Facades\Route;
/*
Route::get('/', function () {
    return view('welcome');
});

// Añadido.
// Estas son las 7 rutas estándar REST:
Route::resource('product', 'ProductController');
// Añadimos una ruta NO ESTÁNDAR para borrar productos mediante GET:
Route::get('product/delete/{product}', 'ProductController@destroy')->name('product.myDestroy');
*/

Route::get('/', function () {return view('index');})->name('menu');

Route::get('product', 'ProductController@index')->name('product.index');
Route::get('product/id={product?}', 'ProductController@show')->name('product.show');
Route::get('product/create', 'ProductController@create')->name('product.create');
Route::post('product/{product?}', 'ProductController@store')->name('product.store');
Route::get('product/{product}/edit', 'ProductController@edit')->name('product.edit');
Route::patch('product/{product}', 'ProductController@update')->name('product.update');
Route::delete('product/{product}', 'ProductController@destroy')->name('product.destroy');

Route::get('supplier/products', 'SupplierController@products')->name('supplier.products');

Route::resource('supplier', 'SupplierController');
Route::resource('contact', 'ContactController');
