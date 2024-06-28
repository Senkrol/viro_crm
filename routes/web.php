<?php


use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// инерция начинает поиск в resources/js/Pages/ и так далее
Route::get('/', function () {
    return Inertia::render('Home');
});

// url компонент данные
Route::inertia('/about', 'About', ['user' => 'Mike']);

/*
Route::get('/about', function () {
  return inertia('About', ['user' => 'Mike']);
});
*/