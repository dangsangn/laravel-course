<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SigninControlller;
use App\Http\Controllers\SignupControlller;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('cars/search', [CarController::class, 'search'])->name('cars.search');
Route::resource('cars', CarController::class);

Route::get('/signup', [SignupControlller::class, 'create'])->name('signup');
Route::get('/signin', [SigninControlller::class, 'create'])->name('signin');

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
 