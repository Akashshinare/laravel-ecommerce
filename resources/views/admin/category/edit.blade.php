@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Edit Categories
            <a href="{{ url('/admin/categories') }}" class="btn btn-danger float-end">Back</a>
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

        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-md-12">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" />
                </div>

                <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{!! $category->description !!}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">--Select Status--</option>
                        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Show</option>
                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Hide</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="popular">Popular</label>
                    <input type="checkbox" name="popular" id="popular" {{ $category->popular == 1 ? 'checked' : '' }}>
                    Check if you want to mark as popular
                </div>

                <div class="col-md-12">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if(isset($category->image) && file_exists(public_path($category->image)))
                    <div class="mt-2">
                        <img src="{{ asset($category->image) }}" alt="Category Image" width="80" height="80">
                    </div>
                    @endif
                </div>

                <div class="col-md-12 mt-4">
                    <h4>SEO Details</h4>
                </div>

                <div class="col-md-12">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control"
                        value="{{ old('meta_title', $category->meta_title) }}">
                </div>

                <div class="col-md-6">
                    <label for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" class="form-control"
                        rows="3">{{ old('meta_description', $category->meta_description) }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="meta_keyword">Meta Keyword</label>
                    <textarea name="meta_keyword" id="meta_keyword" class="form-control"
                        rows="3">{{ old('meta_keyword', $category->meta_keyword) }}</textarea>
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary">update</button>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection