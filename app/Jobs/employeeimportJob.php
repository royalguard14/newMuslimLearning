<?php

namespace App\Jobs;


use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use DB;
use Auth;
use Hash;
use Illuminate\Support\Facades\Log;

class employeeimportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $datafile;
    public $users;
    public $branches;
    public $company;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($datafile,$users,$company,$branches)
    {
        $this->datafile = $datafile;
        $this->users = $users;
        $this->branches = $branches;
        $this->company= $company;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


    
        $branches=$this->branches;
        $company=$this->company;

        $loged=$this->users;
        $arrays=$this->datafile;



        $companydetails=DB::table('company')->where('company_code',$company)->first();

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomu=substr(str_shuffle($permitted_chars), 0, 6);

        $log=null;

        $registered = DB::table('users')->where('employee_id',$arrays[0])->get();        


        if(count($registered)>0){

            \Log::channel('dup_employee')->info('Employee ID:  '.$arrays[0]. ' is already registered ('.$arrays[4].' '.$arrays[3].')');


        }else{





  if($arrays[1] == 'daily_rates'){
                $daily=$arrays[2];
                $hourly = $daily/8;
                $min = $daily/480;
                $salary_real = $daily*$companydetails->workperyear/12;
        }
        else{
             $daily=$arrays[2]*12/$companydetails->workperyear;
             $hourly = $daily/8;
             $min = $daily/480;
               $salary_real = $arrays[2];

        }


if($arrays[26] == 'all'){

    $branch_ack = DB::table('branches')->where('company_code',$company)->where('branch_arc',$arrays[8])->first();

    if($branch_ack != null){



                 $branchk=$branch_ack->branch_code;


        $deptid=DB::table('departments')->where('Company_code',$branch_ack->company_code)->where('Branch_code',$branch_ack->branch_code)->where('department',$arrays[9])->first();

        if($deptid != null){
                   $deptk=$postid->department_id;

            $postid=DB::table('positions')->where('company_code',$deptid->Company_code)->where('branch_code',$deptid->Branch_code)->where('department_id',$deptid->id)->where('position',$arrays[10])->first();

                        if($postid != null){

                           
                            
                            $posk=$postid->id;


                        }else{

                            $deptk='error all pos- '.$arrays[0];

                         \Log::channel('error_found')->info('No Position '.$arrays[10].' found in Dept '.$arrays[9].' Branch '.$arrays[8].' Employee_id '.$arrays[0]);

                     }

     }else{
         $deptk='error all dept- '.$arrays[0];

        \Log::channel('error_found')->info('No Dept '.$arrays[9].' found in Branch '.$arrays[8].' Employee_id '.$arrays[0]);
    }


}else{
     $branchk='error all branch- '.$arrays[0];
    \Log::channel('error_found')->info('No Branch '.$arrays[8].' Employee_id '.$arrays[0]);

}


}else{

   ///


    $branch_ack = DB::table('branches')->where('company_code',$company)->where('branch_code',$arrays[26])->first();

    if($branch_ack != null){

        if($arrays[8] == $branch_ack->branch_arc){




        $deptid=DB::table('departments')->where('company_code',$company)->where('Branch_code',$branch_ack->branch_code)->where('department',$arrays[9])->first();

        if($deptid != null){

            $postid=DB::table('positions')->where('company_code',$company)->where('branch_code',$branch_ack->branch_code)->where('department_id',$deptid->id)->where('position',$arrays[10])->first();

            if($postid != null){

                $branchk=$arrays[26];
                $deptk=$postid->department_id;
                $posk=$postid->id;


            }else{


             \Log::channel('error_found')->info('No Position '.$arrays[10].' found in Dept '.$arrays[9].' Branch '.$arrays[8].' Employee_id '.$arrays[0]);

         }

     }else{

        \Log::channel('error_found')->info('No Dept '.$arrays[9].' found in Branch '.$arrays[8].' Employee_id '.$arrays[0]);
    }




        }



}else{
    \Log::channel('error_found')->info('No Branch '.$arrays[8].' Employee_id '.$arrays[0]);

}


   ///


}


      
       
     
       
DB::table('users')->insert([

 'employee_id'=>$arrays[0],
 'company_code'=>$company,
 'branch_code'=>$branchk,    
 'department_id'=>$deptk,
 'position_id'=>$posk,
 'first_name'=>$arrays[4],
 'middle_name'=>$arrays[5],
 'last_name'=>$arrays[3],
 'suffix_name'=>strtolower($arrays[6]),
 'contact_number'=>$arrays[21],
 'email_address'=>$arrays[22],
 'birthday'=>gmdate("Y-m-d", ($arrays[16] - 25569) * 86400), 
 'gender'=>strtolower($arrays[18]),
 'civilstatus'=>strtolower($arrays[17]),        
 'address'=>ucwords($arrays[19]),
 'address2'=>ucwords($arrays[20]),

 
 'addedby'=>$loged->employee_id,
 'sss_id'=>$arrays[12],
 'pagibig_id'=>$arrays[14],
 'philhealth_id'=>$arrays[13],
 'tin_id'=>$arrays[15],
 'online' => '0',
 'role' => '3',
 'active' => '0',
 'username' => $arrays[0],
 'password' => Hash::make($arrays[0]),
 'created_at'=>$date,
 'updated_at'=>$date


]);


DB::table('employdata')->insert([

    'employee_id'=>$arrays[0],
    'company_code'=>$company,
    'branch_code'=>$branchk,    
    'department_id'=>$deptk,
    'position_id'=>$posk,
    'contract_start'=>strtolower($arrays[11]),
    'local_emp'=>strtolower($arrays[24]),
    'salary_type'=>$arrays[1],
    'salary_offer'=>$salary_real,
    'cola'=>'0',
    'leavecount'=>'15',

    'member_since'=>gmdate("Y-m-d", ($arrays[7] - 25569) * 86400),

    // 'src'=>$arrays[23],
        // 'separated_date'=>$sep,
    'time_sched'=>$arrays[25],
    
    'monday_in'=>$companydetails->dtimein,
    'monday_out'=>$companydetails->dtimeout,
    'tuesday_in'=>$companydetails->dtimein,
    'tuesday_out'=>$companydetails->dtimeout,
    'wednesday_in'=>$companydetails->dtimein,
    'wednesday_out'=>$companydetails->dtimeout,
    'thursday_in'=>$companydetails->dtimein,
    'thursday_out'=>$companydetails->dtimeout,
    'friday_in'=>$companydetails->dtimein,
    'friday_out'=>$companydetails->dtimeout,
    'saturday_in'=>$companydetails->dtimein,
    'saturday_out'=>$companydetails->dtimeout,
    'daily'=>$daily,
    'hourly' => $hourly,
    'minute' => $min,
    'created_at'=>$date,
    'updated_at'=>$date,
    
   
]);





\Log::channel('reg_employee')->info('Employee ID:  '.$arrays[0]. ' registered ('.$arrays[3].' '.$branchk.')');
}//no record



}





}