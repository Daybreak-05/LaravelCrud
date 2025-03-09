<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return redirect()->route('products.index');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('roles', RoleController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/product/{id}/add-favorite', [ProductController::class, 'addToFavorites'])->name('product.addFavorite');
    Route::post('/product/{id}/remove-favorite', [ProductController::class, 'removeFromFavorites'])->name('product.removeFavorite');
    Route::get('/profile/favorites', [ProfileController::class, 'showFavorites'])->name('profile.favorites');
    Route::post('/products/{id}/add-to-favorites', [ProductController::class, 'addToFavorites'])->name('products.addToFavorites');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
