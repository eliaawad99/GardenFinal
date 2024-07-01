<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', function(){
    return Inertia::render('Testing');
})->name('testing');

Route::get('/dashboard', function(){
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');

Route::middleware('auth')->group(function () {
    Route::get('/home', [PlantController::class, 'index'])->name('plants.index');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
