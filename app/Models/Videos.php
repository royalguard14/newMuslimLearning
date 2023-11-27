<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
        protected $table = 'video_library';

    protected $fillable = [

        'video_name',
        'video_path',
        'description',
        'pdf_note',
        'type',
        
                
    ];
}
