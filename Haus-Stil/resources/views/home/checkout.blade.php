@extends('layout.mainlayout')
    @section('cart', 'nav-item active')

    @section('content')
		<!-- Start Hero Section -->
		<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Checkout</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
			<!-- End Hero Section -->
			
			<div class="untree_co-section">
				<div class="container">
					@if($products)
					<div class="col-md-12 mt-4">
						<div class="table-responsive">
							<table class="table table-striped table-bordered" id="products-table">
								<thead>
									<tr>
										<th>Product Name</th>
										<th>Price</th>
										<th>Quantity</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($products as $prod)
									@php
										$prod_quantity = \App\Models\Cart::where('product_id', $prod['id'])
										->where('user_id', auth()->id())
										->first();
									@endphp
									<tr>
										<td>{{ $prod['name'] }}</td>
										<td class="product-price" data-price="{{ $prod['price'] }}">{{ $prod['price'] }}</td>
										<td class="product-quantity" data-quantity="{{ $prod_quantity->total_products }}">
											{{ $prod_quantity->total_products }}
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<td colspan="1"><strong>Total Price</strong></td>
										<td>
											<input type="text" class="form-control" id="total_prod" name="total_prod" required readonly>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
				</div>
				@endif
				
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						const productRows = document.querySelectorAll('#products-table tbody tr');
						let totalPrice = 0;
						
						productRows.forEach(function(row) {
							const priceElement = row.querySelector('.product-price');
							const quantityElement = row.querySelector('.product-quantity');
							
							const price = parseFloat(priceElement.dataset.price);
							console.log(price + '\n');
							const quantity = parseInt(quantityElement.dataset.quantity);
							console.log(quantity);
							if (!isNaN(price) && !isNaN(quantity)) {
								totalPrice += price * quantity;
							}
							console.log('\n' + totalPrice+'\n');
						});
						document.getElementById('total_prod').value = totalPrice.toFixed(2);
						document.getElementById('total_price').value = totalPrice.toFixed(2);
						
					});
				</script>

				<form action="{{route('checkout.store')}}" method="POST">
				<div class="row justify-content-center">
					<div class="col-md-6 mb-5 mb-md-0">
						<h2 class="h3 mb-3 text-black">Billing Details</h2>
						<div class="p-3 p-lg-5 border bg-white">
					@csrf
					@method('PUT') 
		            <div class="form-group">
		              <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
		              <input type="text" class="form-control" id="city" name="country">
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_fname" class="text-black">First Name<span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="firstname" name="firstname">
		              </div>
		              <div class="col-md-6">
		                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="lastname" name="lastname">
		              </div>
		            </div>

		            <div class="form-group row">
		              <div class="col-md-12">
		                <label for="c_address" class="text-black">Address<span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="address" name="address" placeholder="Street address">
		              </div>
		            </div>

		            

		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_state_country" class="text-black">City <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="city" name="city">
		              </div>
		              <div class="col-md-6">
		                <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="postal_number" name="postal_number">
		              </div>
		            </div>

		            <div class="form-group row mb-5">
		              <div class="col-md-6">
		                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="email" name="email">
		              </div>
		              <div class="col-md-6">
		                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
		              </div>
					  <div class="col-md-12">
		                <label class="text-black">Total price<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="total_price" name="total_price" required readonly>
		              </div>
		            </div>
				<div class="card-body border p-0 mt-5 bg-white">
                        <p >
							<a class="btn p-2 w-100 h-100 d-flex align-items-center justify-content-between no-rounded"
							data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
								aria-controls="collapseExample">
								<span>Credit Card</span>
							</a>
                        </p>
                        <div class="collapse show p-3 pt-0" id="collapseExample">
                            <div class="row">	
                                <div class="col-lg-7">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <label for="" class="form__label">Card Number</label>
                                                    <input type="text" class="form-control" id="card_number" name="card_number" placeholder=" ">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <label for="" class="form__label">MM / yy</label>
                                                    <input type="text" class="form-control" placeholder=" " id="expire_date" name="expire_date">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <label for="" class="form__label">cvv code</label>
                                                    <input type="password" class="form-control" placeholder=" " id="ccv" name="ccv">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <label for="" class="form__label">name on the card</label>
                                                    <input type="text" class="form-control" placeholder=" " id="card_name" name="card_name">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class ="btn mt-3" type="subbmit">Confirm</button>
                                            </div>
                                        </div>
										
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

		        </div>
		      </div>
		      <!-- </form> -->
		    </div>
		  </div>

	@endsection
