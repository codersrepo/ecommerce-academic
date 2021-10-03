<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait Sluggable
{
    public static function bootSluggable()
    {
        static::creating(function (Model $model) {
            $model->slug = static::prepareSlug($model);
        });

        static::updating(function (Model $model) {
            $model->slug = static::prepareSlug($model);
        });
    }

    public static function prepareSlug($model)
    {
        $slug = Str::slug($model->{static::sluggableColumn()});
        while (true) {
            if (static::where('slug', $slug)->withoutGlobalScope('lang')->doesntExist()) {
                return $slug;
                break;
            }

            $slug .= rand(1, 10000);
        }
    }

    public static function sluggableColumn()
    {
        return 'title';
    }
}
