<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Courses;
use App\Models\User;
use App\Models\StudentEnrolled;
use App\Models\Subjects;
use App\Models\ProfessorAssigned;

use Hash;
use DB;

class StudentController extends Controller
{
    

    public function index()
    {

        $students=Student::all();
        $courses=Courses::pluck('course_acronym','id');

          return view('student.list',compact('students','courses'));
    }


    public function store(Request $request){


$user=User::where('id_number',mb_strtolower($request->id_number))->first();

date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        

if(!$user){


$postuser['id_number'] = mb_strtolower($request->id_number);
$postuser['active'] = 1;
$postuser['online'] = 0;
$postuser['role'] = 3;
$postuser['username'] = mb_strtolower($request->id_number);
$postuser['password'] = Hash::make($request->password);

$data2 = new User($postuser);
$data2->save();



$postdata['enrolled'] = $request->enrolled;
$postdata['course_id'] = $request->course_id;
$postdata['section_id'] = $request->section_id;
$postdata['student_id_number'] = mb_strtolower($request->id_number);
$postdata['student_first_name'] = mb_strtolower($request->firstname);
$postdata['student_middle_name'] = mb_strtolower($request->middlename);
$postdata['student_lastname_name'] = mb_strtolower($request->lastname);
$postdata['student_suffix'] = mb_strtolower($request->suffix);
$postdata['logs'] = 'Register date: '.$date;


       $data = new Student($postdata);
       $data->save();


}


        return back()->with('is_success','Saved!');


    }


    public function assigned()
    {

        $profid=isset($_GET['professor_id']) && !is_null($_GET['professor_id']) && !empty($_GET['professor_id']) ? $_GET['professor_id'] : null;

        $subcode=isset($_GET['subjects_id']) && !is_null($_GET['subjects_id']) && !empty($_GET['subjects_id']) ? $_GET['subjects_id'] : null;


         $profs=User::join('professor', 'id_number', '=', 'professor.professor_id_number')
                    ->select(DB::raw("UPPER(CONCAT(professor.professor_first_name,' ',professor.professor_lastname_name)) as full_name ,professor.id"))
                    ->where('users.role',2)
                    ->pluck('full_name','id');
                

        if(($profid) && ($subcode)){


           $subs=Subjects::pluck('course_subject_name','id'); 

           $getsubject=ProfessorAssigned::where('professor_id',$profid)->where('subjects_id',$subcode)->first();

           $enrolled=StudentEnrolled::where('professor_assigned_id',$getsubject->id)->get();

        }else{
            $getsubject=[];
            $subs=[]; 
            $enrolled=[];
           
        }


         return view('student.assigned',compact('profs','profid','subs','subcode','enrolled','getsubject'));
    }



}
