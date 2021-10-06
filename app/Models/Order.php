<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const STATUS = ['active', 'inactive'];

    protected $fillable = [
        'address',
        'district',
        'user_id',
        'status',
        'cart_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
