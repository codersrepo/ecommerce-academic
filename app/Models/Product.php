<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductTranslation;
use App\Traits\HasSeo;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\SoftDeletes;



class Product extends Model
{
    use HasStatus, SoftDeletes;

    const STATUS = ['active', 'inactive'];

    protected $fillable = [
        'status',
        'slug',
        // 'is_featured',
        'category_id',
        'price',
        'size',
        'product_code',
        'colour',
        'image_icon'
    ];


    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

        public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id', 'id');
    }


    protected $casts = [
        'images' => 'array',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function sendSubscribersNotification()
    // {
    //     dispatch(new SendProductAddedEmail($this));
    // }

    public function translations()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id', 'id');
    }

    public function belongsToCategory(Category $category)
    {
        return $this->category_id == $category->id;
    }

    public static function boot()
    {
        parent::boot();

        // static::creating(function (Product $product) {
        //     $product['created_by'] = auth()->id();
        // });

        static::deleting(function (Product $product) {
            $product->setToInactive();
        });
    }

    public function firstTranslation()
    {
        return $this->translations[0];
    }

    public function getFromTranslations($prop, $lang_id)
    {
        if (!$this->id) {
            return;
        }
        return $this->translations->where('language_id', $lang_id)->first()->{$prop};
    }}
