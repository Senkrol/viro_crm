<?php

use App\Http\Controllers\Admin\Statistic\StatisticMunicipalAdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'redirectAdmin'])->prefix('admin')->group(function () {

  /**
   *   Route::middleware('OrganizationsFullAccess')->group(function () { });
   */

  Route::get('/statistics/municipal-admins', [StatisticMunicipalAdminController::class, 'index'])->name('admin.statistics.municipal.admins.index');


  Route::get('/statistics/municipal-admin/create', [StatisticMunicipalAdminController::class, 'create'])->name('admin.statistics.municipal.admin.create');
  Route::post('/statistics/municipal-admin/store', [StatisticMunicipalAdminController::class, 'store'])->name('admin.statistics.municipal.admin.store');

  Route::get('/statistics/municipal-admin/{municipalAdmin}/edit', [StatisticMunicipalAdminController::class, 'edit'])->name('admin.statistics.municipal.admin.edit');
  Route::post('/statistics/municipal-admin/update', [StatisticMunicipalAdminController::class, 'update'])->name('admin.statistics.municipal.admin.update');

  Route::delete('/statistics/municipal-admin/{municipalAdmin}/delete', [StatisticMunicipalAdminController::class, 'delete'])->name('admin.statistics.municipal.admin.delete');


  Route::post('/statistics/municipal-admin/getorganizationlist', [StatisticMunicipalAdminController::class, 'GetOrganizationList'])->name('admin.statistics.municipal.admin.getorganizationlist');

  Route::post('/statistics/municipal-admin/getorganizationinfo', [StatisticMunicipalAdminController::class, 'GetOrganizationInfo'])->name('admin.statistics.municipal.admin.getorganizationinfo');
});
