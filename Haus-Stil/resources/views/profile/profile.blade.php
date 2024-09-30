@extends('layout.emptylayout')
@section('content')
<section style="background-color: #eee;">
<link href="{{ asset('css/feedback_cart.css') }}" rel="stylesheet">
  <div class="container py-5">
    

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
          @auth
            @php
                // Assuming $user->name includes the file extension
                $imagePath = 'public/images/users/' . $user->username.'/'.$user->imageName; // Correct path for checking file existence

                // Check if the file exists
                $imageExists = Storage::exists($imagePath);
                
                // Get the public URL for the image if it exists
                $imageUrl = $imageExists ? Storage::url($imagePath) : null;
            @endphp

            @if($imageUrl)
                <img src="{{ $imageUrl }}" class="img-fluid mb-4" style="width: 250px;">
            @else
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" 
                    class="img-fluid mb-4" style="width: 250px;">
            @endif
          @endauth
  
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card mb-4">
        
          <div class="card-body">
          <form action="{{ route('updateprofile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 row">
                <label for="firstname" class="col-sm-2 col-form-label">Firstname</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" disabled>
                </div>
            </div>

            
            <div class="mb-3 row">
                <label for="lastname" class="col-sm-2 col-form-label">Lastname</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}" disabled>
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
              <label for="user_type" class="col-sm-2 col-form-label">User Type</label>
              <div class="col-sm-9">
                <input name="user_type" id="user_type" class="form-control" value="{{ $user->user_type->name }}" disabled/>
              </div>
              @error('user_type')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
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
              document.getElementById("firstname").disabled = false;
              document.getElementById("lastname").disabled = false;
              document.getElementById("username").disabled = false;
              document.getElementById("email").disabled = false;
              
              document.getElementById("image").disabled = false;
              document.getElementById("saveButton").hidden = false;
            }
          </script>

    </div>
  </div>

  
  @if($user->user_type->value == 3&& !$feedbacks->empty())
  <div class="p-4 p-md-5 text-center text-lg-start shadow-1-strong rounded" style="background-color: rgb(59,93,80);">
  @foreach ($feedbacks as $feed)
    @php
      $user_from_feed = \App\Models\User::find($feed->user_id);
    @endphp
    <div class="row d-flex justify-content-center mt-3">
      <div class="col-md-10">
        <div class="card position-relative">
          <div class="card-body m-3">
            <div class="flex-shrink-0 ms-2 position-absolute" style="top: 10px; right: 10px;">
              <form action="{{route('delete.feedback', $feed->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link" title="Remove item" style="padding: 0; background: none; border: none;">
                  <i class="fas fa-trash" style="color: #dc3545;"></i>
                </button>
              </form>
            </div>
            <div class="row">
              <div class="col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-lg-0">
                <img src="{{ $imageUrl }}" class="rounded-circle img-fluid shadow-1" alt="woman avatar" width="100" height="100" />
              </div>
              <div class="col-lg-8">
                <p class="fw-bold lead mb-2"><strong>{{$user_from_feed->username}}</strong></p>
                <p class="fw-bold text-muted mb-0">Role : {{$user_from_feed->user_type->name}}</p>
                <p class="text-muted fw-light mb-4">{{$feed->message}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif

  </div>

  </section>
@endsection


