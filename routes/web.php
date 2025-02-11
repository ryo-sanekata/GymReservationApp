<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');

Route::get('/facilities/{id}', [FacilityController::class, 'show'])->name('facilities.show');

Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');

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
