@extends('layouts.app')
@section('content')
<!-- <section class="container section">
    <div class="main_display">
        <h1 class="display_heading logo">Welcome to Canon</h1>
        <div clas="display_content">
            <p style="font-size: 20px">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur quidem id illum pariatur eos facilis vitae culpa. Harum necessitatibus odio, sed asperiores ipsa repudiandae adipisci at voluptatem repellendus suscipit, inventore quaerat doloribus dolorem dolores aliquam culpa fuga tempore beatae itaque!</p>
            <hr class="hr_display">
        </div>
    <div>
</section> -->


<div class="carousel-inner mb-4">
    <div class="carousel-item active">
      <img src="/images/cam-slider-1.webp" class="d-block w-100" alt="..." style="height: 700px;">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="display_heading logo display-1" style="font-size: 90px;">Welcome to Canon</h1>
        <div class="display_content" style="margin-bottom: 27%; font-size: 20px;">
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur quidem id illum pariatur eos facilis vitae culpa. Harum necessitatibus odio, sed asperiores ipsa repudiandae adipisci at voluptatem repellendus suscipit, inventore quaerat doloribus dolorem dolores aliquam culpa fuga tempore beatae itaque!</p>
        </div>
      </div>
    </div>
</div>

@php $now = date('Y-m-d') @endphp
@if(count($branches) > 0)
  <div class="container" style="margin-top: 6%;">
    <div class="row shadow" style="margin: 3% auto; padding: 3%; height: 225px;">
      @foreach($branches as $branch)
        <div class="col-4">
          <div class="banner_holder">
            <h4>{{ $branch->name }}</h4>
           @php $timings = $branch->branch_schedule @endphp
           @php $day = null @endphp
           @foreach($timings as $time)

              @php $opening = date_create($time->opening_hour) @endphp
              @php $closing = date_create($time->closing_hour) @endphp

              @if($now === $time->date && now() > $opening && now() < $closing)
                @php $day = $time @endphp
                @break
              @endif
           @endforeach

           @if($day != null)
            <p>from {{ $day->opening_hour }} to {{ $day->closing_hour}}</p>
            <div class="open_border mt-3">
              Currently Open
            </div>
           @else
            <div class="closed_border mt-3">
                Currently Closed
              </div>
           @endif
          </div>
        </div>

      <!-- <div class="col-4">
        <div class="banner_holder">
            <h4>Branch Name</h4>
            <p>Opening Hours <span>9 to 5:30</span></p>
            <p>from Mon to Fri</p>
            <div class="open_border">
              <p>Currently Open</p>
            </div>
        </div>
      </div>

      <div class="col-4">
        <div class="banner_holder">
            <h4>Branch Name</h4>
            <p>Opening Hours <span>9 to 5:30</span></p>
            <p>from Mon to Fri</p>
            <div class="closed_border">
              <p>Currently Closed</p>
            </div>
        </div>
      </div> -->
      @endforeach
    </div>
  </div>
@endif


<div class="container" style="margin: 5% auto;">
  <div class="row">
    <div class="col-6" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 5%;">
        <h3 class="display-5">Want to schedule a Photoshoot</h3>
        <h4 style="color: red; font-weight: 300;">Book a session with Canon</h4>
        <hr>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis incidunt asperiores eum aperiam aliquam corrupti.</p>
    </div>
    <div class="col-6" style="padding: 5%;">
        <form action="{{ route('bookSession') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="session_branch_id" class="form-label">Branch Name</label>
            <select id="session_branch_id" name="session_branch_id" class="form-select">
              <option selected value="">Choose...</option>
                                      
                @foreach($branches as $branch)
                  <option value="{{$branch->id}}">{{$branch->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="session_day" class="form-label">Session Day</label>
              <select id="session_day" name="session_day" class="form-select" disabled>
                <option selected value="">Choose...</option>
              </select>
          </div>

          <div class="mb-3">
            <label for="session_time" class="form-label">Session Time</label>
              <select id="session_time" name="session_time" class="form-select" disabled>
                <option selected value="">Choose...</option>
              </select>
          </div>

          <button type="submit" class="btn canon_form_button mt-3">Submit</button>

        </form>
    </div>
  </div>
</div>


@php $gallery = array() @endphp
@foreach($pictures as $picture)
  @php array_push($gallery, $picture) @endphp
@endforeach

<div class="display_secondary container">
  <div class="sec_content">
    <div class="sec_display_content" style="margin-right: 1%;">
        <h1 class="logo">#ShotOnCanon</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio quas a quibusdam aperiam nihil! Similique dolor veritatis mollitia recusandae ea non. Officia sapiente modi iusto?</p>
        <p style="border-left: solid 2px red">Discover our gallery</p>
    </div>
    <div class="imgHolder">
      <div class="imgMain">
        <img src="/images/canoncam.jfif" class="img-fluid" alt="...">
      </div>
      <div class="imgSide">
        <img src="/images/canoncam2.jfif" class="img-fluid" alt="...">
        <img src="/images/canoncam4.jpg" class="img-fluid" alt="...">
      </div>
    </div>
  </div>
</div>



<div class="gallery container"> 
  <div class="column">
  </div>
  
  <div class="column">
  </div> 
   
  <div class="column">
  </div>
  
  <div class="column">
  </div>
</div>

<div class="shop_promote container shadow" style="height: 350px;">
  <h1>Like what you see?</h1>
  <hr>
  <p style="font-size: 25px; color: #6c757d!important;">...Head to our shop and browse through all <span class="logo" style="font-size: 35px;">Canon</span> models</p>
  <a href="{{route('store')}}" class="btn btn-outline-danger">Canon Shop</a>
  <a class="mt-4" href="{{ url('/downloadFiles') }}">download files</a>
</div>





<script>
  const paths = @json($gallery);;
  console.log(paths[0]);
  var columns = document.querySelectorAll('.column');

  function changePictures(){
   
  }

  function setUpGallery(){
      const heights = [250, 300, 200];
      for(let i=0; i < columns.length; i++){
        var html ="";
        
        for(let j =0; j < 5; j++){
          var random = Math.floor(Math.random() * paths.length);
          var height = Math.floor(Math.random() * heights.length);

          html+= `<div class="gallery_picture_holder" style="width:100%; height: 300px; padding-bottom: 8px;">
              <img src='${paths[random].path}' style="width:100%; height: 100%;">
          </div>\n`;
        }
        columns[i].innerHTML = html;
      }
  }

  $(document).ready(setUpGallery());
  setInterval(() => {
    var picture_holders = document.querySelectorAll('.gallery_picture_holder');
    
    var picture_holder = Math.floor(Math.random() * picture_holders.length);
    var path = Math.floor(Math.random() * paths.length);

    picture_holders[picture_holder].innerHTML = "";
    let html = `
          <div class="gallery_picture_holder" style="width:100%; height: 300px; padding-bottom: 8px;">
              <img src='${paths[path].path}' style="width:100%; height: 100%;">
          </div>
    `;
    picture_holders[picture_holder].innerHTML = html;
  }, 2000);
</script>


<script>

    const branches = @json($branches);
    const branch_schedules = @json($branch_schedules);
    const shooting_sessions = @json($shooting_sessions);
    let dates;
    $('#session_branch_id').change(function(){
        var branch_id = $(this).val();
        dates = [];
        getDays(branch_id);
        // console.log(dates);
        setUpDateSelect();
    })

    function getDays(branch_id){
        for(let i =0; i< branch_schedules.length; i++){
            if(branch_schedules[i].branch_id == branch_id){
                dates.push(branch_schedules[i]);
            }
        }
    }

    function setUpDateSelect(){
        $('#session_day').prop('disabled', false);
        $('#session_day').empty();
        var html = '<option value="" selected>Pick Date</option>' ;
        var check = html;
        for(let i =0; i< dates.length; i++){
            var date = new Date(dates[i].date);
            var now = new Date();
            if(date - now > 0){
                html += `<option value="${dates[i].date}">${dates[i].date}</option>\n`;
            }
        }
        if(check === html){
          html = '<option value="" selected>Fully Booked</option>';
        }

        $('#session_day').html(html);  
    }

    $('#session_day').change(function(){
      var day = $(this).val();
      setUpTimeSelect(day);
    });


    function setUpTimeSelect(day){
        $('#session_time').prop('disabled', false);
        $('#session_time').empty();
        var html = '<option value="" selected>Pick Time</option>';
        var check = html;
        for(let i =0; i< shooting_sessions.length; i++){
          if(day == shooting_sessions[i].date && shooting_sessions[i].available == 0){
            html += `<option value="${shooting_sessions[i].id}">${shooting_sessions[i].duration}</option>\n`;
          }  
        }
        if(check === html){
          html = '<option value="" selected>Fully Booked</option>';
        }

        $('#session_time').html(html);  
    }
</script>
@endsection