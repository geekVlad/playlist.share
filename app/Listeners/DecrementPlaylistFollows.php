<?php

namespace App\Listeners;

use App\Events\FollowRowDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\Playlist;

class DecrementPlaylistFollows
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
     * @param  =FollowRowDeleted  $event
     * @return void
     */
    public function handle(FollowRowDeleted $event)
    {
        Playlist::where('id', '=', $event->playlist_id)
        ->decrement('follows_count');

        $playlistId = $event->playlist_id;
        $userId = $event->user_id;

        DB::table('following_playlists')
        ->where('user_id', $userId)
        ->where('playlist_id', $playlistId)
        ->delete();
    }
}
