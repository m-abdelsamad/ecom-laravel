@extends('layouts.app')
@section('content')

<!--<div class="container">
  <div class="row">
    @foreach([1,2,3,4] as $id)
    <div class="col-md-4">
      {{$id}}
    </div>
    @endforeach
  </div>
</div>-->


<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="img-slider-store" src="/images/cam-slider-5.webp" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="img-slider-store" src="/images/cam-slider-1.webp" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="img-slider-store" src="/images/cam-slider-6.webp" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<div class="">
    <nav class="navbar navbar-light">
      <div class="container-fluid">
        <div style="margin: 3% auto; width:50%;" class="d-flex" style="margin-bottom: 0%;">
          
          <input class="form-control me-2" id="search_value" name="search_value" type="search" placeholder="Search by Model name" aria-label="Search">
          <button id="searchModel" class="btn btn-outline-dark apply_filter">Search</button>
        </div>
      </div>
    </nav>

    
    @if(session('success'))
      <div class="success_label mt-3">
        {{ session('success') }}
      </div>
    @endif
    
  <div class="row container store_content" style="margin-top: 5%;">
  

    <div class="col-3 filter_settings">
      <div class="category">
        <p class="category_heading">Filter by Price</p>
      
        <div class="form-check">
          <input name="price_filter" class="form-check-input price_filter filter_checbox" type="checkbox" value="desc" id="high_to_low">
          <label class="form-check-label check_filter" for="high_to_low">
            High to Low
          </label>
        </div>

        <div class="form-check">
          <input name="price_filter" class="form-check-input price_filter filter_checbox" type="checkbox" value="asc" id="low_to_high">
          <label class="form-check-label check_filter" for="low_to_high">
            Low to High
          </label>
        </div>
        
  
      </div>

      <div class="category">
        <p class="category_heading">Filter by Category</p>
            @foreach($categories as $category)
              <div class="form-check">
                <input name="category_filter" class="form-check-input category_filter filter_checbox" type="checkbox" value="{{$category->id}}" id="{{$category->id}}">
                <label class="form-check-label check_filter" for="{{$category->id}}">
                  {{ $category->name }}
                </label>
              </div>
            @endforeach
      </div>

      <div class="category">
        <p class="category_heading">Filter by Model</p>
       
        <div class="form-check">
          <input name="model_filter" class="form-check-input model_filter" type="checkbox" value="UX" id="ux_series">
          <label class="form-check-label" for="ux_series">
            UX series
          </label>
        </div>

        <div class="form-check">
          <input name="model_filter" class="form-check-input model_filter" type="checkbox" value="RX" id="rx_series">
          <label class="form-check-label" for="rx_series">
            RX series
          </label>
        </div>

        <div class="form-check">
          <input name="model_filter" class="form-check-input model_filter" type="checkbox" value="CT" id="ct_series">
          <label class="form-check-label" for="ct_series">
            CT series
          </label>
        </div>

        <div class="form-check">
          <input name="model_filter" class="form-check-input model_filter" type="checkbox" value="MX" id="mx_series">
          <label class="form-check-label" for="mx_series">
            MX series
          </label>
        </div>

      </div>

      <div class="filter_buttons">
        <button id="" type="button" class="btn btn-light apply_filter">Apply</button>
        <!-- <button id="remove_filter" type="button" class="btn btn-light">Remove</button> -->
        <a href="{{route('store')}}" class="btn btn-light">Remove</a>
      </div>

    </div>

    <div class="col-9 items_list">
      <div class="responses_values">
      </div>
      <div class="db_data">
        @if($cameras->count())
          @foreach($cameras as $camera)
            <div class="row item_content mb-3 shadow wow animate__backInRight">
                <div class="col-4 item_image">
                <a class="item_content_link" href="{{ route('viewItem', $camera) }}"><img src="/images/cameraStore.webp"></a>
                </div>
                <div class="col-5 mt-4">
                  <p class="item_name">{{$camera->model}}</p>
                  <p class="item_description">{{$camera->description}}</p>
                  <p class="item_price">{{$camera->price}}</p>
                  <div class="" style="display: flex;">
                    <!--<input type="number" class="quatity" name="quatity" placeholder="quantity">-->
                    <a href="{{ route('addToCart', $camera) }}"><button type="button" class="btn btn-outline-danger btn-sm">Add</button></a>
                  </div>
                </div>
            </div> 
          @endforeach
          <nav aria-label="Page navigation example">
            {{--$cameras->links()--}}
          </nav>
        @endif
      </div>
    </div>

  </div>
</div>




<script>

  $('.apply_filter').click(function(){
    var categoryIds = getValues('category_filter');
    var modelFilters = getValues('model_filter');
    var priceFilters = getValues('price_filter');
    var search_value = document.querySelector('#search_value');
    
    console.log(search_value.value);
    //console.log(priceFilters);
    //console.log(modelFilters);

    $.ajax({
          url:"{{ route('store.searchFilter') }}",
          method: "POST",
          data: {
              categoryIds:categoryIds,
              modelFilters:modelFilters,
              priceFilters:priceFilters,
              search_value: search_value.value,
              "_token": "{{csrf_token()}}"
          },
          success: function(response){
            search_value.value = "";
            uncheckFilters();
            console.log(response.cameras.data);
            renderCamera(response.cameras.data);
          }
    });

  });

  function uncheckFilters(){
    $('.filter_checbox').each(function(){
      $(this).prop('checked', false);
    });
  }

  function getValues(checkboxName){
    var ids = [];
    const checkboxes = document.getElementsByName(checkboxName);
    for(let i = 0; i < checkboxes.length; i++){
      if(checkboxes[i].checked){
          ids.push(checkboxes[i].getAttribute("value"));
      }
    }
  
    return ids;
  }

  function renderCamera(response, search_value){
    // debugger;
    document.querySelector('.db_data').innerHTML = "";
    var response_value = document.querySelector('.responses_values');

    //console.log(response_value);
    response_value.innerHTML = "";


    //console.log(response_value);

    for(let i=0; i< response.length; i++){
      console.log(response[i]);
      html = `
      <div class="row item_content mb-3 shadow">
                <div class="col-4 item_image">
                  <a class="item_content_link" href="/store/view/${response[i].id}"><img src="/images/cameraStore.webp"></a>
                </div>
                <div class="col-5 mt-4">
                  <p class="item_name">${response[i].model}</p>
                  <p class="item_description">${response[i].description}</p>
                  <p class="item_price">${response[i].price}</p>
                  <div class="" style="display: flex;">
                    <a href="/store/addToCart/${response[i].id}"><button type="button" class="btn btn-outline-danger btn-sm">Add</button></a>
                  </div>
                </div>
      </div> 
      `;

      response_value.insertAdjacentHTML('beforeend', html);
    }
  }

</script>




<!-- <footer>
  <div class="footer_container">
        <div class="social footer_content">
            <p class="footer_titles">Follow us on social</p>
            <ul class="footer_lists">
              <li>Facebook</li>
              <li>Twitter</li>
              <li>Instagram</li>
            </ul>
        </div>
        <div class="links footer_content">
          <p class="footer_titles">Useful links</p>
          <ul class="footer_lists">
            <li>Home</li>
            <li>Store</li>
            <li>Login</li>
            <li>Register</li>
          </ul>
        </div>

        <div class="footer_description footer_content">
          <p class="footer_titles">Description</p>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa atque voluptatem, impedit odit ullam dolores perspiciatis, porro, quisquam aliquid explicabo accusamus numquam voluptatibus voluptates. Adipisci!</p>
          
        </div>

        <div class="logo_holder">
          <p><span class="logo">Canon</span><span style="font-size: 15px; color:red;">&#174;</span></p>
        </div>
      </div>
  </div>
</footer> -->
@endsection