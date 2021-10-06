<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function __invoke(Request $request)
    {
          $data = (new Subscriber())->latest()->get();
        return view("admin.subscribers.index")->with('data',$data);
    }

}
