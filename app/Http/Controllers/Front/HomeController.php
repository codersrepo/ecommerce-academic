<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke(){
        $slider =  Slider::translatedIn(app()->getLocale())
        ->latest()
        ->take(10)
        ->get();

        $product = Product::translatedIn(app()->getLocale())
        ->with('category')
        ->latest()
        ->take(10)
        ->get();

        $category = Category::translatedIn(app()->getLocale())
        ->with('products')
        ->latest()
        ->take(3)
        ->get();

        $blog = Blog::translatedIn(app()->getLocale())
        ->latest()
        ->take(3)
        ->get();

        return view('user.index', compact(['category', 'product', 'slider','blog']));
    }
}
