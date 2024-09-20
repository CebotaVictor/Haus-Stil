@extends('layout.mainlayout')
    @section('shop', 'nav-item active')

    @section('content')
        <!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Shop</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section product-section before-footer-section">
		<div class="col-12 mb-4 ms-5">
          <span class="badge bg-pastel-primary text-primary text-uppercase-bold-sm">
            <h4>Topic categories</h4>
          </span>
        </div>
			@foreach ($categories as $cat)
			
				<div class="container">
					<div class="col-12 mb-4">
						<span class="badge bg-pastel-primary text-primary text-uppercase-bold-sm">
							<h3><strong>{{$cat->name}}</strong></h3>
						</span>
					</div>
					<div class="row">
						@foreach ($products as $prod )
							@php
								// Assuming $user->name includes the file extension
								$imagePath = 'public/images/products/' . $prod->name.'/'.$prod->imageName; // Correct path for checking file existence

								// Check if the file exists
								$imageExists = Storage::exists($imagePath);

								// Get the public URL for the image if it exists
								$imageUrl = $imageExists ? Storage::url($imagePath) : null;
							@endphp
							@if($cat->id == $prod->category_id)
								<!-- Start Column 1 -->
								<div class="col-12 col-md-4 col-lg-3 mb-5">
									<a class="product-item d-flex flex-column align-items-center" href="#">
										<div class="product-image-wrapper">
											<img src="{{ $imageUrl }}" width="200px" class="img-fluid product-thumbnail">
										</div>
										<h3 class="product-title">{{ $prod->name }}</h3>
										<strong class="product-price">{{ $prod->price }}</strong>
										<span class="icon-cross">
											<img src="images/cross.svg" class="img-fluid">
										</span>
									</a>
								</div>
							@endif

						@endforeach
						
						<div class="col-12 col-md-4 col-lg-3 mb-5">
                    		<a class="nav-link" href="{{ route('prod.create') }}">
                        		<button class="btn btn-danger btn-sm">
								<span class="icon-cross">
								<img src="images/cross.svg" class="img-fluid">
								</span>
								</button>
                    		</a>
                		</div>
				</div>
					
				</div>
			@endforeach
		</div>
				<div class="d-flex justify-content-center">
    				<a class="nav-link" href="{{ route('cat.create') }}">
        				<button class="btn btn-danger btn-sm ">Create new category</button>
				    </a>
				</div>
		</div>
    @endsection
