<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Organizations\OrganizationController;
use App\Http\Controllers\Admin\Organizations\OrganizationsDistrictController;
use App\Http\Controllers\Admin\Organizations\OrganizationsFounderController;
use App\Http\Controllers\Admin\Organizations\OrganizationsRegionController;
use App\Http\Controllers\Admin\Organizations\OrganizationsTypeController;


Route::middleware(['auth', 'redirectAdmin'])->prefix('admin')->group(function () {



  Route::middleware('OrganizationsFullAccess')->group(function () {
    // Регионы
    Route::get('/organizations/regions', [OrganizationsRegionController::class, 'index'])->name('admin.organizations.regions.index');

    Route::get('/organizations/region/create', [OrganizationsRegionController::class, 'create'])->name('admin.organizations.region.create');
    Route::post('/organizations/region/store', [OrganizationsRegionController::class, 'store'])->name('admin.organizations.region.store');

    Route::get('/organizations/region/{region}/edit', [OrganizationsRegionController::class, 'edit'])->name('admin.organizations.region.edit');
    Route::post('/organizations/region/update', [OrganizationsRegionController::class, 'update'])->name('admin.organizations.region.update');

    Route::delete('/organizations/region/{region}/delete', [OrganizationsRegionController::class, 'delete'])->name('admin.organizations.region.delete');



    // Области
    Route::get('/organizations/districts', [OrganizationsDistrictController::class, 'index'])->name('admin.organizations.districts.index');

    Route::get('/organizations/district/create', [OrganizationsDistrictController::class, 'create'])->name('admin.organizations.district.create');
    Route::post('/organizations/district/store', [OrganizationsDistrictController::class, 'store'])->name('admin.organizations.district.store');

    Route::get('/organizations/district/{district}/edit', [OrganizationsDistrictController::class, 'edit'])->name('admin.organizations.district.edit');
    Route::post('/organizations/district/update', [OrganizationsDistrictController::class, 'update'])->name('admin.organizations.district.update');

    Route::delete('/organizations/district/{district}/delete', [OrganizationsDistrictController::class, 'delete'])->name('admin.organizations.district.delete');

    Route::post('/organizations/districts/getlist', [OrganizationsDistrictController::class, 'getlist'])->name('admin.organizations.districts.getlist');

    // учредители
    Route::get('/organizations/founders', [OrganizationsFounderController::class, 'index'])->name('admin.organizations.founders.index');

    Route::get('/organizations/founder/create', [OrganizationsFounderController::class, 'create'])->name('admin.organizations.founder.create');
    Route::post('/organizations/founder/store', [OrganizationsFounderController::class, 'store'])->name('admin.organizations.founder.store');

    Route::get('/organizations/founder/{founder}/edit', [OrganizationsFounderController::class, 'edit'])->name('admin.organizations.founder.edit');
    Route::post('/organizations/founder/update', [OrganizationsFounderController::class, 'update'])->name('admin.organizations.founder.update');

    Route::delete('/organizations/founder/{founder}/delete', [OrganizationsFounderController::class, 'delete'])->name('admin.organizations.founder.delete');

    // тип образования

    Route::get('/organizations/types', [OrganizationsTypeController::class, 'index'])->name('admin.organizations.types.index');

    Route::get('/organizations/type/create', [OrganizationsTypeController::class, 'create'])->name('admin.organizations.type.create');
    Route::post('/organizations/type/store', [OrganizationsTypeController::class, 'store'])->name('admin.organizations.type.store');

    Route::get('/organizations/type/{type}/edit', [OrganizationsTypeController::class, 'edit'])->name('admin.organizations.type.edit');
    Route::post('/organizations/type/update', [OrganizationsTypeController::class, 'update'])->name('admin.organizations.type.update');

    Route::delete('/organizations/type/{type}/delete', [OrganizationsTypeController::class, 'delete'])->name('admin.organizations.type.delete');

    // ну и наконец сами организации 
    Route::get('/organizations/show', [OrganizationController::class, 'index'])->name('admin.organizations.organizations.index');

    Route::get('/organizations/organization/create', [OrganizationController::class, 'create'])->name('admin.organizations.organization.create');
    Route::post('/organizations/store', [OrganizationController::class, 'store'])->name('admin.organizations.organization.store');

    Route::get('/organizations/organization/{organization}/edit', [OrganizationController::class, 'edit'])->name('admin.organizations.organization.edit');
    Route::post('/organizations/organization/update', [OrganizationController::class, 'update'])->name('admin.organizations.organization.update');

    Route::delete('/organizations/organization/{organization}/delete', [OrganizationController::class, 'delete'])->name('admin.organizations.organization.delete');


    Route::post('/organizations/getlist', [OrganizationController::class, 'getlist'])->name('admin.organizations.getlist');
  });
});
