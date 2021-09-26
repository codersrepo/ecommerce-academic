<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use Auth;

class AdminLoginController extends Controller
{
    public function loginForm(){

        return view('admin.login.admin-login');

    }

    public function login(Request $request){
        $data = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $data['email'],'password' => $data['password']])){
            // dd($request);
            return redirect('admin');
        } else{
            Session::flash('error','Login credentials didnot match');
            return redirect()->route('admin.login');
        }
    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
