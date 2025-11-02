<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Modules\Frontend\Controllers\HomepageController;
use App\Modules\Frontend\Controllers\ProductsController;
use App\Modules\Frontend\Controllers\ArticlesController;
use App\Modules\Frontend\Controllers\PagesController;

// Frontend Routes
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticlesController::class, 'show'])->name('articles.show');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [PagesController::class, 'storeContact'])->name('contact.store');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('role:Super Admin|Admin|Marketing')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});
