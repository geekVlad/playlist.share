<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CommentsRowCreated;
use Illuminate\Support\Facades\DB;

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
     * @param  object  $event
     * @return void
     */
    public function handle(CommmentsRowCreated $event)
    {
        DB::table('playlists')
        ->where('id', '=', $event->playlist_id)
        ->increment('comments');
    }
}
