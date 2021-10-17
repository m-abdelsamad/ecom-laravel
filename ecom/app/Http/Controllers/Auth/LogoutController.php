<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function store(Request $request){
        //$request->session()->forget('cart'.auth()->user()->id);
        auth()->logout();
  
        return redirect()->route('home');
    }
}
