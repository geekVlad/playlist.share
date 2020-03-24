<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class playlist_song extends Pivot
{
    protected $table = 'playlists_songs';
    public $timestamps = false;
}
