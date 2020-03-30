<?php

namespace App\Providers;

use App\Events\LikesRowDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
