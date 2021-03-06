<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Blog extends Model implements TranslatableContract
{

        use  Translatable;
        protected $guarded = ['id'];
        public $translatedAttributes = ['title', 'summary','description'];

        public function scopeCorrectTranslation($q)
        {
            return $q->where('language_id', session('language_id'));
        }
    }
