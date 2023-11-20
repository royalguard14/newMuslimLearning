<?php

namespace App\Http\Controllers;

use App\Models\Department;


use App\Imports\DepartmentImport;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;
use Response;
use DB;
use Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       
       $departments=Department::get();

        return view('department.index',compact('departments'));
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


       $postdata['department_name'] =mb_strtolower($request->department);
       $postdata['department_head'] = $request->head;

       $data = new Department($postdata);
       $data->save();

        return back()->with('is_success','Saved!');
    }

    public function departmentDetails(Request $request){

        $department = Department::findOrFail($request->get('departmentid'));

        return Response::json($department);
    }

    public function departmentUpdates(Request $request){

  DB::table('departments')->where('id',$request->department_id)->update([
   'department'=> $request->department

  ]);

        return back()->with('is_update','Updated!');
        
    }

    public function subDepartmentDetails(Request $request){

        $cc = DepartmentSub::getCC($request->get('dept'));

        $ccs = [];
        if(!empty($cc)){

            foreach ($cc as $key => $value) {
               $ccs[] = $value->cc;
           }       
        }
        return Response::json($ccs);
    }




     public function getbranches(Request $request){



        $branches = DB::table('branches')->where('company_code',$request->deptid)->get();
         
        
            
        return $branches;
         

    }



     public function getbranchess(Request $request){


        $output='';

        if($request->deptid == 'local'){

             $branches = DB::table('branches')->get();

             $output.=' <select class="form-control branchcss" name="branch_code" id="type" required>
                         <option value="" disabled selected>Select Local Branch</option>
                         ';

                    foreach($branches as $row){


                           $output.='<option value="'.$row->branch_code.'">'.$row->branch_name.'</option>';
                    }
                        
                         
            $output.=' </select>';


        }else{

              $output.= '';
        }

       
       echo $output;
         
        
            
       
         

    }

  public function getbranchesajax(Request $request){


    $branches = DB::table('branches')->where('company_code',$request->deptid)->get();

    $output='';

$output.=' 
                                    
                               ';
foreach($branches as $row){

       $output.='
           <option value="'.$row->branch_code.'"> '.$row->branch_name.' </option>
                                        
                                ';
         
}
 
   $output.=' </select>




   ';     
            
        return $output;
         

    }


    public function getbranchesajaxs(Request $request){


    $branches = DB::table('branches')->where('company_code',$request->deptid)->get();

    $output='';

$output.=' <select id="branch_codex" class="form-control" name="branch_code" >
                                   

                                    
                               ';
foreach($branches as $row){

       $output.='
           <option value="'.$row->branch_code.'"> '.$row->branch_name.' </option>
                                        
                                ';
         
}
 
   $output.=' </select>




   ';     
            
        return $output;
         

    }


 public function getdept(Request $request){

        $row=explode("|",$request->deptid);


        $dept = DB::table('departments')->where('Company_code',$row[0])->where('Branch_code',$row[1])->get();
         
        
            
        return $dept;
         

    }

    



     public function routesform(Request $request){

      

        $routes = DB::table('branches')->where('id',$request->b_id)->first();
         
       
            
        return $routes;
         

    }


     public function routes_add(Request $request){

           
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d H:i:s');
            $year = date("Y",strtotime($date));

            $sys_code=$request->depot_code.'-'.$request->type.'-'.$request->route;
          
            
            DB::table('branch_routes')->insert([

           'company_code'=>$request->company_code,
           'branch_code'=>$request->branch_code,
           'route_code_year'=>$year,
           'service_package'=>$request->service_package,
           'depot_code'=>$request->depot_code,
            'type'=>$request->type,
            'route'=>$request->route,
            'system_code'=>$sys_code,
            'area_coverage'=>$request->aoc,
            'log'=>$request->company_code


            ]);

          

       
            
      return back()->with('is_update','Routes Added!');
      
         

    }

public function upload(Request $request){



    Excel::import(new DepartmentImport, request()->file('excel_dept_file'));

      return back()->with('is_update','Department - Position Added!');
}




// public function upload(Request $request){



//     Excel::import(new DepartmentImport, request()->file('excel_dept_file'));

//       return back()->with('is_update','Department - Position Added!');
// }



}
