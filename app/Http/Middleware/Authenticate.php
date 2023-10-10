<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return response()->json(["error" => "Authorization Token not found"]);
        }
        return $next($request);
    }
}
