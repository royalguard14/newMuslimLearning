<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Workgroup extends Model
{
    protected $table = 'workgroups';

    protected $fillable = [

    
    	'workgroup_name',
        'department_id',
        'position_id',
        'access'        
    ];

    public function mngr(){

    	return $this->hasOne('App\User','id','head');
    }

    public static function getList(){

    	return self::pluck('workgroup_name','id');
    }

}
