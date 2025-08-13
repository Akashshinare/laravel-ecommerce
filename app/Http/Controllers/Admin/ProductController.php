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
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(CreatedProductFormRequest $request)
    {
        $data = $request->validated();
        $data['uuid'] = $data['uuid'] ?? Str::uuid()->toString();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/products/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        }

        $data['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Product::create($data);

        return redirect()->route('products.index')->with('status', 'Product Created Successfully');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(UpdateProductFormRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

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
            $data['image'] = $product->image;
        }

        $data['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $product->update($data);

        return redirect()->route('products.index')->with('status', 'Product Updated Successfully');
    }

    public function delete(Product $product)
    {
        return view('admin.products.delete', compact('product'));
    }

    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $product->delete();

        return redirect()->route('products.index')->with('status', 'Product deleted successfully.');
    }
}