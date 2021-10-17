@extends('layouts.app')
@section('content')
@auth
@php $total_items = 0 @endphp
@php $cartSession = 'cart'.auth()->user()->id @endphp
    @if(session($cartSession))
        @foreach(session($cartSession) as $id => $content)
            @if($content['user_id'] === auth()->user()->id)
                @php $total_items += 1 @endphp
            @endif
        @endforeach
    @endif
@endauth
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
        @auth
        @if(session($cartSession))
            @foreach(session($cartSession) as $id => $content)
                @if(auth()->user()->id === $content['user_id'])
                    <div class="row cart_item_list mb-5">
                        <div class="col-2 chechout_img_container">
                        <img style="width:100px; height: 100px;" src="/images/cameraStore.webp">
                        </div>
                        <div class="col-2 checkout_cam_details">
                            <p>{{ $content['camera']->model }}</p>
                            <p>Lorem ipsum{{-- $content['camera']->category()->name --}}</p>
                        </div>
                        <div class="col-2">
                            <input style="width: 70px;" type="number" value="{{ $content['quantity'] }}" id="quantity_{{ $content['camera']->id }}" class="form-control update_cart" />
                        </div>
                        <div class="col-2">{{ $content['camera']->price }}</div>
                        @php $total_price += $content['camera']->price * $content['quantity'] @endphp
                        @php $total_quantity += $content['quantity'] @endphp
                        <div class="col-2">{{ $content['camera']->price * $content['quantity'] }}$</div>
                        <div class="col-2"><button style="color: red;" id="delete_{{ $content['camera']->id }}" class="btn btn-light delete_item">Delete</button></div>
                    </div>
                @endif
            @endforeach
        @endif
        @if($total_items == 0)
            <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 385px;">
                <p style="font-size: 30px;">Cart is empty</p>
                <p>Head back to the store and add items</p>
            </div>
        @endif
        @endauth
        </div> 
        


    </div>
    <!-- #dee2e6;
    --bs-gray-400: #ced4da; -->
    <div style="padding: 3%; display:flex; flex-direction: column; background: #F5F5F5;" class="col-3 checkout_section">
        <p class="chechout_headings">Order Summary</p>
        <hr class="mb-3">
        <p>Total Quantity {{ $total_quantity }} item(s)</p>
        <div style="margin: 0;">
        <div class="mb-3">
            <label for="address" class="form-label chechout_labels">Shipping</label>
            <select name="address" id="address" class="form-select checkout_form_inputs" aria-label="Default select example">
            <option selected>Address</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
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
                <p>Total Cost <span class="to_strike" value="{{ $total_price }}">{{ $total_price }}<span>$</p>
            </div>
            <div style="text-align: right:" class="col new_final_price">
                
            </div>
        </div>
      
        <button class="btn canon_form_button checkout_form_inputs">Checkout</button>
        </div>
    </div>
</div>

<script>
    // $('#apply_promo').click(function(){
    //     var code = document.querySelector('#input_promo').value;
    //     console.log(code);
    //     $.ajax({
    //         url:"{{ route('applyPromoCode') }}",
    //         method: "POST",
    //         data: { 
    //             code:code,
    //             _token: '{{ csrf_token() }}',
    //         },
    //         success: function(response){
    //           console.log(response.result);
    //           //location.reload();
    //         //   if(response.result === "Invalid Code"){
    //         //     errorPromo();
    //         //   } else {
    //         //     successPromo(response);
    //         //   }
    //             //successPromo(response);
    //         }
    //     });
    // });

    function successPromo(response){
        console.log(response.result);
        var percentage = Number(response.result) / 100;
        var to_strike = document.querySelector('.to_strike');

        var old_price = Number(to_strike.getAttribute("value"));
        var new_price = old_price - (old_price * percentage); 
              
        to_strike.classList.add('strike_through');
        var new_final_price = document.querySelector('.new_final_price');
              
        new_final_price.innerHTML = `<p style="color: red; font-size: 20px;">${new_price}$</p>`;
    }

    function errorPromo(){
        var error_label = document.querySelector('.error_text').innerHTML = "Invalid Code";
        var input_promo = document.querySelector('.input_promo').classList.add('error_input');
    }

    $('.update_cart').change(function(){
        var id_value = $(this).attr('id');
        var id = id_value.split("_");
        var quantity = $(this).val();
        $.ajax({
            url:url+'/store/update/'/*+id[1]*/,
            method: "patch",
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
            url:url+'/store/remove/'/*+id[1]*/,
            method: "DELETE",
            data: { 
                _token: '{{ csrf_token() }}',
                id:id[1],
            },
            success: function(response){
              //updateQuantity(response, id[1]);
              location.reload();
            }
        });
    })
</script>
@endsection