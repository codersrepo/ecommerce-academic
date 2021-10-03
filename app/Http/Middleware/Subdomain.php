<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Subdomain
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
        $route = $request->route();

        $locale = $route->parameter('locale');

        $route->forgetParameter('locale');
        return $next($request);
    }
}
