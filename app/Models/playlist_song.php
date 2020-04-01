<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Events\SongRowCreated;
use App\Events\SongRowDeleted;
use App\Models;

class playlist_song extends Pivot
{
    protected $table = 'playlists_songs';
    public $timestamps = false;

    protected $dispatchesEvents = [
        'created' => SongRowCreated::class,
        'deleted' => SongRowDeleted::class,
    ];

}
