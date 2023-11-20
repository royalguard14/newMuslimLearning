<?php

namespace App\Http\Controllers;

use App\Models\AccessControl;
use App\Models\Modules;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class AccessControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $company = DB::table('company')->pluck('company_name','company_code');
    
        $branches = DB::table('branches')->pluck('branch_name','branch_code');

          return view('imports.index',compact('company','branches'));
    }

    public function ajaxlist(Request $request)
    {

        $output='';

       $access = DB::table('role')->where('id',$request->id)->first();
       $str_arr = explode (",", $access->modules); 
     
       $modules=DB::table('modules')->get();

       foreach ($modules as $row) {
           
  if (in_array($row->id, $str_arr)){

                 $output.='

                 <div class="col-md-4"> 
                 <input type="checkbox" name="modules[]" value="'.$row->id.'" checked>
                 <label for="modules"> '.$row->module.'</label>
                 </div>';
    }else{

                 
                 $output.='
                 <div class="col-md-4"> 
                 <input type="checkbox" name="modules[]" value="'.$row->id.'">
                 <label for="modules"> '.$row->module.'</label>
                 </div>';
    }
       }

       $output.='<input type="hidden" name="type" value="'.$request->id.'">';
       echo $output;
    }


    public function updateaccess(Request $request)
    {


$dip=implode( ',', $request->modules );
        
        DB::table('role')->where('id',$request->type)->update([

            'modules'=>$dip


        ]);


        return back()->with('is_update','Success!');

    }


     public function ajaxusers(Request $request)
    {

        $output='';

        $user=DB::table('users')->where('role',$request->id)->orderby('first_name','ASC')->get();

foreach($user as $row){

$output.='
                 <div class="col-md-6"> 
                '.$row->first_name.' '.$row->last_name.'
                 </div>';



}


       echo $output;
    }


    public function adduseraccess(Request $request)
    {

        foreach ($request->cc as $row) {
            
            DB::table('users')->where('id',$row)->update([

                'role'=>$request->id

            ]);
        }

        return back()->with('is_success','Success!');

    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->get('uid');
        $postdata = $request->get('module_id');

        AccessControl::DeleteByUser($id);
        if(!empty($postdata)){

            foreach ($postdata as $postd) {         
                $access = new AccessControl();
                $access->user_id = $id;
                $access->module_id = $postd;
                $access->save();
            }
        }       
        
        return back()->with('is_success', 'Access was successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccessControl  $accessControl
     * @return \Illuminate\Http\Response
     */
    public function show(AccessControl $accessControl)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccessControl  $accessControl
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessControl $accessControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccessControl  $accessControl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessControl $accessControl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccessControl  $accessControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessControl $accessControl)
    {
        //
    }

    public function manage($uid){

        $user = User::find($uid);
        $access_controls = AccessControl::ByUser($uid);
        $modules = Modules::all();
        $access_control = [];        
        if(!empty($access_controls)){

            foreach($access_controls as $ac){

            $access_control[] = $ac->module_id;
            }
        }                
        return view('access_control.manage',compact('user','modules','access_control','uid'));
    }




     public function group()
    {
       $users = DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))
                ->where('active',"0")                
                ->pluck('full_name','id');

      $access = DB::table('role')->get();


$navvar = [
    "" => "Default",
    "navbar-dark navbar-primary" => "primary",
    "navbar-dark navbar-secondary" => "secondary",
    "navbar-dark navbar-info" => "info",
    "navbar-dark navbar-success" => "success",
    "navbar-dark navbar-danger" => "danger",
    "navbar-dark navbar-indigo" => "indigo",
    "navbar-dark navbar-purple" => "purple",
    "navbar-dark navbar-pink" => "pink",
    "navbar-dark navbar-navy" => "navy",
    "navbar-dark navbar-lightblue" => "lightblue",
    "navbar-dark navbar-teal" => "teal",
    "navbar-dark navbar-cyan" => "cyan",
    "navbar-dark" => "dark",
    "navbar-dark navbar-gray-dark" => "gray-dark",
    "navbar-dark navbar-gray" => "gray",
    "navbar-light" => "light",
    "navbar-light navbar-warning" => "warning",
    "navbar-light navbar-white" => "white",
    "navbar-light navbar-orange" => "orange",
];
$logocolor = [
    "" => "Default",
    "navbar-primary" => "primary",
    "navbar-secondary" => "secondary",
    "navbar-info" => "info",
    "navbar-success" => "success",
    "navbar-danger" => "danger",
    "navbar-indigo" => "indigo",
    "navbar-purple" => "purple",
    "navbar-pink" => "pink",
    "navbar-navy" => "navy",
    "navbar-lightblue" => "lightblue",
    "navbar-teal" => "teal",
    "navbar-cyan" => "cyan",
    "navbar-dark" => "dark",
    "navbar-gray-dark" => "gray-dark",
    "navbar-gray" => "gray",
    "text-black navbar-light" => "light",
    "navbar-warning" => "warning",
    "text-black navbar-white" => "white",
    "navbar-orange" => "orange"
];
$accentcolor = [
    "" => "Default",
    "accent-primary" => "primary",
    "accent-warning" => "warning",
    "accent-info" => "info",
    "accent-danger" => "danger",
    "accent-success" => "success",
    "accent-indigo" => "indigo",
    "accent-lightblue" => "lightblue",
    "accent-navy" => "navy",
    "accent-purple" => "purple",
    "accent-fuchsia" => "fuchsia",
    "accent-pink" => "pink",
    "accent-maroon" => "maroon",
    "accent-orange" => "orange",
    "accent-lime" => "lime",
    "accent-teal" => "teal",
    "accent-olive" => "olive"
];
$sbcol = [
    "" => "Default",
    "|1" => "=========Dark-theme=========",
    "os-theme-light|sidebar-dark-primary" => "primary",
    "os-theme-light|sidebar-dark-warning" => "warning",
    "os-theme-light|sidebar-dark-info" => "info",
    "os-theme-light|sidebar-dark-danger" => "danger",
    "os-theme-light|sidebar-dark-success" => "success",
    "os-theme-light|sidebar-dark-indigo" => "indigo",
    "os-theme-light|sidebar-dark-lightblue" => "lightblue",
    "os-theme-light|sidebar-dark-navy" => "navy",
    "os-theme-light|sidebar-dark-purple" => "purple",
    "os-theme-light|sidebar-dark-fuchsia" => "fuchsia",
    "os-theme-light|sidebar-dark-pink" => "pink",
    "os-theme-light|sidebar-dark-maroon" => "maroon",
    "os-theme-light|sidebar-dark-orange" => "orange",
    "os-theme-light|sidebar-dark-lime" => "lime",
    "os-theme-light|sidebar-dark-teal" => "teal",
    "os-theme-light|sidebar-dark-olive" => "olive",
    "|2" => "=========Light-theme=========",
    "os-theme-dark|sidebar-light-primary" => "primary",
    "os-theme-dark|sidebar-light-warning" => "warning",
    "os-theme-dark|sidebar-light-info" => "info",
    "os-theme-dark|sidebar-light-danger" => "danger",
    "os-theme-dark|sidebar-light-success" => "success",
    "os-theme-dark|sidebar-light-indigo" => "indigo",
    "os-theme-dark|sidebar-light-lightblue" => "lightblue",
    "os-theme-dark|sidebar-light-navy" => "navy",
    "os-theme-dark|sidebar-light-purple" => "purple",
    "os-theme-dark|sidebar-light-fuchsia" => "fuchsia",
    "os-theme-dark|sidebar-light-pink" => "pink",
    "os-theme-dark|sidebar-light-maroon" => "maroon",
    "os-theme-dark|sidebar-light-orange" => "orange",
    "os-theme-dark|sidebar-light-lime" => "lime",
    "os-theme-dark|sidebar-light-teal" => "teal",
    "os-theme-dark|sidebar-light-olive" => "olive"
];




       return view('access_control.group',compact('access','users','navvar','logocolor','accentcolor','sbcol'));
    }


    public function roles(Request $request)
{
    DB::table('role')->insert([
        'group'=> $request->name_group,
        'modules' => '0'
    ]);
    // $old_log = DB::table('activity_logs')->where('id',$request->user_id)->first();
    // DB::table('activity_logs')->where('id', $request->user_id)->update([
    //     'logs'=> $old_log->logs . '|' . 'Register new role:' . $request->name_group . '. Date: ' . Carbon::now('Asia/Manila'),
    // ]);
    toast('successfully Add new role','info',);
    return back()->with('is_success','Success!');
}



public function delrole(Request $request){
    $loged = Auth::id();
    $rolename = DB::table('roles')->where('id',$request->id)->first();    
    $old_log = DB::table('activity_logs')->where('id',$loged)->first();
    DB::table('activity_logs')->where('id', $loged)->update([
        'logs'=> $old_log->logs . '|' . 'Deleted role:' . $rolename->group . '. Date: ' . Carbon::now('Asia/Manila'),
    ]);
    DB::table('roles')->where('id',$request->id)->delete();
    return back()->with('is_success','DELETED!');
}



}
