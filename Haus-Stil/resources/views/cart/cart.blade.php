@extends('layout.mainlayout')
<link href="{{ asset('css/cart.css') }}" rel="stylesheet" >
@section('card', 'nav-item active')
@section('content')

@if($products && $carts)
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-xl-8">
            
            @foreach ($carts as $cart)
            <div class="card border shadow-none">
                <div class="card-body">
                    @php
                    if ($cart instanceof \App\Models\Cart){
                        $product = \App\Models\Product::find($cart->product_id);
                        
                    } else {
                        // This is a session cart item
                        $product = \App\Models\Product::find($cart['product_id']);

                    }
                    @endphp
                        
                    @php
                        $imagePath = 'public/images/products/' . $product->name.'/'.$product->imageName;
                        $imageExists = Storage::exists($imagePath);
                        $imageUrl = $imageExists ? Storage::url($imagePath) : null; 
                    @endphp
                    <div class="d-flex align-items-start border-bottom pb-3">
                        @if($imageUrl)
                        <div class="me-4">
                            <img src="{{ $imageUrl }}" alt="" class="avatar-lg rounded">
                        </div>
                        @else
                        
                        <div class="me-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="" class="avatar-lg rounded">
                        </div>
                        @endif
                        
                        <div class="flex-grow-1 align-self-center overflow-hidden">
                            <div>
                                <h5 class="text-truncate font-size-18"><a href="#" class="text-dark">{{$product->name}} </a></h5>
                            </div>
                        </div>
                        <div class="flex-shrink-0 ms-2">
                            <form action="{{ route('cart.delete', $product->id) }}" method="POST">
                            <ul class="list-inline mb-0 font-size-16">
                                <li class="list-inline-item">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm me-1 mb-2" data-mdb-tooltip-init
                                        title="Remove item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </li>
                            </ul>
                        </form>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mt-3">
                                    <p class="text-muted mb-2">Price</p>
                                    <h5 class="mb-0 mt-2"><span class="text-muted me-2"></span>{{$product->price}}</h5>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mt-3">
                                    <p class="text-muted mb-2">Quantity</p>
                                    <div class="d-inline-flex">
                                        <select class="form-select form-select-sm w-xl quantity-select" data-price="{{$product->price}}" data-id="{{$product->id}}">
                                            <option value="1" selected="">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
            
            
            
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to calculate the total price
        function calculateTotalPrice() {
            var quantitySelects = document.querySelectorAll('.quantity-select');
            var total = 0;

            // Loop through each quantity select
            quantitySelects.forEach(function(select) {
                var price = parseFloat(select.getAttribute('data-price'));
                var quantity = parseInt(select.value);
                total += price * quantity; // Add to total
            });

            // Update the total price in the UI
            var totalPriceElement = document.getElementById('total-price');
            totalPriceElement.textContent = total.toFixed(2); // Update UI with new total
        }

        // Add event listener to each select box
        var quantitySelects = document.querySelectorAll('.quantity-select');
        quantitySelects.forEach(function(select) {
            select.addEventListener('change', calculateTotalPrice); // Call calculateTotalPrice on change
        });

        // Initial calculation to set the total price
        calculateTotalPrice();
    });
</script>
<!-- end card -->

<div class="row my-4">
    <div class="col-sm-6">
        <a href="{{route('home.shop')}}" class="btn btn-link text-muted">
            <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
        </div> <!-- end col -->
        <div class="col-sm-6">
            <div class="text-sm-end mt-2 mt-sm-0">
                <a href="{{route('home.checkout')}}" class="btn btn-success">
                    <i class="mdi mdi-cart-outline me-1"></i> Checkout </a>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row-->
    </div>
    
    <div class="col-xl-4">
        <div class="mt-5 mt-lg-0">
            <div class="card border shadow-none">
                <div class="card-header bg-transparent border-bottom py-3 px-4">
                    <h5 class="font-size-16 mb-0">Order Summary <span class="float-end">#MN0124</span></h5>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr class="bg-light">
                                    <th>Total :</th>
                                    <td class="text-end">
                                        <span class="fw-bold" id="total-price">
                                            $ 745.2
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- end row -->
    
</div>
@else
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <h2 class="text-muted">Your cart is empty</h2>
        <!-- Button to redirect to store -->
        <a href="{{ route('home.shop') }}" class="btn btn-primary mb-4">Go to Store</a>
        
        <!-- Centered empty cart message -->
    </div>
</div>
@endif

@endsection

