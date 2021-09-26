<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(){
        $product = Product::translatedIn(app()->getLocale())
        ->latest()
        ->take(10)
        ->get();

        $category = Category::translatedIn(app()->getLocale())
        ->with('products')
        ->latest()
        ->take(3)
        ->get();
        return view('user.shop.index', compact(['category', 'product']));

    }

    public function show($slug){
        $product_data =   Product::translatedIn(app()->getLocale())
        ->where('slug', $slug)
        ->with('category')
        ->with(['images'])
        // ->whereHas('categories', function ($query) use ($product_data->id) {
            //     $query->where('categories.id', $id);
            // })
            ->where('status','=', 'active')
            ->first();


        $related_product =  Product::translatedIn(app()->getLocale())
                        ->get()
                        //  ->where('id','!=',$product_data->id)
                         ->take(6);

        return view('user.Shop.show')
                                    ->with('related_product',$related_product)
                                    ->with('product_data',$product_data);
    }
}

