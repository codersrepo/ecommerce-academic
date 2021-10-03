<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'size','quantity','colour','product_id','user_id'];

    public static function userCartItem(){
        if(Auth::check()){
            $userCartItem = Cart::with(['product'])->where('user_id',Auth::user()->id)->get()->toArray();
            return $userCartItem;
        }
    }
       
    public function product(){
    return  $this->belongsTo(Product::class);
    }
}
