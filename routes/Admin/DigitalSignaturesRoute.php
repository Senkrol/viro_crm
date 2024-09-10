<?php
// базовый

use App\Http\Controllers\Admin\DigitalSignatures\DigitalSignatureController;
use App\Http\Controllers\Admin\DigitalSignatures\DigitalSignatureExcelController;
use App\Http\Controllers\Admin\DigitalSignatures\DigitalSignaturesIsystemController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'redirectAdmin'])->prefix('admin')->group(function () {
  Route::middleware('DigitalSignaturesFullAccess')->group(function () {
    // ЭЦП
    Route::get('/digital-signatures/show', [DigitalSignatureController::class, 'index'])->name('admin.digital-signatures.digital-signatures.index');

    Route::get('/digital-signatures/create', [DigitalSignatureController::class, 'create'])->name('admin.digital-signatures.create');
    Route::post('/digital-signatures/store', [DigitalSignatureController::class, 'store'])->name('admin.digital-signatures.store');

    Route::get('/digital-signatures/{digitalSignature}/edit', [DigitalSignatureController::class, 'edit'])->name('admin.digital-signatures.edit');
    Route::post('/digital-signatures/update', [DigitalSignatureController::class, 'update'])->name('admin.digital-signatures.update');

    Route::delete('/digital-signatures/{digitalSignature}/delete', [DigitalSignatureController::class, 'delete'])->name('admin.digital-signatures.delete');

    Route::get('/digital-signatures/report', [DigitalSignatureExcelController::class, 'index'])->name('admin.digital-signatures.report');

    // ЭЦП - ИС
    Route::get('/digital-signatures/isystems', [DigitalSignaturesIsystemController::class, 'index'])->name('admin.digital-signatures.isystems.index');

    Route::get('/digital-signatures/isystems/create', [DigitalSignaturesIsystemController::class, 'create'])->name('admin.digital-signatures.isystems.create');
    Route::post('/digital-signatures/isystems/store', [DigitalSignaturesIsystemController::class, 'store'])->name('admin.digital-signatures.isystems.store');

    Route::get('/digital-signatures/isystems/{isystem}/edit', [DigitalSignaturesIsystemController::class, 'edit'])->name('admin.digital-signatures.isystems.edit');
    Route::post('/digital-signatures/isystems/update', [DigitalSignaturesIsystemController::class, 'update'])->name('admin.digital-signatures.isystems.update');

    Route::delete('/digital-signatures/isystems/{isystem}/delete', [DigitalSignaturesIsystemController::class, 'delete'])->name('admin.digital-signatures.isystems.delete');
  });
});
