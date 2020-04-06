<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LikesRowCreated;
use App\Models\Playlist;

class IncrementPlaylistLikes
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LikesRowCreated  $event
     * @return void
     */
    public function handle(LikesRowCreated $event)
    {
        Playlist::where('id', '=', $event->playlist_id)
        ->increment('likes_count');
    }
}
