<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Language;


class ProductTranslation extends Model
{
    protected $fillable = [
        'title',
        'summary',
        'description',
        'language_id',
        'product_id'
    ];

    public function product()
    {
        $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function scopeCorrectTranslation($q)
    {
        return $q->where('language_id', session('language_id'));
    }
}
