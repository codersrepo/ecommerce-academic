<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected $order = null;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = Cart::where(['user_id' => Auth::user()->id])->first();
        $data = $request->all();
        $status = Order::create(['cart_id' => $cart->id, 'user_id' => Auth::user()->id,'district' => $data['district'], 'address' => $data['address']]);
        if($status){
            Cart::where('id', Auth::user()->id)
            ->update(['status' => 'inactive']);
            return redirect()->route('front.shop.index')->with('sweet_success','Your Order Has Been Placed');
        } else {
            return redirect()->back()->with('sweet_error','Your Order could not be placed');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function togglestatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Delivered"){
                $status = 'delivered';
            } else {
                $status = 'new';
            }
            Order::where('id',$data['order_id'])->update(['status' => $status]);
            return response()->json(['status' => $status,'order_id' => $data['order_id']]);

        }
    }

}
