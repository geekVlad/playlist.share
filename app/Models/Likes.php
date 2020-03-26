<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\LikesRowCreated;
use App\Events\LikesRowDeleted;
use App\Models;

class Likes extends Model
{
    protected $table = 'likes';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'playlist_id',
    ];
    
    protected $dispatchesEvents = [
        'created' => LikesRowCreated::class,
        'deleted' => LikesRowDeleted::class,
    ];

    public function playlists()
    {
       return $this->belongsTo('App\Models\Playlist', 'likes');
    }
}
