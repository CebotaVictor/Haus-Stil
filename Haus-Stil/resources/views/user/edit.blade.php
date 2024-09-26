@extends('layout.emptylayout')
@section('content')
<div class="container mt-4">
        <h2 class="mb-4">Update User</h2>

        <!-- Display success or error messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Update User Form -->
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            <div class="form-group" style="width:20%;">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="width:20%;">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="width:20%;">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="form-group" style="width:20%;">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control">
                <small class="form-text text-muted">Leave empty if you don't want to change the password.</small>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="width:20%;">
                <label for="image">Select Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3" style="width:20%;">
            <label for="user_type">Select user Type</label>
            <select name="user_type" id="user_type" class="form-control">
                @foreach($userTypes as $type)
                    <option value="{{ $type->value }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('user_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
           </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection