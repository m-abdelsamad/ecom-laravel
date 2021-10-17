<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        $this->validate($request, [
            "name" => "required",
            "email" => "email|required",
            "password" => "required|confirmed",
            "user_type" => "required"
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "user_type" => $request->user_type
        ]);

        auth()->attempt($request->only('email', 'password'));
        return redirect()->route('dashboard');
    }
}
