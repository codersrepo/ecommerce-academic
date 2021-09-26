<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(){
        $blog = Blog::translatedIn(app()->getLocale())
        ->latest()
        ->take(10)
        ->get();
        return view('user.blog.index', compact(['blog']));

    }

    public function show($slug){
        $blog_data = Blog::translatedIn(app()->getLocale())
        ->where('slug', $slug)
        ->where('status','=', 'active')
        ->first();


        return view('user.blog.show')
                                    ->with('blog_data',$blog_data);
    }
}
