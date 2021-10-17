<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base_url" content="{{url('/')}}">
    <title>Canon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
      
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand logo" href="/">Canon</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse space-between" id="navbarNavDropdown">
      <ul class="navbar-nav">
        @auth
        <li class="nav-item">
          <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('logout')}}">Logout</a>
        </li>
        @endauth

        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('register')}}">Register</a>
        </li>
        @endguest

        <li class="nav-item">
          <a class="nav-link" href="{{route('store')}}">Store</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('testCart')}}">Cart</a>
        </li>
      </ul>
      <ul class="navbar-nav dashboard_links ms-auto">
      </ul>
    </div>
  </div>
</nav>



@yield('content')


<footer style="margin-bottom: 0;">
  <div class="row">
    <div class="col-3 social">
      <i class="fab fa-facebook mt-3"></i>
      <i class="fab fa-instagram"></i>
      <i class="fab fa-twitter"></i>
    </div>
    <div class="col-4 footer_items">All Rights Reserved</div>
    <div class="col-3 footer_items"><span class="">Canon&#174;</span> 2021</div>
  </div>
</footer>

<script>
  window.onscroll = function() {myFunction()};

  var navbar = document.querySelector(".navbar");
  var sticky = navbar.offsetTop;

  function myFunction() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }

  var url = document.querySelector("meta[name=base_url]").content;

  $('.add_item').click(function(event){
        event.preventDefault();
        var id_value = $(this).attr('id');
        var id = id_value.split("_");
        $.ajax({
            url:url+'/store/addQuantity/'+id[1],
            method: "GET",
            data: {   
            },
            success: function(response){
              updateQuantity(response, id[1]);
            }
        });
  })

  $('.remove_item').click(function(event){
    event.preventDefault();
    var id_value = $(this).attr('id');
    var id = id_value.split("_");
    $.ajax({
            url:url+'/store/decrementQuantity/'+id[1],
            method: "GET",
            data: {   
            },
            success: function(response){
              updateQuantity(response, id[1]);
            }
        });
  })

  function updateQuantity(response ,id){
    const quantity_response = response.quantity;
    console.log(quantity_response);
    var quantity = document.querySelector(`#quantity_${id}`);
    quantity.innerHTML = quantity_response;
    quantity.setAttribute("value", quantity_response); 
    console.log(quantity);
  }



</script>


</body>
</html>