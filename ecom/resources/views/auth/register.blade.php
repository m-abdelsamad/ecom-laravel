@extends('layouts.app')
@section('content')
<!-- <div class="container">
    <div class="register_promote" style="margin: 5% auto;">
        <p style="font-size: 27px">Register with <span class="logo" >Canon</span></p>
        <p style="color: #6c757d;">Shop our lastest models and join <span class="logo" style="font-size: 22px; color:red;">#ShotOnCanon</span> comunity</p>
    </div>
</div>

<form method="POST" action="{{route('register')}}" class="register_form shadow">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control @error('name') error_input @enderror" id="name">
        @error('name')
        <div class="error_text">
            {{ $message }}
        </div>
        @enderror
    </div>
    

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control @error('email') error_input @enderror" id="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
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
    
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Password</label>
        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
        
    </div>
    
    <div class="mb-3">
        <label for="user_type" class="form-label">User Type</label>
        <select id="user_type" name="user_type" class="form-select @error('user_type') error_input @enderror" aria-label="Default select example">
            <option selected value="">Choose...</option>
            <option value="admin">Admin</option>
            <option value="regular_user">Regular User</option>
        </select>
        @error('user_type')
        <div class="error_text">
            {{ $message }}
        </div>
        @enderror
    </div>
    

    <button type="submit" class="btn canon_form_button" style="">Register</button>
</form> -->


<div class="row" style="height: 900px;">
    <div class="col-4" style="background: #F5F5F5;"></div>
    <div class="col-8"></div>
</div>

<div class="container">
    <div class="login_box shadow row" style="height: 670px;">
        <div class="col-3" style="background: #F5F5F5;">
            <div class="container login_side_content" style="text-align: center; margin-top: 60%;">
                <p style="font-size: 27px">Register with <span class="logo" >Canon</span></p>
                <p style="color: #6c757d;" class="mt-5">Shop our lastest models and join <span class="logo" style="font-size: 22px; color:red;">#ShotOnCanon</span> comunity</p>
            </div>
        </div>
        <div class="col-7 container">
            <form method="POST" action="{{route('register')}}" class="" style="margin-top: 10%;">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control @error('name') error_input @enderror" id="name">
                    @error('name')
                    <div class="error_text">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control @error('email') error_input @enderror" id="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
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
                
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Password</label>
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
                    
                </div>
                
                <div class="mb-3">
                    <label for="user_type" class="form-label">User Type</label>
                    <select id="user_type" name="user_type" class="form-select @error('user_type') error_input @enderror" aria-label="Default select example">
                        <option selected value="">Choose...</option>
                        <option value="admin">Admin</option>
                        <option value="regular_user">Regular User</option>
                    </select>
                    @error('user_type')
                    <div class="error_text">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn canon_form_button" style="">Register</button>   
            
            </form>
        </div>
    </div>
</div>


@endsection