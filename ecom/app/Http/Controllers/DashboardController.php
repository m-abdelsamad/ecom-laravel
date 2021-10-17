<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camera;
use App\Models\Category;
use App\Models\PromoCode;
use App\Models\CustomerOrder;
use App\Models\Cart;
use App\Models\User;
use App\Models\Uploads;
use App\Models\Address;
use App\Models\User_address;
use App\Models\User_payment;
use App\Models\Payment;
use App\Models\Branch;
use App\Models\Branch_schedule;
use App\Models\Branch_shooting_session;
use Illuminate\Support\Facades\Hash;
use ZipArchive;




class DashboardController extends Controller
{   
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
            $categories = Category::get();

            $customerOrders = CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'checked-out')->get();
            $cart = Cart::get();

            $cameras = Camera::with('category')->get();
            
            $allOrders = CustomerOrder::with('cartItems')->get();

            $branches = Branch::get();
            $branch_schedules = Branch_schedule::get();

            $address_ids = User_address::where('user_id', auth()->user()->id)->select('address_id')->get();
            $addresses = Address::whereIn('id', $address_ids)->get();
            
            $paymnet_ids = User_payment::where('user_id', auth()->user()->id)->select('payment_id')->get();
            $payments = Payment::whereIn('id', $paymnet_ids)->get();
            
            

            return view('dashboard', [
                "cameras" => $cameras,
                'categories' => $categories,
                "customerOrders" => $customerOrders,
                'cart' => $cart,
                'addresses' => $addresses,
                "payments" => $payments,
                'branches' => $branches,
                'branch_schedules' => $branch_schedules,
                
            ]);
    }

    public function addCamera(Request $request){
        
        $this->validate($request, [
            "model" => "required",
            "description" => "required",
            "price" => "required",
            "category_id" => "required",
        ]);

        Camera::create([
            "model" => $request->model,
            "description" => $request->description,
            "price" => $request->price,
            "category_id" => $request->category_id,
        ]);

        $successMesg = "The $request->model has been added to the store";
        return back()->with('cameraAdded', $successMesg);
    }



    public function addCategory(Request $request){
        $this->validate($request, [
            "category_name" => "required",
        ]);

        Category::create([
            "name" => $request->category_name,
        ]);
        return back()->with('category_success', "$request->category_name has been added as a category");
    }



    public function addPromoCode(Request $request){
        $this->validate($request, [
            "code" => "required",
            "percentage" => "required",
            "validity" => "required",
        ]);

        PromoCode::create([
            "code" => $request->code,
            "percentage" => $request->percentage,
            "validity" => $request->validity,
            "is_valid" => "true",
        ]);

        return back()->with('promo_success', "Promotion Code '$request->code' is now valid");
    }



    public function makeUpload(Request $request){
        $this->validate($request,[
            "shot_by" => "required",
            "img_description" => "required",
            "upload_img" => "required|mimes:jpg,png,jpeg,webp",
        ]);


        //for uploading zip file

        // $file = $request->file('upload_img');
        // $extention = $file->guessExtension();
        // $msg = "";
        // if($extention == "zip"){
        //    $zip = new ZipArchive();
        //    if($zip->open($file)=== true){      
        //        $zip->extractTo(base_path("zipUpload"));
        //        $zip->close();
        //        $msg = "extracting";         
        //    } else {
        //     $msg = "error";
        //    }
        // }
        // return $msg;


        $imgPath = time() . "-". $request->file('upload_img')->getClientOriginalName();
        $request->upload_img->move(public_path('imageUploads'), $imgPath);

        // dd("/imageUploads/" .$imgPath);
        // exit;

        Uploads::create([
            "user_id" => auth()->user()->id,
            "camera_id" => $request->shot_by,
            "description" => $request->img_description,
            "path" => "/imageUploads/" .$imgPath,
        ]);

        return back()->with('success_upload', 'your image has been uploaded');

    }

    public function addAddress(Request $request){
        $this->validate($request, [
            "country_name" => "required",
            "city_name" => "required",
            "street_name" => "required",
            "building_number" => "required",
        ]);

        $address = Address::create([
            "country_name" => $request->country_name,
            "city_name" => $request->city_name,
            "street_name" => $request->street_name,
            "building_number" => $request->building_number,
        ]);

        User_address::create([
            "user_id" => auth()->user()->id,
            "address_id" => $address->id,
        ]);

        return back()->with('addressAdded', 'Address is added');
    }



    public function addPayment(Request $request){
        $this->validate($request, [
            "card_number" => "required",
            "card_holder" => "required",
            "expiration_date_month" => "required",
            "expiration_date_year" => "required",
            "cvc_code" => "required",
        ]);


        $payment = Payment::create([
            "card_number" => $request->card_number,
            "card_holder"=> $request->card_holder,
            "expiration_date" => $request->expiration_date_month."/".$request->expiration_date_year,
            "cvc_code" => $request->cvc_code,
        ]);

        User_payment::create([
            "user_id" => auth()->user()->id,
            "payment_id" => $payment->id,
        ]);

        return back()->with('paymentAdded', 'Payment Was Added');
    }


    public function updatePassword(Request $request){

        $this->validate($request, [
            "old_password" => "required",
            "password" => "required",
            "password_confirmed" => "required|same:password",
        ]);
        
        

        if(Hash::check($request->old_password, auth()->user()->password)){
            
            if(!Hash::check($request->new_password, auth()->user()->password)){
                
                $user = User::findOrFail(auth()->user()->id);
                $user->update(['password' => Hash::make($request->new_password)]);

                return back()->with('passUpdateSucces', 'Password updated');

            } else {
                return back()->with('updatePassError', 'New password must be different');
            }
        } else {
        
            return back()->with('updatePassError', 'Incorrect old password');
        }
    }

    public function addBranch(Request $request){
        $this->validate($request, [
            "branch_name" => "required",
        ]);

        $branch = Branch::create([
            'name'=> $request->branch_name,  
        ]);

        

        return back()->with('branchAdded', 'Branch has been added');
    }

    public function setBranchSchedule(Request $request){
        $this->validate($request, [
            "branch_id" => "required",
            "opening_hour" => "required",
            "closing_hour" => "required",
            "date" => "required",
        ]);
        
        Branch_schedule::create([
            "branch_id" => $request->branch_id,
            "opening_hour" => $request->opening_hour,
            "closing_hour" => $request->closing_hour,
            'date' => $request->date,
            "date_type" => "working-day"
        ]);

        return back();
    }



    public function addShootingSession(Request $request){
        $this->validate($request, [
            "session_branch_id" => "required",
            "session_day" => "required",
            "session_duration_start" => "required",
            "session_duration_end" => "required",
        ]);

        Branch_shooting_session::create([
            "branch_id" => $request->session_branch_id,
            // 'branch_schedule_id' => $request->,
            'date' => $request->session_day,
            'duration' => $request->session_duration_start. " to ". $request->session_duration_end,
            'available' => 0,
        ]);

        return back();

    }

    public function removePayment($id){
        $payment = Payment::findOrFail($id);
        User_payment::where('payment_id', $payment->id)->delete();
        $payment->delete();

        $payment_message = "Card has been removed";
        
        return response()->JSON(['status' => 200, 'payment_message' => $payment_message]);

    }


    public function updateAddress(Request $request, $id){
        $this->validate($request, [
            "country_name_update" => "required",
            "city_name_update" => "required",
            "street_name_update" => "required",
            "building_number_update" => "required",
        ]);

        Address::findOrFail($id)->update([
            "country_name" => $request->country_name_update,
            "city_name" => $request->city_name_update,
            "street_name" => $request->street_name_update,
            "building_number" => $request->street_name_update,
        ]);

        return back();
    }
}

