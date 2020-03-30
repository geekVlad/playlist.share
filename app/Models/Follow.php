<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Events\FollowRowCreated;
use App\Events\FollowRowDeleted;

class Follow extends Pivot
{
    protected $table = 'following_playlists';
    public $timestamps = false;

    protected $dispatchesEvents = [
        'created' => FollowRowCreated::class,
        'deleted' => FollowRowDeleted::class,
    ];
}

