<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camera;
use App\Models\Category;
use App\Models\CustomerOrder;
use App\Models\Cart;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Session;
use DB;



class StoreController extends Controller
{   

    public function __construct(){
    }

    public function index(Request $request){
        $cameras = Camera::with('category')->orderBy('created_at', 'desc')->paginate(12);
        $categories = Category::get();

        return view('store', [
            "cameras" => $cameras,
            "categories" => $categories,
        ]);
    }

    public function searchFilter(Request $request){
        $toOrder = "created_at";
        $orderBy = "desc";
        $cameras;

        if(isset($request->search_value)){
            $cameras = Camera::orderBy('created_at', 'desc')->where('model', 'like', "$request->search_value%")->paginate(12);
            return response()->JSON(['status' => 200, 'cameras' => $cameras]);
        }

        if(isset($request->priceFilters)) {
            $toOrder = "price";
            $orderBy = $request->priceFilters[0];
        }

        if(isset($request->categoryIds) && isset($request->modelFilters) ){
            $cameras = Camera::whereIn('cetegory_id', $request->categoryIds)
            ->whereIn('model_id', $request->modelFilters)
            ->orderBy($toOrder, $orderBy)->paginate(12);
            return response()->JSON(['status' => 200, 'cameras' => $cameras]);
        }

        if(isset($request->categoryIds)){
            $cameras = Camera::whereIn('category_id', $request->categoryIds)->orderBy($toOrder, $orderBy)->paginate(12);
            return response()->JSON(['status' => 200, 'cameras' => $cameras]);
        }

        if(isset($request->modelFilters)){
            $cameras = Camera::whereIn('category_id', $request->modelFilters)->orderBy($toOrder, $orderBy)->paginate(12);
            return response()->JSON(['status' => 200, 'cameras' => $cameras]);
        }   

        $cameras = Camera::orderBy($toOrder, $orderBy)->paginate(12);
        return response()->JSON(['status' => 200, 'cameras' => $cameras]);
    }

    
    public function addToCart($id){
        $product = Camera::findOrFail($id);
        $customerOrder = CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->first();
        //dd($customerOrder);

        if(!isset($customerOrder)){
            CustomerOrder::create([
                "user_id" => auth()->user()->id,
                "order_type" => "cart",
                "price" => 0,
                "promo_code_id" => null,
            ]);
        }

        $customerOrder = CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->first();

        $cartItem = Cart::where('customer_order_id', $customerOrder->id)->where('camera_id', $product->id)->first();
        if(isset($cartItem)){
            $prevQuantity = $cartItem->quantity;
            $cartItem->update(['quantity' => $prevQuantity+1]);
        } else {
            Cart::create([
                "customer_order_id" => $customerOrder->id,
                "camera_id" => $product->id,
                "quantity" => 1,
            ]);
        }
        $this->updateTotalPrice();
        return redirect()->back()->with('success', "$product->model was added to cart successfully!");
    }

    

    public function update(Request $request){
        if($request->quantity == 0){
            $this->remove($request->id);
        }
        $customerOrder = CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->first();
        $customersCart = Cart::where('customer_order_id', $customerOrder->id)->where('camera_id', $request->id);
        $customersCart->update(['quantity' => $request->quantity]);
        $this->updateTotalPrice();
        return back();
    }

    

    public function remove($id){
        $customerOrder = CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->first();
        Cart::where('customer_order_id', $customerOrder->id)->where('camera_id', $id)->delete();

        $this->updateTotalPrice();
        return back();
    }


    private function updateTotalPrice(){
        $customerOrder = CustomerOrder::where('user_id', auth()->user()->id)->where('order_type', 'cart')->first();
        $cartItems = Cart::where('customer_order_id', $customerOrder->id)->get();
        $totalPrice = 0;
        foreach($cartItems as $cartItem){
            $camera = Camera::findOrFail($cartItem->camera_id);
            $totalPrice += ($camera->price) * ($cartItem->quantity);
        }
        if(isset($customerOrder->promo_code_id)){
            $promo = PromoCode::findOrFail($customerOrder->promo_code_id);
            $totalPrice = ($totalPrice) - (($totalPrice) * ($promo->percentage / 100));
        }
        $customerOrder->update(['price' =>  $totalPrice]);
    }



}
