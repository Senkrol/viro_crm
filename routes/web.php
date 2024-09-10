<?php




use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Inertia::render ищет X.vue в resources/js/pages/  вторым параметром отдаем данные


Route::get('/', function () {
  return Inertia::render('Welcome');
})->name('home');



Route::middleware(['auth', 'verified', 'redirectUser'])->prefix('user')->group(function () {

  Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/Admin/AuthRoute.php';
require __DIR__ . '/Admin/DigitalSignaturesRoute.php';
require __DIR__ . '/Admin/OrganizationsRoute.php';
require __DIR__ . '/Admin/viro_administration.php';
require __DIR__ . '/Admin/StatisticsRoute.php';


// стандартные странички авторизации и тд
require __DIR__ . '/auth.php';
