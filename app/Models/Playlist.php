<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model{
    use HasFactory;

    protected $fillable = [
        'name', // Add any other fields you might need for your playlist
    ];

 public function videos()
{
    return $this->belongsToMany(Videos::class, 'playlist_video', 'playlist_id', 'video_id');
}

}