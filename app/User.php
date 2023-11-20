<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $fillable = [
        'id', 'employee_id', 'company_code', 'branch_code', 'department_id', 'position_id', 'first_name', 'middle_name', 'last_name', 'suffix_name', 'contact_number', 'email_address', 'birthday', 'address', 'address2','addedby', 'sss_id', 'pagibig_id', 'philhealth_id', 'resumefile', 'image', 'online', 'active', 'role', 'username', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function position(){

        return $this->hasOne('App\Models\Position','id','position_id');
    }

    public function department(){

        return $this->hasOne('App\Models\Department','id','dept_id');
    }

    public function workg(){

        return $this->hasOne('App\Models\Workgroup','id','workgroup');
    }

    public static function getList(){

        return DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))
                ->where('active',"1")                
                ->pluck('full_name','id');
    }

    public static function getAll(){

        return self::all();
    }

    public static function getOnDepartment($dept){

        $indUID = UserIndustry::byIndustry($dept);
        return DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))
                ->where('active',"1")
                ->whereIn('id',$indUID)
                ->pluck('full_name','id');
    }

    public static function nameExcludedme($id){    

        return self::select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))->where('active',"1")->where('id','!=',$id)->pluck('full_name','id');
    }

    public static function byProjectNotInWorgroup($proj_id){

        $user_workgroup = ProjectWorkgroup::byProject($proj_id);

        $uids = [];

        foreach($user_workgroup as $wg){

            $uids[] = $wg->user_id;
        }

        return self::select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))->where('active',"1")->whereNotIn('id',$uids)->pluck('full_name','id');
    }

    public static function filterByProjDept($proj_id,$dept_id){

        $user_workgroup = ProjectWorkgroup::byProject($proj_id);

        $uids = [];

        foreach($user_workgroup as $wg){

            $uids[] = $wg->user_id;
        }

        return self::select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))
                    ->where('active',"1")
                    ->whereIn('dept_id',$dept_id)
                    ->whereNotIn('id',$uids)
                    ->pluck('full_name','id');
    }

    public static function byJobOrderNotInWorgroup($job_id){

        $user_workgroup = JobOrderWorkgroup::byJobOrder($job_id);

        $uids = [];

        foreach($user_workgroup as $wg){

            $uids[] = $wg->user_id;
        }

        return self::select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))->where('active',"1")->whereNotIn('id',$uids)->pluck('full_name','id');
    }

    public static function FullDetails(){

        return DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))
                ->where('active',"1")
                ->pluck('full_name','id');
    }

    public static function byRequestNotMember($reqID){

        $reqUsers = UserRequestDetail::byReqID($reqID);
        $reqUserID = [];

        foreach($reqUsers as $reqUser){

            $reqUserID[] = $reqUser->reciever_id;
        }

        return DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))
                ->whereNotIn('id',$reqUserID)
                ->where('active',"1")
                ->pluck('full_name','id');
    }

    public static function byJobOrderNotMember($jobID){

        $reqUsers = JobOrderDetail::byJobID($jobID);
        $reqUserID = [];

        foreach($reqUsers as $reqUser){

            $reqUserID[] = $reqUser->reciever_id;
        }

        return DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))
                ->whereNotIn('id',$reqUserID)
                ->where('active',"1")
                ->pluck('full_name','id');
    }

    public static function getNotInCC($reqID){

        $members = UserRequestDetail::where('request_id',$reqID)->get();
        $ccs = UserRequestCc::where('request_id',$reqID)->get();
        $uIDs = [];

        foreach($members as $member){

            $uIDs[] = $member->reciever_id;
        }

        foreach($ccs as $cc){

            $uIDs[] = $cc->user_id;
        }


        return DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))
                ->whereNotIn('id',$uIDs)
                ->where('active',"1")
                ->pluck('full_name','id');
    }

    public static function getInCC($reqID){
        
        $ccs = UserRequestCc::where('request_id',$reqID)->get();
        $uIDs = [];
        

        foreach($ccs as $cc){

            $uIDs[] = $cc->user_id;
        }

        
        return DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))                
                ->whereIn('id',$uIDs)
                ->where('active',"1")
                ->pluck('full_name','id');
    }

    public static function getJobNotInCC($jobID){

        $members = JobOrderDetail::where('job_order_id',$jobID)->get();
        $ccs = JobOrderCc::where('job_order_id',$jobID)->get();
        $uIDs = [];

        foreach($members as $member){

            $uIDs[] = $member->reciever_id;
        }

        foreach($ccs as $cc){

            $uIDs[] = $cc->user_id;
        }


        return DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))
                ->whereNotIn('id',$uIDs)
                ->where('active',"1")
                ->pluck('full_name','id');
    }

    public static function getJobInCC($jobID){
        
        $ccs = JobOrderCc::where('job_order_id',$jobID)->get();
        $uIDs = [];
        

        foreach($ccs as $cc){

            $uIDs[] = $cc->user_id;
        }

        
        return DB::table('users')->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name ,id"))                
                ->whereIn('id',$uIDs)
                ->where('active',"1")
                ->pluck('full_name','id');
    }

    public static function ById($id){

        return self::where('id',$id)->first();
    }
}
