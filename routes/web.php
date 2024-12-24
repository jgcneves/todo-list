<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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


Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Profile
    Route::prefix('profile')->name('.profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Task
    // Route::resource('tasks', TaskController::class);
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/' ,[TaskController::class, 'index'])->name('index');
        Route::get('/create' ,[TaskController::class, 'create'])->name('create');
        Route::post('/' ,[TaskController::class, 'store'])->name('store');
        Route::get('/{task}' ,[TaskController::class, 'show'])->name('show');
        Route::put('/{id}' ,[TaskController::class, 'update'])->name('update');
        Route::put('/{id}/{status}' ,[TaskController::class, 'updateStatus'])->name('update.status');
        Route::delete('/{id}' ,[TaskController::class, 'destroy'])->name('destroy');
        Route::get('/{task}/edit' ,[TaskController::class, 'edit'])->name('edit');

    });
});

require __DIR__.'/auth.php';
