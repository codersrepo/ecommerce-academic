<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'status',
        'slug'
    ];

    public function translations()
    {
        return $this->hasMany(FacilityTranslation::class, 'facility_id', 'id');
    }

    public function getFromTranslations($prop, $lang_id)
    {
        if (!$this->id) {
            return;
        }
        return $this->translations->where('language_id', $lang_id)->first()->{$prop};
    }

}
