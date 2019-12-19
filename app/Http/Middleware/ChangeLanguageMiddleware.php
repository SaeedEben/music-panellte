<?php

namespace App\Http\Middleware;

use Closure;

class ChangeLanguageMiddleware
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
        $locale =  $request->headers->get('accept_language');

        if ($locale)
            app()->setLocale($locale);

        return $next($request);
    }
}
