@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <h4>Product Name: {{ $product->name }}</h4>
        <h4>Slug: {{ $product->slug }}</h4>
        <h4>Category: {{ $product->category ? $product->category->name : 'N/A' }}</h4>
        <h4>Brand: {{ $product->brand ? $product->brand->name : 'N/A' }}</h4>
        <h4>Small Description:</h4>
        <p>{!! nl2br(e($product->small_description)) !!}</p>
        <h4>Description:</h4>
        <p>{!! nl2br(e($product->description)) !!}</p>
        <h4>Original Price: ₹{{ number_format($product->original_price, 2) }}</h4>
        <h4>Selling Price: ₹{{ number_format($product->selling_price, 2) }}</h4>
        <h4>Quantity: {{ $product->quantity }}</h4>
        <h4>Status: {{ $product->is_active == 1 ? 'Active' : 'Inactive' }}</h4>
        <h4>Trending: {{ $product->is_trending == 1 ? 'Yes' : 'No' }}</h4>
        @if(isset($product->image) && file_exists(public_path($product->image)))
        <h4>Image:</h4>
        <img src="{{ asset($product->image) }}" alt="Product Image" width="150" height="150">
        @endif
        <h4>Meta Title: {{ $product->meta_title }}</h4>
        <h4>Meta Description:</h4>
        <p>{!! nl2br(e($product->meta_description)) !!}</p>
        <h4>Meta Keyword:</h4>
        <p>{!! nl2br(e($product->meta_keyword)) !!}</p>
    </div>
</div>
@endsection