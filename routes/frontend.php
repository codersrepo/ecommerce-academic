<?php

use Illuminate\Support\Facades\Route;


    Route::get('','HomeController')->name('home');
    Route::get('product', 'ShopController@index')->name('shop.index');
    Route::get('product/{slug}', 'ShopController@show')->name('shop.show');
    Route::get('blog', 'BlogController@index')->name('blogs.index');
    Route::get('blog/{slug}', 'BlogController@show')->name('blogs.show');
    Route::post('add-to-cart','Cartcontroller@store')->name('add-to-cart');
    Route::delete('/cart/{id}','Cartcontroller@destroy')->name('cart.destroy');
    Route::get('/cart','CartController@cart')->name('cart');
    Route::get('/header/cart','CartController@header_cart')->name('cart.index');
    Route::get('/contact','HeaderController@contact')->name('contact');
    Route::get('/about','HeaderController@about')->name('about');
    Route::get('/checkout', 'CheckoutController@create')->name('checkout.create');
    Route::resource('/checkout','CheckoutController');
    Route::post('updateOrderStatus','CheckoutController@togglestatus')->name('updateOrderStatus');
    Route::post('subscribers', 'SubscriberController@store')->name('subscribers.store');





