@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Product Images - {{ $product->name }}</h4>
        <a href="{{ route('productImages.create', $product->id) }}" class="btn btn-primary">Upload New Images</a>
    </div>

    <div class="card-body">
        @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if($productImages->count() > 0)
        <div class="row">
            @foreach($productImages as $img)
            <div class="col-md-3 text-center mb-3">
                <img src="{{ asset('images/products/'.$img->image) }}" class="img-thumbnail mb-2"
                    style="height:150px; object-fit:cover;">
                <form action="{{ route('productImages.destroy', [$product->id, $img->id]) }}" method="POST"
                    onsubmit="return confirm('Delete this image?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
            @endforeach
        </div>
        @else
        <p>No images found for this product.</p>
        @endif
    </div>
</div>
@endsection