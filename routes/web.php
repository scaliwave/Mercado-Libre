<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Shopping_CartController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;


// Home
Route::get('/', [ProductController::class, 'showHomeWithProducts'])->name('home');

// Products
Route::group(['prefix' => 'Products', 'controller' => ProductController::class], function () {
	Route::get('/GetProductsByCategory', 'getProductsByCategory');
	Route::get('/GetAnProduct/{product}', 'getAnProduct');
});

//shopping_cart
Route::group(['prefix' => 'ShoppingCart', 'controller' => Shopping_CartController::class], function () {
	Route::post('/CreateShoppingCart', 'createShoppingCart');
	Route::get('/MyCart/{user}', 'getMyShoppingCart')->name('shoppingCart');
	Route::put('/UpdateShoppingCart/{user}', 'updateShoppingCart');

});




// auth ----------------------------------------------------------------
// Login Routes...
Route::group(['controller' => LoginController::class], function () {
	Route::get('login', 'showLoginForm')
		->name('login');
	Route::post('login', 'login');

	// Logout Routes...
	Route::post('logout', 'logout')
		->name('logout');
});

// Registration Routes...
Route::group(['controller' => RegisterController::class], function () {
	Route::get('register', 'showRegistrationForm')
		->name('register');
	Route::post('register', 'registerUser');
});

// User
// Route::group(['controller' => UserController::class], function () {

// });


// Password Reset Routes...
Route::group(['controller' => ForgotPasswordController::class], function () {
	Route::get('password/reset', 'showLinkRequestForm')
		->name('password.request');
	Route::post('password/email', 'sendResetLinkEmail')
		->name('password.email');
});

// Reset Password
Route::group(['controller' => ResetPasswordController::class], function () {
	Route::get('password/reset/{token}', 'showResetForm')
		->name('password.reset');
	Route::post('password/reset', 'reset')
		->name('password.update');
});

// Password Confirmation Routes...
Route::group(['controller' => ConfirmPasswordController::class], function () {
	Route::get('password/confirm', 'showConfirmForm')
		->name('password.confirm');
	Route::post('password/confirm', 'confirm');
});

// Email Verification Routes...
Route::group(['controller' => VerificationController::class], function () {
	Route::get('email/verify', 'show')
		->name('verification.notice');
	Route::get('email/verify/{id}/{hash}', 'verify')
		->name('verification.verify');
	Route::post('email/resend', 'resend')
		->name('verification.resend');
});
