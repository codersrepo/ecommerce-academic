<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(Request $request){
        // if($request->ajax()){
            $data = $request->all();
            $getStockProduct = Product::translatedIn(app()->getLocale())
                ->where(['id' => $data['product_id']])
                ->first();


            // dd($getStockProduct)
            // $getStock = Product::find($id);
            // dd($data);
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }
            if(Auth::check()){
                $countProducts = Cart::where(['product_id' => $data['product_id'],'size' => $data['size'],'user_id' => Auth::user()->id])->count();
                dd($countProducts);
            } else {
                $countProducts = Cart::where(['product_id' => $data['product_id'],'size' => $data['size'],'session_id' => Session::get('session_id')])->count();
            }
            if($countProducts>0){
                $message = "Product already exists!!";
                Session::flash('error_message',$message);
                return redirect()->back();
            }

            $status = Cart::create(['session_id' => $session_id,'product_id' => $data['product_id'],'colour' => $data['colour'] ,'size' => $data['size'],'quantity' => $data['quantity']]);
            $message = "Product added to cart!!";
            Session::flash('success_message',$message);
            return redirect()->back();
        }
    // }\


    public function cart(){
        $userCartItem = Cart::userCartItem();
        return view('user.cart.cart')->with('cart_data',$userCartItem);
    }
}
