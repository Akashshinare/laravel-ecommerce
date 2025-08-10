<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\BrandFormRequest;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandFormRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = 'uploads/brands/';
        $file->move(public_path($path), $filename);
        $data['image'] = $path . $filename;
    } else {
        $data['image'] = null; // now works because DB column is nullable
    }

    $data['is_active'] = $request->has('is_active') ? 1 : 0;

    Brand::create($data);

    return redirect('/admin/brands')->with('status', 'Brand created successfully.');
}


    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(BrandFormRequest $request, Brand $brand)
    {
        $data = $request->validated();

        // Handle image update if provided
        if ($request->hasFile('image')) {
            if (!empty($brand->image) && file_exists(public_path($brand->image))) {
                unlink(public_path($brand->image));
            }
            $file = $request->file('image');
            $imgExt = $file->getClientOriginalExtension();
            $filename = time() . '.' . $imgExt;
            $path = 'uploads/brands/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        } else {
            // Keep old image or set to null if there was none before
            $data['image'] = $brand->image ?? null;
        }

        // Ensure active flag is set
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $brand->update($data);

        return redirect('/admin/brands')->with('status', 'Brand updated successfully.');
    }

    public function delete(Brand $brand)
    {
        if (!empty($brand->image) && file_exists(public_path($brand->image))) {
            unlink(public_path($brand->image));
        }

        $brand->delete();

        return redirect('/admin/brands')->with('status', 'Brand deleted successfully.');
    }
}