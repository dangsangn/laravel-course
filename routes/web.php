<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function() {
    return view('about');
});

Route::get('/sum/{a}/{b}', function(float $a, float $b) {
    return $a + $b;
})->whereNumber(['a', 'b']);