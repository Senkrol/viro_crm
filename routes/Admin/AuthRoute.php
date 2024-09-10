<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;


Route::middleware(['auth', 'redirectAdmin'])->prefix('admin')->group(function () {

  Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

  Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
  Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
  Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
  
});
