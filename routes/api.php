<?

use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CartApiController;

// Products API
Route::get('/products', [ProductApiController::class, 'index']); // Get all products with images

// Cart API
Route::post('/cart/add', [CartApiController::class, 'add']);      // Add product to cart
Route::get('/cart', [CartApiController::class, 'list']);         // List cart items
Route::put('/cart/{id}', [CartApiController::class, 'update']);  // Update quantity
Route::delete('/cart/{id}', [CartApiController::class, 'delete']); // Remove item
Route::post('/cart/checkout', [CartApiController::class, 'checkout']); // Checkout