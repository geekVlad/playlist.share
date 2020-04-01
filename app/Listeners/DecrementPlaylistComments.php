<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CommentsRowDeleted;
use Illuminate\Support\Facades\DB;

class DecrementPlaylistComments
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
    public function handle(CommentsRowDeleted $event)
    {
        DB::table('playlists')
        ->where('id', '=', $event->playlist_id)
        ->decrement('comments_count');
    }
}
