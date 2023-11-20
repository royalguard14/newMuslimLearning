<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;
use Auth;

class Zeardev
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        

        if (Auth::check()) {
            $id = Auth::id();
            $role = DB::table('users')->where('id',$id)->first();

            if ($role->role == '13') {
                return $next($request);
            }
            else {

                return redirect('restricted_page');
            }
        }
        else {
            return redirect()->guest('login');
        }


    }
}
