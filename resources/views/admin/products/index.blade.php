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
                    <th>Image</th>
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
                    <td>
                        @if(isset($item->image) && file_exists(public_path($item->image)))
                        <img src="{{ asset($item->image) }}" alt="Product Image" width="60" height="60"
                            style="object-fit:cover; border-radius:4px;">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
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
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa fa-list"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('products.show', $item->id) }}">Show</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('products.edit', $item->id) }}">Edit</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('productImages.index', $item->id) }}">Upload
                                        Images</a></li>
                                <li>
                                    <form action="{{ route('products.delete', $item->id) }}" method="GET"
                                        class="m-0 p-0">
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

    </div>
</div>

@endsection