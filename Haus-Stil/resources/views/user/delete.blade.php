@extends('layout.emptylayout')
@section('content')
<div class="container mt-4">
        <h2 class="mb-4">Delete User</h2>

        <div class="alert alert-warning" role="alert">
            <strong>Warning!</strong> Are you sure you want to delete the following user? This action cannot be undone.
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $user->name }}</h5>
                <p class="card-text">Username: {{ $user->username }}</p>
                <p class="card-text">Email: {{ $user->email }}</p>
                <p class="card-text">password: {{ $user->password }}</p>
                <p class="card-text">Created At: {{ $user->created_at }}</p>
            </div>
        </div>

        <form action="{{ route('students.destroy', $user->id) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection