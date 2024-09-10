<?php

use App\Http\Controllers\Admin\Administration\AdminController;
use App\Http\Controllers\Admin\Administration\DepartmentController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'redirectAdmin'])->prefix('admin')->group(function () {

  Route::middleware('AdministrationFullAccess')->group(function () {
    //администраторы
    Route::get('/administration/admins', [AdminController::class, 'index'])->name('admin.administration.admins.index');

    Route::get('/administration/admin/create', [AdminController::class, 'create'])->name('admin.administration.admin.create');
    Route::post('/administration/admin/store', [AdminController::class, 'store'])->name('admin.administration.admin.store');

    Route::get('/administration/admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.administration.admin.edit');
    Route::post('/administration/admin/update', [AdminController::class, 'update'])->name('admin.administration.admin.update');

    Route::delete('/administration/admin/{admin}/delete', [AdminController::class, 'delete'])->name('admin.administration.admin.delete');

    
    //отделы, или скорее направления работы
    Route::get('/administration/departments', [DepartmentController::class, 'index'])->name('admin.administration.departments.index');

    Route::get('/administration/department/create', [DepartmentController::class, 'create'])->name('admin.administration.department.create');
    Route::post('/administration/department/store', [DepartmentController::class, 'store'])->name('admin.administration.department.store');

    Route::get('/administration/department/{department}/edit', [DepartmentController::class, 'edit'])->name('admin.administration.department.edit');
    Route::post('/administration/department/update', [DepartmentController::class, 'update'])->name('admin.administration.department.update');

    Route::delete('/administration/department/{department}/delete', [DepartmentController::class, 'delete'])->name('admin.administration.department.delete');
  });
});
