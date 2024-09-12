<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;



Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home');    
    Route::get('/about', 'about'); 
    Route::get('/shop', 'shop');    
    Route::get('/cart', 'cart'); 
    Route::get('/checkout', 'checkout');    
    Route::get('/blog', 'blog'); 
    Route::get('/contact', 'contact');    
    Route::get('/services', 'services'); 
    Route::get('/confirmed', 'confirmed'); 
}

);


Auth::routes();

Route::get('/home', [App\Http\Controllers\AuthController::class, 'index'])->name('home');
