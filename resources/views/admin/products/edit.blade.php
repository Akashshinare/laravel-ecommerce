@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Edit Product
            <a href="{{ url('/admin/products') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                <!-- Product Name -->
                <div class="col-md-12 mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}"
                        required />
                </div>

                <!-- Slug -->
                <div class="col-md-12 mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}" />
                </div>

                <!-- Small Description -->
                <div class="col-md-12 mb-3">
                    <label for="small_description">Small Description</label>
                    <textarea name="small_description" class="form-control"
                        rows="2">{{ old('small_description', $product->small_description) }}</textarea>
                </div>

                <!-- Description -->
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control"
                        rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Original Price -->
                <div class="col-md-6 mb-3">
                    <label for="original_price">Original Price</label>
                    <input type="number" name="original_price" class="form-control" step="0.01"
                        value="{{ old('original_price', $product->original_price) }}" required />
                </div>

                <!-- Selling Price -->
                <div class="col-md-6 mb-3">
                    <label for="selling_price">Selling Price</label>
                    <input type="number" name="selling_price" class="form-control" step="0.01"
                        value="{{ old('selling_price', $product->selling_price) }}" required />
                </div>

                <!-- Quantity -->
                <div class="col-md-6 mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control" min="0"
                        value="{{ old('quantity', $product->quantity) }}" required />
                </div>

                <!-- Trending -->
                <div class="col-md-6 mb-3 d-flex align-items-center">
                    <input type="checkbox" name="is_trending" id="is_trending" class="form-check-input me-2" value="1"
                        {{ $product->is_trending == 1 ? 'checked' : '' }} />
                    <label for="is_trending" class="form-check-label">Is Trending</label>
                </div>

                <!-- Active -->
                <div class="col-md-6 mb-3 d-flex align-items-center">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input me-2" value="1"
                        {{ $product->is_active == 1 ? 'checked' : '' }} />
                    <label for="is_active" class="form-check-label">Is Active</label>
                </div>

                <!-- Image -->
                <div class="col-md-12 mb-3">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if(isset($product->image) && file_exists(public_path($product->image)))
                    <div class="mt-2">
                        <img src="{{ asset($product->image) }}" alt="Product Image" width="100" height="100">
                    </div>
                    @endif
                </div>

                <!-- SEO Details -->
                <div class="col-md-12 mt-4 mb-3">
                    <h4>SEO Details</h4>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                        value="{{ old('meta_title', $product->meta_title) }}" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meta_description">Meta Description</label>
                    <textarea name="meta_description" class="form-control"
                        rows="3">{{ old('meta_description', $product->meta_description) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meta_keyword">Meta Keyword</label>
                    <textarea name="meta_keyword" class="form-control"
                        rows="3">{{ old('meta_keyword', $product->meta_keyword) }}</textarea>
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </div>
        </form>

    </div>
</div>

@endsection