<?php

use App\Http\Controllers\Admin\Statistic\StatisticMunicipalAdminController;
use App\Http\Controllers\Admin\Statistic\StatisticOrganizationAdminController;
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


  
  Route::get('/statistics/organizations-admins', [StatisticOrganizationAdminController::class, 'index'])->name('admin.statistics.organizations.admins.index');

  Route::get('/statistics/organization-admin/create', [StatisticOrganizationAdminController::class, 'create'])->name('admin.statistics.organizations.admin.create');
  Route::post('/statistics/organization-admin/store', [StatisticOrganizationAdminController::class, 'store'])->name('admin.statistics.organizations.admin.store');

  Route::get('/statistics/organization-admin/{organizationAdmin}/edit', [StatisticOrganizationAdminController::class, 'edit'])->name('admin.statistics.organizations.admin.edit');
  Route::post('/statistics/organization-admin/update', [StatisticOrganizationAdminController::class, 'update'])->name('admin.statistics.organizations.admin.update');

  Route::delete('/statistics/organization-admin/{organizationAdmin}/delete', [StatisticOrganizationAdminController::class, 'delete'])->name('admin.statistics.organizations.admin.delete');

  Route::post('/statistics/organization-admin/getorganizationlist', [StatisticOrganizationAdminController::class, 'GetOrganizationList'])->name('admin.statistics.organizations.admin.getorganizationlist');
  Route::post('/statistics/organization-admin/getorganizationinfo', [StatisticOrganizationAdminController::class, 'GetOrganizationInfo'])->name('admin.statistics.organizations.admin.getorganizationinfo');




});
