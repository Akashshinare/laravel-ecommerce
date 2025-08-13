<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController; 
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController; 

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Categories routes
    Route::resource('categories', CategoryController::class);
    Route::get('categories/delete/{category}', [CategoryController::class, 'delete'])->name('categories.delete');

    // Brands routes
    Route::resource('brands', BrandController::class);
    Route::get('brands/delete/{brand}', [BrandController::class, 'delete'])->name('brands.delete');

    // Products routes
    Route::resource('products', ProductController::class);
    Route::get('products/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');

  Route::get('{product}/images', [ProductImageController::class, 'index'])->name('productImages.index');
    Route::get('{product}/images/create', [ProductImageController::class, 'create'])->name('productImages.create'); // GET
    Route::post('{product}/images', [ProductImageController::class, 'store'])->name('productImages.store'); // POST
    Route::delete('{product}/images/{image}', [ProductImageController::class, 'destroy'])->name('productImages.destroy');

});