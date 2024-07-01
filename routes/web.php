<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// инерция начинает поиск в resources/js/Pages/ и так далее
Route::inertia('/', 'Home')->name('home');
Route::inertia('/register', 'Auth/Register')->name('register');

Route::post('/register',[AuthController::class, 'register']);

/*
// url компонент данные
Route::inertia('/about', 'About', ['user' => 'Mike'])->name('about');

Route::get('/about', function () {
  return inertia('About', ['user' => 'Mike']);
});
*/