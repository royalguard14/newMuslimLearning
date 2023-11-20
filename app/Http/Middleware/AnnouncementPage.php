<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\AccessControl;

class AnnouncementPage
{  /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = Auth::id();

        $module_id = 17;

        $access_control = AccessControl::CheckUserModule($id, $module_id);

        if($access_control){

            return $next($request);
        }
        else{           

            return redirect('restricted_page');
        }    
    }}
