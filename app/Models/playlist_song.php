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

}
