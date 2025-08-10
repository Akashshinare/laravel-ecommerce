@extends('layouts.admin')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">
            Edit Brand
            <a href="{{ url('/admin/brands') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                {{-- Brand Name --}}
                <div class="col-md-12">
                    <label for="name">Brand Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $brand->name) }}" required>
                </div>

                {{-- Active Status --}}
                <div class="col-md-6 mt-3">
                    <label for="is_active">Status</label>
                    <select name="is_active" id="is_active" class="form-select">
                        <option value="1" {{ $brand->is_active == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $brand->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Upload Image --}}
                <div class="col-md-6 mt-3">
                    <label for="image">Upload Image (optional)</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if(isset($brand->image) && file_exists(public_path($brand->image)))
                    <div class="mt-2">
                        <img src="{{ asset($brand->image) }}" alt="Brand Image" width="80" height="80">
                    </div>
                    @endif
                </div>

                <div class="col-md-12 text-end mt-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection