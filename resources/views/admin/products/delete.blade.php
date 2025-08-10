@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h4>Delete Product</h4>
        <a href="{{ route('products.index') }}" class="btn btn-secondary float-end">Back</a>
    </div>
    <div class="card-body">
        <h5>Are you sure you want to delete this product?</h5>

        <p><strong>Product Name:</strong> {{ $product->name }}</p>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection