@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Product</h1>

    <form action="{{ route('prod.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group" style="width:20%;">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group" style="width:20%;">
            <label for="price">Product Price</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" required>
        </div>

        <div class="form-group" style="width:20%;">
            <label for="price">Product Description</label>
            <input type="text" name="description" id="price" class="form-control" step="0.01" required>
        </div>

        <div class="form-group" style="width:20%;">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="width:20%;">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>
@endsection
