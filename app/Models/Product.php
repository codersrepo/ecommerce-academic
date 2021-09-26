<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use  Translatable,HasFactory;
    protected $guarded = ['id'];
    public $translatedAttributes = ['title', 'summary','description','product_color','price','brand_name','discount_percent','stock'];

    protected $casts = [
        'properties' => 'array'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

        public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    // protected $casts = [
    //     'images' => 'array',
    // ];
}
