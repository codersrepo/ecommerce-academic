<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class BlogController extends Controller
{
    protected $blog;


    public function __construct(Blog $blog,Category $category,Product $product)
    {
        $this->blog = $blog;
        $this->category = $category;
        $this->product = $product;

    }


    public function index(Request $request){
        $blog = $this->blog
            ->active()
            ->when($request->q, function ($q, $title) {
                $q->whereHas('translations', function ($q) use ($title) {
                    $q->correctTranslation()->where('title', 'LIKE', "%{$title}%");
                });
            })
            ->latest()
            ->with(['translations' => function ($q) {
                $q->correctTranslation()->select(['title', 'blog_id']);
            }])
            ->paginate(9);

            $related_products =  $this->product->active()
            ->with(['translations' => function ($q) {
                $q->correctTranslation();
            }])
            ->take(4)
            ->get();


        return view('user.blog.index', compact(['blog','related_products']));

    }

    public function show($slug){

        $categories = $this->category->active()
        ->latest()
        ->with(['translations' => function ($q) {
            $q->correctTranslation()->select(['title', 'category_id']);
        }])
        ->get(['id', 'slug']);


        $blog_data =  $this->blog->active()
            ->with(['translations' => function ($q) {
                $q->correctTranslation();
            }])->where('slug', $slug)
            ->first();

            $related_products =  $this->product->active()
            ->with(['translations' => function ($q) {
                $q->correctTranslation();
            }])
            ->take(4)
            ->get();


            return view('user.blog.show', compact(['blog_data', 'categories','related_products']));
    }
}
