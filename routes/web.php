<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

// public
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/search', [ProductController::class, 'search'])->name('search');

// register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// favorites
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

// Admin actions
Route::get('/products/create', [ProductController::class, 'create'])->middleware(['auth'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->middleware(['auth'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware(['auth'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->middleware(['auth'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware(['auth'])->name('products.destroy');



Route::resource('admin/users', UserController::class)->middleware(['auth'])->names('admin.users');
Route::resource('roles', RoleController::class)->middleware(['auth']);
