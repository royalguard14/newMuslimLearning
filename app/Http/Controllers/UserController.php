<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Position;
use App\Models\Department;
use App\Models\Workgroup;
use App\Models\UserIndustry;
use App\Models\Role;
use Auth;
use Response;
use Redirect;
use DB;
use Hash;


class UserController extends Controller
{
    
public function index(){

        $users = [];
      
        
        $positions = [];
        $departments = [];        

        return view('users.index',compact('users','positions','departments'));
    }

    public function create(){

        $positions = Position::getList();
        $departments = Department::getList();  

        $company = DB::table('company')->pluck('company_name','company_code');
    
        $branches = DB::table('branches')->pluck('branch_name','branch_code');

        return view('users.create',compact('positions','departments','company','branches'));
    }

    public function store(Request $request){

date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

       $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $randomu=substr(str_shuffle($permitted_chars), 0, 8); 

  

    $company_list=DB::table('company')->orderby('id','DESC')->first();


if($company_list == null){
   $maxcode=0;
}else{
   $maxcode=$company_list->company_code;
}

$code = $maxcode+1;


DB::table('company')->insert([


      'company_code' => str_pad($code, 4, '0', STR_PAD_LEFT),
      'company_name' => $request->company_name,
      'company_address' => $request->company_address,
       'company_contact' => $request->company_contact,
       'workperyear'=>$request->dayswork,
       'dtimein'=>$request->d_timein,
       'dtimeout'=>$request->d_timeout


]);

        DB::table('users')->insert([
            'employee_id' => $randomu,
            'company_code' => str_pad($code, 4, '0', STR_PAD_LEFT),
            'branch_code' => null,
            'position_id' => '0',
            'department_id' => '0',
            'first_name'     => $request->first_name,
            'middle_name' => 'x',           
            'last_name' => $request->last_name,
            'suffix_name' => null,
            'contact_number' => $request->company_contact,
            'email_address' => $request->username.'@zeardev.com',
            'birthday' => $date,
            'address' => $request->company_address,
            'addedby' => 'admin',
            'sss_id' => null,
            'pagibig_id' =>  null,
            'philhealth_id' =>  null,           
            'online' => '0',
            'role' => '5',
            'active' => '1',
            'username' => $request->username,
            'password' => Hash::make($request->password)
                        
        ]);



        
        return redirect('users')->with('is_success', 'User was successfully saved');

    }

    public function edit($id){

        $user = User::findOrFail($id);
        $positions = Position::getList();
        $departments = Department::getList();
        $myIndus = UserIndustry::byUser($id);        
        return view('users.edit',compact('user','positions','departments','myIndus'));
    }

    public function update(Request $request, $id){

        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->empid = $request->empid;
        $user->email = $request->email;
        $user->position_id = $request->position_id;     
        // $user->dept_id = $request->dept_id;
        $user->username = $request->username;

        if($request->hasFile('image'));
        {   
            if(!empty($file)){
                $old_files = public_path().'/uploads/users/'. $request->get('employee_number').'/'.$user->image;// get all file names                                
                if(is_file($old_files)){
                    unlink($old_files); // delete file
                }                 
            }   
            $file = Input::file('image');                        
            if(!empty($file)){
                $destinationPath = public_path().'/uploads/users/'. $request->get('employee_number');
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $user->image = $filename;
            }                                    
        }                       
        $user->update();

        $indus = $request->get('dept_id');        
        UserIndustry::reset($user->id);
        if(!empty($indus)){
            foreach ($indus as $ind) {
                $post2['user_id'] = $user->id;
                $post2['industry_id'] = $ind;
                UserIndustry::savePayload($post2);    
            }
        }
        return redirect('users')->with('is_update', 'User was successfully saved');
    }

    public function activate($id){

        $user = User::findOrFail($id);

        if($user->active > 0){

            $user->active = 0;
        }else{

            $user->active = 1;
        }

        $user->update();
        return redirect('users');
    }

    public function getUserDetails(Request $request){

        $user = User::findOrFail($request->userid);

        return Response::json($user);
    }

    public function user_reset_pass($payload){

        return view('users.reset_password_user');
    }

    public function reset_password_update_user(Request $request){

        $this->validate($request, [            
            'password' => 'required|min:6',                              
        ]);

        $user = User::find(Auth::id());
        $user->password = \Hash::make($request->password);
        $user->update();        

        return redirect('user/reset/password.php')->with('is_reset', 'User was successfully saved');
    }


    public function delete(){


    }

    
}
