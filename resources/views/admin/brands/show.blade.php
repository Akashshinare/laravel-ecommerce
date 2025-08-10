@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <h4>Brand Name: {{ $brand->name }}</h4>
        <h4>Status: {{ $brand->is_active == 1 ? 'Active' : 'Inactive' }}</h4>

        @if(isset($brand->image) && file_exists(public_path($brand->image)))
        <h4>Image:</h4>
        <img src="{{ asset($brand->image) }}" alt="Brand Image" width="100" height="100">
        @endif
    </div>
</div>
@endsection