<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'modules';

    protected $fillable = [

    	'module',
    	'description',
    	'routeUri',
    	'icon',
    	'default_url',
    	'encryptname'
    ];

    public static function getAll(){

    	return self::all();
    }

    public static function savePayload($payload){

        $module = static::query()->create($payload);

        return $module;
    }

    public static function updatePayload($payload,$id){

        $module = Modules::findOrFail($id);
        $module->fill($payload)->save();

        return $module;
    }
}
