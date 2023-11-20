<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\Holiday;
use DB;
use App\Models\employeedata;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon;

class AttendanceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    //1.upload
    public function model(array $row)
    { //1
        foreach($row as $rw){

            $new_data = preg_replace("/[\t\s]+/", " ", trim($rw));
            $fixarray = explode (" ", $new_data);
          

    /*******normal time in time out*********/
    
    //timein
     if(($fixarray[3]=='1') AND ($fixarray[4]=='0')){
        //1
        $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','10')
                          ->first();
         if(count($checking)>0){
            //2

            //pass (only get the first entry)

         }else{
         

             DB::table('employee_attendance')->insert([
                
                'employee_id'=>$fixarray[0],
                'datein'=>$fixarray[1],
                'timein' =>$fixarray[2],
                'status'=>'10'

                ]);
             }//2

        }//1


//timeout
          if(($fixarray[3]=='1') AND ($fixarray[4]=='1')){
        //1
        $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','10')
                          ->first();
         if(count($checking)>0){
            //2

            DB::table('employee_attendance')
                ->where('employee_id',$fixarray[0])
                ->where('datein',$fixarray[1])
                ->where('status','10')


                ->update([
                'dateout'=>$fixarray[1],
                'timeout' =>$fixarray[2],
                'status'=>$fixarray[3].''.$fixarray[4]

                ]);


         }else{
         
            //pass once record doesnt exists
            
             }//2

        }//1



//ot timein
 if(($fixarray[3]=='1') AND ($fixarray[4]=='4')){
        //1
        $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','14')
                          ->first();
         if(count($checking)>0){
            //2

            //pass (only get the first entry)

         }else{
         

             DB::table('employee_attendance')->insert([
                
                'employee_id'=>$fixarray[0],
                'datein'=>$fixarray[1],
                'timein' =>$fixarray[2],
                'status'=>'14'

                ]);
             }//2

        }//1




//ot timeout
   if(($fixarray[3]=='1') AND ($fixarray[4]=='5')){
        //1

   $dateminus1 = new DateTime($fixarray[1]);
    $dateminus1->modify('-1 day');

   
        $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$dateminus1)
                          ->where('status','14')
                          ->first();
         if(count($checking)>0){
            //2

            DB::table('employee_attendance')
                ->where('employee_id',$fixarray[0])
                ->where('datein',$dateminus1)
                ->where('status','14')


                ->update([
                'dateout'=>$fixarray[1],
                'timeout' =>$fixarray[2],
                'status'=>$fixarray[3].''.$fixarray[4]

                ]);


         }else{
         
            //pass once record doesnt exists
            
             }//2

        }//1






       
             
   /*******normal time in time out*********/



    /*******OT time in time out*********/
       
             
   /*******OT time in time out*********/

        

                            
            }//foreach row

        
 


    }

}
