<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjects;
use App\Models\Professor;
use App\Models\Section;
use App\Models\ProfessorAssigned;
use App\Models\Room;
use App\Models\User;
use DB;



class AjaxController extends Controller
{
    
    public function getSubjectByCourse(Request $request)
    {
      
        $data=Subjects::where('course_id',$request->course_id)->get();

        return $data;

    }

    public function getProfessorByCourse(Request $request)
    {
      
        $data=User::join('professor', 'id_number', '=', 'professor.professor_id_number')
                    ->where('users.role',2)
                    ->get();



        return $data;

    }

    public function getSectionByCourse(Request $request)
    {
      
        $data=Section::where('course_id',$request->course_id)->get();

        return $data;

    }


    public function getSectionByProf(Request $request)
    {
        $data=[];
        $datas=ProfessorAssigned::where('professor_id',$request->proffesor_id)->first();

          
                $subject=Subjects::where('id',$datas->subjects_id)->get();

                foreach ($subject as $row) {
                    
        $data[]=array('id'=>$row->id,'subject_name'=>mb_strtoupper($row->course_subject_name),'subjects_code'=>mb_strtoupper($row->course_subject_code));

                }
            
        return $data;

    }
    


     public function checkassigned(Request $request)
    {
       
        $rooms=[];
      
      $rid=[];


         $rooms_taken=ProfessorAssigned::distinct()->select('room_id')
         ->where('day',$request->days)
         ->get();
      

         $roms=Room::get(); 
             foreach ($roms as $rms) {
                  $roomid[]=$rms->id;
             }



         if(count($rooms_taken)>0){


        
             foreach($rooms_taken as $roomavailable){

            $takens=ProfessorAssigned::where('room_id',$roomavailable->room_id)->where('day',$request->days)->orderby('time_end','DESC')->first();


            if(strtotime($takens->time_end) > strtotime($request->timestart)){
            $rid[]=$takens->room_id;
            }
                }


                $romleft=array_diff($roomid,$rid);
                // dd(strtotime($request->timestart),$request->timestart, strtotime($takens->time_end),$takens->time_end,$roomid,$rid,$romleft);

                foreach ($romleft as $res) {
                    
                    $room_av=Room::find($res);
                      $rooms[]=array('id'=>$room_av->id,'room_name'=>$room_av->room_name);
              


                }


         }else{
            $rom=Room::get();
             
             foreach ($rom as $rm) {
                  $rooms[]=array('id'=>$rm->id,'room_name'=>$rm->room_name);
             }
        

         }


  $scheduled=ProfessorAssigned::where('professor_id',$request->proffesor_id)->where('day',$request->days)->orderby('time_end','DESC')->first();




        if($scheduled){    

            if(strtotime($request->timestart) < strtotime($scheduled->time_end)){

            

            $data=array('status'=>'1','message'=>'Professor has already schedule that Time','rooms'=>[]);
            }else{


              $data=array('status'=>'0','message'=>'Select Room','rooms'=>$rooms);
            }


       

        }else{

             $data=array('status'=>'3','message'=>'Select Room','rooms'=>$rooms);
        }

        
        return $data;

    }







   

}
