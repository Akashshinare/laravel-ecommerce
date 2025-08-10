@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Add Categories
            <a href="{{ url('/admin/categories') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error) {{-- Returns array of errors --}}
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('/admin/categories') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <!-- Category Name -->
                <div class="col-md-12">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" />
                </div>

                <!-- Description -->
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">--Select Status--</option>
                        <option value="0">Show</option>
                        <option value="1">Hide</option>
                    </select>
                </div>

                <!-- Popular -->
                <div class="col-md-6">
                    <label for="popular">Popular</label>
                    <input type="checkbox" name="popular" id="popular"> Check if you want to as popular
                </div>

                <!-- Image -->
                <div class="col-md-12">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <!-- SEO Details -->
                <div class="col-md-12 mt-4">
                    <h4>SEO Details</h4>
                </div>

                <div class="col-md-12">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-6">
                    <label for="meta_keyword">Meta Keyword</label>
                    <textarea name="meta_keyword" id="meta_keyword" class="form-control" rows="3"></textarea>
                </div>

                <!-- Submit -->
                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection