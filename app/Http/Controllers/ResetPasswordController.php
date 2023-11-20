<?php

namespace App\Http\Controllers;

use App\Models\ResetPassword;

use App\Http\Requests;
use App\Models\User;
use Session;
use Redirect;

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
   

protected $request;

    public function __construct(Request $request){

        $this->request = $request;
    }
    
    

    // public function index(){

    //  return view('auth.reset_password');
    // }

    // public function store(Request $request){

    //  $email = $this->request->get('email');

    //  if(empty($email)){

    //      Session::flash('flash_message', 'Email does not exist!');
    //          Session::flash('flash_class', 'alert alert-danger');
    //          return \Redirect::back();
    //  }       

    //  $url = url('/');
    //     $user = User::where('email',$email)->first();
    //     if(!empty($user)){

       //      PasswordReset::where('email',$user->email)->delete();

       //      $encrypt_email = Hash::make($email);

       //           \Mail::send('auth.message',
          //            $data = [
          //             'name' => strtoupper($user->first_name.' '.$user->last_name),
          //             'email' =>$encrypt_email,
          //             'url' => $url,
             //        ],function ($message) use($data,$user){
             //              $email_add = $user->email;
             //              $message->from('admin@admin.com', 'Project Reference System');
             //              $message->to($email_add)->subject('Password Reset Email');
             //             });

          //         $reset_pass = new PasswordReset();
          //         $reset_pass->email = $email;
          //         $reset_pass->token = $encrypt_email;
          //         $reset_pass->save();

          //         return view('auth.success_message');
       //      }

       //        return view('auth.invalidemail');

    // }

   
}
