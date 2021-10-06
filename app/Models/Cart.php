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
            $userCartItem = Cart::with(['product.translations'])->where('user_id',Auth::user()->id)->get()->toArray();
            return $userCartItem;
        }
    }

    public function scopeActive($q){
        return $q->where('status', 'active');
    }

       
    public function product(){
    return  $this->belongsTo(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
