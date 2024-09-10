<?php

use App\Http\Controllers\Admin\Statistic\StatisticRegionalAdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'redirectAdmin'])->prefix('admin')->group(function () {

  /**
   *   Route::middleware('OrganizationsFullAccess')->group(function () { });
   */

  Route::get('/statistics/regional-admins', [StatisticRegionalAdminController::class, 'index'])->name('admin.statistics.regional.admins.index');


  Route::get('/statistics/regional-admin/create', [StatisticRegionalAdminController::class, 'create'])->name('admin.statistics.regional.admin.create');
  Route::post('/statistics/regional-admin/store', [StatisticRegionalAdminController::class, 'store'])->name('admin.statistics.regional.admin.store');

  Route::get('/statistics/regional-admin/{regionalAdmin}/edit', [StatisticRegionalAdminController::class, 'edit'])->name('admin.statistics.regional.admin.edit');
  Route::post('/statistics/regional-admin/update', [StatisticRegionalAdminController::class, 'update'])->name('admin.statistics.regional.admin.update');

  Route::delete('/statistics/regional-admin/{regionalAdmin}/delete', [StatisticRegionalAdminController::class, 'delete'])->name('admin.statistics.regional.admin.delete');


  Route::post('/statistics/regional-admin/getorganizationlist', [StatisticRegionalAdminController::class, 'GetOrganizationList'])->name('admin.statistics.regional.admin.getorganizationlist');

  Route::post('/statistics/regional-admin/getorganizationinfo', [StatisticRegionalAdminController::class, 'GetOrganizationInfo'])->name('admin.statistics.regional.admin.getorganizationinfo');
});
