<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\Holiday;
use DB;
use App\Models\employeedata;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon;
use Auth;

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



        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        $loged=Auth::user();

        foreach($row as $rw){

           
            $new_data = preg_replace("/[\t\s]+/", " ", trim($rw));
            $fixarray = explode (" ", $new_data);
          
            $emp=employeedata::Where('employee_id',$fixarray[0])->first();


            if(count($emp)>0){


                $days = date("l",strtotime($fixarray[1]));
                $indatefine=strtolower($days."_in"); 
                $outdatefine=strtolower($days."_out");


              $holiday=Holiday::Where('date',$fixarray[1])->first();
                        if(count($holiday)>0){
                          $holi=$holiday->id;

                        }else{
                            //normal days
                           
                             $holi=0;

                        }//holiday





 if($emp[$indatefine] <> "00:00:00"){//nowork?

                       
                    
    /******************************************/
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
                'company_code'=>$loged->company_code,
                'branch_code'=>$loged->branch_code,
                'uploadedby'=>$loged->employee_id,
                'uploadeddate'=>$date,
                'employee_id'=>$fixarray[0],
                'datein'=>$fixarray[1],
                'timein' =>$fixarray[2],
                'holiday_id'=>$holi,
                'status'=>'10'

                ]);
             }//2

        }//1
/**************************************************/


/********************************************/



//timeout
          if(($fixarray[3]=='1') AND ($fixarray[4]=='1')){
        //1
        $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','10')
                          ->first();



         if(count($checking)>0){
            //2



            $inhours=$checking->timein;
            $inminutes = 0; 
            if (strpos($inhours, ':') !== false) 
            { 
              
                list($inhours, $inminutes) = explode(':', $inhours); 
            } 
            $inputmin=$inhours * 60 + $inminutes; 


            $outhours=$fixarray[2];
            $outminutes = 0; 
            if (strpos($outhours, ':') !== false) 
            { 
              
                list($outhours, $outminutes) = explode(':', $outhours); 
            } 
            $outputmin=$outhours * 60 + $outminutes; 



  
            $mnhours = $emp[$indatefine];
            $mnminutes = 0; 
            if (strpos($mnhours, ':') !== false) 
            { 
                list($mnhours, $mnminutes) = explode(':', $mnhours); 
            } 
           $mainmin= $mnhours * 60 + $mnminutes; 

          

            $outmnhours = $emp[$outdatefine];
            $outmnminutes = 0; 
            if (strpos($outmnhours, ':') !== false) 
            { 
                list($outmnhours, $outmnminutes) = explode(':', $outmnhours); 
            } 
           $outmainmin=$outmnhours * 60 + $outmnminutes; 



           $start= new DateTime($checking->datein." ".$checking->timein);
           $end= new DateTime($fixarray[1]." ".$fixarray[2]);




           $interval =  $start->diff($end);
           $intervalminute = $interval->h * 60 + $interval->i;



   //add flex time her 362
            $timecheck=DB::table('employdata')->where('employee_id',$checking->employee_id)->first();

            if($timecheck->time_sched == '1'){

                 $overtime = 0;
                 $late = 0;
                 $undertime = 0;
                 $offset=true;
                


            }else{
             

                 if($mainmin >= $inputmin) {
                            if($outmainmin == $outputmin) {
                    
                         $overtime = 0;
                         $late = 0;
                         $undertime = 0;
                         $offset=true;
                         
                            }else if($outmainmin <= $outputmin) {
                        $overtime = $outputmin - $outmainmin;
                         $late = 0;
                         $undertime = 0;
                       
                         $offset=true;
                         
                             }else if($outmainmin >= $outputmin) {
               
                           $overtime = 0;
                           $late = 0;
                         $undertime =  $outmainmin - $outputmin; 
                         $offset=true;
                         
                            }
                            else{


                            }

                            
                    }else
                    {

                            if($outmainmin == $outputmin) {
              
                         $overtime = 0;
                          $undertime = 0;
                         $late = $inputmin - $mainmin;
                         $offset=false;
                         
                            }else if($outmainmin <= $outputmin) {
                
                         $overtime = $outputmin - $outmainmin;
                          $late = $inputmin - $mainmin;
                           $undertime = 0;
                           $offset=false;
                         
                             }else if($outmainmin >= $outputmin) {
                     
                           $overtime = 0;
                         $undertime =  $outmainmin - $outputmin; 
                          $late = $inputmin - $mainmin;
                          $offset=false;
                         
                            }
                            else{ }
                      
                    } 


            }

            //

            





                if ($intervalminute<=60){

                    $hrate=$intervalminute;
                }else
                {
                    $hrate=480-$late-$undertime;
                }
///////////////////

        $holidaytoday=DB::table('holiday')->where('id',$checking->holiday_id)->first();

        if($holidaytoday == null){
            $todayearn=round($hrate*$emp->minute,2);

        }else{
            //regular
            if(($holidaytoday->type =='regular') AND ($holidaytoday->access =='open')){

                $fulltime=DB::table('employdata')->where('employee_id',$fixarray[0])->first();
                   if(($fulltime->contract_start=='Full-Time') AND ($fulltime->salary_type=='monthly_rate')){
                        $todayearn=round(($hrate*$emp->minute)*2,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);

                    }
            }

            if(($holidaytoday->type =='regular') AND ($holidaytoday->access =='close')){

                $todayearn=0;
            }

            //special non working

             if(($holidaytoday->type =='nonspecial') AND ($holidaytoday->access =='open')){

                $fulltime=DB::table('employdata')->where('employee_id',$fixarray[0])->first();
                   if(($fulltime->contract_start=='Full-Time') AND ($fulltime->salary_type=='monthly_rate')){
                        $todayearn=round(($hrate*$emp->minute)*1.3,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);

                    }
            }

            if(($holidaytoday->type =='nonspecial') AND ($holidaytoday->access == 'close')){

                $fulltime=DB::table('employdata')->where('employee_id',$fixarray[0])->first();
                   if(($fulltime->contract_start=='Full-Time') AND ($fulltime->salary_type=='monthly_rate')){
                        $todayearn=round(($hrate*$emp->minute)*1.3,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);

                    }
            }
            ///


              //special working

             if(($holidaytoday->type =='special') AND ($holidaytoday->access =='open')){

                $fulltime=DB::table('employdata')->where('employee_id',$fixarray[0])->first();
                   if(($fulltime->contract_start=='Full-Time') AND ($fulltime->salary_type=='monthly_rate')){
                        $todayearn=round(($hrate*$emp->minute)*1.3,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);

                    }
            }

            if(($holidaytoday->type =='special') AND ($holidaytoday->access == 'close')){

                $fulltime=DB::table('employdata')->where('employee_id',$fixarray[0])->first();
                   if(($fulltime->contract_start=='Full-Time') AND ($fulltime->salary_type=='monthly_rate')){
                        $todayearn=round(($hrate*$emp->minute)*1.3,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);

                    }
            }
            ///


              //local

             if(($holidaytoday->type =='local') AND ($holidaytoday->access =='open')){

                $fulltime=DB::table('employdata')->where('employee_id',$fixarray[0])->first();
                   if(($fulltime->contract_start=='Full-Time') AND ($fulltime->salary_type=='monthly_rate')){
                        $todayearn=round(($hrate*$emp->minute)*1.3,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);

                    }
            }

            if(($holidaytoday->type =='local') AND ($holidaytoday->access == 'close')){

                $fulltime=DB::table('employdata')->where('employee_id',$fixarray[0])->first();
                   if(($fulltime->contract_start=='Full-Time') AND ($fulltime->salary_type=='monthly_rate')){
                        $todayearn=round(($hrate*$emp->minute)*1.3,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);

                    }
            }
            ///




        }


///////////////////



            DB::table('employee_attendance')
                ->where('employee_id',$fixarray[0])
                ->where('datein',$fixarray[1])
                ->where('status','10')


                ->update([

                'dateout'=>$fixarray[1],
                'timeout' =>$fixarray[2],
                'interval_rec'=> $intervalminute,
                'overtime'     => $overtime,
                'undertime'     => $undertime,
                'late'     => $late,
                'absent'     => 0,
                'hourly_rate' =>$hrate, 
                'today_earn' => $todayearn,
                'interval_rec' => $intervalminute,
                'log'=>$log,
                'status'=>$fixarray[3].''.$fixarray[4]

                ]);

         }else{
         
            //pass once record doesnt exists

            
             }//2

        }//1

/*********************************************/



/*********************************************/



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
                'company_code'=>$loged->company_code,
                'branch_code'=>$loged->branch_code,
                'uploadedby'=>$loged->employee_id,
                'uploadeddate'=>$date,
                'employee_id'=>$fixarray[0],
                'datein'=>$fixarray[1],
                'timein' =>$fixarray[2],
                'holiday_id'=>0,
                'remarks'=>'OT',
                'status'=>'14'

                ]);
             }//2

        }//1

/*********************************************/


/***********************************************/
//ot timeout
   if(($fixarray[3]=='1') AND ($fixarray[4]=='5')){
        //1

  
        $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','14')
                          ->first();

         if(count($checking)>0){
            //2

            DB::table('employee_attendance')
                ->where('employee_id',$fixarray[0])
                ->where('datein',$fixarray[1])
                ->where('status','14')


                ->update([
                'dateout'=>$fixarray[1],
                'timeout' =>$fixarray[2],
                'status'=>$fixarray[3].''.$fixarray[4]


                ]);


         }else{
         


        $dateminus1 = new DateTime($fixarray[1]);
        $dateminus1->modify('-1 day');


           $checkin1=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$dateminus1)
                          ->where('status','14')
                          ->first();
            
        if(count($checkin1)>0){
            DB::table('employee_attendance')
                ->where('employee_id',$fixarray[0])
                ->where('datein',$dateminus1)
                ->where('status','14')


                ->update([
                'dateout'=>$fixarray[1],
                'timeout' =>$fixarray[2],
                'status'=>$fixarray[3].''.$fixarray[4]
               

                ]);
            }
            else{

            }
            
             }//2

        }//1




/********************************************/




}//nowork00:00:00







            }else{}//empcount
    }//end

}

}