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
    protected $product, $category, $slider, $blog;


    public function __construct(Product $product, Category $category, Slider $slider, Blog $blog)
    {
        $this->product = $product;
        $this->category = $category;
        $this->blog = $blog;
        $this->slider = $slider;
    }


    public function __invoke(){
        $slider =  Slider::latest()
        ->take(10)
        ->get();

        $product = $this->product->active()
            ->with(['translations' => function ($q) {
                $q->correctTranslation()->select(['title', 'product_id']);
            }])
            ->with('category')
            ->take(8)
            ->get();

        $category = $this->category->active()
            ->with('product')
            ->with(['translations' => function ($q) {
                $q->correctTranslation()->select(['title', 'category_id']);
            }])
            ->take(3)
            ->get();


        $blog = Blog::latest()
        ->take(3)
        ->get();

        return view('user.index', compact(['category', 'product', 'slider','blog']));
    }
}
