<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function(){
    return Inertia::render('LoginPage');
})->name('loginPage');

Route::get('/registerPage', function () {
    return Inertia::render('RegisterPage');
})->name('registerPage');


Route::middleware('auth')->group(function () {
    Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');
    Route::post('/plants', [PlantController::class, 'store'])->name('plants.store');
    Route::post('/plants/{plantId}', [PlantController::class, 'update'])->name('plants.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
