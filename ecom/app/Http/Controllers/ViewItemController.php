<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camera;

class ViewItemController extends Controller
{
    public function index(Camera $camera){
        return view('viewItem', [
            "camera" => $camera,
        ]);
    }
}
