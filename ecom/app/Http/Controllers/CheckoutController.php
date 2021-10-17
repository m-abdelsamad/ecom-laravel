<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerOrder;
use App\Models\Cart;
use App\Models\User_address;
use App\Models\Address;
use Illuminate\Support\Facades\Redis;

use Cache;

class CheckoutController extends Controller
{  

    public function __construct(){
        $this->middleware(['auth']);
    }


    public function index(){
        ini_set('memory_limit', '-1');
        // print_r(app()->make('redis'));
        // exit;
        //exit;
        // $app = Redis::conection();
        // $app->set("testKey", "testValue");
        // return $app->get('testKey');
        // $redis = app()->make('redis');
        // $redis->set('testKey', 'testValue');
        // print_r($redis->get('testKey'));

        // $redis = Redis::connection();
        // $customerOrder = Cache::remember("customerOrder", 10*64, function(){
        //     return CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->first();
        // });



        $customerOrder = CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->first();
        $cart = array();
        
        if(isset($customerOrder)){
            $cart = Cart::where('customer_order_id', $customerOrder->id)->get();
        }


        $address_ids = User_address::where('user_id', auth()->user()->id)->select('address_id')->get();
        $addresses = Address::whereIn('id', $address_ids)->get();


        return view('testCart', [
            "cart" => $cart,
            "customerOrder" => $customerOrder,
            "addresses" => $addresses,
        ]);
    }

    public function applyPromoCode(Request $request){
        $result = PromoCode::where('code', $request->promo_code)->first();
        if(!$result){
            return back()->with('error_promo', 'Invalid coupon code');
        }
        $customerOrder = CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->first();
        if(!isset($customerOrder->promo_code_id)){
            $customerOrder->update(['promo_code_id' => $result->id]);
            $newPrice = ($customerOrder->price) - (($customerOrder->price) * ($result->percentage / 100));
            $customerOrder->update(['price' => $newPrice]);

            return back();
        } else {
            return back()->with('error_promo', 'Coupon is already applied');
        } 
    }

    public function emptyCart(){
        $customerOrder = CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->first();
        Cart::where('customer_order_id', $customerOrder->id)->delete();
        return back();
    }

    public function checkout(Request $request){
        CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->update(['order_type' => 'checked-out']);
        return back();
    }
}
