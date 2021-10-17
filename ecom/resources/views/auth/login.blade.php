@extends('layouts.app')
@section('content')
<!-- <div class="container">
    <div class="register_promote" style="margin: 1.5% auto 0%;">
        <p style="font-size: 27px">Login to <span class="logo" >Canon</span></p>
    </div>
</div>
<div class="shadow login_form" style="margin-top: 0.5%;">
    <form method="POST" action="{{route('login')}}" class="">
        @csrf

        @if(session('errorLogin'))
            <div class="error_label">
                <p><span class="">{{ session('errorLogin') }}</span></p>
            </div>
        @endif

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control @error('email') error_input @enderror" id="email">
            @error('email')
            <div class="error_text">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control @error('password') error_input @enderror" id="password">
            @error('password')
            <div class="error_text">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="">
            <p>Dont Have an account? <a href="{{route('register')}}" class="" style="text-decoration: none; color:red;">Register here</a></p>
        </div>
        <button type="submit" class="btn canon_form_button">Submit</button>
    </form>
</div> -->

<div class="row" style="height: 700px;">
    <div class="col-4" style="background: #F5F5F5;"></div>
    <div class="col-8"></div>
</div>

<div class="container">
    <div class="login_box shadow row" style="height: 450px;">
        <div class="col-3" style="background: #F5F5F5;">
            <div class="container login_side_content" style="">
                <p class="" style="font-size: 27px; margin-top: 40%; margin-bottom: 0;">Login to</p>
                <p class="logo">Canon</p>

                <p style="margin-top: 40px; text-align: center">Lorem ipsum, dolor sit veritatis optio nisi necessitatibus!</p>
            </div>
        </div>
        <div class="col-7 container">
        <form method="POST" action="{{route('login')}}" class="" style="margin-top: 15%;">
                @csrf

                @if(session('errorLogin'))
                    <div class="error_label">
                        <p><span class="">{{ session('errorLogin') }}</span></p>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control @error('email') error_input @enderror" id="email">
                    @error('email')
                    <div class="error_text">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control @error('password') error_input @enderror" id="password">
                    @error('password')
                    <div class="error_text">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="">
                    <p>Dont Have an account? <a href="{{route('register')}}" class="" style="text-decoration: none; color:red;">Register here</a></p>
                </div>
                <button type="submit" class="btn canon_form_button">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection