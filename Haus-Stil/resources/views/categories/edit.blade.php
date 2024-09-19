@extends('layout.emptylayout')
@section('content')
<div class="container mt-4">
        <h2 class="mb-4">Update category</h2>

        <!-- Display success or error messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Update cat Form -->
        <form action="{{ route('cat.update', $categories->id) }} " enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT') 

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $categories->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
            <label for="image">Select Image</label>
            <input type="file" class="form-control" id="image" name="image">
                <!-- @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror -->
            </div>

        

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection