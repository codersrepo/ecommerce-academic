<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class FrontLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locales = Language::all()->pluck('prefix', 'id')->toArray();

        $locale = Route::input('locale');
        if (!in_array($locale, $locales)) {
            $locale = 'en';
        }

        app()->setlocale($locale);
        session(['language_id' => array_search($locale, $locales) ?? 1]);

        return $next($request);
        }
}
