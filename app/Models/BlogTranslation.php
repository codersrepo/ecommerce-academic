<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'summary',
        'description',
        'language_id',
        'blog_id'
    ];

    public function blog()
    {
        $this->belongsTo(blog::class, 'blog_id', 'id');
    }

    public function scopeCorrectTranslation($q)
    {
        return $q->where('language_id', session('language_id'));
    }
}
