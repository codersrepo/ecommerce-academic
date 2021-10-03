<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class CategoryTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'summary',
        'language_id',
        'category_id'
    ];

    public function category()
    {
        $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function scopeCorrectTranslation($q)
    {
        return $q->where('language_id', session('language_id'));
    }
}
