<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Language as LanguageModel;


class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->session()->forget('key');
        $locales = LanguageModel::all()->pluck('prefix', 'id')->toArray();
        $locale = session('locale');

        if (!in_array($locale, $locales)) {
            $locale = 'en';
        }

        session(['locale' => $locale]);
        session(['language_id' => array_search($locale, $locales)]);

        app()->setLocale($locale);
        return $next($request);
    }
}
