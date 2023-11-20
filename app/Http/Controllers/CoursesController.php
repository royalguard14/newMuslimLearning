<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Subjects;

class CoursesController extends Controller
{
    

    public function index()
    {
       

        $courses=Courses::all();
        return view('courses.index',compact('courses'));


    }


    public function store(Request $request){

     
        $postdata['course_name'] = mb_strtolower($request->name);
        $postdata['course_acronym'] = mb_strtolower($request->acro);
        $data=new Courses($postdata);
        $data->save();

            return back()->with('is_success','Saved!');
    }



 public function subject()
    {
       

        $subject=Subjects::all();

        return view('courses.subjects',compact('subject'));


    }

    public function add_subject(Request $request)
    {
        
        $postdata['course_id'] = $request->id;
        $postdata['course_sem'] =$request->sub_sem;
        $postdata['course_subject_code'] = mb_strtoupper($request->code);
        $postdata['course_subject_name'] = mb_strtolower($request->sub_name);
        $postdata['course_subject_desc'] = mb_strtolower($request->sub_dec);
       
        $data=new Subjects($postdata);
        $data->save();

         return back()->with('is_success','Saved!');
    }
}
