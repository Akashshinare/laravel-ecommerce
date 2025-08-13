@extends('layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Upload Product Images</h4>
        <a href="{{ route('productImages.index', $product->id) }}" class="btn btn-danger">Back</a>
    </div>

    <div class="card-body">
        {{-- Success Message --}}
        @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Upload Form --}}
        <form action="{{ route('productImages.store', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="images" class="form-label">Select Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple required>
                <small class="text-muted">Allowed: jpeg, png, jpg, gif. Max 2MB each.</small>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        {{-- Existing Images --}}
        @if($productImages->count() > 0)
        <hr>
        <h5>Existing Images</h5>
        <div class="row">
            @foreach($productImages as $img)
            <div class="col-md-3 text-center mb-3">
                <img src="{{ asset('images/products/'.$img->image) }}" alt="Image" class="img-thumbnail mb-2"
                    style="height:150px; object-fit:cover;">
                <form action="{{ route('productImages.destroy', [$product->id, $img->id]) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this image?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection