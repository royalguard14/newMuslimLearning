<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Room;
use App\Models\Courses;

class SectionRoomController extends Controller
{



    public function index()
    {

       $courses=Courses::GetData();
       $sections=Section::get();
       $rooms=Room::get();

         return view('secrom.index',compact('courses','sections','rooms'));
    }


    public function section_store(Request $request)
    {

$postdata['course_id'] = $request->course_id;
$postdata['section_name'] = mb_strtoupper($request->section_name);
$postdata['sy_from'] = $request->yr_from;
$postdata['sy_to'] = $request->yr_to;


$data = new Section($postdata);
$data->save();

     return back()->with('is_success','Saved!');
    }

     public function room_store(Request $request)
    {


$postdata['room_name'] = mb_strtoupper($request->room_name);
$postdata['room_location'] = $request->room_location;
$postdata['room_available'] = 0;



$data = new Room($postdata);
$data->save();

          return back()->with('is_success','Saved!');


    }



}
