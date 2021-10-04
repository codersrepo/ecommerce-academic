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


    public function __construct(Product $product,Blog $blog, Category $category, Slider $slider)
    {
        $this->product = $product;
        $this->blog = $blog;
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


            $blog = $this->blog->active()
            ->with(['translations' => function ($q) {
                $q->correctTranslation()->select(['title', 'blog_id']);
            }])
            ->take(8)
            ->get();

        return view('user.index', compact(['category', 'blog', 'slider','product']));
    }
}
