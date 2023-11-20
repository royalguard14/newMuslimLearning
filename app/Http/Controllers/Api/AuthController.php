<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Auth\AuthManager;
use App\Account;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\View;
use App\Services\Validation\AuthValidator;
use Illuminate\Routing\Redirector;
use Illuminate\Session\SessionManager;


class AuthController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    protected $auth;

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(    
        AuthManager $auth,
        Request $request,
        Redirector $redirect,
        SessionManager $session
        )

    {
        // $this->middleware('guest', ['except' => 'getLogout']);
        $this->request = $request;
        $this->redirect = $redirect;
        $this->auth = $auth;
        $this->session = $session;
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function getLogin(){        
                
        
        return view('auth.login');
    }

    public function postLogin(Request $request){      
            
            $usernameinput =  $request->username;
            $password = $request->password;        

            if ($this->auth->attempt([

                'username' => $usernameinput,
                'password' => $password,   
                'active' => 1,
                ])) 
            {            
                $user = Auth::user();                
                $user->online = 1;
                $user->update();

                
                   return ['access'=>'1','message'=>'connected'];  
               
             

                
            }

         
  
                  return ['access'=>'0','message'=>'Invalid Credentials'];           
    }


    public function getLogout(){

        $user = Auth::user();        
        $user->online = 0;
        $user->update();
        Auth::logout();
        Session::flush();
        return redirect('/');

    }
}
