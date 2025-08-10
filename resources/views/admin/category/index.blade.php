@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Categories
            <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary float-end">Add Category</a>
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
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Popular</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach($categories as $item)
            <tbody>
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->status == 0 ? 'Show' : 'Hide' }}</td>
                    <td>{{ $item->popular == 1 ? 'YES' : 'NO' }}</td>
                    <td>
                        <a href="{{ route('categories.show', $item->id) }}" class="btn btn-info">Show</a>


                        <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-success">Edit</a>


                        <a href="{{ route('categories.delete', $item->id) }}" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this category?')">
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