<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('selectedLanguage', config('app.locale')); // Default to app locale

        if (Auth::check()) {
            $user = Auth::user();
            $locale = cache()->remember("user-{$user->id}-locale", 60 * 60, function () use ($user) {
                return $user->language ? $user->language->code : config('app.locale');
            });
        }

        App::setLocale($locale);

        return $next($request);
    }
}
