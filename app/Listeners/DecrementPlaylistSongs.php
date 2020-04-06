<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SongsRowDeleted;
use Illuminate\Support\Facades\DB;
use App\Models\Playlist;

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
    public function handle(SongsRowDeleted $event)
    {
        $playlistId = $event->playlist_id;
        $songId = $event->song_id;

        Playlist::where('id', '=', $playlistId)
        ->decrement('songs_count');

        DB::table('playlists_songs')
        ->where('song_id', $songId)
        ->where('playlist_id', $playlistId)
        ->delete();
    }
}
