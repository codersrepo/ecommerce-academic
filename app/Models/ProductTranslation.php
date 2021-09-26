<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['title', 'summary','description','product_color','price','brand_name','discount_percent'];
}
