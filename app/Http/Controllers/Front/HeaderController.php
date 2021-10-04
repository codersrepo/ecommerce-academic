<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function contact(){
        return view('user.contacts');
    }
    public function about(){
        return view('user.about');
    }
}
