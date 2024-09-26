@extends('layout.emptylayout')
@section('content')
<div class="container mt-4">
        <h2 class="mb-4">Category Form</h2>

        <form action="{{ route('cat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group " style="width:20%;">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required>
            </div>

            <div class="form-group mb-2" style="width:20%;">
                <label for="image">Select Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            
            <button type="submit" class="btn btn-primary" >Submit</button>
        </form>
    </div>
@endsection