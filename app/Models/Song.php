<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Song extends Model
{
    protected $table = 'songs';

    public function album()
    {
        return $this->belongsTo('App\Models\Album');
    }

    public function artist()
    {
        return $this->belongsTo('App\Models\Artist');
    }

    public function playlists()
    {
        return $this->belongsToMany('App\Models\Playlist', 'playlists_songs');
    }
}
