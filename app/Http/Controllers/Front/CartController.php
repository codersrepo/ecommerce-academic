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
    public function store(Request $request)
    {
        // if($request->ajax()){
        $data = $request->all();            
        if (Auth::check()) {
            $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'user_id' => Auth::user()->id])->count();
        } else {
            return redirect()->route('login');
        }
        if ($countProducts > 0) {
            $message = "Product already exists!!";
            Session::flash('error_message', $message);
            return redirect()->back();
        }

        $status = Cart::create(['product_id' => $data['product_id'],'user_id' =>Auth::user()->id ,'colour' => $data['colour'], 'size' => $data['size'], 'quantity' => $data['quantity']]);
        $message = "Product added to cart!!";
        Session::flash('success_message', $message);
        return redirect()->back();
    }
    // }\


    public function cart()
    {
        if(Auth::check()){
            $userCartItem = Cart::with(['product.translations'])->where('user_id',Auth::user()->id)->get();
            return view('user.cart.cart')->with('cart_data', $userCartItem);
        }
    }

    public function header_cart()
    {
        if(Auth::check()){
            $userCartItem = Cart::with(['product.translations'])->where('user_id',Auth::user()->id)->get();
            return view('layouts.app')->with('cart_data', $userCartItem);
        }
    }



        public function update(Request $request, $id){
            
        }

        public function destroy($id)
        {
            dd($id);
            $data = Cart::FindOrFail($id);
            dd($data);
            if($data){
                $data->delete();
                return redirect()->route('front.cart')->with('sweet_success','Product removed from cart');
            } else {
                return redirect()->route('front.cart')->with('sweet_error','Product couldnot be deleted');
            }
            }
    

        // $getStockProduct = Product::with([
        //     'translations' => function ($q) {
        //         $q->where('language_id', session('language_id'));
        //     },
        //     'category.translations' => function ($q) {
        //         $q->where('language_id', session('language_id'))->select();
        //     },
        // ])
        //     ->where(['id' => $data['product_id']])
        //     ->first();

        // $userCartItem = Cart::userCartItem();
        // return view('user.cart.cart')->with('cart_data', $userCartItem);
    
}
