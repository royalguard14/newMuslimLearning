<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoDetails extends Model
{
          protected $table = 'video_details';

    protected $fillable = [

        'vidlib_id',
        'views',
        'likes',
        'dislikes',
        'downloads',
        'uploader',
                
    ];
}

