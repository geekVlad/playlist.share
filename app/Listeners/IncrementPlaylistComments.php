<?php

namespace App\Listeners;

use App\Events\CommentsRowCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Playlist;

class IncrementPlaylistComments
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
     * @param  CommentsRowCreated  $event
     * @return void
     */
    public function handle(CommentsRowCreated $event)
    {
        Playlist::where('id', '=', $event->playlist_id)
        ->increment('comments_count');
    }
}
