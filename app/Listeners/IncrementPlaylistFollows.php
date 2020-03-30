<?php

namespace App\Listeners;

use App\Events\FollowRowCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class IncrementPlaylistFollows
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
     * @param  =FollowRowCreated  $event
     * @return void
     */
    public function handle(FollowRowCreated $event)
    {
        DB::table('playlists')
        ->where('id', '=', $event->playlist_id)
        ->increment('follows');    
    }
}
