@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Brands
            <a href="{{ url('/admin/brands/create') }}" class="btn btn-primary float-end">Add Brand</a>
        </h4>
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

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand Name</th>
                    <th>Image</th>
                    <th>Is Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        @if ($item->image)
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" width="80" height="50">
                        @else
                        No Image
                        @endif
                    </td>
                    <td>{{ $item->is_active == 1 ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('brands.show', $item->id) }}" class="btn btn-info">Show</a>

                        <a href="{{ route('brands.edit', $item->id) }}" class="btn btn-success">Edit</a>

                        <a href="{{ route('brands.delete', $item->id) }}" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this brand?')">
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection