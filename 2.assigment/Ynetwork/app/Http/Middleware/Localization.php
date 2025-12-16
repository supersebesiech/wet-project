<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Localization
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
        // Check session locale first
        $locale = session('locale');
        
        // Use user's stored locale preference
        if (Auth::check()) {
            $locale = Auth::user()->locale ?? session('locale') ?? config('app.locale');
        }
        
        // Default to app config locale if nothing else is set
        $locale = $locale ?? config('app.locale');
        
        App::setLocale($locale);
        return $next($request);
    }
}