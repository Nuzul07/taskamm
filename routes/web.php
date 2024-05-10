<?php

use App\Http\Controllers\MachineController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/machineData', function() {
    return Inertia::render('Machine');
})->name('machine');

Route::get('/index', function () {
    return Inertia::render('aonstore/index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/machine', [MachineController::class, 'index'])->name('machine.index');
Route::post('/machine/store', [MachineController::class, 'store'])->name('machine.store');
Route::put('/machine/update', [MachineController::class, 'update'])->name('machine.update');
Route::delete('/machine/destroy', [MachineController::class, 'destroy'])->name('machine.destroy');

require __DIR__ . '/auth.php';
