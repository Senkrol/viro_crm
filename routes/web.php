<?php


use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// инерция начинает поиск в resources/js/Pages/ и так далее
Route::get('/', function () {
    return Inertia::render('Home');
});
