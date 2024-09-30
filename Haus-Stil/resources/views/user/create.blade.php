@extends('layout.emptylayout')
@section('content')
<div class="container mt-4">
        <h2 class="mb-4">User Form</h2>

        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group" style="width:20%;">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your firstname" required>
            </div>

            <div class="form-group" style="width:20%;">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your lastname" required>
            </div>

            <div class="form-group" style="width:20%;">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>

            <div class="form-group" style="width:20%;">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>

            
            <div class="form-group" style="width:20%;">
                <label for="password-confirm">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="form-group" style="width:20%;">
                <label for="password-confirm">Confirm password</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
            </div>

           

            <div class="form-group mb-2" style="width:20%;">
                <label for="image">Select Image</label>
                <input type="file" class="form-control" id="image" name="image">
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

            <button type="submit" class="btn btn-primary" >Submit</button>
        </form>
    </div>
@endsection