<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get(); // Include multiple images
        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }
}