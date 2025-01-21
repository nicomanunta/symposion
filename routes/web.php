<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventDressCodeController;
use App\Http\Controllers\Admin\EventLocationController;
use App\Http\Controllers\Admin\FavoriteController;
use App\Http\Controllers\Admin\GallaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ROTTE CRUD
Route::middleware('auth', 'verified')->name('admin.')->group(function () {
    Route::resource('galleries', GallaryController::class);
    Route::resource('favorites', FavoriteController::class);
    Route::resource('event-locations', EventLocationController::class);
    Route::resource('event-dress-codes', EventDressCodeController::class);
    Route::resource('events', EventController::class);
    Route::resource('users', ProfileController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
