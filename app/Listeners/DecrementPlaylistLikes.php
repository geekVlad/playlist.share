<?php

namespace App\Listeners;

use App\Events\LikesRowDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DecrementPlaylistLikes
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
     * @param  LikesRowDeleted  $event
     * @return void
     */
    public function handle(LikesRowDeleted $event)
    {
        DB::table('playlists')
        ->where('id', '=', $event->playlist_id)
        ->decrement('likes');
    }
}
