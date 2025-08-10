@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Products</h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>

    <div class="card-body">

        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if ($products->isEmpty())
        <p>No products found.</p>
        @else
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Original Price</th>
                    <th>Selling Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Trending</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category ? $item->category->name : 'N/A' }}</td>
                    <td>{{ $item->brand ? $item->brand->name : 'N/A' }}</td>
                    <td>₹{{ number_format($item->original_price, 2) }}</td>
                    <td>₹{{ number_format($item->selling_price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        @if($item->is_active == 1)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        @if($item->is_trending == 1)
                        <span class="badge bg-info text-dark">YES</span>
                        @else
                        <span class="badge bg-light text-dark">NO</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.show', $item->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('products.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                        <form action="{{ route('products.delete', $item->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

    </div>
</div>

@endsection