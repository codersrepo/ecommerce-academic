<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    protected $fillable = ['images','product_id'];
    // protected $table = 'images';

    public function product(){
        $this->belongsTo(Product::class);
    }
}
