<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function __construct(    
        AuthManager $auth
        )
    {
        // $this->middleware('guest', ['except' => 'getLogout']);
      
        $this->auth = $auth;
    
    }
    public function handle(Request $request, Closure $next)
    {

        $usernameinput =  $request->username;
            $password = $request->password;        

            if ($this->auth->attempt([

                'username' => $usernameinput,
                'password' => $password,   
                ])) 
            {            

        return $next($request);
             }else{

               
                return response()->json(['message'=>'Credentials error'], 401);
             }

    }
}
