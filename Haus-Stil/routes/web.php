<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;



Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home.home');    
    Route::get('/about', 'about')->name('home.about');  
    Route::get('/shop', 'shop')->name('home.shop') ;    
    Route::get('/cart', 'cart')->name('home.cart') ; 
    Route::get('/checkout', 'checkout')->name('home.checkout');     
    Route::get('/blog', 'blog') ->name('home.blog'); 
    Route::get('/contact', 'contact')  ->name('home.contract');   
    Route::get('/services', 'services')->name('home.services');  
    Route::get('/confirmed', 'confirmed')->name('home.confirmed');  
}

);

Route::controller(UserController::class)->group(function () {
    Route::get('/user/create', 'create')->name('user.create');    
    Route::post('/user/store', 'store')->name('user.store');    
    Route::get('/user/read', 'index')->name('user.read');    
    Route::put('/user/{id}', 'update')->name('user.update');
    Route::get('/user/{id}/edit', 'edit')->name('user.edit');
    Route::delete('/user/{id}', 'destroy')->name('user.delete');
}
);


Route::controller(CategoryController::class)->group(function () {
    Route::get('/cat/create', 'create')->name('cat.create');    
    Route::post('/cat/store', 'store')->name('cat.store');    
    Route::get('/cat/read', 'index')->name('cat.read');    
    Route::put('/cat/{id}', 'update')->name('cat.update');
    Route::get('/cat/{id}/edit', 'edit')->name('cat.edit');
    Route::delete('/cat/{id}', 'destroy')->name('cat.delete');

}
);


Route::controller(ProductController::class)->group(function () {
    Route::get('/prod/create', 'create')->name('prod.create');    
    Route::post('/prod/store', 'store')->name('prod.store');    
    Route::get('/prod/read', 'index')->name('prod.read');    
    Route::put('/prod/{id}', 'update')->name('prod.update');
    Route::get('/prod/{id}/edit', 'edit')->name('prod.edit');
    Route::delete('/prod/{id}', 'destroy')->name('prod.delete');
    
}
);


Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'showProfile'])->name('profile');
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('updateprofile');

// Route::get('/forgot', [App\Http\Controllers\ForgotController::class, 'create'])->name('forgotPassword');


Route::get('/testroute', function() {
    $name = "Funny Coder";

    // The email sending is done using the to method on the Mail facade
    Mail::to('cebotavictor14@gmail.com')->send(new MyTestEmail($name));
});

//     use App\Http\Controllers\Auth\LoginController;
//     use App\Http\Controllers\Auth\RegisterController;
//     use App\Http\Controllers\Auth\ForgotPasswordController;
//     use App\Http\Controllers\Auth\ConfirmPasswordController;
//     use App\Http\Controllers\Auth\VerificationController;


// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class,'login']);
// Route::post('logout',  [LoginController::class,'logout'])->name('logout');

// // Registration Routes...
// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register']);

// // Password Reset Routes...
// Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');

// // Confirm Password 
// Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
// Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

// // Email Verification Routes...
// Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
// Route::get('email/resend',  [VerificationController::class, 'resend'])->name('verification.resend');

Auth::routes();
// Home
Route::get('/home', [App\Http\Controllers\AuthController::class, 'index'])->name('home');