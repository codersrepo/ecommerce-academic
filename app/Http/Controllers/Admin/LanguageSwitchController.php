<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class LanguageSwitchController extends Controller
{
    // public function __invoke($locale){
    //     App::setlocale($locale);
    //     session()->put('locale',$locale);
    //     return redirect()->back();
    // }
    public function __invoke(String $lang)
    {
    if (in_array($lang, ['en', 'np', 'hi'])) {
        session(['locale' => $lang]);
    }
    return back();
}

}
