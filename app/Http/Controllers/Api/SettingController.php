<?php

namespace App\Http\Controllers\Api;
use App\Models\Professor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SettingController extends Controller
{
    

    public function connect(Request $request)
    {
      return ['message'=>'connected na.'];

// $zhie =  base64_encode(env('APP_KEY'));
// if($zhie == $request->openid ) {
// $data=Status::all();

// return response()->json(['status'=>$data,'message'=>'connected'], 200);

// //return ['message'=>'connected'];
// }
// else{
// return ['message'=>'Contact Developer'];

// }

    }


    public function getData(Request $request)
    {

        $professor = Professor::join('users', 'professor_id_number', '=', 'users.id_number')
                    ->where('users.role',2)
                    ->get();


          return response()->json(['professor'=>$professor], 200);

    }


    
}
