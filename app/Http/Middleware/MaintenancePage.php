<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use App\Models\AccessControl;
use App\Models\Role;
use DB;
use App\Http\Middleware\Route;
class MaintenancePage
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
 $loged = Auth::user();
if($loged == null){

return redirect('/');

}else{


 $uri = $request->path();
     
       $path=explode("/",$uri);
      

       

        $access = Db::table('role')->where('id',$loged->role)->first();
       

        $ids = explode (",", $access->modules);

        $urix = $path[0];



         $access_control = DB::table('modules')->where('routeUri',$urix)->first();
      
            
         $key = in_array($access_control->id,$ids);
           

     if($key){
         return $next($request);
          
     }else{

       return redirect('restricted_page');
     }






}


















/*
        if (Auth::check()) {



            $id = Auth::id();
            $role = DB::table('users')->where('id',$id)->first();
            $access = Db::table('role')->where('id',$role->role)->first();
            $ids = explode (",", $access->modules);
            $uri = $request->path();


            if (strpos($uri, '/') !== 0) {
               $idsplash = explode ("/", $uri);
               $access_control = DB::table('modules')->where('routeUri',$idsplash[0])->first();
               $key = in_array($access_control->id,$ids);
// dd($access,$ids,$uri,$idsplash,$access_control,$key);
               if(!$key){
                 return redirect('restricted_page');
             }
             else{           
                 return $next($request);
             }    
         }
         else{
             $access_control = DB::table('modules')->where('routeUri',$uri)->first();
             $key = in_array($access_control->id,$ids);
             if(!$key){
                 return redirect('restricted_page');
             }
             else{           
                 return $next($request);
             }    
         }




     }
     else{
        return redirect()->guest('login');
    }
*/




}
}
