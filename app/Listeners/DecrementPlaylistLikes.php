<?php

namespace App\Listeners;

use App\Events\LikesRowDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\Playlist;

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
        Playlist::where('id', '=', $event->playlist_id)
        ->decrement('likes_count');

        $playlistId = $event->playlist_id;
        $userId = $event->user_id;

        DB::table('likes')
        ->where('user_id', $userId)
        ->where('playlist_id', $playlistId)
        ->delete();
    }
}