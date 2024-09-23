@extends('layout.mainlayout')

    @section('content')
    <link href="{{ asset('css/details.css') }}" rel="stylesheet">
    <div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
                    @php
                        // Assuming $user->name includes the file extension
                        $imagePath = 'public/images/products/' . $product->name.'/'.$product->imageName; // Correct path for checking file existence
                        // Check if the file exists
                        $imageExists = Storage::exists($imagePath);
                        
                        // Get the public URL for the image if it exists
                        $imageUrl = $imageExists ? Storage::url($imagePath) : null;
                        @endphp

                        @if($imageUrl)
                        <div class="preview-pic tab-content" style="width: 400px; overflow: hidden;">
						  <div class="tab-pane active" id="pic-1"> <img src="{{ $imageUrl }}" class="img-fluid mb-4"> </div>
						</div>
                        @else
                            <div class="preview-pic tab-content" style="width: 400px; overflow: hidden;">
                                <div class="tab-pane active" id="pic-1"> <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" 
                                class="img-fluid mb-4" style="width: 250px;">
                                </div>
                            </div>
                            
                    @endif
						
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{$product->name}}</h3>
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
						<p class="product-description">{{$product->description}}</p>
						<h4 class="price">current price: <span>{{$product->price}}</span></h4>
						<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
						
						<div class="action">
							<button class="add-to-cart btn no-rounded" type="button">add to cart</button>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    @endsection