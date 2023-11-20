<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Department;
use App\Models\User;
use App\Models\Courses;
use App\Models\Subjects;
use App\Models\ProfessorAssigned;


use Hash;

class ProfessorController extends Controller
{
    public function index()
    {

        $professors=Professor::GetData();
        $department=Department::GetList();


       return view('professor.list',compact('professors','department'));
    }


    public function store(Request $request){

$user=User::where('id_number',mb_strtolower($request->id_number))->first();

if(!$user){


$postuser['id_number'] = mb_strtolower($request->id_number);
$postuser['active'] = 1;
$postuser['online'] = 0;
$postuser['role'] = 2;
$postuser['username'] = mb_strtolower($request->id_number);
$postuser['password'] = Hash::make($request->password);

$data2 = new User($postuser);
$data2->save();



$postdata['professor_id_number'] = mb_strtolower($request->id_number);
$postdata['department_id'] = $request->department;
$postdata['professor_first_name'] = mb_strtolower($request->firstname);
$postdata['professor_middle_name'] = mb_strtolower($request->middlename);
$postdata['professor_lastname_name'] = mb_strtolower($request->lastname);
$postdata['professor_suffix'] = mb_strtolower($request->suffix);
$postdata['professor_points'] = $request->points;

       $data = new Professor($postdata);
       $data->save();


}


        return back()->with('is_success','Saved!');
    }




public function assigned()
{

    $courses=Courses::GetData();
    $assigned=ProfessorAssigned::all();


    $days=array('mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thursday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday');


    return view('professor.assigned',compact('assigned','courses','days'));
}

public function assigned_scheduled(Request $request)
{


$postdata['courses_id']=$request->course_id;
$postdata['subjects_id']=$request->subjects_id;
$postdata['end_date']=$request->end_date;
$postdata['room_id']=$request->room_id;
$postdata['professor_id']=$request->professor_id;
$postdata['day']=$request->day;
$postdata['time_start']=$request->time_start;
$postdata['time_end']=$request->time_end;

       $data = new ProfessorAssigned($postdata);
       $data->save();


 return back()->with('is_success','Saved!');
}

public function scheduled()
{
    dd('scheduled');
}




}
