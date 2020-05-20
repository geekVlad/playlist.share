<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Events\SongsRowCreated;
use App\Events\SongsRowDeleted;

class playlist_song extends Pivot
{
    protected $table = 'playlists_songs';
    public $timestamps = false;

    protected $dispatchesEvents = [
        'created' => SongsRowCreated::class,
        'deleted' => SongsRowDeleted::class,
    ];

    public function song()
  	{
    	return $this->belongsTo('App\Models\Song');
  	}

  	public function playlist()
  	{
    	return $this->belongsTo('App\Models\Playlist');
  	}
}
