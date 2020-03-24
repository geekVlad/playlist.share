<?php

namespace App\Listeners;

use App\Events\LikesRowDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\Likes;

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

        $playlistId = $event->playlist_id;
        $userId = $event->user_id;

        DB::table('likes')
        ->where('user_id', $userId)
        ->where('playlist_id', $playlistId)
        ->delete();

        // $like = Likes::where('user_id', $userId)
        // ->where('playlist_id', $playlistId)
        // ->first();

        // $like->delete();
        //Likes::destroy(['user_id' => $userId, 'playlist_id' => $playlistId]);
    }
}
