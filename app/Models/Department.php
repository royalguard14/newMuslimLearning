<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [

        'department_name',
        'department_head',
        'logs'
                
    ];



    public function GetList()
    {
        

        return self::select(DB::raw("UPPER(department_name) as name ,id"))               
                ->pluck('name','id');

    }

    
    


}
