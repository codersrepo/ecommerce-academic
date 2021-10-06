<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function __invoke()
    {
        $orders = $this->order->with(['user','cart.product'])
        ->latest()
        ->get();

        return view('admin.dashboard')
        ->with('orders', $orders);
    }

}
