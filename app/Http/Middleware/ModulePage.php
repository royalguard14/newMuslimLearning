<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AccessControl;
use Auth;

class ModulePage
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
        $loged=Auth::user();
        

        if($loged->username == 'zeardev'){

            return $next($request);
        }
        else{ 

            if($loged->role == 2){



            }



            return redirect('/');
        }    
    }
}
