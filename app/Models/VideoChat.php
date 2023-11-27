<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoChat extends Model
{
       use HasFactory;

    protected $table = 'video_chats';

    protected $fillable = [
        'video_id',
        'user_id',
        'message',
    ];
}
