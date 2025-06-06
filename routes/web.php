<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Models\City;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\CityController;
use App\Models\Citizen;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cities', CityController::class);
    Route::resource('citizens', CitizenController::class)->except(['show']);
    Route::get('/citizens/send-report', [CitizenController::class, 'sendReport'])->name('citizens.sendReport');
    // Otras rutas protegidas por autenticación
});


require __DIR__.'/auth.php';
