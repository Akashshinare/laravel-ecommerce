<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\CreatedProductFormRequest;
use App\Http\Requests\UpdateProductFormRequest;

class ProductController extends Controller
{
    // List all products with eager loading category and brand
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('admin.products.index', compact('products'));
    }

    // Show create product form
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    // Store new product
    public function store(CreatedProductFormRequest $request)
    {
        $data = $request->validated();

        // Generate UUID and slug if not provided
        $data['uuid'] = $data['uuid'] ?? Str::uuid()->toString();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/products/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        }

        // Checkbox handling
        $data['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Product::create($data);

        return redirect()->route('products.index')->with('status', 'Product Created Successfully');
    }

    // Show single product details
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Show edit form for product
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    // Update product data
    public function update(UpdateProductFormRequest $request, Product $product)
    {
        $data = $request->validated();

        // Generate slug if not provided
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        // Handle image upload and delete old image if exists
        if ($request->hasFile('image')) {
            if (!empty($product->image) && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/products/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        } else {
            // Keep existing image if no new image uploaded
            $data['image'] = $product->image;
        }

        // Checkbox handling
        $data['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $product->update($data);

        return redirect()->route('products.index')->with('status', 'Product Updated Successfully');
    }

   // Show delete confirmation page
// Show delete confirmation
public function delete(Product $product)
{
    return view('admin.products.delete', compact('product'));
}

// Perform actual delete
public function destroy(Product $product)
{
    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }
    $product->delete();

    return redirect()->route('products.index')->with('status', 'Product deleted successfully.');
}


}