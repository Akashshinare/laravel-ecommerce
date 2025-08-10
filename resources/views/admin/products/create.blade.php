@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Add Product
            <a href="{{ url('/admin/products') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">

        {{-- Validation Errors --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('/admin/products') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <!-- Product Name -->
                <div class="col-md-12 mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" required />
                </div>

                <!-- Slug -->
                <div class="col-md-12 mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" />
                </div>

                <!-- Small Description -->
                <div class="col-md-12 mb-3">
                    <label for="small_description">Small Description</label>
                    <textarea name="small_description" id="small_description" rows="2" class="form-control"></textarea>
                </div>

                <!-- Description -->
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                </div>

                <!-- Original Price -->
                <div class="col-md-6 mb-3">
                    <label for="original_price">Original Price</label>
                    <input type="number" name="original_price" id="original_price" class="form-control" step="0.01"
                        required />
                </div>

                <!-- Selling Price -->
                <div class="col-md-6 mb-3">
                    <label for="selling_price">Selling Price</label>
                    <input type="number" name="selling_price" id="selling_price" class="form-control" step="0.01"
                        required />
                </div>

                <!-- Quantity -->
                <div class="col-md-6 mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="0" required />
                </div>

                <!-- Trending -->
                <div class="col-md-6 mb-3 d-flex align-items-center">
                    <input type="checkbox" name="is_trending" id="is_trending" class="form-check-input me-2"
                        value="1" />
                    <label for="is_trending" class="form-check-label">Is Trending</label>
                </div>

                <!-- Active -->
                <div class="col-md-6 mb-3 d-flex align-items-center">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input me-2" value="1"
                        checked />
                    <label for="is_active" class="form-check-label">Is Active</label>
                </div>

                <!-- Image -->
                <div class="col-md-12 mb-3">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control" />
                </div>

                <!-- SEO Details -->
                <div class="col-md-12 mt-4 mb-3">
                    <h4>SEO Details</h4>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meta_keyword">Meta Keyword</label>
                    <textarea name="meta_keyword" id="meta_keyword" rows="3" class="form-control"></textarea>
                </div>

                <!-- Submit -->
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </form>

    </div>
</div>

@endsection