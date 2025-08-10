@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Add Brand
            <a href="{{ url('/admin/brands') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('/admin/brands') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-md-12 mb-3">
                    <label for="name">Brand Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="is_active">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active') ? 'checked' : '' }}>
                        Active (Check if active)
                    </label>
                    @error('is_active')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Save Brand</button>
                </div>

            </div>
        </form>

    </div>
</div>

@endsection