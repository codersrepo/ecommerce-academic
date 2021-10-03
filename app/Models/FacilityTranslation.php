<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'language_id',
        'facility_id',
    ];
    public function scopeCorrectTranslation($q)
    {
        return $q->where('language_id', session('language_id'));
    }
}
