<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventDressCodeController;
use App\Http\Controllers\Admin\EventLocationController;
use App\Http\Controllers\Admin\FavoriteController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// ROTTE CRUD
Route::middleware('auth', 'verified')->name('admin.')->group(function () {
    Route::resource('galleries', GalleryController::class);
    Route::resource('favorites', FavoriteController::class);
    Route::resource('event-locations', EventLocationController::class);
    Route::resource('event-dress-codes', EventDressCodeController::class);
    Route::resource('events', EventController::class);
    Route::resource('users', ProfileController::class);
});


Route::post('/favorites/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle');
Route::get('/users/{user}', [ProfileController::class, 'usersProfile'])->name('profile.users');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
});

require __DIR__.'/auth.php';
