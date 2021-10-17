@extends('layouts.app')
@section('content')
    <!-- <div class="profile">
        <div class="profile_content">
            <div class="imgContainer">
                <img src="/images/profile.png" class="img-fluid" alt="...">
                <p class="user_email">{{ auth()->user()->email }}</p>
            </div>
            <div class="user_info">
                <p class="greeting">Welcome, <span class="greeting_user">{{ auth()->user()->name }}</span></p>
                <p class="profile_action_heading">Settings</p>
                <div class="btn-group-vertical">
                    <p class="profile_action" data-bs-toggle="modal" data-bs-target="#profile_settings">Change Email Address</p>
                    <p class="profile_action" data-bs-toggle="modal" data-bs-target="#profile_settings">Change Password</p>
                    <p class="profile_action" data-bs-toggle="modal" data-bs-target="#profile_settings">Change Profile Photo</p>
                </div>
            </div>        
        </div>
    </div>-->

<div class="profile_heading" style="margin:7%; auto;">
    <h1 style="color:red; font-weight: 300; text-align:left; margin-left: 7%;" class="display-3">Welcome, {{ auth()->user()->name }}</h1>
    <div class="profie_subheading">
        <h1 style="text-align: center; font-weight: 300; margin-left: 42%" class="display-5 ml-3">~To Canon</h1>
    </div>
</div>


<!--Main Content-->
<div class="container" style="margin: 0 auto;">
  <div style="margin: 4%; padding-left: 5px;">
    <h1 id="" class="display-3">Account Settings</h1> 
  </div>

  <div class="row">
    <div class="col-1"></div>

    <div class="col-3 account_settings_cards shadow">
      <div>
        <h1 class="display-6 mt-3">Add Payment</h1>
      </div>
      <form action="{{ route('addPayment') }}" method="POST">
        @csrf
        @if(session('paymentAdded'))
          <div class="mb-2 success_label" style="font-size: 20px;">
            {{ session('paymentAdded') }}
          </div>
        @endif
        <div class="mb-3">
          <label for="card_number" class="form-label">Card Number</label>
          <input name="card_number" type="text" maxlength="14" class="form-control account_settings_inputs @error('card_number') error_input @enderror" id="card_number" placeholder="" pattern="[0-9]*" inputmode="numeric">
          @error('card_number')
            <div class="error_text"> 
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="card_holder" class="form-label">Card holder</label>
          <input name="card_holder" maxlength="20" type="text" class="form-control account_settings_inputs @error('card_holder') error_input @enderror" id="card_holder">
          @error('card_holder')
            <div class="error_text"> 
              {{ $message }}
            </div>
          @enderror
        </div>

        <!--expiration date and cvc-->
        <div class="row">
          <div class="mb-3">
            <label for="" class="form-label">Expiration Date</label>
            <div style="display:flex;">
              <input name="expiration_date_month" type="text" maxlength="2" class="form-control account_settings_inputs @error('expiration_date_month') error_input @enderror" placeholder="MM" id="" style="width: 70px;">
              <input name="expiration_date_year" type="text" maxlength="2" class="form-control account_settings_inputs @error('expiration_date_month') error_input @enderror" placeholder="YY" id="" style="width: 70px; margin-left: 5%;">
            </div>
            @error('expiration_date_month')
              <div class="error_text"> 
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="cvc_code" class="form-label">CVC code</label>
            <input name="cvc_code" type="text" maxlength="3" class="form-control account_settings_inputs @error('cvc_code') error_input @enderror" id="cvc_code" pattern="[0-9]*" inputmode="numeric">
            @error('cvc_code')
            <div class="error_text"> 
              {{ $message }}
            </div>
          @enderror
          </div>
        </div>

        <button type="submit" class="btn canon_form_button">Add Payment</button>
      </form>
    </div>
    
    <div class="col-3 account_settings_cards shadow mt-5">
      <div>
        <h1 class="display-6 mt-3">Change Password</h1>
      </div>
      @if(session('passUpdateSucces'))
        <div class="success_label mt-2">
            {{ session('passUpdateSucces') }}
        </div>
      @endif
      @if(session('updatePassError'))
        <div class="error_label mt-2">
            {{ session('updatePassError') }}
        </div>
      @endif
      <form action="{{ route('updatePassword') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="old_password" class="form-label">Old Password</label>
          <input name="old_password" type="password" class="form-control account_settings_inputs  @error('old_password') error_input @enderror" id="old_password" placeholder="">
          @error('old_password')
            <div class="error_text"> 
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="new_password" class="form-label">New Password</label>
          <input name="password" type="password" class="form-control account_settings_inputs  @error('password') error_input @enderror" id="new_password">
          @error('password')
            <div class="error_text"> 
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="new_password_confirm" class="form-label">Confirm New Password</label>
          <input name="password_confirmed" type="password" class="form-control account_settings_inputs" id="new_password_confirm">
        </div>

        <button type="submit" class="btn canon_form_button">Update</button>
      </form>
    </div>
    
    
    <div class="col-3 account_settings_cards shadow">
      <div>
        <h1 class="display-6 mt-3">Add Address</h1>
      </div>
      <form action="{{route('addAddress')}}" method="POST">
        @if(session('addressAdded'))
          <div class="mb-2 success_label" style="font-size: 20px;">
            {{ session('addressAdded') }}
          </div>
        @endif
        @csrf 
        <div class="mb-3">
            <label for="" class="form-label">Enter Country</label>
            <select id="country_name" name="country_name" class="form-select account_settings_inputs @error('country_name') error_input @enderror" aria-label="Default select example">
              <option id="select_country_default" selected value="">Choose...</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Enter City</label>
            <select  id="city_name" name="city_name" class="form-select account_settings_inputs @error('city_name') error_input @enderror" aria-label="Default select example" disabled>
              <option id="select_city_default" selected value="">Choose...</option>
              <div id="" class="city_select_values">
                <option value="">test</option>
              </div>
            </select>
        </div>

        <div class="mb-3">
            <label for="street_name" class="form-label">Street Name</label>
            <input name="street_name" type="text" class="form-control account_settings_inputs" id="street_name">
        </div>

        <div class="mb-3">
            <label for="building_number" class="form-label">Building Number</label>
            <input name="building_number" type="text" class="form-control account_settings_inputs" id="building_number">
        </div>

        <button type="submit" class="btn canon_form_button">Add Address</button>
      </form>
    </div>
    
    <div class="col-1"></div>
  </div>
</div>




<div class="row">
  <div class="col-10" style="margin:2% auto;">

  <div style="margin: 4%; padding-left: 5px;">
    <h1 id="" class="display-3">Account Details</h1>
  </div>


  <div class="row shadow" style="height: 620px;">
    <div class="col-6">
       
      <h1 class="display-6 mt-3 mb-4" style="text-align: center; font-weight: 350; margin-left: 6px;">Payment Methods</h1>
      <div class="cards_holder">
        @if(count($payments) > 0)
          @foreach($payments as $payment)
            <div class="card row shadow">
                <div class="card_details">
                <img class="card_logo" style="" src="/images/card-sim.png" alt="">
                <i id="rpayment_{{ $payment->id }}" class="fas fa-minus-circle remove_icon" style="position: absolute; top: -6px; right: -9px;"></i>
                  <div class="card_number mt-3">
                    <p class="card_number_title">Card Number</p>
                    @php $cardNumber = substr($payment->card_number, 11) @endphp
                    <p class="card_info">xxxx xxxx xxx {{ $cardNumber }}</p>
                  </div>
                  <p><span class="card_number_title">Expiration </span> {{ $payment->expiration_date }}</</p>
                  <div class="holder">
                    <p class="card_number_title">Card Holder</p>
                    <p style="font-size: 25px;">{{ $payment->card_holder}}</</p>
                  </div>
              
                </div>
            </div>
          @endforeach
        @else
          <div class="no_details_found">
            <h4>No Payments Methods Saved</h4>
          </div>  
        @endif  

        <!-- <div class="card row shadow">
            <div class="card_details">
            <img class="card_logo" style="" src="/images/card-sim.png" alt="">
              
              <div class="card_number mt-3">
                <p class="card_number_title">Card Number</p>
                <p class="card_info">xxxx xxxx xxx 570</p>
              </div>
              <p><span class="card_number_title">Expiration</span> 11/29</p>
              <div class="holder">
                <p class="card_number_title">Card Holder</p>
                <p style="font-size: 25px;">Card Holder</p>
              </div>
          
            </div>
        </div>

        <div class="card row shadow">
            <div class="card_details">
            <img class="card_logo" style="" src="/images/card-sim.png" alt="">
              
              <div class="card_number mt-3">
                <p class="card_number_title">Card Number</p>
                <p class="card_info">xxxx xxxx xxx 570</p>
              </div>
              <p><span class="card_number_title">Expiration</span> 11/29</p>
              <div class="holder">
                <p class="card_number_title">Card Holder</p>
                <p style="font-size: 25px;">Card Holder</p>
              </div>
          
            </div>
        </div>

        <div class="card row shadow">
            <div class="card_details">
            <img class="card_logo" style="" src="/images/card-sim.png" alt="">
              
              <div class="card_number mt-3">
                <p class="card_number_title">Card Number</p>
                <p class="card_info">xxxx xxxx xxx 570</p>
              </div>
              <p><span class="card_number_title">Expiration</span> 11/29</p>
              <div class="holder">
                <p class="card_number_title">Card Holder</p>
                <p style="font-size: 25px;">Card Holder</p>
              </div>
          
            </div>
        </div> -->
      </div>
       
    </div>
    <div class="col-6">
      <h1 class="display-6 mt-3 mb-4" style="text-align: center; font-weight: 350;  margin-left: 6px;">Saved Addresses</h1>
      <div class="addresses_holder">
        @if(count($addresses) > 0)
          @php $index = 1 @endphp
          @foreach($addresses as $address)
            <div id="addressBlock_{{ $address->id }}" class="address_block">
              
              <div class="row">    
                <div class="address_details col-5">
                  <h4 class="">Address {{ $index }}</h4>
                  <p><span class="chosen_street_name_{{ $address->id }}">{{ $address->street_name }}</span>, Building <span class="chosen_building_number_{{ $address->id }}">{{ $address->building_number }}</span></p>
                  <p><span class="chosen_city_name_{{ $address->id }}">{{ $address->city_name }}</span>, <span class="chosen_country_name_{{ $address->id }}">{{ $address->country_name }}</span>.</p>
                </div> 
                <div id="addressSettings_{{ $address->id }}" class="col-3 hidden address_edit_holder address_edit_holder_{{ $address->id }}" style="margin: 2%;">
                  <button id="updateAddress_{{ $address->id }}" class="btn btn-light mb-2 address_edit" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: red;">Update</button>
                  <button id="removeAddress_{{ $address->id }}" class="btn btn-light address_delete" style="color: red;">Remove</button>
                </div> 
              </div>
            </div>
            @php $index++ @endphp
          @endforeach
        @else
          <div class="no_details_found">
            <h4>No Addresses Saved</h4>
          </div> 
        @endif

      </div>
    </div>
  </div>
  

        <!--HighCharts-->
        <div class="" style="margin: 4%; padding-left: 5px; margin-top: 10%;">
            <h1 id="" class="display-3">Canon Statistics</h1> 
        </div>
        <div class="" style="margin-bottom: 10%;">
            <div id="carouselExampleControlsNoTouching" class="carousel slide shadow carousel-dark mb-4" data-bs-ride="carousel">
                <div class="carousel-inner" style="height: 500px;">
                    <div class="carousel-item active">
                        <h2 class="display-6 mt-4 container">Camera Model Sales</h2>
                        <div id="pieChart-container" class="">
                        </div>
                    </div>

                    <div class="carousel-item">
                        <h2 class="display-6 mt-4 container">Canon Popularity Rates</h2>
                        <div id="barChart-container" style="padding: 10px;">
                        </div>
                    </div>


                    <!-- <div class="carousel-item">
                    </div> -->
                </div>
                <button class="carousel-control-prev" style="color: black;" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" style="color: black;" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

          @if(count($cameras) > 0)
              <div style="margin: 4%; padding-left: 5px;">
                <h1 id="shot_by_canon" class="display-3">#ShotOnCanon</h1> 
              </div>
              <div class="upload_img_form mb-5">
                  <div class="row">
                      <div class="col-12">
                          <img style="width: 100%; margin:0; height: 550px;" class="" src="/images/cam-slider-1.webp" class="d-block w-100" alt="...">
                      </div>
                  </div>
                  <form action="{{ route('makeUpload') }}" method="POST" enctype="multipart/form-data" style="margin: 0 0.89%;">
                      @csrf
                      <div class="row shadow" style="margin-top: 0;">
                              <div class="col-6" style="padding: 5%;">
                                  <h2 class="mb-3 display-5" >Share Your Pictures shot on Canon</h2>

                                  <div class="mb-3">
                                      <label for="upload_img" class="form-label">Upload Image</label>
                                      <input name="upload_img" type="file" class="form-control @error('upload_img') error_input @enderror" id="upload_img">
                                      @error('upload_img')
                                          <div class="error_text">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>

                                  
                                  <div class="mb-3">
                                      <label for="shot_by" class="form-label">Shot On?</label>
                                      <select id="shot_by" name="shot_by" class="form-select @error('shot_by') error_input @enderror" aria-label="Default select example">
                                          <option selected value="">Choose...</option>
                                          @foreach($cameras as $camera)
                                              <option value="{{$camera->id}}">{{$camera->model}}</option>
                                          @endforeach
                                      </select>
                                      @error('shot_by')
                                      <div class="error_text">
                                          {{ $message }}
                                      </div>
                                      @enderror
                                  </div> 
                                  


                              </div>
                              <div class="col-6" style="padding: 5%;">
                                  <div class="form-floating mt-3 mb-3">
                                      <textarea name="img_description" class="form-control @error('img_description') error_input @enderror" placeholder="Leave a comment here" id="img_description" style="height: 100px"></textarea>
                                      <label for="img_description">Description</label>
                                      @error('img_description')
                                          <div class="error_text">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>

                                  <button type="submit" class="btn canon_form_button">Upload</button>

                                  @if(session('success_upload'))
                                      <div>
                                          <p class="display-6 mt-3">{{ session('success_upload') }}</p>
                                      </div>
                                  @endIf
                              </div>
                              
                      </div>
                  </form>
              </div>
          @endif

          
          


          @if(auth()->user()->user_type === "admin")
            @include('auth.admin')
          @endif

          <div style="margin: 4%; padding-left: 5px; margin-bottom: 2%;">
                <h1 id="prev_orders" class="display-3">Previous Orders</h1> 
          </div>
          @if(count($customerOrders) > 0)
              @foreach($customerOrders as $customerOrder)
              <div style="padding: 3%; margin: 2% auto;" class="col-10 checkout_cart mb-6 shadow">
                  <div class="cart_heading">
                      <div style="padding: 0 10px;" class="row">
                          <div class="col">
                              <p class="cart_title">Order-Id: {{$customerOrder->id}}</p>
                          </div>
                          <div class="col">
                              <p style="text-align: right;" class="cart_count">Total Price {{ $customerOrder->price }}$</p>
                          </div>
                      </div>
                      <hr>
                  </div>
                  <div class="row mb-4 mt-4" style="width: 100%;">
                      <div style="text-align: center;" class="col-4 checkout_headings">Product Details</div>
                      <div class="col-2 checkout_headings">Quantity</div>
                      <div class="col-2 checkout_headings">Price</div>
                      <div style="" class="col-2 checkout_headings">Total</div>
                  </div>
                  <div class="">
                  @foreach($cart as $cartItem)
                      @if($cartItem->customer_order_id == $customerOrder->id)
                          <div class="row cart_item_list mb-5">
                              <div class="col-2 chechout_img_container">
                                  <img style="width:100px; height: 100px;" src="/images/cameraStore.webp">
                              </div>
                              <div class="col-2 checkout_cam_details">
                                  <p>{{ $cartItem->camera->model }}</p>
                                  <p>Lorem ipsum{{-- $cartItem->category->name --}}</p>
                              </div>
                              <div class="col-2">{{ $cartItem->quantity }}</div>
                              <div class="col-2">{{ $cartItem->camera->price }}</div>
                              <div class="col-2">{{ $cartItem->camera->price * $cartItem->quantity }}$</div>
                          </div>
                      @endif
                  @endforeach
                  </div>
                  @if($customerOrder->promo_code_id != null)
                      <div>
                          <p>Discount Code was applied at checkout of this order.</p>
                      </div>
                  @endif
              </div>
              @endforeach
          @else
              <div style="padding: 3%;" class="col-10 checkout_cart mb-6">
                  <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 385px; position: relative; left: 15%;">
                      <p style="font-size: 30px;">No Orders Yet</p>
                      <p>Head back to the store and make your first order</p>
                  </div>
              </div>
          @endif





  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="change_address_form">

          </div>
      </div>
    </div>
  </div>
</div>




<script>

  $('.address_block').hover(function(){
      var id_value = $(this).attr('id');
      var id = id_value.split("_");

      $(`.address_edit_holder_${id[1]}`).toggleClass("hidden"); 
    });


    $('.address_edit').click(function(){
      var id_value = $(this).attr('id');
      var id = id_value.split("_");

      var building_number = $(`.chosen_building_number_${id[1]}`).text();
      var country_name = $(`.chosen_country_name_${id[1]}`).text();
      var city_name = $(`.chosen_city_name_${id[1]}`).text();
      var street_name = $(`.chosen_street_name_${id[1]}`).text();
      
      let html = `
        <div class="mb-3">
            <label for="country_name_update" class="form-label">Country</label>
            <input name="country_name_update" type="text" class="form-control account_settings_inputs" id="country_name_update" placeholder="${country_name}">
        </div>

        <div class="mb-3">
            <label for="city_name_update" class="form-label">City</label>
            <input name="city_name_update" type="text" class="form-control account_settings_inputs" id="city_name_update" placeholder="${city_name}">
        </div>

        <div class="mb-3">
            <label for="street_name_update" class="form-label">Street Name</label>
            <input name="street_name_update" type="text" class="form-control account_settings_inputs" id="street_name_update" placeholder="${street_name}">
        </div>

        <div class="mb-3">
            <label for="building_number_update" class="form-label">Building Number</label>
            <input name="building_number_update" type="text" class="form-control account_settings_inputs" id="building_number_update" placeholder="${building_number}">
        </div>


        <button type="button" id="${id[1]}" class="mt-2 mb-3 btn btn-light update_addres_form_btn" style="color:red;">Save changes</button>
      `;

      $('.change_address_form').html(html);

    });


    $('.update_addres_form_btn').click(function(){
      
      var id = $(this).attr('id');
      var country_name_update = doucument.querySelector('#country_name_update').value;
      var city_name_update = doucument.querySelector('#city_name_update').value;
      var street_name_update = doucument.querySelector('#street_name_update').value;
      var building_number_update = doucument.querySelector('#building_number_update').value;

      console.log(id);
        $.ajax({
            url:url+'/dashboard/updateAddress/'+id,
            method: "POST",
            data: { 
                _token: '{{ csrf_token() }}',
                country_name_update:country_name_update,
                city_name_update: city_name_update,
                street_name_update: street_name_update,
                building_number_update: building_number_update,
            },
            success: function(response){
              location.reload();
            }
        });
    });



  

  //delete payment method
  $('.remove_icon').click(function(){
      var id_value = $(this).attr('id');
      var id = id_value.split("_");
        $.ajax({
            url:url+'/dashboard/removePayment/'+id[1],
            method: "POST",
            data: { 
                _token: '{{ csrf_token() }}',
            },
            success: function(response){
              location.reload();
            }
        });
  });


    //countries API------------------------------------------------------------------------------------------
    //for address select values
    let countries = [];
    let cities = [];



    function setUpCountrySelect(){
      var select_country_default = document.getElementById('select_country_default');
      for(let i =0; i< countries.length; i++){
        var country = countries[i];
        var newSelect = `<option value="${country.country}">${country.country}</option>`;
        select_country_default.insertAdjacentHTML('beforebegin', newSelect);
      }
    }


    const getApiData = async function(){
		  const res = await fetch(`https://countriesnow.space/api/v0.1/countries`);
		  const data = await res.json();
	    //console.log(data.data);

      countries = data.data;
      //console.log(countries);

      setUpCountrySelect();
    }

    

    //rendering cities
    function setUpCitySelect(){
      $('#city_name').html("");
      
      var newSelect ='<option value="">Choose...</option>\n';
      for(let i =0; i< cities.length; i++){
        var city = cities[i];
        newSelect += `<option value="${city}">${city}</option>\n`;
      }
      $('#city_name').html(newSelect);
    }



    $('#country_name').change(function(){
        $('#city_name').prop('disabled', false);
        var country_val = $(this).val();
        cities = (countries.find(country => country.country === country_val)).cities;
        console.log(cities);
        setUpCitySelect();
    });
    //--------------------------------------------------------------------------------------------------------------------------




    $(document).ready(function(){
        var dashboard_links = document.querySelector('.dashboard_links');
        var html = `
                <li class="nav-item"><a href="#shot_by_canon" class="nav-link">#ShotOnCanon</a></li>
                @if(auth()->user()->user_type === "admin")
                <li class="nav-item"><a href="#admin_forms" class="nav-link">Admin Forms</a></li>
                @endif
                <li class="nav-item"><a href="#prev_orders" class="nav-link">Orders</a></li>
                
                
                `;
        dashboard_links.innerHTML = html;

        getApiData();


        
    });

    


    const carts = @json($cart);
    const cameras = @json($cameras);

    let cameraSales = [];


    for(let i =0; i < cameras.length; i++){
        var quantity = 0;
        var cameraName = cameras[i].model;
        for(let j=0; j< carts.length; j++){
            if(cameras[i].id == carts[j].camera_id){
                quantity+= carts[j].quantity;
            }
        }
        quantity = Math.floor((quantity / carts.length) * 100);
        cameraSales.push({name: cameraName, y: quantity});
    }

    // console.log(cameraSales);
    
    function findMostSales(){
        let max = 0;
        let maxIndex = 0;
        for(let i=0; i < cameraSales.length; i++){
            // console.log(cameraSales[i]);
            if(cameraSales[i].y > max){
                max = cameraSales[i].y;
                maxIndex = i;
            }
        }
        // console.log(maxIndex);

        cameraSales[maxIndex].sliced = true;
        cameraSales[maxIndex].selected = true;
    }

    findMostSales();


Highcharts.chart('pieChart-container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
   data: cameraSales
  }]
});

Highcharts.chart('barChart-container', {
  chart: {
    type: 'column'
  },
  title: {
    text: ''
  },
  xAxis: {
    categories: [
      '2018',
      '2019',
      '2020'
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: ''
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [{
    name: 'Canon',
    data: [89.9, 85.5, 95]

  }, {
    name: 'Nikon',
    data: [80.6, 70.8, 90]

  }, {
    name: 'Sony',
    data: [48.9, 38.8, 39.3]

  }, {
    name: 'Leica',
    data: [42.4, 33.2, 34.5]

  }]
});

</script>
@endsection