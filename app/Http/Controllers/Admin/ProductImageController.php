<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    // List images for a product
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $productImages = ProductImage::where('product_image', $productId)->get();

        return view('admin.products.images.index', compact('product', 'productImages'));
    }

    // Show upload form
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        $productImages = ProductImage::where('product_image', $productId)->get();

        return view('admin.products.images.create', compact('product', 'productImages'));
    }

    // Store uploaded images
    public function store(Request $request, $productId)
    {
        $request->validate([
            'images'   => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($productId);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

                // Save to public/images/products
                $imageFile->move(public_path('images/products'), $imageName);

                ProductImage::create([
                    'product_image' => $product->id, // match DB column name
                    'image'         => $imageName,
                    'reorder'       => 0,
                ]);
            }
        }

        return redirect()->route('productImages.create', $product->id)
                         ->with('status', 'Images uploaded successfully!');
    }

    // Delete an image
    public function destroy($productId, $id)
    {
        $image = ProductImage::findOrFail($id);

        $imagePath = public_path('images/products/' . $image->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image->delete();

        return redirect()->route('productImages.create', $productId)
                         ->with('status', 'Image deleted successfully!');
    }
}