<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Job;
use App\Models\Attendance;
use DB;
use DateTime;
use Response;
use Auth;
use Hash;



use App\Models\Holiday;

use App\Models\employeedata;

use Carbon;

use Illuminate\Support\Facades\Log;

class AttendanceUploadJob extends Job implements ShouldQueue
{
   use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $datafile;
    public $users;

    /**
     * Create a new job instance.
     *
     * @return void
     */
 
     public function __construct($datafile,$users)
    {
       
        $this->datafile = $datafile;
        $this->users = $users;



    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    

 date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');

 $loged=$this->users;

      foreach($this->datafile as $data){

              foreach($data as $rw){

            $new_data = preg_replace("/[\t\s]+/", " ", trim($rw));
            $fixarray = explode (" ", $new_data);
          
            $emp=employeedata::Where('employee_id',$fixarray[0])->first();

           if($emp != null){



                $days = date("l",strtotime($fixarray[1]));
                $indatefine=strtolower($days."_in"); 
                $outdatefine=strtolower($days."_out");

                 $holiday=Holiday::Where('date',$fixarray[1])->first();
                        if($holiday){
                          $holi=$holiday->id;

                        }else{
                            //normal days
                           
                             $holi=0;

                        }//$holiday
                if(($emp[$indatefine] <> "00:00:00") OR ($emp[$indatefine] <> null)){



                            /******************************************/
                            //timein
                             if(($fixarray[3]=='1') AND ($fixarray[4]=='0')){
                                //1
                                $checking=Attendance::where('employee_id',$fixarray[0])
                                                  ->where('datein',$fixarray[1])
                                                  ->where('company_code',$emp->company_code)
                                                  ->where('branch_code',$emp->branch_code)
                                                  ->where('status','10')
                                                  ->first();
                                 if($checking){
                                    //2

                                    //pass (only get the first entry)

                                 }else{
                                   
                                     DB::table('employee_attendance')->insert([
                                        'company_code'=>$emp->company_code,
                                        'branch_code'=>$emp->branch_code,
                                        'uploadedby'=>$loged['employee_id'],
                                        'uploadeddate'=>$date,
                                        'employee_id'=>$fixarray[0],
                                        'datein'=>$fixarray[1],
                                        'timein' =>$fixarray[2],
                                        'holiday_id'=>$holi,
                                        'ot_interval_rec'=>0,
                                        'ot_earn'=>0,
                                        'leave_id'=>0,
                                        'leave_inv'=>0,
                                        'leave_earn'=>0,
                                        'status'=>'10'

                                        ]);
                                     }//2

                                }//1
                        /**************************************************/

                         if(($fixarray[3]=='1') AND ($fixarray[4]=='1')){


                             $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','10')
                          ->first();



                             if($checking){
                                


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



   //add flex time her
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



            
                if ($intervalminute<=60){

                    $hrate=$intervalminute;
                }else
                {
                    $hrate=480-$late-$undertime;
                }


$log=null;
 
$holidaytoday=DB::table('holiday')->where('id',$checking->holiday_id)->first();

        if($holidaytoday == null){
            #not holiday
            $todayearn=round($hrate*$emp->minute,2);
            $holiearn=0;
            $holtime=0;
            
             $im=$hrate;

        }else{
            #holiday set type
             $holtime=$hrate;
         
              $im=0;
            //regular
            if(($holidaytoday->type =='regular') AND ($holidaytoday->access =='open')){

              
                   if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                       $todayearn=round($hrate*$emp->minute,2);
                         $holiearn=round(($hrate*$emp->minute)*2-$hrate*$emp->minute,2);

                    }else{

                              $todayearn=round($hrate*$emp->minute,2);
                              $holiearn=0;

                    }
            }//regopen

            if(($holidaytoday->type =='regular') AND ($holidaytoday->access =='close')){

                if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                         
                              $todayearn=round($hrate*$emp->minute,2);
                              $holiearn=0;
                    }else{

                            //not allowed to work
                               $todayearn=0;
                                $holiearn=0;

                    }
               
            }//regclose



            //special non working

             if(($holidaytoday->type =='nonspecial') AND ($holidaytoday->access =='open')){

                    if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                         
                        $todayearn=round($hrate*$emp->minute,2);
                         $holiearn=round(($hrate*$emp->minute)*1.3-$hrate*$emp->minute,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);
                             $holiearn=0;
                    }
            }//nonspecialopen

            if(($holidaytoday->type =='nonspecial') AND ($holidaytoday->access == 'close')){

               $todayearn=0;
               $holiearn=0;
               $log='nonspecial(closed)-no work';
                    
             }//nonspecialclose


 //special
             if(($holidaytoday->type =='special') AND ($holidaytoday->access =='open')){

                    if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                         
                       $todayearn=round($hrate*$emp->minute,2);
                         $holiearn=round(($hrate*$emp->minute)*1.3-$hrate*$emp->minute,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);
                             $holiearn=0;

                    }
            }//specialopen

            if(($holidaytoday->type =='special') AND ($holidaytoday->access == 'close')){

               $todayearn=0;
               $holiearn=0;
               $log='special(closed)-no work';
                    
             }//specialclose



 //local
             if(($holidaytoday->type =='local') AND ($holidaytoday->access =='open')){

                    if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                         
                         $todayearn=round($hrate*$emp->minute,2);
                         $holiearn=round(($hrate*$emp->minute)*1.3-$hrate*$emp->minute,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);
                              $holiearn=0;

                    }
            }//specialopen

            if(($holidaytoday->type =='local') AND ($holidaytoday->access == 'close')){

               $todayearn=0;
               $holiearn=0;
               $log='local(closed)-no work';
                    
             }//specialclose

        }//holiday set

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
                'ot_interval_rec'=>0,
                'ot_earn'=>0,

                'hourly_rate' =>$im, 
                'today_earn' => $todayearn,
                'holiday_earn'=> $holiearn,
                'holinterval'=>$holtime,
                'interval_rec' => $intervalminute,
                'min_rate'=>$emp->minute,
                'status'=>$fixarray[3].''.$fixarray[4],
                'log'=>$log

                ]);
               


                             }else{
                                //checking pass once record doesnt exists

                             }


                         }//11






//ot timein
 if(($fixarray[3]=='1') AND ($fixarray[4]=='4')){
        //1
        $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','14')
                          ->first();
         if($checking){
            //2

            //pass (only get the first entry)

         }else{
         

             DB::table('employee_attendance')->insert([
                 'company_code'=>$emp->company_code,
                'branch_code'=>$emp->branch_code,
                'uploadedby'=>$loged['employee_id'],
                'uploadeddate'=>$date,
                'employee_id'=>$fixarray[0],
                'datein'=>$fixarray[1],
                'timein' =>$fixarray[2],
                'leave_id'=>0,
                 'leave_inv'=>0,
                'holiday_id'=>0,
                'ot_interval_rec'=>0,
                'ot_earn'=>0,
                'leave_earn'=>0,
                'holinterval'=>0,
                'status'=>'14'

                ]);
             }//2

        }//1


//ot timeout
   if(($fixarray[3]=='1') AND ($fixarray[4]=='5')){
        //1

  
        $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','14')
                          ->first();

         if($checking){
            //2

            DB::table('employee_attendance')
                ->where('employee_id',$fixarray[0])
                ->where('datein',$fixarray[1])
                ->where('status','14')


                ->update([
                'dateout'=>$fixarray[1],
                'timeout' =>$fixarray[2],
                'min_rate'=>$emp->minute,
                'status'=>$fixarray[3].''.$fixarray[4]
                


                ]);


         }else{
         


        $dateminus1 = new DateTime($fixarray[1]);
        $dateminus1->modify('-1 day');


           $checkin1=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$dateminus1)
                          ->where('status','14')
                          ->first();
            
        if($checkin1){
            DB::table('employee_attendance')
                ->where('employee_id',$fixarray[0])
                ->where('datein',$dateminus1)
                ->where('status','14')


                ->update([
                'dateout'=>$fixarray[1],
                'timeout' =>$fixarray[2],
                'min_rate'=>$emp->minute,
                'status'=>$fixarray[3].''.$fixarray[4]
               

                ]);
            }
            else{
                #ignore

            }
            
             }//2

        }//1


                }else{
                    #restday but worked





//ot timein
 if(($fixarray[3]=='1') AND ($fixarray[4]=='0')){

     $holiday=Holiday::Where('date',$fixarray[1])->first();
                        if($holiday){
                          $holi=$holiday->id;

                        }else{
                            //normal days
                           
                             $holi=0;

                        }//holiday

        //1
        $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','10')
                          ->first();
         if($checking){
            //2

            //pass (only get the first entry)

         }else{
         


          DB::table('employee_attendance')->insert([
                 'company_code'=>$emp->company_code,
                'branch_code'=>$emp->branch_code,
                'uploadedby'=>$loged['employee_id'],
                'uploadeddate'=>$date,
                'employee_id'=>$fixarray[0],
                'datein'=>$fixarray[1],
                'timein' =>$fixarray[2],
                'holiday_id'=>$holi,
                'ot_interval_rec'=>0,
                'ot_earn'=>0,
                'log'=>'RDOT',
                'status'=>'10'

                ]);

             }//2

        }//1



    if(($fixarray[3]=='1') AND ($fixarray[4]=='1')){


                             $checking=Attendance::where('employee_id',$fixarray[0])
                          ->where('datein',$fixarray[1])
                          ->where('status','10')
                          ->first();



                             if($checking){
                                


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
                if ($intervalminute<=60){

                    $hrate=$intervalminute;
                }else
                {
                    $hrate=480-$late-$undertime;
                }




$holidaytoday=DB::table('holiday')->where('id',$checking->holiday_id)->first();

        if($holidaytoday == null){
            #not holiday
            $todayearn=round($hrate*$emp->minute,2);
            $holiearn=0;
             $holtime=0;
             $intervalminute = $interval->h * 60 + $interval->i;
             $interv=$hrate;


        }else{
            #holiday set type
             $holtime=$hrate;
             $intervalminute=0;

             $intervalminutes = $interval->h * 60 + $interval->i;
             $interv=0;

            
            //regular
            if(($holidaytoday->type =='regular') AND ($holidaytoday->access =='open')){

              
                   if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                       $todayearn=round($hrate*$emp->minute,2);
                         $holiearn=round(($hrate*$emp->minute)*2-$hrate*$emp->minute,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);
                              $holiearn=0;

                    }
            }//regopen

            if(($holidaytoday->type =='regular') AND ($holidaytoday->access =='close')){

                if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                         
                              $todayearn=round($hrate*$emp->minute,2);
                              $holiearn=0;
                    }else{

                               $todayearn=0;
                                $holiearn=0;

                    }
               
            }//regclose



            //special non working

             if(($holidaytoday->type =='nonspecial') AND ($holidaytoday->access =='open')){

                    if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                         
                        $todayearn=round($hrate*$emp->minute,2);
                         $holiearn=round(($hrate*$emp->minute)*1.3-$hrate*$emp->minute,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);
                             $holiearn=0;
                    }
            }//nonspecialopen

            if(($holidaytoday->type =='nonspecial') AND ($holidaytoday->access == 'close')){

               $todayearn=0;
               $holiearn=0;
               $log='nonspecial(closed)-no work';
                    
             }//nonspecialclose


 //special
             if(($holidaytoday->type =='special') AND ($holidaytoday->access =='open')){

                    if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                         
                       $todayearn=round($hrate*$emp->minute,2);
                         $holiearn=round(($hrate*$emp->minute)*1.3-$hrate*$emp->minute,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);
                             $holiearn=0;

                    }
            }//specialopen

            if(($holidaytoday->type =='special') AND ($holidaytoday->access == 'close')){

               $todayearn=0;
               $holiearn=0;
               $log='special(closed)-no work';
                    
             }//specialclose



 //local
             if(($holidaytoday->type =='local') AND ($holidaytoday->access =='open')){

                    if(($emp->contract_start=='regular') OR ($emp->contract_start=='probationary')){
                         
                         $todayearn=round($hrate*$emp->minute,2);
                         $holiearn=round(($hrate*$emp->minute)*1.3-$hrate*$emp->minute,2);
                    }else{

                              $todayearn=round($hrate*$emp->minute,2);
                              $holiearn=0;

                    }
            }//specialopen

            if(($holidaytoday->type =='local') AND ($holidaytoday->access == 'close')){

               $todayearn=0;
               $holiearn=0;
               $log='local(closed)-no work';
                    
             }//specialclose





}//holiday set

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
                'ot_interval_rec'=>0,
                'ot_earn'=>0,
                'hourly_rate' =>$interv, 
                'today_earn' => $todayearn,
                'holiday_earn'=> $holiearn,

                'holinterval'=>$holtime,
                     


                'leave_id'=>0,
                'leave_inv'=>0,
                'leave_earn'=>0,


                'min_rate'=>$emp->minute,
                'status'=>$fixarray[3].''.$fixarray[4]

                ]);
                


                             }else{
                                //checking pass once record doesnt exists

                             }


                         }//11



                }//last


            }else{
                //$emp doesnt 

            \Log::channel('attendance_error')->info('no Record:  EmpID '.$fixarray[0]. ' from '.$emp->company_code.'-'.$emp->branch_code).'!';

            }



              }//foreachdatarow

      }//foreachdatafile


       
      

    }//
}
