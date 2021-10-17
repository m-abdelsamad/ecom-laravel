<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uploads;
use App\Models\Branch;
use App\Models\Branch_schedule;
use App\Models\Branch_shooting_session;
use Illuminate\Support\Facades\Carbon;
use Illuminate\Support\Facades\Response;
use File;
use ZipArchive;

class HomeController extends Controller
{
    public function index(){
        $pictures = Uploads::get();
        $branches = Branch::get();
        $branch_schedules = Branch_schedule::get();
        $shooting_sessions = Branch_shooting_session::get();

        // $now = date_format(now(), "Y-m-d");
        // $test = $branches[0]->branch_schedule->pluck('date')->toArray();
        //return $test;
        // echo gettype($test);
        // exit;

        // $array = array();
        // array_push($array, $test);
        // return $array;

        // if(in_array($now, $test)){
        //     return "yes";
        // } else {
        //     return "no";
        // }

        return view('home', [
            "pictures" => $pictures,
            "branches" => $branches, 
            'branch_schedules' => $branch_schedules,
            'shooting_sessions' => $shooting_sessions,
        ]);
    }


    function bookSession(Request $request){
        $this->validate($request, [
            "session_branch_id" => "required",
            "session_day" => "required",
            "session_time" => "required",
        ]);

        $session =Branch_shooting_session::findOrFail($request->session_time);
        $session->update(['available' => 1]);
        return back();
    }


    public function downloadFiles(){
        // $file= public_path(). "/OS_report_6606598.pdf";
        // return Response::download($file);

        $zip = new ZipArchive();
        $fileName = 'canonFiles.zip';

        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === true){
            $files = File::files(public_path('imageUploads'));
   
            foreach ($files as $key => $value) {
                $fileName = basename($value);
                echo  $value . "<br>";
                // $filePath = base_path("imageUploads/". $fileName);
                $zip->addFile($fileName, $value);
            }
            $zip->close();
        }

        return Response::download($fileName);
    
    }
}
