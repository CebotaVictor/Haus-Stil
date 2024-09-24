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
</div>

@endsection
