<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    protected $product;
    protected $category;


    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }


    public function index(Request $request){
        $product = $this->product
            ->active()
            ->when($request->q, function ($q, $title) {
                $q->whereHas('translations', function ($q) use ($title) {
                    $q->correctTranslation()->where('title', 'LIKE', "%{$title}%");
                });
            })
            ->when($request->category, function ($q, $category) {
                $q->whereHas('category', function ($q) use ($category) {
                    $q->active()->where('slug', $category);
                });
            })
            ->latest()
            ->with(['translations' => function ($q) {
                $q->correctTranslation()->select(['title', 'product_id']);
            }])
            ->paginate(9);

        $category = $this->category->active()
            ->latest()
            ->with(['translations' => function ($q) {
                $q->correctTranslation()->select(['title', 'category_id']);
            }])
            ->get();

        // $featured_products = $this->product->active()
        //     ->where('is_featured', 1)
        //     ->with(['translations' => function ($q) {
        //         $q->correctTranslation()->select(['title', 'product_id']);
        //     }])
        //     ->get();

        return view('user.shop.index', compact(['category', 'product']));

    }

    public function show($slug){
        $products =  $this->product->active()
        ->with('images')
            ->with(['translations' => function ($q) {
                $q->correctTranslation();
            }])->where('slug', $slug)
            ->first();

        $related_product =  $this->product->active()
            ->with(['translations' => function ($q) {
                $q->correctTranslation()->select(['title', 'product_id']);
            }])
            ->where('id', '!=', $products->id)
            ->take(6)
            ->get();


        return view('user.Shop.show')
                                    ->with('related_product',$related_product)
                                    ->with('product_data',$products);
    }
}

