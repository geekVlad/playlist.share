<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class playlist_song extends Pivot
{
    protected $table = 'playlists_songs';
    public $timestamps = false;

    public function song()
  	{
    	return $this->belongsTo('App\Models\Song');
  	}

  	public function playlist()
  	{
    	return $this->belongsTo('App\Models\Playlist');
  	}
}
