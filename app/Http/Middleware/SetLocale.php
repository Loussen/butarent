<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->filled('lang') && in_array($request->query('lang'), ['az', 'en', 'ru'], true)) {
            session(['locale' => $request->query('lang')]);
        }

        $locale = session('locale', config('app.locale'));

        if (in_array($locale, ['az', 'en', 'ru'], true)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
