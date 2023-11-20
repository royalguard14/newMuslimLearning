<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Auth\Middleware\Authenticate as Middleware;
//class Authenticate extends Middleware



class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     * 
         protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    } */




     public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }


}
