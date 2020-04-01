<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Song extends Model
{
    protected $table = 'songs';

    public function albums()
    {
        return $this->belongsTo('App\Models\Album');
    }

    public function artists()
    {
        return $this->belongsTo('App\Models\Artist');
    }

    public function playlists()
    {
        return $this->belongsToMany('App\Models\Playlist', 'playlists_songs');
    }
}
