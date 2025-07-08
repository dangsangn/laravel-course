<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('cars/search', [CarController::class, 'search'])->name('cars.search');
Route::get('cars/watched-list', [CarController::class, 'watchedList'])->name('cars.watched-list');
Route::get('cars/cities-by-state', [CarController::class, 'getCitiesByState'])->name('cars.cities-by-state');
Route::get('cars/models-by-maker', [CarController::class, 'getModelsByMaker'])->name('cars.models-by-maker');
Route::resource('cars', CarController::class);

Route::get('/signup', [AuthController::class, 'showSignup'])->name('show.signup');
Route::get('/signin', [AuthController::class, 'showSignin'])->name('show.signin');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/about', function() {
    return view('about');
});

Route::get('/sum/{a}/{b}', function(float $a, float $b) {
    return $a + $b;
})->whereNumber(['a', 'b']);

// Route::get('/car', [CarController::class, 'index']);

// Route::controller(CarController::class)->group(function() {
//     Route::get('/car', 'index');
//     Route::get('/my-car', 'myCar');
// });

// Route::resource('products', ProductControl::class);

// Route::apiResource('cars', CarController::class);

// Route::get('/sum/{a}/{b}', [MathController::class, 'sum'])->whereNumber(['a','b']);
// Route::get('/subtract/{a}/{b}', [MathController::class, 'subtract'])->whereNumber(['a','b']);
 