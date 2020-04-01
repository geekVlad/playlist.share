<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\playlist_song;
use App\Events\SongRowDeleted;

class DecrementPlaylistSongs
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
    public function handle(SongRowDeleted $event)
    {
        DB::table('playlists')
        ->where('id', '=', $event->playlist_id)
        ->decrement('songs_count');

        $playlistId = $event->playlist_id;
        $userId = $event->user_id;

        DB::table('playlists_songs')
        ->where('user_id', $userId)
        ->where('playlist_id', $playlistId)
        ->delete();
    }
}
