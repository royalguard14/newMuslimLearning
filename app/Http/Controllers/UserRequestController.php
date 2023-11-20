<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use App\Models\UserRequestDetail;
use App\Models\UserRequestRemark;
use App\Models\UserRequestFile;
use App\Models\UserRequestCc;
use App\Models\UserNotification;
use App\Models\User;
use App\Models\Department;
use App\Models\DepartmentSub;
use App\Models\ReminderUpdate;
use App\Models\RequestType;
use App\Events\SendRequest;
use App\Models\UserIndustry;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Response;
use Auth;



class UserRequestController extends Controller
{
   


    $id = Auth::id();

       dd($id);
    
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::orderBy('department','ASC')->pluck('department','id');        
        $date_now = Date('m/d/Y');        
        $reqtypes = RequestType::getList();
        $users = [];
        return view('user_request.create',compact('departments','date_now','reqtypes','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if(empty($request->get('reciever'))){
            return back()->with('is_required','Required');
        }else{

            $str = \Hash::make($request->details);
            $str2 = str_replace('/', "1", $str);            
            $str3 = substr($str2, 0, 25);
            $postdata = $request->all();
            $checking = UserRequest::checkCode($str3);
            while ( $checking > 0) {
                $str3 = substr($str2, 0, 25);
                $checking = UserRequest::checkCode($str3);
            }
            $postdata['request_code'] = $str3;
            $postdata['details'] = nl2br($request->details);
            $postdata['status'] = 1;
            $postdata['requestor'] = Auth::id();
            $postdata['request_no'] = "";
            $postdata['start_date'] = Date('Y-m-d',strtotime($request->get('start_date')));
            $postdata['end_date'] = Date('Y-m-d',strtotime($request->get('end_date')));
            $postdata['subject'] = $request->subject;

            //user_request table
            $user_request = new UserRequest($postdata);
            $user_request->save();
            $user_request->request_no = "UR".$user_request->id;
            $user_request->update();            

            //user_request_details table            
            $sender = Auth::user();
            $email_adds = [];
            foreach($postdata['reciever'] as $reciever){

                $user = User::findOrFail($reciever);
                $user_request_details = new UserRequestDetail();
                $user_request_details->request_id = $user_request->id;
                $user_request_details->reciever_id = $reciever;
                $user_request_details->dept_id = $request->department_id;                
                $user_request_details->save();
                               
                if($user_request->recuring == 1){
                    
                    $upd = "DAILY";
                    $date1 = date_create($request->start_date);
                    $date2 = date_create($request->end_date);
                    $counter2=date_diff($date1,$date2);  
                    $counter = $counter2->days;

                    if($counter < 1){
                        $counter=1;
                    }
                }
                elseif($user_request->recuring == 2){

                    $upd = "WEEKLY";                    
                    $endDate = strtotime($request->end_date);
                    $days=array('1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday','7'=>'Sunday');
                    
                    for($i = strtotime(Date('l',strtotime($request->start_date)), strtotime($request->start_date)); $i <= $endDate; $i = strtotime('+1 week', $i))
                    
                    $date_array[]=date('Y-m-d',$i);
                    $cntdate = count($date_array);
                    
                    if($cntdate < 1){
                         $counter=1;
                    }else{
                         $counter=$cntdate-1;
                    }
                }
                else{
                    
                    $upd = "MONTHLY";
                    $start = new \DateTime($request->start_date);
                    $end = new \DateTime($request->end_date);
                    $counter = $start->diff($end)->m;

                    if($counter < 1){
                        $counter=1;
                    }
                }                            
                

                $email_adds[] = $user->email.'^'."REQUEST #: ".$user_request->request_no.'^'.$user_request->start_date.' - '.$user_request->end_date.'^'.strtoupper($user->first_name.' '.$user->last_name).'^'.$upd;

                $user_notificaton = new UserNotification();
                $user_notificaton->user_id = $reciever;
                $user_notificaton->details = strtoupper($sender->first_name.' '.$sender->last_name).' TAGGED YOU IN A REQUEST';
                $user_notificaton->ref_link = "UR-".$user_request->request_code;
                $user_notificaton->save();                
                $post2['info'] = $user_request->request_no;
                $post2['link'] = $user_request->request_code;

                $post2['last_update'] = Date('Y-m-d H:i:s',strtotime($user_request->updated_at));

                $post2['cnt_need'] = $counter;
                $post2['cnt_donw'] = 0;
                $post2['type'] = $user_request->recuring;
                $post2['user_id'] = $reciever;
                $post2['created_by'] = Auth::id();       
                
                $reminder = ReminderUpdate::savePayload($post2);
            }
            $cntFile = 0;
            $destinationPath = "";
            $filesSending = [];
            if($request->hasFile('attached')){                 
                $files = Input::file('attached');                        
                if(!empty($files)){
                    $cntFile = 1;
                    $destinationPath = storage_path().'/uploads/UR/'. $user_request->id;
                    if (!\File::exists($destinationPath))
                    {
                        mkdir($destinationPath, 0755, true); 
                    }  

                    foreach ($files as $file) {
                        $filename = $file->getClientOriginalName();
                        $file->move($destinationPath, $filename);      

                        $hashname = \Hash::make($filename);

                        $enc = str_replace("/","", $hashname);

                        $user_request_file = new UserRequestFile();
                        $user_request_file->request_id = $user_request->id;
                        $user_request_file->filename = $filename;
                        $user_request_file->encrpytname = $enc;
                        $user_request_file->download = 0;          
                        $user_request_file->uploaded_by = $sender->id;        
                        $user_request_file->save();       

                        $filesSending[] = $filename;
                    }                      
                }                                 
            }                        
            if(!empty($request->get('cc'))){

                $reqID = $user_request->id;
                foreach($request->get('cc') as $ccs) {

                    $cc = new UserRequestCc();                    
                    $cc->request_id = $reqID;
                    $cc->user_id = $ccs;

                    $cc->save();                    
                }
            }
            if(!empty($email_adds)){                
                foreach($email_adds as $email){

                    $breakdown = explode('^', $email);                    
                    if(filter_var($breakdown[0], FILTER_VALIDATE_EMAIL)) {
                        
                        \Mail::send('emails.user_request',
                            [
                                "data"=>$postdata['details'],
                                "range"=>$breakdown[2],                         
                                "name"=>$breakdown[3],
                                "needupdate" =>$breakdown[4]
                            ],function($m) use($sender,$breakdown,$cntFile,$destinationPath,$filesSending){
                            $m->from($sender->email,strtoupper($sender->first_name.' '.$sender->last_name));
                            $m->to($breakdown[0])->subject($breakdown[1]);           
                            if($cntFile > 0){
                                foreach($filesSending as $fsending){

                                    $m->attach($destinationPath.'/'.$fsending);         
                                }                                
                            }
                        
                        });                        
                    }             
                }
            }
            broadcast(new SendRequest($user_request,Auth::user()))->toOthers();
            
            return redirect('user_request')->with('is_success','saved');
        }
    }

    public function filterUserDept(Request $request){

        $users = UserIndustry::bydept($request->get('dept_id'));


        return Response::json($users);
    }

    public function userCC(Request $request){

        $cc = UserIndustry::notInList($request->users_id);

        return Response::json($cc);
    }
}
