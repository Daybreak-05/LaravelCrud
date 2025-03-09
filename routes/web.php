<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;




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

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/error-417', function () {abort(417);
});

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');


Route::post('/products/{product}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
