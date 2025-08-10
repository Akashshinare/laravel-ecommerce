@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Delete Brand
            <a href="{{ url('/admin/brands') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
        <h5>Are you sure you want to delete this brand?</h5>
        <p><strong>Name:</strong> {{ $brand->name }}</p>
        <p><strong>Status:</strong> {{ $brand->is_active == 1 ? 'Active' : 'Inactive' }}</p>

        @if(isset($brand->image) && file_exists(public_path($brand->image)))
        <p><strong>Image:</strong></p>
        <img src="{{ asset($brand->image) }}" alt="Brand Image" width="100" height="100">
        @endif

        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="{{ url('/admin/brands') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection