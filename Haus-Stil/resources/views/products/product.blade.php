  @extends('layout.mainlayout')

  @section('content')
  <link href="{{ asset('css/details.css') }}" rel="stylesheet">

  <div class="container mb-4">
      <div class="card">
          <div class="container-fluid">
              <div class="row d-flex align-items-center"> <!-- Align items center to prevent stretching -->
                  <!-- Image Container -->
                  <div class="preview col-md-6" style="max-width: 500px;"> <!-- Fixed width for image -->
                      @php
                          $imagePath = 'public/images/products/' . $product->name.'/'.$product->imageName;
                          $imageExists = Storage::exists($imagePath);
                          $imageUrl = $imageExists ? Storage::url($imagePath) : null;
                      @endphp

                      @if($imageUrl)
                          <div class="preview-pic tab-content" style="overflow: hidden;">
                              <div class="tab-pane active" id="pic-1">
                                  <img src="{{ $imageUrl }}" class="img-fluid mb-4" style="width: 100%;"> <!-- Image fully contained -->
                              </div>
                          </div>
                      @else
                          <div class="preview-pic tab-content" style="overflow: hidden;">
                              <div class="tab-pane active" id="pic-1">
                                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                      class="img-fluid mb-4" style="width: 250px;">
                              </div>
                          </div>
                      @endif
                  </div>

                  <!-- Text Container -->
                  <div class="details col-md-6 bg-white p-4 d-flex flex-column" style="flex-grow: 1;"> <!-- Ensure it doesn't stretch more than the image -->
                      <form action="{{ route('cart.cart', $product->id) }}" method="POST">
                      @csrf
                          <h3 class="product-title">{{ $product->name }}</h3>
                          <div class="rating">
                              <div class="stars">
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                              </div>
                              <span class="review-no">41 reviews</span>
                          </div>
                          <p class="product-description">{{ $product->description }}</p>
                          <h4 class="price">Current price: <span>{{ $product->price }}</span></h4>
                          <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>

                          <div class="action">
                              <button class="add-to-cart btn btn-primary no-rounded" type="submit">Add to Cart</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

      
    @if($reviews->empty())
    <div class="p-4 p-md-5 text-center text-lg-start shadow-1-strong rounded" style="background-color: rgb(59,93,80);">
    @foreach ($reviews as $review)
      @php
        $user_from_review = \App\Models\User::find($review->user_id);
        if($user_from_review->imageName){
          $user_imagePath = 'public/images/users/' . $user_from_review->name.'/'.$user_from_review->imageName;
          $user_imageExists = Storage::exists($user_imagePath);
          $user_imageUrl = $user_imageExists ? Storage::url($user_imagePath) : "https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp";
        }
        else $user_imageUrl = "https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp";
      @endphp
      <div class="row d-flex justify-content-center mt-3">
        <div class="col-md-8">
          <div class="card" style="height:200px;">
            <div class="card-body m-3" style="height:10px;">
              <div class="flex-shrink-0 ms-2 position-absolute" style="top: 10px; right: 10px;">
                <form action="{{route('review.delete', $review->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  @if($review->user_id == $user_from_review->id && auth()->check())
                  <button type="submit" class="btn btn-link" title="Remove item" style="padding: 0; background: none; border: none;">
                    <i class="fas fa-trash" style="color: #dc3545;"></i>
                  </button>
                  @endif
                </form>
              </div>
              <div class="row">
                <div class="col-lg-2 d-flex justify-content-center align-items-center mb-4 mb-lg-0">  
                  <img src="{{ $user_imageUrl }}" class="rounded-circle img-fluid shadow-1" alt="avatar" width="50" height="50" />
                </div>
                <div class="col-lg-8">
                  <p class="fw-bold lead mb-2"><strong>{{$user_from_review->username}}</strong></p>
                  <p class="fw-bold text-muted mb-0">Role : {{$user_from_review->user_type->name}}</p>
                  <p class="text-muted fw-light mb-4">{{$review->message}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
    <form action="{{route('review.store' , $product->id)}}" method="POST">
    @csrf
    <div class="input-group input-group-lg shadow-sm position-relative">
      <textarea class="form-control bg-white border-0 px-1" id="message" name="message" cols="30" rows="5" placeholder="Type a comment"></textarea>
      <button type="submit" class="btn btn-primary text-uppercase-bold-sm position-absolute" style="bottom: 10px; right: 10px;">
          Post
      </button>
    </div>
    </form>
    

  </div>

  @endsection
