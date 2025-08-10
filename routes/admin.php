<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController; 
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Categories routes
    Route::resource('categories', CategoryController::class);
    Route::get('categories/delete/{category}', [CategoryController::class, 'delete'])->name('categories.delete');

    // Brands routes
    Route::resource('brands', BrandController::class);
    Route::get('brands/delete/{brand}', [BrandController::class, 'delete'])->name('brands.delete');

    Route::resource('products', ProductController::class);
Route::get('products/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');


});