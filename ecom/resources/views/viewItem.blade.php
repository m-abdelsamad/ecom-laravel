@extends('layouts.app')
@section('content')

<div class="col container items_list">
    <div class="row item_content mb-3">
        <div class="col-4 item_image">
            <img src="/images/cameraStore.webp">
        </div>
        <div class="col-5">
            <p class="item_name">{{$camera->model}}</p>
            <p class="item_description">{{$camera->description}}</p>
            <p class="item_price">{{$camera->price}}</p>
            
        </div>
    </div>      
</div>

@endsection