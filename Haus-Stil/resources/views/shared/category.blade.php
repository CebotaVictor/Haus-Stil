
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<link href="{{ asset('css/category.css') }}" rel="stylesheet">


<section class="pt-8 pt-md-9">
    <div class="container">
      
      <!-- Form -->
      <form class="mt-4">
        <div class="input-group input-group-lg shadow-sm">
          <span class="input-group-text border-0">
            <i class="fas fa-search fa-xs text-secondary mb-1"></i>
          </span>
          
          <input type="text" class="form-control bg-white border-0 px-1" placeholder="Search help topics...">

          <span class="input-group-text border-0 py-1 pe-2">
            <button type="submit" class="btn btn-primary text-uppercase-bold-sm">
              Search
            </button>
          </span>
        </div>
      </form>

      <!-- Categories -->
      <div class="row mt-6">
        <div class="col-12 mb-4">
          <span class="badge bg-pastel-primary text-primary text-uppercase-bold-sm" id ="category">
            Topic categories
          </span>
        </div>
  
  
        @foreach ($categories as $cat )
          @php
              // Assuming $user->name includes the file extension
            $imagePath = 'public/images/categories/' . $cat->name.'/'.$cat->imageName; // Correct path for checking file existence

            // Check if the file exists
            $imageExists = Storage::exists($imagePath);

            // Get the public URL for the image if it exists
            $imageUrl = $imageExists ? Storage::url($imagePath) : null;
          @endphp
          <div class="col-md-3 mb-4" id="category">
            <a href="{{route('home.shop')}}" class="card align-items-center text-decoration-none border-0 hover-lift-light py-4">
                <div class="product-image-wrapper">
                    @if($imageUrl)
                        <img src="{{ $imageUrl }}" width="200px" class="img-fluid product-thumbnail">
                    @else
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" 
                            class="img-fluid">
                    @endif
                </div>
                <h3 class="product-title">{{ $cat->name }}</h3>
                <span class="icon-cross"> 
                    <img src="images/cross.svg" class="img-fluid">
                </span>
            </a>
        </div>
        @endforeach


      </div>
    </div>
  </section>
