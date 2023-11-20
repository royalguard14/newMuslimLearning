<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AccessControl extends Model
{
    protected $table = 'access_controls';

    protected $fillable = [

    	'user_id',
    	'module_id'
    ];

    public function module(){

    	return $this->hasOne('App\Models\Modules','id','module_id');
    }

    public static function ByUser($uid){

    	return self::where('user_id',$uid)->get();
    }
	
	public static function DeleteByUser($uid){

		return self::where('user_id',$uid)->delete();
	}

    public static function CheckUserModule($uid,$moduleID){

        return self::where('user_id',$uid)->where('module_id',$moduleID)->first();
    }

    public static function CheckUserModuleMultiple($uid,$modIDs){

        return self::where('user_id',$uid)->whereIn('module_id',$modIDs)->count();
    }
}
