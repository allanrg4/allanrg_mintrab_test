<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect(route('people.index'));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/people', [PersonController::class, 'index'])
        ->name('people.index');

    Route::get('/people/create', [PersonController::class, 'create'])
        ->name('people.create');

    Route::post('/people/store', [PersonController::class, 'store'])
        ->name('people.store');

    Route::get('/people/{person}', [PersonController::class, 'show'])
        ->name('people.show');

    Route::get('/people/{person}/edit', [PersonController::class, 'edit'])
        ->name('people.edit');

    Route::patch('/people/{person}/update', [PersonController::class, 'update'])
        ->name('people.update');

    Route::patch('/people/{person}/approve', [PersonController::class, 'approve'])
        ->middleware('role:technical')
        ->name('people.approve');

    Route::patch('/people/{person}/reject', [PersonController::class, 'reject'])
        ->middleware('role:technical')
        ->name('people.reject');

    Route::delete('/people/{person}/destroy', [PersonController::class, 'destroy'])
        ->name('people.destroy');
});

require __DIR__.'/auth.php';
