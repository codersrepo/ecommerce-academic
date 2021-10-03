<?php

use Illuminate\Support\Facades\Route;


    Route::get('','HomeController')->name('home');
    Route::get('product', 'ShopController@index')->name('shop.index');
    Route::get('product/{slug}', 'ShopController@show')->name('shop.show');
    Route::get('blog', 'BlogController@index')->name('blogs.index');
    Route::get('blog/{slug}', 'BlogController@show')->name('blogs.show');
    Route::post('add-to-cart','Cartcontroller@index')->name('add-to-cart');
    Route::get('cart','CartController@cart')->name('cart');

