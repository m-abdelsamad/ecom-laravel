<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function addCamera(Request $request){
        $thhis->validate($request, [
            "model" => "required",
            "price" => "required",
            "description" => "required"
        ]);

        Camera::create([
            "model" => $request->model,
            "price" => $request->price,
            "description" => $request->description
        ]);
        $successMesg = "The $request->model has been added to the store";
        return back()->with('cameraAdded', $successMesg);
    }
}
