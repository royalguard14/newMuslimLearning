<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollStudentController extends Controller
{
    

    public function enroll_subject(Request $request)
    {
        
        




        return response()->json(['message'=>'Successfully Enrolled'], 200);
    }



}
