@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Delete Category
            <a href="{{ url('/admin/categories') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
        <h5>Are you sure you want to delete this category?</h5>
        <p><strong>Name:</strong> {{ $category->name }}</p>
        <p><strong>Status:</strong> {{ $category->status == 0 ? 'Show' : 'Hide' }}</p>
        <p><strong>Popular:</strong> {{ $category->popular == 1 ? 'YES' : 'NO' }}</p>

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="{{ url('/admin/categories') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection