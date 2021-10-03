<?php

namespace App\Traits;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait MultiLocaleable
{
    public static function bootMultiLocaleable()
    {
        static::addGlobalScope('lang', function (Builder $q) {
            $q->where('language_id', static::getCurrentLocaleId());
        });

        static::creating(function (Model $model) {
            $model->language_id = static::getCurrentLocaleId();
        });
    }


    protected static function getCurrentLocaleId()
    {
        return session('language_id');
    }
}
