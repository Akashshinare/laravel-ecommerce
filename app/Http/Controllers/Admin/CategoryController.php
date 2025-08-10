<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Str;
use App\Models\Category; // Added to use Category model

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();

        // Generate UUID and slug
        // $data['uuid'] = Str::uuid()->toString();
        // $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgExt = $file->getClientOriginalExtension(); // fixed: should use $file, not $request

            $filename = time() . '.' . $imgExt;
            $path = 'uploads/category/';
            $file->move($path, $filename);

            $data['image'] =  $path . $filename;
        }

        // $data['popular'] = $request->popular == true ? 1 : 0;

        Category::create($data); // fixed: capital C and semicolon

        return redirect('/admin/categories')->with('status', 'Category Created'); // fixed: added semicolon
    }

       public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

      public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

   public function update(CategoryFormRequest $request, Category $category)
{
    $data = $request->validated();

    if ($request->hasFile('image')) {
        if (!empty($category->image) && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $file = $request->file('image');
        $imgExt = $file->getClientOriginalExtension();
        $filename = time() . '.' . $imgExt;
        $path = 'uploads/category/';
        $file->move($path, $filename);

        $data['image'] = $path . $filename;
    } else {
        $data['image'] = $category->image;
    }

    $data['popular'] = $request->has('popular') ? 1 : 0;

    $category->update($data);

    return redirect('/admin/categories')->with('status', 'Category Updated');
}

public function delete(Category $category)
{
    $category->delete();

    return redirect()->route('categories.index')->with('status', 'Category deleted successfully');
}

}