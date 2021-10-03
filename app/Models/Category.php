<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasStatus;
use App\Models\CategoryTranslation;


class Category extends Model
{
    use HasFactory, HasStatus;

    const STATUS = ['active', 'inactive'];

    protected $fillable = [
        'image',
        'status',
        'slug',
        'created_by'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id', 'id');
    }

    public function getFromTranslations($prop, $lang_id)
    {
        if (!$this->id) {
            return;
        }
        return $this->translations->where('language_id', $lang_id)->first()->{$prop};
    }

    public function scopeActive($q){
        return $q->where('status', 'active');
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($category) {
    //         $category['created_by'] = auth()->id();
    //     });
    // }

    public function firstTranslation()
    {
        return $this->translations[0];
    }
}
