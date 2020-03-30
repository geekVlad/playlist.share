<?php

namespace App\Providers;

use App\Events\CommentsRowDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * @param  CommentsRowDeleted  $event
     * @return void
     */
    public function handle(CommentsRowDeleted $event)
    {
        //
    }
}
