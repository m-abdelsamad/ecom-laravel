@extends('layouts.app')
@section('content')

@php $total_items = 0 @endphp
@if(count($cart))
    @foreach($cart as $cartItem)
        @php $total_items += 1 @endphp
    @endforeach
@endif

<div style="margin: 5% auto; height: 600px;" class="shadow container cart_box row">
    <div style="padding: 3%;" class="col-9 checkout_cart">
        <div class="cart_heading">
            <div style="padding: 0 10px;" class="row">
                <div class="col">
                    <p class="cart_title">Shopping Cart</p>
                </div>
                <div class="col">
                    <p style="text-align: right;" class="cart_count">{{ $total_items }} items</p>
                </div>
            </div>
            <hr>
        </div>
        <div class="row mb-4 mt-4">
            <div style="text-align: center;" class="col-4 checkout_headings">Product Details</div>
            <div class="col-2 checkout_headings">Quantity</div>
            <div class="col-2 checkout_headings">Price</div>
            <div style="" class="col-2 checkout_headings">Total</div>
            <div class="col-2 checkout_headings">Remove</div>
        </div>
        <div class="item_scroll">
        @php $total_price = 0 @endphp
        @php $total_quantity = 0 @endphp
        @if(count($cart) > 0)
            @foreach($cart as $cartItem)
                    <div class="row cart_item_list mb-5">
                        <div class="col-2 chechout_img_container">
                        <img style="width:100px; height: 100px;" src="/images/cameraStore.webp">
                        </div>
                        <div class="col-2 checkout_cam_details">
                            <p>{{ $cartItem->camera->model }}</p>
                            <p>Lorem ipsum{{-- $cartItem->category->name --}}</p>
                        </div>
                        <div class="col-2">
                            <input style="width: 70px;" type="number" value="{{ $cartItem->quantity }}" id="quantity_{{ $cartItem->camera->id }}" class="form-control update_cart" />
                        </div>
                        <div class="col-2">{{ $cartItem->camera->price }}</div>
                        @php $total_price += $cartItem->camera->price * $cartItem->quantity @endphp
                        @php $total_quantity += $cartItem->quantity @endphp
                        <div class="col-2">{{ $cartItem->camera->price * $cartItem->quantity }}$</div>
                        <div class="col-2"><button style="color: red;" id="delete_{{ $cartItem->camera->id }}" class="btn btn-light delete_item">Delete</button></div>
                    </div>
            @endforeach
        @else
            <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 385px;">
                <p style="font-size: 30px;">Cart is empty</p>
                <p>Head back to the store and add items</p>
            </div>
        @endif
        </div> 
        


    </div>
    <!-- #dee2e6;
    --bs-gray-400: #ced4da; -->
    <div style="padding: 3%; display:flex; flex-direction: column; background: #F5F5F5;" class="col-3 checkout_section">
        <p class="chechout_headings">Order Summary</p>
        <hr class="mb-3">
        @if(count($cart) > 0)
            <!-- <button class="btn btn-light empty_cart" style="color: red;">Empty Cart</button> -->
        @endif
        <p>Total Quantity {{ $total_quantity }} item(s)</p>
        <div style="margin: 0;">
        <div class="mb-3">
            <label for="address" class="form-label chechout_labels">Shipping</label>
            <select name="address" id="address" class="form-select checkout_form_inputs" aria-label="Default select example">
            <option selected>Address</option>
            @if(count($addresses) > 0)
                @foreach($addresses as $address)
                    <option value="{{ $address->id }}">{{ $address->street_name }}, building-no: {{ $address->building_number }}</option>
                @endforeach
            @else
                <option value="">No addresses found</option>
            @endif
            </select>
        </div>
        <form action="{{ route('applyPromoCode') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label  for="promo_code" class="form-label chechout_labels">Promo Code</label>
                <input id="input_promo" name="promo_code" type="text" class="form-control checkout_form_inputs @error('error_promo') error_input @enderror" placeholder="Code">
                @if(session('error_promo'))
                    <div class="error_text">
                        {{ session('error_promo')}}
                    </div>
                @endif
            </div>
            <button type="submit" id="apply_promo" class="btn canon_form_button checkout_form_inputs">Apply</button>
        </form>
        <hr class="mb-3 checkout_form_inputs">
        <div class="row">
            <div class="col">
                <p>Total Cost
                    @if( isset($customerOrder) )
                        <span class="to_strike" value="{{ $total_price }}">{{ $customerOrder->price }}$<span>
                    @else
                        <span class="to_strike" value="{{ $total_price }}">0$<span>
                    @endif
                </p>
            </div>
            <!--<div style="text-align: right:" class="col new_final_price">   
            </div> -->
        </div>
        
        <button type="submit" id="checkout_btn" class="btn canon_form_button checkout_form_inputs" data-bs-toggle="modal" data-bs-target="#exampleModal">Checkout</button>
        
        </div>
    </div>
</div>


<!--modal-->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

<script>

    $('.empty_cart').click(function(){
        $.ajax({
            url: "{{ route('emptyCart') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(){
                location.reload();
            }
        })
    });

    $('#checkout_btn').click(function(){
        $.ajax({
            url:"{{route('checkedOut')}}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response){
                location.reload();
            }
        })
    });

    $('.update_cart').change(function(){
        var id_value = $(this).attr('id');
        var id = id_value.split("_");
        var quantity = $(this).val();
        $.ajax({
            url:url+'/store/update/'/*+id[1]*/,
            method: "POST",
            data: { 
                _token: '{{ csrf_token() }}',
                id:id[1],
                quantity:quantity,
            },
            success: function(response){
              //updateQuantity(response, id[1]);
              location.reload();
            }
        });
    });

    $('.delete_item').click(function(){
        var id_value = $(this).attr('id');
        var id = id_value.split("_");
        $.ajax({
            url:url+'/store/remove/'+id[1],
            method: "POST",
            data: { 
                _token: '{{ csrf_token() }}',
                //id:id[1],
            },
            success: function(response){
              //updateQuantity(response, id[1]);
              location.reload();
            }
        });
    })
</script>
@endsection