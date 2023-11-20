<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\AccessControl;
use DB;

class AccessPage
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
        



         $user_ip_address=$request->ip();
        
        date_default_timezone_set('Asia/Manila');
      
        $datetime=date('Y-m-d H:i:s');
        $date=date('m-d-Y');

      

       $allowed = DB::table('ip_access')->where('status',1)->pluck('ip_address');
       

        if (in_array($user_ip_address, json_decode($allowed,true))){

          return $next($request);
        }else{           


           


//normal pips
        $user = Auth::user(); 
        if ($user == null){
           return redirect('restricted_page');
        }else{

        $user->online = 0;
        $user->update();
        Auth::logout();
         return redirect('restricted_page');
        }
      


      } 


            





    }
}
