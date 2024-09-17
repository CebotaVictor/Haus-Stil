@extends('layout.emptylayout')
@section('content')
<section style="background-color: #eee;">
  <div class="container py-5">
    

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="public/#eee" 
              class="img-fluid mb-4" style="width: 250px;">
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card mb-4">
          
          <div class="card-body">
          <form action="{{ route('updateprofile', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" disabled>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" disabled>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-9">
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}" disabled>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="image" class="col-sm-2 col-form-label">Profile Image</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" id="image" name="image" disabled>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-sm-9 offset-sm-2">
            <button type="button" class="btn btn-primary" id="editButton" onclick="enableFields()">Edit</button>
            <button type="submit" class="btn btn-success" id="saveButton" hidden>Save</button>
        </div>
    </div>
</form>
<script>
  function enableFields(){
    document.getElementById("name").disabled = false;
    document.getElementById("username").disabled = false;
    document.getElementById("email").disabled = false;
    
    document.getElementById("image").disabled = false;
    document.getElementById("saveButton").hidden = false;
  }
  </script>

    </div>
  </div>
</section>
@endsection


