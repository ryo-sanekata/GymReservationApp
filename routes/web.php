<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [FacilityController::class, 'index'])->name('facilities.index');

Route::get('/facilities/search', [FacilityController::class, 'search'])->name('facilities.search');

Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');

Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');

Route::get('/facilities/{id}', [FacilityController::class, 'show'])->name('facilities.show');

Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');

Route::get('/reservations/complete', function () {
    return view('reservations.complete');
})->name('reservations.complete');

Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage')->middleware('auth');

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// 予約削除のルート（DELETEメソッド）
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])
    ->name('reservations.destroy')
    ->middleware('auth'); // ログイン必須

Route::middleware('auth')->group(function () {
    Route::get('/facilities/{facility}/reserve', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/facilities/{facility}/reserve', [ReservationController::class, 'store'])->name('reservations.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/facilities/create', [AdminFacilityController::class, 'create'])->name('admin.facilities.create');
    Route::post('/admin/facilities', [AdminFacilityController::class, 'store'])->name('admin.facilities.store');
});

