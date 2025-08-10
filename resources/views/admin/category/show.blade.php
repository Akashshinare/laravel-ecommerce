@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <h4>Category Name: {{ $category->name }}</h4>
        <h4>Description: {!! $category->description !!}</h4>
        <h4>Status: {{ $category->status == 0 ? 'Show' : 'Hide' }}</h4>
        <h4>Popular: {{ $category->popular == 1 ? 'Yes' : 'No' }}</h4>
        @if(isset($category->image) && file_exists(public_path($category->image)))
        <h4>Image:</h4>
        <img src="{{ asset($category->image) }}" alt="Category Image" width="100" height="100">
        @endif
        <h4>Meta Title: {{ $category->meta_title }}</h4>
        <h4>Meta Description: {{ $category->meta_description }}</h4>
        <h4>Meta Keyword: {{ $category->meta_keyword }}</h4>
    </div>
</div>
@endsection