<?php

use App\Http\Controllers\GreetingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hello, World!';
});

Route::get('/greet', function () {
    return view('greet');
});

Route::get('/greetings', [GreetingController::class, 'index']);
Route::post('/greet', [GreetingController::class, 'store']);
Route::delete('/greetings/{greeting}', [GreetingController::class, 'destroy']);
